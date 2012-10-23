<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Shopping</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
        <?php echo Asset::css( 'style.css' ) ?>

        <?php echo Asset::js( 'vendor/modernizr-2.6.1-respond-1.1.0.min.js' ) ?>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">
                You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> 
                or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> 
                to better experience this site.
            </p>
        <![endif]-->

        <!-- start main header -->
        <header>
            <div class="container">
                <!-- start top row of header -->
                <div class="row">
                    <div class="span3">
                        <h1>
                            <a href="<?php echo Uri::base() ?>">
                                Shopping
                                <span>Feel the difference</span>
                            </a>
                        </h1>
                    </div>
                    <div class="span9">
                        <a href="#" class="search">Search</a>
                        <div class="search_toggle">
                            <form action="">
                                <input id="word_search" placeholder="Type keyword and hit enter">
                            </form>
                        </div>
                        <a href="" class="login_register">Login <span>-- or --</span> Register</a>
                        <select id="currency">
                            <option value="euros">Euros</option>
                            <option value="GB Pounds">GB Pounds</option>
                            <option value="US Dollars">US Dollars</option>
                        </select>
                    </div>
                </div>
                <!-- end top row of header -->
                
                <!-- start bottom row of header -->
                <div class="row">
                    <nav id="main_nav" class="span10">
                        <ul>
                            <li><a href="<?php echo Uri::base() ?>" class="active">Home<span></span></a></li>
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                    <div class="span2">
                        <aside class="wrap_cart">
                            <a href="#" class="cart_status">$12.90</a>
                        </aside>
                    </div>
                </div>
                <!-- end bottom row of header -->
            </div>
        </header>
        <!-- end main header -->
        
        <!-- start menu under shopping cart -->
        <div class="row">
            <div class="container">
                <nav id="cart_nav" class="span12">               
                    <ul>
                        <li><a href="#" class="my_shopping_cart">Shopping Cart</a></li>
                        <li><a href="#" class="checkout_cart">Checkout</a></li>
                    </ul>                
                </nav>
            </div>
        </div>
        <!-- end menu under shopping cart -->
        
        <!-- start slider -->
        <div class="row">
            <div class="container">
                <div class="span12" id="slider">
                    <a href="#" class="slider_prev">Prev</a>
                    <a href="#" class="slider_next">Next</a>
                    <div class="left_part">
                        <?php echo Asset::img( 'example-product.png', array( 'alt' => 'Example Product' ) ) ?>
                    </div>
                    <div class="right_part">
                        <div class="discount_sticker">
                            <span class="old">$199</span>
                            <span class="new">$122</span>
                        </div>
                        <h1>Stylish Jacket, be your best deal</h1>
                        <div class="product_description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis ab iure nihil quidem odit architecto temporibus aperiam nobis rerum..
                        </div>
                        <a href="#" class="btn btn-large btn-danger">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end slider -->
        
        <!-- start featured products -->
        <div class="row" id="featured_products">
            <div class="container">
                <div class="span9">
                    <div class="title_bg">
                        <h2 class="title">Featured Products</h2>
                    </div>
                </div>
                <div class="span2" style="float: right;">                    
                    <div class="controls">
                        <a href="#" class="control_prev">Prev</a>
                        <a href="#" class="control_next">Next</a>
                    </div>
                </div>
                <ul class="span12">
                    <li class="span3">
                        <article>
                            <figure>
                                <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                <figcaption>
                                    Nikon Camera<br>
                                    <span>Item no: 1422</span>
                                </figcaption>
                            </figure>
                            <span class="price">
                                $199
                            </span>
                        </article>
                    </li>
                    <li class="span3">
                        <article>
                            <figure>
                                <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                <figcaption>
                                    Special Gift<br>
                                    <span>Item no: 1455</span>
                                </figcaption>
                            </figure>
                            <span class="price">
                                $199
                            </span>
                        </article>
                    </li>
                    <li class="span3">
                        <article>
                            <figure>
                                <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                <figcaption>
                                    Adidas Shoes<br>
                                    <span>Item no: 0166</span>
                                </figcaption>
                            </figure>
                            <span class="price">
                                $199
                            </span>
                        </article>
                    </li>
                    <li class="span3">
                        <article>
                            <figure>
                                <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                <figcaption>
                                    Nikon Camera<br>
                                    <span>Item no: 1422</span>
                                </figcaption>
                            </figure>
                            <span class="price">
                                $199
                            </span>
                        </article>
                    </li>
                </ul>
            </div>            
        </div>
        <!-- end featured products -->
        
        <!-- start about + latest products -->
        <div class="row">
            <div class="container">
                <div id="main" class="span9 about" role="main">
                    <!-- start about the site -->
                    <div class="title_bg">
                        <h2 class="title">About Shopping</h2>
                    </div>
                    
                    <article>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero suscipit nostrum in laudantium amet autem sapiente voluptates. Labore neque aut atque sunt fuga dolore expedita consequuntur eius pariatur consectetur saepe debitis aliquid laborum omnis soluta id fugiat vero nulla vel nemo sed asperiores quidem unde doloribus laboriosam mollitia aspernatur odio tenetur quo delectus eum dolor dolores quaerat iste enim voluptates necessitatibus! Suscipit totam dolorem laborum quo saepe officiis necessitatibus.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus consequatur assumenda non tempora illo libero perspiciatis! Dolor sequi eius dolorum voluptatem officiis in repellendus? Nobis facilis tempore ad quidem sequi.
                        </p>
                        
                        <a href="#" class="btn btn-danger">Read More</a>
                    </article>
                    <!-- end about the site  -->
                    
                    <!-- start latest products -->
                    <div class="title_bg" style="margin-top: 15px;">
                        <h2 class="title">Latest Products</h2>
                    </div>
                    
                    <div id="latest_products">
                        <ul class="clearfix">
                            <li class="span3">
                                <article>
                                    <figure>
                                        <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                        <figcaption>
                                            Adidas Shoes<br>
                                            <span>Item no: 0166</span>
                                        </figcaption>
                                    </figure>
                                    <span class="price">
                                        $199
                                    </span>
                                </article>
                            </li>
                            <li class="span3">
                                <article>
                                    <figure>
                                        <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                        <figcaption>
                                            Adidas Shoes<br>
                                            <span>Item no: 0166</span>
                                        </figcaption>
                                    </figure>
                                    <span class="price">
                                        $199
                                    </span>
                                </article>
                            </li>
                            <li class="span3">
                                <article>
                                    <figure>
                                        <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                        <figcaption>
                                            Adidas Shoes<br>
                                            <span>Item no: 0166</span>
                                        </figcaption>
                                    </figure>
                                    <span class="price">
                                        $199
                                    </span>
                                </article>
                            </li>
                            <li class="span3">
                                <article>
                                    <figure>
                                        <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                        <figcaption>
                                            Adidas Shoes<br>
                                            <span>Item no: 0166</span>
                                        </figcaption>
                                    </figure>
                                    <span class="price">
                                        $199
                                    </span>
                                </article>
                            </li>
                            <li class="span3">
                                <article>
                                    <figure>
                                        <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                        <figcaption>
                                            Adidas Shoes<br>
                                            <span>Item no: 0166</span>
                                        </figcaption>
                                    </figure>
                                    <span class="price">
                                        $199
                                    </span>
                                </article>
                            </li>
                            <li class="span3">
                                <article>
                                    <figure>
                                        <?php echo Asset::img( 'featured-img.jpg', array( 'alt' => '' ) ) ?>
                                        <figcaption>
                                            Adidas Shoes<br>
                                            <span>Item no: 0166</span>
                                        </figcaption>
                                    </figure>
                                    <span class="price">
                                        $199
                                    </span>
                                </article>
                            </li>
                        </ul>
                    </div>
                    <!-- end latest products -->
                </div>
                <aside class="span3">
                    <div class="title_bg">
                        <h2 class="title">Categories</h2>
                    </div>
                    
                    <ul id="category_box">
                        <li><a href="#">Women's Accessories</a></li>
                        <li><a href="#">Men's Shoes</a></li>
                        <li><a href="#">Gift Specials</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">On Sale</a></li>
                        <li><a href="#">Summer Specials</a></li>
                        <li><a href="#">Unique Stuff</a></li>
                    </ul>
                </aside>
            </div>
        </div>
        <!-- end about + latest products -->
        
        <!-- start footer top -->
        <footer class="row" id="footer_top">
            <div class="container">
                <div class="span4">
                    <div class="title_bg">
                        <h2 class="title">Twitter </h2>
                    </div>
                    
                    <ul class="tweets">
                        <li>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error eum officia <a href="#">http://t.co/LbLwldb6</a><br>
                            <span>2 weeks ago</span>
                        </li>
                        <li>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error eum officia <a href="#">http://t.co/LbLwldb6</a><br>
                            <span>2 weeks ago</span>
                        </li>
                    </ul>
                    
                    <a href="#" class="follow_twitter">
                        <span>Twitter</span>
                        Follow Us on Twitter
                    </a>
                </div>
                <div class="span4">
                    <div class="title_bg">
                        <h2 class="title">Newsletter Signup</h2>
                    </div>
                    
                    <p>
                        Become the first one to know about every new product we release on every day. Sign up for the newsletter to get discounts too...
                    </p>
                    
                    <form action="">
                        <label for="email_address" style="margin-top: 25px;">Your Email Address</label>
                        <input type="email" name="email_address" id="email_address" placeholder="name@emailaddress.com">
                        <button type="submit" class="btn btn-danger">Sign Up</button>
                    </form>
                </div>
                <div class="span4">
                    <div class="title_bg">
                        <h2 class="title" style="top: 21px;">
                            <?php echo Asset::img( 'mini-logo.png', array( 'alt' => 'Shopping' ) ); ?>
                        </h2>
                    </div>
                    
                    <ul class="contact_means">
                        <li class="contact_fixed">
                            +91 - 123 - 456789, +91 - 123456789
                            <br>
                            +91 - 123 - 456789
                        </li>
                        <li class="contact_mobile">
                            +91 - 123 - 456789
                            <br>
                            +91 - 123 - 456789
                        </li>
                        <li class="contact_email">
                            <a href="mailto:">info@shopping.com</a>
                            <br>
                            <a href="mailto:">mail.shopping@shopping.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
        <!-- end footer top -->
        
        <!-- start footer bottom -->
        <footer class="row" id="footer_bottom">
            <div class="container">
                <div class="span9" style="margin-left: 0;">
                    <nav id="footer_menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">My Cart</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Completed Orders</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                    <p class="copyright" style="margin-bottom: 0;">&copy; <?php echo date('Y') ?> All rights reserved by <a href="http://daniel-lucas.com" target="_blank">Daniel Lucas</a> &amp; <span style="color: #08c;">Severine Stempin</span></p>
                    <p class="accepted_payments" style="margin-bottom: 0;">
                        The accepted payment methods on this site are Visa, Paypal, Mastercard, American Express
                    </p>
                </div>
                <aside class="span3">
                    <p style="text-align: right;">Follow us on</p>
                    <ul class="follow">
                        <li><a href="#" class="twitter">Twitter</a></li>
                        <li><a href="#" class="facebook">Facebook</a></li>
                        <li><a href="#" class="rss">RSS</a></li>
                    </ul>
                </aside>
            </div>
        </footer>
        <!-- end footer bottom -->
        

        

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

        <?php echo Asset::js( 'vendor/bootstrap.min.js' ) ?>

        <?php echo Asset::js( 'plugins.js' ) ?>
        <?php echo Asset::js( 'main.js' ) ?>

        <!-- <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script> -->
    </body>
</html>