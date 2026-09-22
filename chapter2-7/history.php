<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>

<h2 class="search-title">購入履歴</h2>

<?php
if (isset($_SESSION['customer'])) {

	$pdo = new PDO(
		'mysql:host=********;dbname=********;charset=utf8',
		'********',
		'********'
	);

	$sql_purchase = $pdo->prepare(
		'select * from purchase
		where customer_id=?
		order by id desc'
	);

	$sql_purchase->execute([
		$_SESSION['customer']['id']
	]);

	$purchases = $sql_purchase->fetchAll(PDO::FETCH_ASSOC);

	if (empty($purchases)) {
		echo '<p class="history-login">購入履歴はありません。</p>';
	}

	foreach ($purchases as $row_purchase) {

		echo '<section class="purchase-history">';

		echo '<p class="purchase-date">';
		echo '<span>購入日：</span>';
		echo date(
			'Y/m/d H:i',
			strtotime($row_purchase['purchase_date'])
		);
		echo '</p>';

		$sql_detail = $pdo->prepare(
			'select * from purchase_detail, product
			where purchase_id=?
			and product_id=id'
		);

		$sql_detail->execute([
			$row_purchase['id']
		]);

		$total = 0;

		echo '<div class="purchase-items">';

		foreach ($sql_detail as $row_detail) {

			$subtotal = $row_detail['price'] * $row_detail['count'];
			$total += $subtotal;

			echo '<div class="purchase-item">';

			echo '<a class="purchase-image" href="detail.php?id=',
				$row_detail['id'], '">';

			echo '<img src="images/', $row_detail['id'], '.png" alt="',
				$row_detail['name'], '">';

			echo '</a>';

			echo '<div class="purchase-info">';

			echo '<p class="purchase-id">No.',
				$row_detail['id'], '</p>';

			echo '<h3 class="purchase-name">';
			echo '<a href="detail.php?id=', $row_detail['id'], '">';
			echo $row_detail['name'];
			echo '</a>';
			echo '</h3>';

			echo '<p class="purchase-price">';
			echo $row_detail['price'], '円 × ',
				$row_detail['count'], '個';
			echo '</p>';

			echo '<p class="purchase-subtotal">';
			echo '<strong>','小計:','</strong>', $subtotal, '円';
			echo '</p>';

			echo '</div>';
			echo '</div>';
		}

		echo '</div>';

		echo '<div class="purchase-total">';
		echo '<span>合計</span>';
		echo '<strong>', $total, '円</strong>';
		echo '</div>';

		echo '</section>';
	}

} else {
	echo '<p class="history-login">';
	echo '購入履歴を表示するには、ログインしてください。';
	echo '</p>';
}
?>

<?php require '../footer.php'; ?>
