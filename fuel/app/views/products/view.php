<div class="title_bg">
    <h2 class="title"><?= $product->name ?></h2>
</div>

<div id="product_top">
	<div class="span4" style="margin-left: 0;">
		<?php foreach( $product->images as $image ) : ?>
			<?php
				$original_image_size = explode( ' ', getimagesize( 'assets/uploads/' . $image->folder . DS . $image->name )[3] );
				list( $image_width, $image_height ) = $original_image_size;
				$image_width = intval( str_replace( '"', '', explode( '=', $image_width )[1] ) );
				$image_height = intval( str_replace( '"', '', explode( '=', $image_height )[1] ) );
			?>
			
			<?php if( $image->name == reset( $product->images )->name ) : ?>
			
				<!-- display the first image in big -->
				<figure class="product_large">
					<a href="<?= '/assets/uploads/' . $image->folder . DS . $image->name ?>" class="fancybox" rel="group">
						<?php if( $image_width > $image_height ) : ?>
							<?php $img_dims = Model_Image::calculate_width( $image_width, $image_height, 330 ); ?>
							<img src="<?= '/assets/uploads/' . $image->folder . DS . $image->name ?>" alt="<?= $image->alt ?>" width="<?= $img_dims['width'] ?>" 
								height="<?= $img_dims['height'] ?>" style="margin-left: -<?= $img_dims['width'] / 2 ?>px;margin-top: -<?= $img_dims['height'] / 2 ?>px;">
						<?php else : ?>
							<?php $img_dims = Model_Image::calculate_height( $image_width, $image_height, 250 ); ?>
							<img src="<?= '/assets/uploads/' . $image->folder . DS . $image->name ?>" alt="<?= $image->alt ?>" width="<?= $img_dims['width'] ?>" 
								height="<?= $img_dims['height'] ?>" style="margin-left: -<?= $img_dims['width'] / 2 ?>px;margin-top: -<?= $img_dims['height'] / 2 ?>px;">
						<?php endif; ?>
					</a>
				</figure>
				<div class="clearfix"></div>
				
			<?php else : ?>
			
				<!-- display smaller images -->
				<figure class="product_thumb">
					<a href="<?= '/assets/uploads/' . $image->folder . DS . $image->name ?>" class="fancybox" rel="group">
						<?php if( $image_width > $image_height ) : ?>
							<?php $img_dims = Model_Image::calculate_width( $image_width, $image_height, 75 ); ?>
							<img src="<?= '/assets/uploads/' . $image->folder . DS . $image->name ?>" alt="<?= $image->alt ?>" width="<?= $img_dims['width'] ?>" 
							 height="<?= $img_dims['height'] ?>" style="margin-left: -<?= $img_dims['width'] / 2 ?>px;margin-top: -<?= $img_dims['height'] / 2 ?>px;">
						<?php else : ?>
							<?php $img_dims = Model_Image::calculate_height( $image_width, $image_height, 62 ); ?>
							<img src="<?= '/assets/uploads/' . $image->folder . DS . $image->name ?>" alt="<?= $image->alt ?>" width="<?= $img_dims['width'] ?>" 
								height="<?= $img_dims['height'] ?>" style="margin-left: -<?= $img_dims['width'] / 2 ?>px;margin-top: -<?= $img_dims['height'] / 2 ?>px;">
						<?php endif; ?>
					</a>
				</figure>
				
			<?php endif; ?>
			
		<?php endforeach; ?>
	</div>
	
	<div class="span5">
		<ul class="characteristics" style="list-style: none; margin-left: 0;">
			<li style="border-bottom: 1px dashed #c2cbd3; padding-bottom: 10px;"><span class="charac_label">Item No:</span> <?= $product->id ?></li>
		</ul>
		
		<?= Form::open( array( 'class' => 'form-inline' ) ) ?>
			<div class="control-group" <?php if( $val->error( 'quantity' ) ) echo 'error' ?>>
				<label for="quantity" class="control-label" style="color: #2d343d; margin-right: 12px;">Qty. :</label>
				<input type="text" class="input-mini" name="quantity" id="quantity" value="<?= $val->validated( 'quantity', 1 ) ?>" style="margin-right: 12px;">
				<button class="btn btn-danger">
					<?= Asset::img( 'white-cart.png', array( 'alt' => '', 'style' => 'margin-top: -4px; margin-right: 5px;' ) ) ?>
					Add to Cart
				</button>
			</div>
		</form>
	</div>
</div>

<div class="clearfix"></div>

<ul class="tabs">
	<li class="active" rel="tab1">Description</li>
	<li rel="tab2">Reviews</li>
</ul>

<!-- start tab box -->
<div class="tab_container">
	<div id="tab1" class="tab_content">
		<?= nl2br( $product->description ) ?>
	</div>
	
	<div id="tab2" class="tab_content">
		<p>
			<button type="button" class="btn comment_button" rel="tab3">Add New Comment</button>
			
			<div class="ratings" style="margin-top: 20px;">
				<?php foreach( $ratings as $rating ) : ?>
					<div style="border-top: 1px dashed #c2cbd3; padding-top: 15px;">
						<span style="color: #474c52; font-size: 14px;"><?= $rating->user->first_name ?> <?= $rating->user->last_name ?></span> 
						<span style="color: #8b949f; font-size: 12px;">(<?= date( 'd/m/Y', $rating->created_at ) ?>)</span>
						<p style="margin-top: 16px;"><?= $rating->description ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</p>
	</div>
	
	<div id="tab3" class="tab_content">
		<h3>Write Review</h3>
		<?= Form::open() ?>
			<div class="control-group form-inline <?php if( $val->error( 'review' ) ) echo 'error' ?>">
				<textarea name="review" id="review" placeholder="Your Review" style="width: 98%; height: 120px;"></textarea>
				<?php echo $val->error( 'review' ) ? '<span class="help-inline">' . $val->error( 'review' ) . '</span>' : '' ?>
			</div>
			<div class="control-group form-inline <?php if( $val->error( 'rating' ) ) echo 'error' ?>">
				<label for="rating" style="margin-right: 10px;">Rating</label>
				<select name="rating" class="input-xlarge" name="rating" id="rating">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<?php echo $val->error( 'rating' ) ? '<span class="help-inline">' . $val->error( 'rating' ) . '</span>' : '' ?>
			</div>
			<div>
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="button" class="btn comment_button" rel="tab2">Return</button>
			</div>
		</form>
	</div>
</div>
<!-- end tap box -->