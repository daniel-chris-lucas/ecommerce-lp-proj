<h2>Products</h2>

<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Category</th>
			<th>Description</th>
			<th>Price</th>
			<th style="width: 110px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $products as $product ) : ?>
			<tr>
				<td><?= $product->id ?></td>
				<td><?= $product->name ?></td>
				<td><?= $product->category->name ?></td>
				<td><?= Str::truncate( $product->description, 100 ) ?></td>
				<td>€ <?= $product->price ?></td>
				<td style="padding-top: 4px;">
					<a href="<?= Uri::create( 'admin/products/view/' . $product->id ) ?>" class="table-icons view">View</a>
					<a href="<?= Uri::create( 'admin/products/edit/' . $product->id ) ?>" class="table-icons edit">Edit</a>
					<a href="<?= Uri::create( 'admin/products/delete/' . $product->id ) ?>" onclick="return confirm( 'Are you sure you want to delete this product?' );" 
					class="table-icons delete">Delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>