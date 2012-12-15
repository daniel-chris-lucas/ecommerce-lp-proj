<div class="title_bg">
	<?php if( Input::method() != 'POST' ) : ?>
		<h2 class="title">Search Articles</h2>
	<?php else : ?>
		<h2 class="title">Results For: <?= $query ?></h2>
	<?php endif; ?>
</div>

<?= Form::open( array( 'class' => 'form-search' ) ) ?>
	<div class="input-append">
		<input type="text" name="search" id="search" placeholder="Search..." class="search-query">
		<button type="submit" class="btn">Search</button>
	</div>
</form>

<div class="results">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Link</th>
			</tr>
		</thead>
		<tbody>
			<?php if( isset( $products ) ) : ?>
				<?php foreach( $products as $product ) : ?>
					<tr>
						<td><?= $product->name ?></td>
						<td><?= Str::truncate( $product->description, 200 ) ?></td>
						<td>&euro; <?= number_format( (float)$product->price, 2, '.', '' ) ?></td>
						<td><a href="<?= Uri::create( 'products/view/' . $product->slug ) ?>">View product</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>