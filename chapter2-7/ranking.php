<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>

<h2 class="search-title">人気ランキング</h2>

<?php
$pdo = new PDO(
	'mysql:host=********;dbname=********;charset=utf8',
	'********',
	'********'
);

$sql = $pdo->query(
	'select product.id, product.name, product.price,
	sum(purchase_detail.count) as total_count
	from purchase_detail
	join product on purchase_detail.product_id = product.id
	group by product.id, product.name, product.price
	order by total_count desc'
);

$rank = 0;
$number = 0;
$previous_count = null;

echo '<div class="products">';

foreach ($sql as $row) {
	$number++;

	if ($previous_count !== $row['total_count']) {
		$rank = $number;
	}

	echo '<div class="card">';

	echo '<a href="detail.php?id=', $row['id'], '">';

	echo '<img src="images/', $row['id'], '.png" alt="', $row['name'], '">';

	echo '<div class="card-header">';
	echo '<p class="product-id rank-', $rank, '">', $rank, '位</p>';
	echo '<h3 class="card-name">', $row['name'], '</h3>';
	echo '</div>';

	echo '<div class="card-info">';
	echo '<p class="price"><strong>値段：</strong><label>', $row['price'], '</label>円</p>';
	echo '<p class="stock"><strong>購入数：</strong><label>', $row['total_count'], '</label>個</p>';
	echo '</div>';

	echo '</a>';

	echo '</div>';

	$previous_count = $row['total_count'];
}

echo '</div>';
?>

<?php require '../footer.php'; ?>
