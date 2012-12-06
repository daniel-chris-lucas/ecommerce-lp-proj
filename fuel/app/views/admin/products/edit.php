<h2>Edit Product: <?= $product->name ?></h2>

<?= Form::open( array( 'enctype' => 'multipart/form-data' ) ) ?>
	<div class="control-group <?php if( $val->error( 'name' ) ) echo 'error' ?>">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" class="input-xlarge" placeholder="Product Name" value="<?= $val->validated( 'name', $product->name ) ?>">
		<?php echo $val->error( 'name' ) ? '<span class="help-inline">' . $val->error( 'name' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'description' ) ) echo 'error' ?>">
		<label for="description">Description:</label>
		<textarea class="input-xxlarge" style="height: 255px;" name="description" id="description" placeholder="Product Description"><?= $val->validated( 'name', $product->description ) ?></textarea>
		<?php echo $val->error( 'description' ) ? '<span class="help-inline">' . $val->error( 'description' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'category' ) ) echo 'error' ?>">
		<label for="category">Category:</label>
		<select name="category" id="category">
			<option value="">--- Category ---</option>
			<?php foreach( $categories as $category ) : ?>
				<option value="<?= $category->id ?>" <?php if( $product->category->id == $category->id ) echo 'selected=selected' ?>>
					<?= $category->name ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php echo $val->error( 'category' ) ? '<span class="help-inline">' . $val->error( 'category' ) . '</span>' : '' ?>
	</div>
	<div class="control-group <?php if( $val->error( 'price' ) ) echo 'error' ?>" style="margin-bottom: 25px;">
		<label for="price">Price:</label>
		<div class="input-append">
			<input type="text" name="price" id="price" placeholder="Price" value="<?= $val->validated( 'price', $product->price ) ?>">
			<?php echo $val->error( 'price' ) ? '<span class="help-inline">' . $val->error( 'price' ) . '</span>' : '' ?>
			<span class="add-on">&euro;</a>
		</div>		
	</div>
	
	<!-- start generating image upload fields -->
	<?php for( $i = 1; $i <= 5; $i++ ) : ?>
		<div class="control-group form-inline  <?php if( $val->error( 'image' . $i ) ) echo 'error' ?>">
			<label for="image<?= $i ?>">Image <?= $i ?>:</label>
			
			<!-- twitter bootstrap hack: hide the input field -->
			<input type="file" name="image<?= $i ?>" id="image<?= $i ?>" style="display: none;" 
				value="<?= $val->validated( 'image' . $i, isset( $product_images[$i - 1] ) ? $product_images[$i - 1]->name : '' ) ?>"
				<?= isset( $product_images[$i - 1] ) ? 'disabled' : '' ?>>
			
			<!-- display alternate looking field instead -->
			<div class="input-append">
				<input type="text" id="imagereplace<?= $i ?>" class="input-large" 
					value="<?= $val->validated( 'image' . $i, isset( $product_images[$i - 1] ) ? $product_images[$i - 1]->name : '' ) ?>"
					<?= isset( $product_images[$i - 1] ) ? 'disabled' : '' ?>>
				<a class="btn" onclick="$( 'input[id=image<?= $i ?>]' ).click();">Browse</a>
			</div>

			<label for="image_alt<?= $i ?>" style="margin-left: 20px;">Text:</label>
			<input type="text" name="image_alt<?= $i ?>" id="image_alt<?= $i ?>" placeholder="Image Text" 
				value="<?= $val->validated( 'image_alt' . $i, isset( $product_images[$i - 1] ) ? $product_images[$i - 1]->alt : '' ) ?>">
			<?php echo $val->error( 'image_alt' . $i ) ? '<span class="help-inline">' . $val->error( 'image_alt' . $i ) . '</span>' : '' ?>
			
			<?php if( isset( $product_images[$i - 1] ) ) : ?>
				<a class="delete_icon" href="<?= Uri::create( 'admin/products/delete_image/' . $product_images[$i - 1]->id . '/' . $product->id ) ?>">
					Delete Image
				</a>
			<?php endif; ?>
		</div>
	<?php endfor; ?>
	<!-- end generating image upload fields -->
	
	<p>
		<button type="submit" class="btn btn-primary">Edit Product</button>
		<button type="button" class="btn" onclick="document.location.href='<?= Uri::create( 'admin/products' ) ?>'">Return to Products</button>
	</p>
</form>