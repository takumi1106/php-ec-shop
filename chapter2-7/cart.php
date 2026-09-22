<h2 class="search-title">カート</h2>

<?php
if (!empty($_SESSION['product'])) {

	$total = 0;

	echo '<div class="cart-items">';

	foreach ($_SESSION['product'] as $id => $product) {

		$subtotal = $product['price'] * $product['count'];
		$total += $subtotal;

		echo '<div class="purchase-item">';

		echo '<a class="purchase-image" href="detail.php?id=', $id, '">';
		echo '<img src="images/', $id, '.png" alt="', $product['name'], '">';
		echo '</a>';

		echo '<div class="purchase-info">';

		echo '<p class="purchase-id">No.', $id, '</p>';

		echo '<h3>';
		echo '<a href="detail.php?id=', $id, '">';
		echo $product['name'];
		echo '</a>';
		echo '</h3>';

		echo '<p class="purchase-price">';
		echo $product['price'], '円 × ', $product['count'], '個';
		echo '</p>';

		echo '<p class="purchase-subtotal">';
		echo '<strong>小計：</strong>', $subtotal, '円';
		echo '</p>';

		echo '</div>';
		echo '<a class="cart-delete-btn" href="cart-delete.php?id=', $id, '">';
		echo '削除';
		echo '</a>';
		echo '</div>';
	}

	echo '<div class="purchase-total">';
	echo '<span>合計</span>';
	echo '<strong>', $total, '円</strong>';
	echo '</div>';

	echo '</div>';

} else {
	echo '<p class="not-cart">カートに商品がありません。</p>';
}
?>