<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<h2 class="login-title">ログイン名とパスワードを入力してください。</h2>
<form class="login" action="login-output.php" method="post">
<div class="logi-name_M">ログイン名：<input class="login-name" type="text" name="login"></div>
<div class="logi-pass_M">パスワード：<input class="login-pass" type="password" name="password"></div>
<input class="login-btn" type="submit" value="ログイン">
</form>
<?php require '../footer.php'; ?>
