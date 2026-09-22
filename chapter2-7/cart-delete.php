<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
unset($_SESSION['product'][$_REQUEST['id']]);
require 'cart.php';
?>
<?php require '../footer.php'; ?>
