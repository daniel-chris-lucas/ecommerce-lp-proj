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
        
        <?php echo Asset::css( 'admin/admin.css' ) ?>

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
        <!-- start header -->
        <?php if( Session::get_flash( 'flash_message' ) ) : ?>
            <div class="flash_message message_confirm"><?= Session::get_flash( 'flash_message' ) ?></div>
        <?php elseif ( Session::get_flash( 'flash_message_error' ) ) : ?>
            <div class="flash_message message_error"><?= Session::get_flash( 'flash_message_error' ) ?></div>
        <?php endif; ?>     
        <header id="main_header">
            <div class="container">
                
                <div class="row">
                    <div class="span3">
                        <h1><a href="#">Ecommerce Admin</a></h1>
                    </div>
                    <div class="span9">
                        <p>
                            <?php echo Asset::img( 'admin/user.png', array( 'alt' => '', 'width' => 16, 'height' => 19 ) ) ?>
                            Hello, <a href="#" class="white_link">Administrator</a>. | <a href="#">Settings</a> | <a href="<?php echo Uri::create( 'users/logout' ) ?>">Logout</a>
                        </p>
                        <div class="clearfix"></div>
                        <p id="login_info">Last Login: <span>28 Sept 2012</span></p>
                    </div>
                </div>
                
                <!-- start main menu -->
                <nav id="main_menu" class="row">
                    <ul class="span10">
                        <!-- menu items are declared at the top of the page -->
                        <?php foreach( $menu_items as $menu_item_name => $menu_item_link ) : ?>
                        
                            <?php if( strstr( Uri::string(), $menu_item_link ) != false ) : ?>
                                <li class="selected">
                                    <span><?= $menu_item_name ?></span>
                                </li>
                            <?php else : ?>
                                <li>
                                    <a href="<?php echo Uri::create( $menu_item_link ) ?>"><?= $menu_item_name ?></a>
                                </li>
                            <?php endif; ?>                            
                        <?php endforeach; ?>
                    </ul>
                    <p class="span2">
                        <a href="<?php echo Uri::base() ?>">View Site</a>
                    </p>
                    <div class="clearfix"></div>
                    <?php if( !empty( $submenus ) ) : ?>
                        <ul class="submenu">
                            <?php foreach( $submenus as $submenu) : ?>
                                <li><a href="<?= Uri::create( $submenu['link'] ) ?>" class="<?= $submenu['class'] ?>"><?= $submenu['name'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </nav>
                <!-- end main menu -->
            </div>
        </header>
        <!-- end header -->
        
        <div id="main" role="main">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <?php echo $content ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- start footer -->
        <footer id="main_footer">
            <div class="container">
                <div class="row">
                    <!-- start footer menu -->
                    <nav id="footer_menu" class="span6">
                        <ul>
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Users</a></li>
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">Articles</a></li>
                            <li><a href="#">Countries</a></li>
                            <li><a href="#">Orders</a></li>
                        </ul>
                    </nav>
                    <!-- end footer menu -->
                    
                    <div class="span6 footer_right">
                        &copy; Copyright <?php echo date( 'Y' ) ?> <span>Ecommerce</span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

        <!-- <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script> -->        
        <?= Asset::js( 'admin.js' ) ?>

        <!-- <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script> -->
    </body>
</html>
