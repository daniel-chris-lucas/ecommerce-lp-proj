<h2><?= ucfirst( $user->first_name ) ?> <?= strtoupper( $user->last_name ) ?></h2>

<ul style="margin-left: 0;">
	<li>First Name: <b><?= ucfirst( $user->first_name ) ?></b></li>
	<li>Last Name: <b><?= strtoupper( $user->last_name ) ?></b></li>
	<li>Date of Birth: <b><?= $user->date_of_birth ?></b></li>
	<li>Street: <b><?= $user->street ?></b></li>
	<li>Street Number: <b><?= $user->street_number ? $user->street_number : '-' ?></b></li>
	<li>Town: <b><?= $user->town ?></b></li>
	<li>Country: <b><?= $user->country->name ?></b></li>
	<li>Telephone: <b><?= $user->tel ? $user->tel : '-' ?></b></li>
	<li>Email Address: <b><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></b></li>
	<li>Role: <b><?= $user->role->name ?></b></li>
</ul>

<p>
	<a href="<?= Uri::create( 'admin/users' ) ?>" class="btn">Return to Users</a>
</p>