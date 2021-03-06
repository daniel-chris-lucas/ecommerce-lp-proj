<div class="title_bg">
    <h2 class="title">Register Account</h2>
</div>


<?php echo Form::open() ?>

	<div class="span6" style="margin-left: 0">
		<div class="title_bg">
		    <h3 class="title">Personal Details</h3>
		</div>

		<input type="text" name="first_name" id="first_name" placeholder="First Name">
		<input type="text" name="last_name" id="last_name" placeholder="Last Name">
		<input type="email" name="email" id="email" placeholder="E-Mail Address">
		<input type="text" name="tel" id="tel" placeholder="Telephone">
		<label style="display: block">Date of birth</label>
		<select name="birth_day" id="birth_day" style="width: 105px">
			<option>--- Day ---</option>
			<?php foreach ($birth_days as $birth_day): ?>
				<option value="<?php echo $birth_day ?>"> <?php echo $birth_day ?> </option>
			<?php endforeach; ?>
		</select>
		<select name="birth_month" id="birth_month" style="width: 125px">
			<option>--- Month ---</option>
			<?php foreach ($birth_months as $birth_month): ?>
				<option value=" <?php echo $birth_month ?> "> <?php echo $birth_month ?> </option>
			<?php endforeach; ?>
		</select>
		<select name="birth_year" id="birth_year" style="width: 115px">
			<option>--- Year ---</option>
			<?php foreach ($birth_years as $birth_year): ?>
				<option value=" <?php echo $birth_year ?> "> <?php echo $birth_year ?> </option>
			<?php endforeach; ?>
		</select>

	</div>

	<div class="span6">
		<div class="title_bg">
		    <h3 class="title">Your Address</h3>
		</div>
		<input type="text" name="street" id="street" placeholder="Street Name">
		<input type="text" name="street_number" id="street_number" placeholder="Street Number">
		<input type="text" name="town" id="town" placeholder="Town">
		<select name="country" id="country">
			<option>--- Country ---</option>
			<?php foreach ($countries as $country): ?>
				<option value=" <?php echo $country['id'] ?> "> <?php echo $country['name'] ?> </option>
			<?php endforeach; ?>
		</select>

	</div>

	<div class="clearfix"></div>
	<!-- nettoye tous les float, on repart à la ligne -->

	<div class="span6"  style="margin-left: 0">
		<div class="title_bg">
		    <h3 class="title">Account Details</h3>
		</div>
		<input type="text" name="username" id="username" placeholder="Username">
		<input type="password" name="password" id="password" placeholder="Password">
		<input type="password" name="password_confirm" id="password_confirm" placeholder="Password Again">

		<p>
			<button type="submit" class="btn btn-primary"> Register </button>
		</p>

	</div>



</form>
