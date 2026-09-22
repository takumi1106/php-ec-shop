<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$pdo=new PDO('mysql:host=********;dbname=********;charset=utf8',
	'********', '********');
if (isset($_SESSION['customer'])) {
	$id=$_SESSION['customer']['id'];
	$sql=$pdo->prepare('select * from customer where id!=? and login=?');
	$sql->execute([$id, $_REQUEST['login']]);
} else {
	$sql=$pdo->prepare('select * from customer where login=?');
	$sql->execute([$_REQUEST['login']]);
}
if (empty($sql->fetchAll())) {
	if (isset($_SESSION['customer'])) {
		$sql=$pdo->prepare('update customer set name=?, address=?, '.
			'login=?, password=? where id=?');
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'],
			$_REQUEST['login'], $_REQUEST['password'], $id]);
		$_SESSION['customer']=[
			'id'=>$id, 'name'=>$_REQUEST['name'],
			'address'=>$_REQUEST['address'], 'login'=>$_REQUEST['login'],
			'password'=>$_REQUEST['password'],
			'coupon_count'=>$_SESSION['customer']['coupon_count']];
		echo '<p class="login-message">お客様情報を更新しました。</p>';
	} else {
		$sql=$pdo->prepare(
			'insert into customer (name, address, login, password, coupon_count) '.
			'values (?, ?, ?, ?, 0)'
		);
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'],
			$_REQUEST['login'], $_REQUEST['password']]);
		echo '<p class="login-message">お客様情報を登録しました。</p>';
	}
} else {
	echo '<p class="login-message">ログイン名がすでに使用されていますので、変更してください。</p>';
}
?>
<?php require '../footer.php'; ?>
