<h2>Categories</h2>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Parent</th>
			<th style="width: 72px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $categories as $category ) : ?>
			<tr>
				<td><?= $category->name ?></td>
				<td><?php echo !empty( $category->parent_id ) ? $category->parent->name : '-' ?></td>
				<td style="padding-top: 4px;">
					<a href="<?= Uri::create( 'admin/categories/edit/' . $category->id ) ?>" class="table-icons edit">Edit</a>
					<a href="<?= Uri::create( 'admin/categories/delete/' . $category->id ) ?>" 
						onclick="return confirm('Are you sure you want to delete this category?');" class="table-icons delete">Delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>