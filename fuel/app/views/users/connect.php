<!-- start login part -->
<div class="title_bg">
    <h2 class="title">Login</h2>
</div>

<?php echo Form::open() ?>
	<p>
		<label for="username">Username :</label>
		<input type="text" name="username" id="username" placeholder="Username">
	</p>
	<p>
		<label for="password">Password :</label>
		<input type="text" name="password" id="password" placeholder="Password">
	</p>
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
<a href="<?php echo Uri::create( 'users/register' ) ?>" class="btn btn">Register Now</a>
<!-- end register part -->