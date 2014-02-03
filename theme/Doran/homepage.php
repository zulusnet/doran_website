<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 
/****************************************************
*
* @File:        homepage.inc.php
* @Package:     Doran - Technologie OZE
* @Action:      Szablon wykonany dla firmy Doran, 2013
*
*****************************************************/

# Include the header template
include('header.inc.php'); 
?>

        <!-- include the slider template -->
		<div class="hidden-xs">
			<?php include('slider.inc.php'); ?>
		</div>
        
        <div id="content">
            <div class="container">
            
                <div id="thumbs" class="row">
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thumbnail">
                            <?php get_i18n_component('homepage-thumbnail-left'); ?>
                        </div>
                    </div>
					
					<hr class="v-separator hidden-lg hidden-md hidden-sm">
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thumbnail">
                            <?php get_i18n_component('homepage-thumbnail-middle'); ?>
                        </div>
                    </div>
					
					<hr class="v-separator hidden-lg hidden-md hidden-sm">
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thumbnail">
                            <?php get_i18n_component('homepage-thumbnail-right'); ?>
                        </div>
                    </div>
                    
                </div><!--/#thumbs -->
                
                <hr class="v-separator">
                
                <div id="main" class="row">
                
                    <div class="col-md-8 col-xs-12">
                        <section class="about-us">
                            <?php get_page_content(); ?>
                        </section>
                    </div>
                    
                    <div class="col-md-4 hidden-sm hidden-xs">
			<section class="news">
							<?php get_i18n_component('homepage-news'); ?>
                        </section>
						
                        <section class="partners">
                            <?php get_i18n_component('homepage-partners'); ?>
                        </section>

                    </div>
                
                </div><!--/#main -->
                
            </div><!--/.container -->
        </div><!--/#content -->

<!-- include the footer template -->
<?php include('footer.inc.php'); ?>