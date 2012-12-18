<style>
	#main .span3:nth-child(4n-1) {
		margin-left: 0;
	}
</style>

<div class="title_bg">
    <h2 class="title"><?= $category->name ?></h2>
</div>

<?php foreach( $category->products as $product ) : ?>
	<div class="span3">
		<article class="product_wrapper">
			<a href="<?= Uri::create( 'products/view/' . $product->slug ) ?>">
				<figure>
					<!-- use reset to get first element in array -->
					<img src="/assets/uploads/<?= reset( $product->images )->folder . DS . reset( $product->images )->name ?>" alt="<?= reset( $product->images )->alt ?>">
					<p class="product_info">
						<figcaption>
							<?= Str::truncate( $product->name, 25 ) ?><br>
							<span>Item No.: <?= $product->id ?></span>
						</figcaption>
					</p>
				</figure>
				<span class="price">&euro; <?= $product->price ?></span>
			</a>
		</article>
	</div>
<?php endforeach; ?>