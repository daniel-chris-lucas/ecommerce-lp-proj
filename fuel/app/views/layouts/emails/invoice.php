<!doctype html>
<html>
<head>
	<title>Shopping: Order #<?= $order_id ?></title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Order #<?= $order_id ?></h1>
	<p>
		Thank you for purchasing your products from our store. Below are the details of your order.
	</p>
	<p>
		Date: <?= date( 'd/m/Y' ) ?><br>
		Order Number: <?= $order_id ?>
	</p>

	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $products as $product ) : ?>
				<?php $sub_total += ( $product['unit_price'] * $product['quantity'] ); ?>
				<tr>
					<td><?= $product['item_no'] ?></td>
					<td><?= $product['name'] ?></td>
					<td><?= $product['quantity'] ?></td>
					<td><?= $product['unit_price'] ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<span class="price">Total: &euro; <?= $sub_total ?></span>
</body>
</html>