<div class="title_bg">
    <h2 class="title">My Account</h2>
</div>

<div class="title_bg">
    <h3 class="title">Account Details</h3>
</div>

<p>
	First Name: <b><?php echo $current_user->first_name ?></b><br>
	Last Name: <b><?php echo $current_user->last_name ?></b><br>
	Date of Birth: <b><?php echo $current_user->date_of_birth ?></b><br>
	Email Address: <b><?php echo $current_user->email ?></b><br>
	Tel: <b><?php echo $current_user->tel ?></b><br>
	<br>
	Street: <b><?php echo $current_user->street ?></b><br>
	Street Number: <b><?php echo $current_user->street_number ?></b><br>
	Town: <b><?php echo $current_user->town ?></b><br>
	Country: <b><?php echo $current_user->country->name ?></b><br>
	<br>
	Username: <b><?php echo $current_user->username ?></b><br>
	<a href="<?php echo Uri::create( 'users/edit' ) ?>" class="btn">Edit Account</a>
</p>