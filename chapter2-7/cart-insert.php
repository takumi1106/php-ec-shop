<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$id=$_REQUEST['id'];
if (!isset($_SESSION['product'])) {
	$_SESSION['product']=[];
}
$count=0;
if (isset($_SESSION['product'][$id])) {
	$count=$_SESSION['product'][$id]['count'];
}
$_SESSION['product'][$id]=[
	'name'=>$_REQUEST['name'],
	'price'=>$_REQUEST['price'],
	'count'=>$count+$_REQUEST['count']
];
echo '<p class="cart-plus">カートに商品を追加しました。</p>';
require 'cart.php';
?>
<?php require '../footer.php'; ?>
