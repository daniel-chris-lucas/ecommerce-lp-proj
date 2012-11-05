<h2>Edit: <?= $country->name ?></h2>

<?= Form::open() ?>
	<p>
		<label for="name">Name :</label>
		<input type="text" name="name" id="name" placeholder="Country Name" value="<?php echo $val->validated( 'name', $country->name ) ?>">
		<?php // echo $val->error( 'username' ) ? '<p class="form_error">' . $val->error( 'username' ) . '</p>' : '' ?>
	</p>
	<p>
		<label for="iso">ISO :</label>
		<input type="text" name="iso" id="iso" placeholder="ISO" value="<?php echo $val->validated( 'iso', $country->iso ) ?>">
		<?php // echo $val->error( 'password' ) ? '<p class="form_error">' . $val->error( 'password' ) . '</p>' : '' ?>
	</p>
	<p>
		<label for="iso3">ISO3 :</label>
		<input type="text" name="iso3" id="iso3" placeholder="ISO3" value="<?php echo $val->validated( 'iso3', $country->iso3 ) ?>">
		<?php // echo $val->error( 'password' ) ? '<p class="form_error">' . $val->error( 'password' ) . '</p>' : '' ?>
	</p>
	<p>
		<button type="submit" class="btn btn-primary">Edit Country</button>
	</p>
</form>