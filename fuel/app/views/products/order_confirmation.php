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

	.updaters a { float: right; }
</style>

<div class="title_bg">
    <h2 class="title">Order Confirmation</h2>
</div>

<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr>
			<th>Image</th>
			<th>Name</th>
			<th>Item no.</th>
			<th>Quantity</th>
			<th>Unit Price</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php if( !empty( $products ) ) : ?>
			<?php $i = 0; ?>
			<?php foreach( $products as $product ) : ?>
				<?php $product_total = $product['unit_price'] * $product['quantity']; ?>
				<?php $sub_total += $product_total ?>
				<tr>
					<td><img src="<?= $product['img_location'] . DS . $product['image'] ?>"></td>
					<td><?= $product['name'] ?></td>
					<td><?= $product['item_no'] ?></td>
					<td><?= $product['quantity'] ?></td>
					<td>&euro; <?= number_format( (float) $product['unit_price'], 2, '.', '' ) ?></td>
					<td>&euro; <?= number_format( (float) $product_total, 2, '.', '' ) ?></td>						
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>

<aside class="span4 offset8">
	<div class="total">
		Total: <span class="bigprice">&euro; <?= number_format( (float) $sub_total, 2, '.', '' ) ?></span>
	</div>

	<div class="clearfix"></div>
	
	<div class="updaters clearfix">
		<a href="<?= Uri::create( 'shopping-cart/buy' ) ?>" class="btn btn-danger" style="margin-right: 30px;">Confirm &amp; Buy</a>
		<a href="<?= Uri::create( 'shopping-cart/cancel' ) ?>" class="btn" style="margin-right: 15px;">Cancel Order</a>
		<a href="<?= Uri::create( 'shopping-cart' ) ?>" class="btn" style="margin-right: 15px;">Return</a>
	</div>
</aside>