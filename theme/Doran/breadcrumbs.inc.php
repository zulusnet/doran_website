<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 
/****************************************************
*
* @File:        breadcrumbs.inc.php
* @Package:     Doran - Technologie OZE
* @Action:      Szablon wykonany dla firmy Doran, 2013
*
*****************************************************/
?>
<div class="breadcrumbs">

    <div class="container">
        <span class="home">
            <a href="<?php get_site_url(); ?>"><i class="fa fa-home"></i></a>
        </span>
        <?php get_i18n_breadcrumbs(return_page_slug()); ?>
    </div>
    
</div>