<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>

<?php
$pdo = new PDO(
	'mysql:host=********;dbname=********;charset=utf8',
	'********',
	'********'
);

if (!isset($_SESSION['customer'])) {

	echo '<p class="not-cart">購入手続きを行うにはログインしてください。</p>';

} else if (empty($_SESSION['product'])) {

	echo '<p class="not-cart">カートに商品がありません。</p>';

} else {

	$purchase_id = 1;

	foreach ($pdo->query('select max(id) as max_id from purchase') as $row) {
		if ($row['max_id'] !== null) {
			$purchase_id = $row['max_id'] + 1;
		}
	}

	$sql = $pdo->prepare(
		'insert into purchase
		(id, customer_id, purchase_date)
		values (?, ?, now())'
	);

	if ($sql->execute([
		$purchase_id,
		$_SESSION['customer']['id']
	])) {

		$total = 0;

		foreach ($_SESSION['product'] as $product_id => $product) {

			$sql = $pdo->prepare(
				'insert into purchase_detail
				(purchase_id, product_id, count)
				values (?, ?, ?)'
			);

			$sql->execute([
				$purchase_id,
				$product_id,
				$product['count']
			]);

			// 在庫を減らす
			$sql = $pdo->prepare(
				'update product
				set stock = stock - ?
				where id = ?'
			);

			$sql->execute([
				$product['count'],
				$product_id
			]);

			$total += $product['price'] * $product['count'];
		}

		$original_total = $total;

		if (
			isset($_POST['coupon']) &&
			$_SESSION['customer']['coupon_count'] > 0
		) {
			$discount = floor($total * 0.1);
			$total -= $discount;

			$sql = $pdo->prepare(
				'update customer
				set coupon_count = coupon_count - 1
				where id = ?'
			);

			$sql->execute([
				$_SESSION['customer']['id']
			]);

			$_SESSION['customer']['coupon_count']--;

			echo '<div class="coupon-use">';
			echo '<p>クーポンを使用しました。</p>';
			echo '<p>割引額：', number_format($discount), '円</p>';
			echo '</div>';
		}

		echo '<p class="purchase-thank">';
		echo '<strong>', number_format($total), '</strong>';
		echo '円のご購入が完了しました。ありがとうございます。';
		echo '</p>';

		if ($original_total >= 5000) {

			$sql = $pdo->prepare(
				'update customer
				set coupon_count = coupon_count + 1
				where id = ?'
			);

			$sql->execute([
				$_SESSION['customer']['id']
			]);

			$_SESSION['customer']['coupon_count']++;

			echo '<p class="coupon-plus">';
			echo '5000円以上購入したため、クーポンが1回分増えました。';
			echo '</p>';
		}

		// 購入完了後にカートを空にする
		unset($_SESSION['product']);

	} else {

		echo '<p class="not-cart">';
		echo '購入手続き中にエラーが発生しました。';
		echo '</p>';
	}
}
?>

<?php require '../footer.php'; ?>
