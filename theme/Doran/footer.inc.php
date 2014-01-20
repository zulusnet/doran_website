<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 
/****************************************************
*
* @File:        footer.inc.php
* @Package:     Doran - Technologie OZE
* @Action:      Szablon wykonany dla firmy Doran, 2013
*
*****************************************************/
?>
        <!-- site footer -->
        <footer id="footer">
            
            <aside class="footer-aside">
                <div class="container">
                
                    <div class="row">
                    
                        <div class="col-md-3 hidden-sm hidden-xs">
                            
                            <div class="footer-nav">
                            
                                <?php get_i18n_component('footer-nav'); ?>
                                
                            </div><!--/.footer-nav -->

                        </div>
                        
                        <div class="col-md-5 col-xs-12">
                            
                            <div class="footer-clients">
                            
                                <?php get_i18n_component('footer-clients'); ?>
                                
                            </div><!--/.footer-clients -->
                            
                        </div>
                        
                        <div class="col-md-4 hidden-sm hidden-xs">
                            
                            <div class="footer-contact">
                            
                                <?php get_i18n_component('footer-contact'); ?>
                                
                            </div><!--/.footer-contact -->
                            
                        </div>
                    
                    </div>
                    
                </div><!--/.container -->
            </aside><!--/.footer-aside -->
            
            <div class="footer-meta">
                <div class="container">
                    
                    <div class="footer-keywords text-center text-muted">
                        
                        <?php get_i18n_component('footer-keywords'); ?>
                        
                    </div><!--/.footer-keywords -->
                    
                    <div class="footer-copyright text-center">
		      <p>&copy; 2009 - <?php echo date('Y'); ?> <strong><?php get_site_name(); ?></strong> &middot; <?php if ($language == 'pl') echo 'Wszelkie prawa zastrzeżone.'; else if($language == 'ru') echo 'Все права защищены.'; else if($language == 'de') echo 'Alle Rechte vorbehalten.'; ?></p>
		      <p><?php if ($language == 'pl') echo 'Realizacja projektu: '; else if($language == 'ru') echo 'Реализация проекта: '; else if($language == 'de') echo 'Durchführung des Projekts: '; ?><a href="mailto:rafal.osko@gmail.com">Rafał Ośko</a> &middot; Powered by <a href="http://get-simple.info/">GetSimple CMS</a>.</p>
                    </div><!--/.footer-copyright -->
                    
                    <?php get_footer(); ?>
                    
                </div><!--/.container -->
            </div><!--/.footer-meta -->
            
        </footer><!--/#footer -->
	
	<?php get_component('google-analitycs'); ?>
</body>
</html>