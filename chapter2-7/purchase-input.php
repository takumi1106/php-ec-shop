<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<h2 class="search-title">購入手続き</h2>
<?php
if (!isset($_SESSION['customer'])) {
	echo '<p class="cart-plus">','購入手続きを行うにはログインしてください。','</p>';
} else if (empty($_SESSION['product'])) {
	echo '<p class="cart-plus">','カートに商品がありません。','</p>';
} else {
	require 'cart.php';
	echo '<hr>';
	echo '<div class="customer-info">';
	echo '<p class="customer-name">','<strong>','お名前：','</strong>', $_SESSION['customer']['name'],' 様', '</p>';
	echo '<p class="customer-address">','<strong>','ご住所：','</strong>', $_SESSION['customer']['address'], '</p>';
	echo '</div>';
	echo '<p class="confirm-message">内容をご確認いただき、購入を確定してください。</p>';
	echo '<div class="coupon">';
	echo '<p class="coupon-numbers">','<strong>','クーポン残り：','</strong>', $_SESSION['customer']['coupon_count'], '回</p>';
	echo '<p class="coupon-explanation">※5,000円以上のお買い上げでクーポンを1枚獲得できます。</p>';
	echo '</div>';
	echo '<form class="coupon-form" action="purchase-output.php" method="post">';
	if ($_SESSION['customer']['coupon_count'] > 0) {
		echo '<label>';
		echo '<input class="coupon-check" type="checkbox" name="coupon" value="1">';
		echo 'クーポンを使用する（合計金額から10%OFF）';
		echo '</label><br><br>';
	} else {
		echo '<p>使用できるクーポンがありません。</p>';
	}
	echo '<input class="coupon-confirmed" type="submit" value="購入を確定">';
	echo '</form>';
}
?>

<?php require '../footer.php'; ?>