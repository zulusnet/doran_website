<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 
/****************************************************
*
* @File:        template.inc.php
* @Package:     Doran - Technologie OZE
* @Action:      Szablon wykonany dla firmy Doran, 2013
*
*****************************************************/

# Include the header template
include('header.inc.php'); 
?>

    <!-- include the breadcrumbs template -->
    <?php include('breadcrumbs.inc.php'); ?>
	
        <div id="content">
            <div class="container">
                
                <div id="main" class="row">
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <aside class="sidebar">
                            <?php
                                if (return_i18n_component('sidebar-'.return_page_slug())) {
                                    get_i18n_component('sidebar-'.return_page_slug());
                                } else {
                                    get_i18n_component('sidebar');
                                }
                            ?>
                        </aside>
                    </div>
                    
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <section class="page-content">
                            <h2><?php echo i18n_search_mark(return_page_title()); ?></h2>
                            <hr>
                            <?php get_page_content(); ?>
                        </section>
                    </div>
                
                </div><!--/#main -->
                
            </div><!--/.container -->
        </div><!--/#content -->

<!-- include the footer template -->
<?php include('footer.inc.php'); ?>