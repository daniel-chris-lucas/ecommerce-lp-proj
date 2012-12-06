<h2>Edit Category: <?= $category->name ?></h2>

<?= Form::open() ?>
	<div class="control-group <?php if( $val->error( 'name' ) ) echo 'error' ?>">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" placeholder="Category Name" value="<?php echo $val->validated( 'name', $category->name ) ?>">
		<?php echo $val->error( 'name' ) ? '<span class="help-inline">' . $val->error( 'name' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'slug' ) ) echo 'error' ?>">
		<label for="slug">Slug:</label>
		<input type="text" name="slug" id="slug" placeholder="Category Name" value="<?php echo $val->validated( 'slug', $category->slug ) ?>">
		<?php echo $val->error( 'slug' ) ? '<span class="help-inline">' . $val->error( 'slug' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'parent' ) ) echo 'error' ?>">
		<label for="parent">Parent Category:</label>
		<select name="parent" id="parent">
			<option value="">--- No Parent ---</option>
			<?php foreach( $categories as $p_cat ) : ?>
				<option value="<?= $p_cat->id ?>" <?php if( $p_cat->id == $val->validated( 'parent', $category->parent_id ) ) echo 'selected=selected'?>>
					<?= $p_cat->name ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php echo $val->error( 'parent' ) ? '<span class="help-inline">' . $val->error( 'parent' ) . '</span>' : '' ?>
	</div>
	<p>
		<button type="submit" class="btn btn-primary">Edit Category</button>
		<button type="button" class="btn" onclick="document.location.href='<?= Uri::create( 'admin/categories' ) ?>'">Return to Categories</button>
	</p>
</form>