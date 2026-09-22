<?php require '../header.php'; ?>

<h2 class="search-title">お気に入り</h2>

<?php
if (isset($_SESSION['customer'])) {

	$pdo = new PDO(
		'mysql:host=********;dbname=********;charset=utf8',
		'********',
		'********'
	);

	$sql = $pdo->prepare(
		'select product.*
		from favorite
		join product on favorite.product_id = product.id
		where favorite.customer_id = ?'
	);

	$sql->execute([
		$_SESSION['customer']['id']
	]);

	$found = false;

	echo '<div class="products">';

	foreach ($sql as $row) {
		$found = true;
		$id = $row['id'];

		echo '<div class="card">';

		echo '<a href="detail.php?id=', $id, '">';

		echo '<img src="images/', $id, '.png" alt="', $row['name'], '">';

		echo '<div class="card-header">';
		echo '<p class="product-id">No.', $id, '</p>';
		echo '<h3 class="card-name">', $row['name'], '</h3>';
		echo '</div>';

		echo '<div class="card-info">';
		echo '<p class="price">';
		echo '<strong>値段：</strong>';
		echo '<label>', $row['price'], '</label>円';
		echo '</p>';
		if ($row['stock'] > 0) {
		echo '<p class="stock"><strong>在庫：</strong>','<label>', $row['stock'], '</label>','個</p>';
	} else {
		echo '<p class="soldout">売り切れ</p>';
	}

	echo '</div>';

		echo '</a>';

		echo '<form class="favorite-delete-form" action="favorite-delete.php" method="post">';
		echo '<input type="hidden" name="id" value="', $id, '">';
		echo '<button class="favorite-delete-btn" type="submit">お気に入りから削除</button>';
		echo '</form>';

		echo '</div>';
	}

	if (!$found) {
		echo '<p class="not-found">お気に入りの商品はありません。</p>';
	}

	echo '</div>';

} else {
	echo '<p class="not-found">お気に入りを表示するにはログインしてください。</p>';
}
?>

<?php require '../footer.php'; ?>
