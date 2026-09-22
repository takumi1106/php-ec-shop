<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
	unset($_SESSION['product']);
	unset($_SESSION['account_token']);
	session_regenerate_id(true);
	$message = 'ログアウトしました。';
	$message_class = 'is-success';
	$message_icon = '✓';
} else {
	$message = 'すでにログアウトしています。';
	$message_class = 'is-info';
	$message_icon = 'i';
}
?>
<?php require 'menu.php'; ?>
<div class="logout-message <?= $message_class ?>">
	<span class="logout-message-icon" aria-hidden="true"><?= $message_icon ?></span>
	<p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
	<a href="product.php">商品ページへ戻る</a>
</div>
<?php require '../footer.php'; ?>
