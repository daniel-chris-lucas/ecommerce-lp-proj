<h2>Create New Category</h2>

<?= Form::open() ?>
	<div class="control-group <?php if( $val->error( 'name' ) ) echo 'error' ?>">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" placeholder="Category Name" value="<?php echo $val->validated( 'name', $category->name ) ?>">
		<?php echo $val->error( 'name' ) ? '<span class="help-inline">' . $val->error( 'name' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'parent' ) ) echo 'error' ?>">
		<label for="parent">Parent Category:</label>
		<select name="parent" id="parent">
			<option value="">--- Parent Category ---</option>
			<?php foreach( $categories as $p_cat ) : ?>
				<option value="<?= $p_cat->id ?>" <?php if( $p_cat->id == $val->validated( 'parent', $category->parent_id ) ) echo 'selected=selected'?>>
					<?= $p_cat->name ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php echo $val->error( 'parent' ) ? '<span class="help-inline">' . $val->error( 'parent' ) . '</span>' : '' ?>
	</div>
	<p>
		<button type="submit" class="btn btn-primary">Add Category</button>
	</p>
</form>