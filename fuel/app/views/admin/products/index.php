<h2>Products</h2>

<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Category</th>
			<th>Description</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $products as $product ) : ?>
			<tr>
				<td><?= $product->id ?></td>
				<td><?= $product->name ?></td>
				<td><?= $product->category_id ?></td>
				<td><?= Str::truncate( $product->description, 100 ) ?></td>
				<td>€ <?= $product->price ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>