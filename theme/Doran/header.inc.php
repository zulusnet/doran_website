<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 
/****************************************************
*
* @File:        header.inc.php
* @Package:     Doran - Technologie OZE
* @Action:      Szablon wykonany dla firmy Doran, 2013
*
*****************************************************/
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php get_page_clean_title(); ?> &middot; <?php get_site_name(); ?></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow">
        <meta charset="utf-8">
        
        <!-- Styles -->
        <link href="<?php get_theme_url(); ?>/assets/stylesheets/custom-bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php get_theme_url(); ?>/assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="<?php get_theme_url(); ?>/assets/stylesheets/fancybox.css" rel="stylesheet" type="text/css">
        <link href="<?php get_theme_url(); ?>/assets/stylesheets/style.css" rel="stylesheet" type="text/css">
        
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="<?php get_theme_url(); ?>/assets/javascripts/html5shiv.js"></script>
            <script src="<?php get_theme_url(); ?>/assets/javascripts/respond.min.js"></script>
        <![endif]-->
		<?php get_i18n_gallery_header('slider'); ?>
		<?php get_i18n_gallery_header('partners'); ?>
		<?php get_i18n_header(); ?>
    </head>
    <body id="<?php get_page_slug(); ?>">

        <!-- site header -->
        <header id="header">
            <div class="container">
                
                <div class="row">
                    
                    <div class="col-md-3 col-xs-12">
                        <div class="site-logo">
							<a href="<?php get_site_url(); ?>" id="logo" >
								<figure>
									<img class="img-responsive" src="<?php get_theme_url(); ?>/assets/images/logo.png" alt="<?php get_site_name(); ?>">
								</figure>
                            </a>
                        </div><!--/.site-logo -->
                    </div>
                
                    <div class="col-md-3 col-md-offset-6 col-xs-12">
                    
                        <div class="language text-right">
                            <ul class="picker list-inline">
                                <?php if ($language == 'pl') { ?><li class="active"><?php } else { ?><li><?php } ?><a href="<?php echo htmlspecialchars(return_i18n_setlang_url('pl')); ?>">pl</a></li>
                                <?php if ($language == 'en') { ?><li class="active"><?php } else { ?><li><?php } ?><a href="<?php echo htmlspecialchars(return_i18n_setlang_url('en')); ?>">en</a></li>
                                <?php if ($language == 'de') { ?><li class="active"><?php } else { ?><li><?php } ?><a href="<?php echo htmlspecialchars(return_i18n_setlang_url('de')); ?>">de</a></li>
                                <?php if ($language == 'ru') { ?><li class="active"><?php } else { ?><li><?php } ?><a href="<?php echo htmlspecialchars(return_i18n_setlang_url('ru')); ?>">ru</a></li>
                            </ul>
                        </div><!--/.language -->
                        
                        <div class="search">
                            <?php get_i18n_search_form(array('slug'=>'search', 'showTags'=>false)); ?>
                        </div><!--/.search -->
                        
                    </div>
                    
                </div>
                    
            </div><!--/.container --> 
        </header><!--/#header -->
        
        <nav id="nav" role="navigation">
            <div class="container">
            
                <div class="navbar ">
                    <ul class="navbar-nav" role="menu">
                        <?php get_i18n_navigation(return_page_slug()); ?>
                    </ul>
                </div><!--/.navbar -->
                
            </div><!--/.container -->
        </nav><!--/#nav -->