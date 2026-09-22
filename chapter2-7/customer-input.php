<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<h2 class="search-title">会員登録</h2>
<?php
$name=$address=$login=$password='';
if (isset($_SESSION['customer'])) {
	$name=$_SESSION['customer']['name'];
	$address=$_SESSION['customer']['address'];
	$login=$_SESSION['customer']['login'];
	$password=$_SESSION['customer']['password'];
}
?>
<form class="customer" action="customer-output.php" method="post">
	<div class="customer-field">
		お　名　前：<input class="customer-input" type="text" name="name"
			value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
	</div>
	<div class="customer-field">
		ご　住　所：<input class="customer-input" type="text" name="address"
			value="<?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?>">
	</div>
	<div class="customer-field">
		ログイン名：<input class="customer-input" type="text" name="login"
			value="<?= htmlspecialchars($login, ENT_QUOTES, 'UTF-8') ?>">
	</div>
	<div class="customer-field">
		パスワード：<input class="customer-input" type="password" name="password"
			value="<?= htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?>">
	</div>
	<input class="customer-btn" type="submit" value="確定">
</form>
<?php require '../footer.php'; ?>
