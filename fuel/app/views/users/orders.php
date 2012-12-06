<style>
	.total {
		color: #38414b;
		float: right;
		font-size: 21px;
		margin-bottom: 10px;
		margin-top: 10px;
		margin-right: 30px;
	}

	.bigprice { font-weight: bold; }
</style>

<div class="title_bg">
    <h2 class="title">Order #<?= $order->id ?></h2>
</div>

<p>Date: <?= date( 'd/m/Y', $order->created_at ) ?></p>

<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Item No.</th>
			<th>Unit Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $order->orderproducts as $product ) : ?>
			<tr>
				<td><?= $product->name ?></td>
				<td><?= $product->id ?></td>
				<td><?= number_format( (float)$product->price, 2, '.', '' ) ?></td>
				<td><?= $product->quantity ?></td>
				<td><?= number_format( (float)($product->price * $product->quantity), 2, '.', '' ) ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="total">
	Total: <span class="bigprice">&euro; <?= number_format( (float) $order->total, 2, '.', '' ) ?></span>
</div>