<h2>Create New Category</h2>

<?= Form::open() ?>
	<div class="control-group <?php if( $val->error( 'name' ) ) echo 'error' ?>">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" placeholder="Category Name" value="<?= $val->validated( 'name' ) ?>">
		<?php echo $val->error( 'name' ) ? '<span class="help-inline">' . $val->error( 'name' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'slug' ) ) echo 'error' ?>">
		<label for="slug">Slug:</label>
		<input type="text" name="slug" id="slug" placeholder="eg: computers-office">
		<?php echo $val->error( 'slug' ) ? '<span class="help-inline">' . $val->error( 'slug' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'parent' ) ) echo 'error' ?>">
		<label for="parent">Parent Category:</label>
		<select name="parent" id="parent">
			<option value="">--- Parent Category ---</option>
			<?php foreach( $categories as $category ) : ?>
				<option value="<?= $category->id ?>"><?= $category->name ?></option>
			<?php endforeach; ?>
		</select>
		<?php echo $val->error( 'parent' ) ? '<span class="help-inline">' . $val->error( 'parent' ) . '</span>' : '' ?>
	</div>
	<p>
		<button type="submit" class="btn btn-primary">Add Category</button>
		<a href="<?= Uri::create( 'admin/categories' ) ?>" class="btn">Return to Categories</a>
	</p>
</form>