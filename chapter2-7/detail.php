<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<h2 class="search-title">商品詳細</h2>
<?php
$pdo = new PDO(
	'mysql:host=********;dbname=********;charset=utf8',
	'********',
	'********'
);

$sql = $pdo->prepare('select * from product where id=?');
$sql->execute([$_REQUEST['id']]);

foreach ($sql as $row) {
	echo '<div class="detail-inner">';

	echo '<p>';
	echo '<img class="detail-img" alt="', $row['name'], '" src="images/', $row['id'], '.png">';
	echo '</p>';

	echo '<div class="card-header detail-header">';
echo '<p class="detail-id product-id">No.', $row['id'], '</p>';
echo '<h3 class="card-name detail-card-name">', $row['name'], '</h3>';

if (isset($_SESSION['customer'])) {
	$favorite_sql = $pdo->prepare(
		'select * from favorite where customer_id=? and product_id=?'
	);

	$favorite_sql->execute([
		$_SESSION['customer']['id'],
		$row['id']
	]);

	$favorite = $favorite_sql->fetch();

	if ($favorite) {
		echo '<form class="favorite-form" action="favorite-delete.php" method="post">';
		echo '<input type="hidden" name="id" value="', $row['id'], '">';
		echo '<button class="favorite-btn active" type="submit" aria-label="お気に入りから削除">★</button>';
		echo '</form>';
	} else {
		echo '<form class="favorite-form" action="favorite-insert.php" method="post">';
		echo '<input type="hidden" name="id" value="', $row['id'], '">';
		echo '<button class="favorite-btn" type="submit" aria-label="お気に入りに追加">☆</button>';
		echo '</form>';
	}
}

echo '</div>';

	echo '<div class="card-info">';
	echo '<p class="price detail-price">';
	echo '<strong>値段：</strong>';
	echo '<label>', $row['price'], '</label>円';
	echo '</p>';

	if ($row['stock'] > 0) {
		echo '<p class="stock detail-stock">';
		echo '<strong>在庫：</strong>';
		echo '<label>', $row['stock'], '</label>個';
		echo '</p>';

		echo '</div>';

		echo '<div class="detail-count">';

		echo '<form class="detail-form" action="cart-insert.php" method="post">';

		echo '<label class="pieces">個数：</label>';

		echo '<input class="count-cart" type="number" name="count" min="1" max="',
			$row['stock'], '" value="1">';

		echo '<input type="hidden" name="id" value="', $row['id'], '">';
		echo '<input type="hidden" name="name" value="', $row['name'], '">';
		echo '<input type="hidden" name="price" value="', $row['price'], '">';

		echo '<input class="plus" type="submit" value="追加">';

		echo '</form>';
		echo '</div>';

	} else {
		echo '</div>';
		echo '<p class="soldout">売り切れのため購入できません。</p>';
	}

	echo '</div>';
}
?>

<script>
document.querySelectorAll('.favorite-form').forEach((form) => {
	form.addEventListener('submit', async (event) => {
		event.preventDefault();

		const button = form.querySelector('.favorite-btn');
		const formData = new FormData(form);

		try {
			const response = await fetch(form.action, {
				method: 'POST',
				body: formData
			});

			if (!response.ok) {
				throw new Error('お気に入りの更新に失敗しました。');
			}

			if (button.classList.contains('active')) {
				button.classList.remove('active');
				button.textContent = '☆';
				button.setAttribute('aria-label', 'お気に入りに追加');
				form.action = 'favorite-insert.php';
			} else {
				button.classList.add('active');
				button.textContent = '★';
				button.setAttribute('aria-label', 'お気に入りから削除');
				form.action = 'favorite-delete.php';
			}
		} catch (error) {
			alert(error.message);
		}
	});
});
</script>

<?php require '../footer.php'; ?>
