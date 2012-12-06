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

	.updaters button { float: right; }
</style>

<div class="title_bg">
    <h2 class="title">Shopping Cart</h2>
</div>

<?= Form::open() ?>
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
						<td><input type="text" name="quantity_<?= $i ?>" id="name" value="<?= $product['quantity'] ?>" class="input-mini"></td>
						<td>&euro; <?= number_format( (float) $product['unit_price'], 2, '.', '' ) ?></td>
						<td>&euro; <?= number_format( (float) $product_total, 2, '.', '' ) ?></td>						
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	
	<aside class="span3 offset9">
		<div class="total">
			Total: <span class="bigprice">&euro; <?= number_format( (float) $sub_total, 2, '.', '' ) ?></span>
		</div>
		
		<div class="clearfix"></div>
		
		<div class="updaters clearfix">
			<button type="submit" class="btn btn-danger" name="submit" value="update" style="margin-right: 30px;">Update</button>
			<button type="submit" class="btn btn-danger" name="submit" value="checkout" style="margin-right: 15px;">Checkout</button>
		</div>
		
		<a href="<?= Uri::base() ?>" class="btn" style="margin-top: 15px; margin-left: 75px;">Continue Shopping</a>
	</aside>
</form>