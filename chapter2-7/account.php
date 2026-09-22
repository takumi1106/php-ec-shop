<?php
session_start();

if (!isset($_SESSION['customer'])) {
	header('Location: login-input.php');
	exit;
}

if ($_SESSION['customer']['login'] !== '********_10') {
	header('Location: product.php');
	exit;
}

if (empty($_SESSION['account_token'])) {
	$_SESSION['account_token'] = bin2hex(random_bytes(32));
}

$pdo = new PDO(
	'mysql:host=********;dbname=********;charset=utf8',
	'********',
	'********',
	[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$customers = $pdo->query(
	'select id, name, login, coupon_count from customer order by id'
);
$products = $pdo->query('select id, name, stock from product order by id');
$message = $_SESSION['account_message'] ?? '';
unset($_SESSION['account_message']);

require '../header.php';
require 'menu.php';
?>

<h2 class="search-title">マイページ</h2>

<?php if ($message !== ''): ?>
	<p class="account-message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<section class="account-panel">
	<h3>ユーザーのクーポン</h3>
	<div class="stock-list">
	<?php foreach ($customers as $customer): ?>
		<form class="stock-row" action="account-update.php" method="post">
			<input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['account_token'], ENT_QUOTES, 'UTF-8') ?>">
			<input type="hidden" name="target" value="coupon">
			<input type="hidden" name="customer_id" value="<?= (int) $customer['id'] ?>">
			<span class="stock-product"><?= htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8') ?>（<?= htmlspecialchars($customer['login'], ENT_QUOTES, 'UTF-8') ?>）</span>
			<span class="stock-current"><span>残り</span><strong><?= (int) $customer['coupon_count'] ?></strong><span>回</span></span>
			<label>変更数
				<input type="number" name="amount" min="1" max="999" value="1" required>
			</label>
			<button type="submit" name="operation" value="increase">増やす</button>
			<button type="submit" name="operation" value="decrease">減らす</button>
		</form>
	<?php endforeach; ?>
	</div>
</section>

<section class="account-panel">
	<h3>商品在庫</h3>
	<div class="stock-list">
	<?php foreach ($products as $product): ?>
		<form class="stock-row" action="account-update.php" method="post">
			<input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['account_token'], ENT_QUOTES, 'UTF-8') ?>">
			<input type="hidden" name="target" value="stock">
			<input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
			<span class="stock-product">No.<?= (int) $product['id'] ?> <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></span>
			<span class="stock-current"><span>残り</span><strong><?= (int) $product['stock'] ?></strong><span>個</span></span>
			<label>変更数
				<input type="number" name="amount" min="1" max="9999" value="1" required>
			</label>
			<button type="submit" name="operation" value="increase">増やす</button>
			<button type="submit" name="operation" value="decrease">減らす</button>
		</form>
	<?php endforeach; ?>
	</div>
</section>

<?php require '../footer.php'; ?>
