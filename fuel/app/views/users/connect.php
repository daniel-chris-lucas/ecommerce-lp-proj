<style>
	.controls { float: none; margin-top: 5px; }
</style>

<!-- start login part -->
<div class="title_bg">
    <h2 class="title">Login</h2>
</div>

<?php echo Input::get( 'red' ) ? Form::open( Uri::current().'?red='.Input::get( 'red' ) ) : Form::open() ?>
	<div class="control-group <?php if( $val->error( 'username' ) ) echo 'error' ?>">
		<label class="control-label" for="username">Username :</label>
		<div class="controls">
			<input type="text" name="username" id="username" placeholder="Username">
			<?php echo $val->error( 'username' ) ? "<span class='help-inline'>{$val->error( 'username' )}</span>" : '' ?>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<div class="control-group <?php if( $val->error( 'password' ) ) echo 'error' ?>">
		<label class="control-label" for="password">Password :</label>
		<div class="controls">
			<input type="password" name="password" id="password" placeholder="Password">
			<?php echo $val->error( 'password' ) ? "<span class='help-inline'>{$val->error( 'username' )}</span>" : '' ?>
		</div>
	</div>
	
	<p>
		<button type="submit" class="btn btn-primary">Sign In</button>
	</p>
</form>
<!-- end login part -->

<!-- start register part -->
<div class="title_bg">
    <h2 class="title">Register</h2>
</div>

<p>New user? By creating an account you will be able to shop faster, be up to date on our latest products...</p>
<a href="<?php echo Uri::create( 'users/register' ) ?>" class="btn">Register Now</a>
<!-- end register part -->