<div class="title_bg">
    <h2 class="title">Edit Account</h2>
</div>

<?php echo Form::open() ?>
	<div class="span6" style="margin-left: 0;">
		<div class="title_bg">
		    <h2 class="title">Personal Details</h2>
		</div>
		<input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $val->validated( 'first_name', $current_user->first_name ) ?>">
		<input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $val->validated( 'last_name', $current_user->last_name ) ?>">
		<?php echo $val->error( 'first_name' ) ? '<p class="form_error">' . $val->error( 'first_name' ) . '</p>' : '' ?>
		<?php echo $val->error( 'last_name' ) ? '<p class="form_error">' . $val->error( 'last_name' ) . '</p>' : '' ?>
		<input type="email" name="email" id="email" placeholder="E-Mail" value="<?php echo $val->validated( 'email', $current_user->email ) ?>">
		<input type="text" name="tel" id="tel" placeholder="Telephone" value="<?php echo $val->validated( 'tel', $current_user->tel ) ?>">
		<?php echo $val->error( 'email' ) ? '<p class="form_error">' . $val->error( 'email' ) . '</p>' : '' ?>
		<?php echo $val->error( 'tel' ) ? '<p class="form_error">' . $val->error( 'tel' ) . '</p>' : '' ?>
		<br>
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
		<?php echo $val->error( 'birth_day' ) ? '<p class="form_error">' . $val->error( 'birth_day' ) . '</p>' : '' ?>
		<?php echo $val->error( 'birth_month' ) ? '<p class="form_error">' . $val->error( 'birth_month' ) . '</p>' : '' ?>
		<?php echo $val->error( 'birth_year' ) ? '<p class="form_error">' . $val->error( 'birth_year' ) . '</p>' : '' ?>
	</div>
	<div class="span6">
		<div class="title_bg">
		    <h2 class="title">Your Address</h2>
		</div>
		<input type="text" name="street" id="street" placeholder="Street Name" value="<?php echo $val->validated( 'street', $current_user->street ) ?>">
		<input type="text" name="street_number" id="street_number" placeholder="Street Number" value="<?php echo $val->validated( 'street_number', $current_user->street_number ) ?>">
		<?php echo $val->error( 'street' ) ? '<p class="form_error">' . $val->error( 'street' ) . '</p>' : '' ?>
		<?php echo $val->error( 'street_number' ) ? '<p class="form_error">' . $val->error( 'street_number' ) . '</p>' : '' ?>
		<input type="text" name="town" id="town" placeholder="Town" value="<?php echo $val->validated( 'town', $current_user->town ) ?>">
		<select name="country" id="country">
			<option value="">---Country---</option>
			<?php foreach( $countries as $country ) : ?>
				<option value="<?php echo $country['id'] ?>" <?php if( $country['id'] == $val->validated( 'country', $current_user->country_id ) ) echo 'selected=selected'?>>
					<?php echo $country['name'] ?>
				</option>
			<?php endforeach ?>
		</select>
		<?php echo $val->error( 'town' ) ? '<p class="form_error">' . $val->error( 'town' ) . '</p>' : '' ?>
		<?php echo $val->error( 'country' ) ? '<p class="form_error">' . $val->error( 'country' ) . '</p>' : '' ?>
	</div>
	<div class="clearfix"></div>
	<div class="span6" style="margin-left: 0;">
		<div class="title_bg">
		    <h2 class="title">Account Details</h2>
		</div>
		<input type="text" name="username" id="username" placeholder="Username" value="<?php echo $val->validated( 'username', $current_user->username ) ?>">
		<input type="password" name="password" id="password" placeholder="Password" value="<?php echo $val->validated( 'password' ) ?>">
		<input type="password" name="password_confirm" id="password_confirm" placeholder="Password Again" value="<?php echo $val->validated( 'password_confirm' ) ?>">
		<?php echo $val->error( 'username' ) ? '<p class="form_error">' . $val->error( 'username' ) . '</p>' : '' ?>
		<?php echo $val->error( 'password' ) ? '<p class="form_error">' . $val->error( 'password' ) . '</p>' : '' ?>
		<?php echo $val->error( 'password_confirm' ) ? '<p class="form_error">' . $val->error( 'password_confirm' ) . '</p>' : '' ?>
		<p>
			<button class="btn btn-primary">Save Changes</button>
		</p>
	</div>
</form>