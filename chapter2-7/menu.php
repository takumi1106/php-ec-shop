<div class="nav">
<a href="product.php">商品</a>
<a href="ranking.php">ランキング</a>
<a href="favorite-show.php">お気に入り</a>
<a href="history.php">購入履歴</a>
<a href="cart-show.php">カート</a>
<a href="purchase-input.php">購入</a>
<?php if (isset($_SESSION['customer'])): ?>
<?php if ($_SESSION['customer']['login'] === '********_10'): ?>
<a href="account.php">マイページ</a>
<?php endif; ?>
<a href="logout-input.php">ログアウト</a>
<?php else: ?>
<a href="login-input.php">ログイン</a>
<a href="customer-input.php">会員登録</a>
<?php endif; ?>
</div>
<hr>
