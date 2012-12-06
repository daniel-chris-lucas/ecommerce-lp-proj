<h2>Edit: <?= ucfirst( $user->first_name ) ?> <?= strtoupper( $user->last_name ) ?></h2>

<?php echo Form::open() ?>
	<!-- start personal details -->
	<div class="span6" style="margin-left: 0;">
		<div class="title_bg">
		    <h3 class="title">Personal Details</h3>
		</div>
		
		<div class="control-group <?php if( $val->error( 'first_name' ) ) echo 'error' ?>" style="float: left; margin-right: 3px;">
			<input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $val->validated( 'first_name', $user->first_name ) ?>">
		</div>
		<div class="control-group <?php if( $val->error( 'last_name' ) ) echo 'error' ?>">
			<input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $val->validated( 'last_name', $user->last_name ) ?>">
		</div>
		<?php echo $val->error( 'first_name' ) ? '<p class="form_error">' . $val->error( 'first_name' ) . '</p>' : '' ?>
		<?php echo $val->error( 'last_name' ) ? '<p class="form_error">' . $val->error( 'last_name' ) . '</p>' : '' ?>
		
		<div class="control-group <?php if( $val->error( 'email' ) ) echo 'error' ?>" style="float: left; margin-right: 3px;">
			<input type="email" name="email" id="email" placeholder="E-Mail" value="<?php echo $val->validated( 'email', $user->email ) ?>">
		</div>
		<div class="control-group <?php if( $val->error( 'tel' ) ) echo 'error' ?>">
			<input type="text" name="tel" id="tel" placeholder="Telephone" value="<?php echo $val->validated( 'tel', $user->tel ) ?>">
		</div>
		<?php echo $val->error( 'email' ) ? '<p class="form_error">' . $val->error( 'email' ) . '</p>' : '' ?>
		<?php echo $val->error( 'tel' ) ? '<p class="form_error">' . $val->error( 'tel' ) . '</p>' : '' ?>
		
		<div class="control-group <?php if( $val->error( 'birth_day' ) || $val->error( 'birth_month' ) || $val->error( 'birth_year' ) ) echo 'error' ?>">
			<label style="display: block;">Date of Birth :</label>
			<select name="birth_day" id="birth_day" style="width: 105px;">
				<option>--- Day ---</option>
				<?php foreach( $birth_days as $birth_day ) : ?>
					<option value="<?php echo $birth_day ?>" <?php if( $birth_day == $val->validated( 'birth_day', $current_birth_day ) ) echo 'selected=selected'?>>
						<?php echo $birth_day ?>
					</option>
				<?php endforeach ?>
			</select>
			<select name="birth_month" id="birth_month" style="width: 125px;">
				<option>--- Month ---</option>
				<?php foreach( $birth_months as $birth_month_k => $birth_month_v ) : ?>
					<option value="<?php echo $birth_month_k ?>"  <?php if( $birth_month_k == $val->validated( 'birth_month', $current_birth_month ) ) echo 'selected=selected'?>>
						<?php echo $birth_month_v ?>
					</option>
				<?php endforeach ?>
			</select>
			<select name="birth_year" id="birth_year" style="width: 115px;">
				<option>--- Year ---</option>
				<?php foreach( $birth_years as $birth_year ) : ?>
					<option value="<?php echo $birth_year ?>"  <?php if( $birth_year == $val->validated( 'birth_year', $current_birth_year ) ) echo 'selected=selected'?>>
						<?php echo $birth_year ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
		<?php echo $val->error( 'birth_day' ) ? '<p class="form_error">' . $val->error( 'birth_day' ) . '</p>' : '' ?>
		<?php echo $val->error( 'birth_month' ) ? '<p class="form_error">' . $val->error( 'birth_month' ) . '</p>' : '' ?>
		<?php echo $val->error( 'birth_year' ) ? '<p class="form_error">' . $val->error( 'birth_year' ) . '</p>' : '' ?>
	</div>
	<!-- end personal details -->
	
	<!-- start address -->
	<div class="span6">
		<div class="title_bg">
		    <h3 class="title">Your Address</h3>
		</div>
		
		<div class="control-group <?php if( $val->error( 'street' ) ) echo 'error' ?>" style="float: left; margin-right: 3px;">
			<input type="text" name="street" id="street" placeholder="Street Name" value="<?php echo $val->validated( 'street', $user->street ) ?>">
		</div>
		<div class="control-group <?php if( $val->error( 'street_number' ) ) echo 'error' ?>">
			<input type="text" name="street_number" id="street_number" placeholder="Street Number" value="<?php echo $val->validated( 'street_number', $user->street_number ) ?>">
		</div>
		<?php echo $val->error( 'street' ) ? '<p class="form_error">' . $val->error( 'street' ) . '</p>' : '' ?>
		<?php echo $val->error( 'street_number' ) ? '<p class="form_error">' . $val->error( 'street_number' ) . '</p>' : '' ?>
		
		<div class="control-group <?php if( $val->error( 'town' ) ) echo 'error' ?>" style="float: left; margin-right: 3px;">
			<input type="text" name="town" id="town" placeholder="Town" value="<?php echo $val->validated( 'town', $user->town ) ?>">
		</div>
		<div class="control-group <?php if( $val->error( 'country' ) ) echo 'error' ?>">
			<select name="country" id="country">
				<option value="">---Country---</option>
				<?php foreach( $countries as $country ) : ?>
					<option value="<?php echo $country['id'] ?>" <?php if( $country['id'] == $val->validated( 'country', $user->country_id ) ) echo 'selected=selected'?>>
						<?php echo $country['name'] ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
		<?php echo $val->error( 'town' ) ? '<p class="form_error">' . $val->error( 'town' ) . '</p>' : '' ?>
		<?php echo $val->error( 'country' ) ? '<p class="form_error">' . $val->error( 'country' ) . '</p>' : '' ?>
	</div>
	<!-- end address -->
	
	<div class="clearfix"></div>
	
	
	<div class="span6" style="margin-left: 0;">
		<div class="title_bg">
		    <h3 class="title">Account Details</h3>
		</div>
		
		<div class="control-group <?php if( $val->error( 'username' ) ) echo 'error' ?>" style="float: left; margin-right: 3px;">
			<input type="text" name="username" id="username" placeholder="Username" value="<?php echo $val->validated( 'username', $user->username ) ?>">
		</div>
		<div class="control-group <?php if( $val->error( 'password' ) ) echo 'error' ?>">
			<input type="password" name="password" id="password" placeholder="Password" value="<?php echo $val->validated( 'password' ) ?>">
		</div>
		<div class="control-group <?php if( $val->error( 'password_confirm' ) ) echo 'error' ?>" style="float: left; margin-right: 3px;">
			<input type="password" name="password_confirm" id="password_confirm" placeholder="Password Again" value="<?php echo $val->validated( 'password_confirm' ) ?>">
		</div>
			
		<div class="control-group <?php if( $val->error( 'role' ) ) echo 'error' ?>">
			<select name="role" id="role">
				<option value="">---Role---</option>
				<?php foreach( $roles as $role ) : ?>
					<option value="<?php echo $role['id'] ?>" <?php if( $role['id'] == $val->validated( 'role', $user->role_id ) ) echo 'selected=selected'?>>
						<?php echo ucfirst( $role['name'] ) ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
		
		<?php echo $val->error( 'username' ) ? '<p class="form_error">' . $val->error( 'username' ) . '</p>' : '' ?>
		<?php echo $val->error( 'password' ) ? '<p class="form_error">' . $val->error( 'password' ) . '</p>' : '' ?>
		<?php echo $val->error( 'password_confirm' ) ? '<p class="form_error">' . $val->error( 'password_confirm' ) . '</p>' : '' ?>		
		<?php echo $val->error( 'role' ) ? '<p class="form_error">' . $val->error( 'role' ) . '</p>' : '' ?>
		
		<p>
			<button class="btn btn-primary">Save Changes</button>
			<a class="btn" href="<?= Uri::create( 'admin/users' ) ?>">Return to Users</a>
		</p>
	</div>
</form>