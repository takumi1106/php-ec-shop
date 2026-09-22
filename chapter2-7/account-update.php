<?php
session_start();

function backWithMessage($message) {
	$_SESSION['account_message'] = $message;
	header('Location: account.php');
	exit;
}

if (!isset($_SESSION['customer'])) {
	header('Location: login-input.php');
	exit;
}

if ($_SESSION['customer']['login'] !== '********_10') {
	header('Location: product.php');
	exit;
}

if (
	!isset($_POST['token'], $_SESSION['account_token']) ||
	!hash_equals($_SESSION['account_token'], $_POST['token'])
) {
	backWithMessage('不正なリクエストです。もう一度操作してください。');
}

$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
$operation = $_POST['operation'] ?? '';
$target = $_POST['target'] ?? '';

if (
	$amount === false || $amount === null || $amount < 1 || $amount > 9999 ||
	!in_array($operation, ['increase', 'decrease'], true)
) {
	backWithMessage('変更数は1以上の整数で入力してください。');
}

$delta = $operation === 'increase' ? $amount : -$amount;
$pdo = new PDO(
    'mysql:host=********;dbname=********;charset=utf8',
    '********',
    '********',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

if ($target === 'coupon') {
	if ($amount > 999) {
		backWithMessage('クーポンの変更数は999回以下で入力してください。');
	}
	$customerId = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
	if ($customerId === false || $customerId === null || $customerId < 1) {
		backWithMessage('ユーザーが正しく選択されていません。');
	}

	$sql = $pdo->prepare(
		'update customer set coupon_count = coupon_count + ? where id = ? and coupon_count + ? >= 0'
	);
	$sql->execute([$delta, $customerId, $delta]);

	if ($sql->rowCount() !== 1) {
		backWithMessage('クーポン残数を0回未満にはできません。');
	}

	if ($customerId === (int) $_SESSION['customer']['id']) {
		$_SESSION['customer']['coupon_count'] += $delta;
	}
	backWithMessage('ユーザーのクーポン残数を変更しました。');
}

if ($target === 'stock') {
	$productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
	if ($productId === false || $productId < 1) {
		backWithMessage('商品が正しく選択されていません。');
	}

	$sql = $pdo->prepare(
		'update product set stock = stock + ? where id = ? and stock + ? >= 0'
	);
	$sql->execute([$delta, $productId, $delta]);

	if ($sql->rowCount() !== 1) {
		backWithMessage('商品が存在しないか、在庫を0個未満にしようとしています。');
	}

	backWithMessage('商品の在庫数を変更しました。');
}

backWithMessage('変更対象が正しくありません。');
