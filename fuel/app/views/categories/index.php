<div class="title_bg">
    <h2 class="title">Categories</h2>
</div>

<ul>
	<?php foreach( $categories as $category ) : ?>
		<li><a href="<?php echo Uri::create( 'categories/view/' . $category->slug ) ?>"><?php echo $category->name ?></a></li>
	<?php endforeach; ?>
</ul>