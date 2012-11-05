<h2>Create New Country</h2>

<?= Form::open() ?>
	<div class="control-group <?php if( $val->error( 'name' ) ) echo 'error' ?>">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" placeholder="Country Name">
		<?php echo $val->error( 'name' ) ? '<span class="help-inline">' . $val->error( 'name' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'iso' ) ) echo 'error' ?>">
		<label for="iso">ISO:</label>
		<input type="text" name="iso" id="iso" placeholder="ISO">
		<?php echo $val->error( 'iso' ) ? '<span class="help-inline">' . $val->error( 'iso' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'iso3' ) ) echo 'error' ?>">
		<label for="iso3">ISO3:</label>
		<input type="text" name="iso3" id="iso3" placeholder="ISO3">
		<?php echo $val->error( 'iso3' ) ? '<span class="help-inline">' . $val->error( 'iso3' ) . '</span>' : '' ?>
	</div>
	<p>
		<button type="submit" class="btn btn-primary">Add Country</button>
	</p>
</form>