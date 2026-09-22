<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php
$previousCustomerId = $_SESSION['customer']['id'] ?? null;
unset($_SESSION['customer']);

$pdo = new PDO('mysql:host=********;dbname=********;charset=utf8', '********', '********');

$sql = $pdo->prepare('select * from customer where login=? and password=?');
$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);

foreach ($sql as $row) {
	// 別ユーザーのカートを引き継がない。
	if ($previousCustomerId !== null && (int) $previousCustomerId !== (int) $row['id']) {
		unset($_SESSION['product']);
	}
	$_SESSION['customer'] = [
		'id' => $row['id'],
		'name' => $row['name'],
		'address' => $row['address'],
		'login' => $row['login'],
		'password' => $row['password'],
		'coupon_count' => $row['coupon_count']
	];
}

if (isset($_SESSION['customer'])) {
	session_regenerate_id(true);
	$message = 'いらっしゃいませ、' . $_SESSION['customer']['name'] . 'さん。';
} else {
	// 認証に失敗した状態で以前のカートだけが残らないようにする。
	if ($previousCustomerId !== null) {
		unset($_SESSION['product']);
	}
	$message = 'ログイン名またはパスワードが違います。';
}
?>
<?php require 'menu.php'; ?>
<p class="login-message">
	<?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
</p>
<?php require '../footer.php'; ?>
