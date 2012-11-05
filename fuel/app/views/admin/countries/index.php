<h2>Countries</h2>

<?= Pagination::create_links() ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>ISO</th>
			<th>ISO3</th>
			<th style="width: 72px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $countries as $country ) : ?>
			<tr>
				<td><?= $country['name'] ?></td>
				<td><?= $country['iso'] ?></td>
				<td><?= $country['iso3'] ?></td>
				<td style="padding-top: 4px;">
					<a href="<?= Uri::create( 'admin/countries/edit/' . $country['id'] ) ?>" class="table-icons edit">Edit</a>
					<a href="<?= Uri::create( 'admin/countries/delete/' . $country['id'] ) ?>" class="table-icons delete">Delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>