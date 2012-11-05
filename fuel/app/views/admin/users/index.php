<h2>User List</h2>

<?= Pagination::create_links() ?>

<table class="table table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Age</th>
			<th>Email</th>
			<th>Country</th>
			<th>Role</th>
			<th style="width: 110px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $users as $user ) : ?>
			<tr>
				<td><?= $user->id ?></td>
				<td><?= ucfirst( $user->first_name ) ?> <?= strtoupper( $user->last_name ) ?></td>
				<td><?= Model_User::age_from_dob( $user->date_of_birth ) ?></td>
				<td><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td>
				<td><?= $user->country->name ?></td>
				<td><?= ucfirst( $user->role->name ) ?></td>
				<td style="padding-top: 4px;">
					<a href="<?= Uri::create( 'admin/users/view/' . $user->id ) ?>" class="table-icons view">View</a>
					<a href="<?= Uri::create( 'admin/users/edit/' . $user->id ) ?>" class="table-icons edit">Edit</a>
					<a href="<?= Uri::create( 'admin/users/delete/' . $user->id ) ?>" onclick="return confirm( 'Are you sure you want to delete this user?' );" 
					class="table-icons delete">Delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>