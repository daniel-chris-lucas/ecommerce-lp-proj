<aside class="span3 sidebar">
    <div class="title_bg">
        <h2 class="title">Categories</h2>
    </div>
    
    <?php $newCategories = array() ?>
    <ul id="category_box">
        <?php foreach( $main_categories as $name => $subCat ) : ?>
    	    <?php if( !empty( $subCat[0]['child_name'] ) ) : ?>
    			<li><a href="<?= Uri::create( 'categories/view/' . $subCat[0]['parent_slug'] ) ?>"><?= $name ?></a>
    	    		<ul>
    	    			<?php foreach( $subCat as $cat ) : ?>
    	    				<li><a href="<?= Uri::create( 'categories/view/' . $cat['child_slug'] ) ?>"><?= $cat['child_name'] ?></a></li>
    	    			<?php endforeach; ?>
    	    		</ul>
    	    	</li>
    		<?php else : ?>
    			<li><a href="<?= Uri::create( 'categories/view/' . $subCat[0]['parent_slug'] ) ?>"><?= $name ?></a></li>
    		<?php endif; ?>
        <?php endforeach; ?>
    </ul>
</aside>