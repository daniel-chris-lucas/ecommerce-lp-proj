<div class="title_bg">
    <h2 class="title">Login</h2>
</div>

<?php echo Form::open() ?>

	<p>
		<label for="username">Username : </label>
		<input type="text" name="username" id="username" placeholder="Username">
	</p>

	<p>
		<label for="password">Password : </label>
		<input type="password" name="password" id="password" placeholder="Password">
	</p>

	<p>
		<button type="submit" class="btn btn-primary">Sign In</button>
	</p>


</form>

<div class="title_bg">
    <h2 class="title">Register</h2>
</div>

<a href="<?php echo Uri::create('users/register') ?>" class="btn">Register Now</a>