<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title ?></title>
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
            <div class="container" style="position: relative;">
                <!-- start top row of header -->      
                <?php if( Session::get_flash( 'flash_message' ) ) : ?>
                    <div class="flash_message message_confirm"><?php echo Session::get_flash( 'flash_message' ) ?></div>
                <?php elseif ( Session::get_flash( 'flash_message_error' ) ) : ?>
                    <div class="flash_message message_error"><?php echo Session::get_flash( 'flash_message_error' ) ?></div>
                <?php endif; ?>
                
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
                        <a href="<?= Uri::create( 'search' ) ?>" class="search">Search</a>
                        <div class="search_panel">
                            <?= Form::open( array( 'action' => Uri::create( 'search' ), 'class' => 'form-search' ) ) ?>
                                <div class="input-append">
                                    <input type="text" name="search" id="search" placeholder="Search..." class="search-query">
                                    <button type="submit" class="btn">Search</button>
                                </div>
                            </form>
                        </div>
                        <?php if( !isset( $current_user ) ) : ?>
                            <a href="<?php echo Uri::create( 'users/connect' ) ?>" class="login_register login_button">Login <span>-- or --</span> Register</a>
                            <aside class="login_frame">
                                <div class="col1">
                                    <h2 class="title">Login</h2>
                                    <?= Form::open( 'users/quick_login' ) ?>
                                        <input type="text" name="username" id="username" placeholder="Username">
                                        <input type="password" name="password" id="password" placeholder="Password">
                                        <button type="submit" name="login_submit" class="btn btn-danger">Sign In</button>
                                    </form>
                                </div>
                                <div class="col2">
                                    <h2 class="title">Register</h2>
                                    <p>
                                        New User? By creating an account you will be able to shop faster, be up to date on our
                                        latest products...

                                        <a href="<?= Uri::create( 'users/register' ) ?>" class="btn btn-warning" style="margin-top: 15px;">Register Now</a>
                                    </p>
                                </div>
                            </aside>
                        <?php else : ?>
                            <a href="<?php echo Uri::create( 'users/logout' ) ?>" class="login_register">Logout</a>
                        <?php endif ?>
                    </div>
                </div>
                <!-- end top row of header -->
                
                <!-- start bottom row of header -->
                <div class="row">
                    <nav id="main_nav" class="span10">
                        <ul>
                            <li><a href="<?php echo Uri::base() ?>" class="active">Home<span></span></a></li>
                            <li class="drop_menu">
                                <a href="<?php echo Uri::create( 'categories' ) ?>">Categories</a>
                                <div class="megamenu">
                                    <ul class="sub_menu">
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
                                </div>
                            </li>
                            <?php if( isset( $current_user ) ) : ?>
                                <li><a href="<?php echo Uri::create( 'users/account' ) ?>">My Account</a></li>
                            <?php endif ?>
                            <li><a href="<?php echo Uri::create( 'home/contact' ) ?>">Contact</a></li>
                            <?php if( isset( $current_user ) && ( $current_user->role_id === $moderator_id || $current_user->role_id === $admin_id ) ) : ?>
                                <li><a href="<?php echo Uri::create( 'admin/dashboard' ) ?>">Admin Panel</a></li>
                            <?php endif ?>
                        </ul>
                    </nav>
                    <div class="span2">
                        <aside class="wrap_cart">
                            <a href="<?= Uri::create( 'shopping-cart' ) ?>" class="cart_status">&euro; <?= number_format( (float) $cart_total, 2, '.', '' ) ?></a>
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
                        <li
                        ><a href="<?= Uri::create( 'shopping-cart' ) ?>" class="my_shopping_cart">Shopping Cart</a></li>
                        <li><a href="<?= Uri::create( 'shopping-cart/confirmation' ) ?>" class="checkout_cart">Checkout</a></li>
                    </ul>                
                </nav>
            </div>
        </div>
        <!-- end menu under shopping cart -->
        
        <?php if( Uri::String() === '' ) echo View::forge( 'layouts/slider' ) ?>
        
        <?php if( Uri::String() === '' ) echo View::forge( 'layouts/featured-products' ) ?>
        
        <!-- start about + latest products -->
        <div class="row">
            <div class="container">
                <?php if( Uri::segment(1) !== 'users' && Uri::segment(2) !== 'contact' && Uri::segment(1) !== 'categories' && Uri::segment(1) !== 'shopping-cart' ) echo View::forge( 'layouts/sidebar' ) ?>
                
                <div id="main" class="<?php echo ( ( Uri::segment(1) == 'users' ) || ( Uri::segment(2) == 'contact' ) || ( Uri::segment(1) == 'categories' ) || Uri::segment(1) == 'shopping-cart' ) ? 'span12' : 'span9' ?> about" role="main">
                    <?php echo $content ?>
                </div>
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
        <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

        <?php echo Asset::js( array( 'vendor/bootstrap.min.js', 'gmaps.js', 'plugins.js', 'main.js' ) ) ?>

        <!-- <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script> -->
    </body>
</html>