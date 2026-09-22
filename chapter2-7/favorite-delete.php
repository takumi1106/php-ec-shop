<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=********;dbname=********;charset=utf8',
		'********', '********');
	$sql=$pdo->prepare(
		'delete from favorite where customer_id=? and product_id=?');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
} else {
	echo 'お気に入りから商品を削除するには、ログインしてください。';
}
require 'favorite.php';
?>
<?php require '../footer.php'; ?>
