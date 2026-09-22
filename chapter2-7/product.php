<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>

<form class="search-form" action="product.php" method="post">
	<h2 class="search-title">商品検索</h2>
	<div class="search-box">
		<input class="search-name" type="text" name="keyword" placeholder="商品名を入力">
		<input class="search-submit" type="submit" value="検索">
	</div>
</form>

<hr>

<h2 class="search-title">商品一覧</h2>

<?php
echo '<div class="products">';

$pdo = new PDO('mysql:host=********;dbname=********;charset=utf8', '********', '********');
echo '接続OK<br>';

echo '商品数：' . $pdo->query('SELECT COUNT(*) FROM product')->fetchColumn();

if (isset($_REQUEST['keyword'])) {
	$sql = $pdo->prepare('select * from product where name like ?');
	$sql->execute(['%' . $_REQUEST['keyword'] . '%']);
} else {
	$sql = $pdo->query('select * from product');
}

$found = false;

foreach ($sql as $row) {
	$found = true;

	$id = $row['id'];

	echo '<div class="card">';
	echo '<a href="detail.php?id=', $id, '">';
	echo '<img src="images/', $id, '.png">';

	echo '<div class="card-header">';
	echo '<p class="product-id">No.', $id, '</p>';
	echo '<h3 class="card-name">', $row['name'], '</h3>';
	echo '</div>';

	echo '<div class="card-info">';
	echo '<p class="price"><strong>値段：</strong>', '<label>',$row['price'],'</label>', '円</p>';

	if ($row['stock'] > 0) {
		echo '<p class="stock"><strong>在庫：</strong>','<label>', $row['stock'], '</label>','個</p>';
	} else {
		echo '<p class="soldout">売り切れ</p>';
	}

	echo '</div>';
	echo '</a>';
	echo '</div>';
}

if (!$found) {
	echo '<p class="not-found">該当する商品はありません。</p>';
}

echo '</div>';
?>

<?php require '../footer.php'; ?>
