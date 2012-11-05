<h2>Add New Product</h2>

<?= Form::open() ?>
	<div class="control-group">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" class="input-xlarge" placeholder="Product Name">
	</div>
	<div class="control-group">
		<label for="description">Description:</label>
		<textarea class="input-xxlarge" name="description" id="description" placeholder="Product Description"></textarea>
	</div>
	<div class="control-group">
		<label for="category">Category:</label>
		<select name="category" id="category">
			<option value="">--- Category ---</option>
			<?php foreach( $categories as $category ) : ?>
				<option value="<?= $category->id ?>"><?= $category->name ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="control-group">
		<label for="price">Price:</label>
		<input type="text" name="price" id="price" placeholder="Price">
	</div>
	<div class="control-group">
		<label for="image">Image:</label>
		<!-- twitter bootstrap hack: hide the input field -->
		<input type="file" name="image" id="image" style="display: none;">
		<!-- display alternate looking field instead -->
		<div class="input-append">
			<input type="text" id="image1" class="input-large">
			<a class="btn" onclick="$( 'input[id=image]' ).click();">Browse</a>
		</div>
	</div>
	<p>
		<button type="submit" class="btn btn-primary">Create Product</button>
	</p>
</form>