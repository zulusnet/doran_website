<?php
i18n_gallery_register('bxslider', 'bxslider', 
  '<strong>bxslider</strong> is a responsive jQuery Content Slider.<br/>'.
  'License: WTFPL<br/>'.
  '<a target="_blank" href="http://bxslider.com/">http://bxslider.com/</a><br/>'.
  'Implemented by: <a href="mailto:rafal.osko@gmail.com">Rafał Ośko</a>',
  'i18n_gallery_bxslider_edit', 'i18n_gallery_bxslider_header', 'i18n_gallery_bxslider_content');
?>

<?php
function i18n_gallery_bxslider_edit($gallery) {
	?>
	<p>
		<label for="bxslider-interval"><?php i18n('i18n_gallery/INTERVAL'); ?></label>
		<input type="text" class="text" id="bxslider-interval" name="bxslider-interval" value="<?php echo @$gallery['interval']; ?>" style="width:5em"/>
	</p>
	<p>
		<label for="bxslider-effect"><?php i18n('i18n_gallery/EFFECT'); ?></label>
		<select class="text" name="bxslider-effect">
			<option value="fade" <?php echo @$gallery['effect'] == 'fade' ? 'selected="selected"' : ''; ?>>fade</option>
			<option value="vertical" <?php echo @$gallery['effect'] == 'vertical' ? 'selected="selected"' : ''; ?>>vertical</option>
			<option value="horizontal" <?php echo @$gallery['effect'] == 'horizontal' ? 'selected="selected"' : ''; ?>>horizontal</option>
		</select>
	<p>	
	<?php
}
?>

<?php
function i18n_gallery_bxslider_header($gallery) {
	global $SITEURL;
	
	if (i18n_gallery_check($gallery,'jquery') && i18n_gallery_needs_include('jquery.js')) {
	?>
		<script type="text/javascript" src="<?php echo i18n_gallery_site_link(); ?>plugins/i18n_gallery/js/jquery-1.8.2.min.js"></script>
	<?php
	}
	if (i18n_gallery_check($gallery,'js') && i18n_gallery_needs_include('bxslider.js')) {
	?>
		<script type="text/javascript" src="<?php echo i18n_gallery_site_link(); ?>plugins/i18n_gallery/js/jquery.bxslider.min.js"></script>
	<?php
	}
	if (i18n_gallery_check($gallery,'css') && i18n_gallery_needs_include('bxslider.css')) {
	?>
		<style type="text/css">
			/**
			 * BxSlider v4.0 - Fully loaded, responsive content slider
			 * http://bxslider.com
			 *
			 * Written by: Steven Wanderski, 2012
			 * http://stevenwanderski.com
			 * (while drinking Belgian ales and listening to jazz)
			 *
			 * CEO and founder of bxCreative, LTD
			 * http://bxcreative.com
			 */		
		
			/** RESET AND LAYOUT
			===================================*/

			.bx-wrapper {
				position: relative;
				margin: 0 auto 60px;
				padding: 0;
				*zoom: 1;
			}

			.bx-wrapper img {
				max-width: 100%;
				display: block;
			}

			/** THEME
			===================================*/

			.bx-wrapper .bx-viewport {
				-moz-box-shadow: 0 0 5px #ccc;
				-webkit-box-shadow: 0 0 5px #ccc;
				box-shadow: 0 0 5px #ccc;
				border: solid #fff 5px;
				left: -5px;
				background: #fff;
			}

			.bx-wrapper .bx-pager,
			.bx-wrapper .bx-controls-auto {
				position: absolute;
				bottom: -30px;
				width: 100%;
			}

			/* LOADER */

			.bx-wrapper .bx-loading {
				min-height: 50px;
				background: url(<?php echo $SITEURL; ?>plugins/i18n_gallery/images/bxslider/bx_loader.gif) center center no-repeat #fff;
				height: 100%;
				width: 100%;
				position: absolute;
				top: 0;
				left: 0;
				z-index: 2000;
			}

			/* PAGER */

			.bx-wrapper .bx-pager {
				text-align: center;
				font-size: .85em;
				font-family: Arial;
				font-weight: bold;
				color: #666;
				padding-top: 20px;
			}

			.bx-wrapper .bx-pager .bx-pager-item,
			.bx-wrapper .bx-controls-auto .bx-controls-auto-item {
				display: inline-block;
				*zoom: 1;
				*display: inline;
			}

			.bx-wrapper .bx-pager.bx-default-pager a {
				background: #666;
				text-indent: -9999px;
				display: block;
				width: 10px;
				height: 10px;
				margin: 0 5px;
				outline: 0;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				border-radius: 5px;
			}

			.bx-wrapper .bx-pager.bx-default-pager a:hover,
			.bx-wrapper .bx-pager.bx-default-pager a.active {
				background: #000;
			}

			/* DIRECTION CONTROLS (NEXT / PREV) */

			.bx-wrapper .bx-prev {
				left: 10px;
				background: url(<?php echo $SITEURL; ?>plugins/i18n_gallery/images/bxslider/controls.png) no-repeat 0 -32px;
			}

			.bx-wrapper .bx-next {
				right: 10px;
				background: url(<?php echo $SITEURL; ?>plugins/i18n_gallery/images/bxslider/controls.png) no-repeat -43px -32px;
			}

			.bx-wrapper .bx-prev:hover {
				background-position: 0 0;
			}

			.bx-wrapper .bx-next:hover {
				background-position: -43px 0;
			}

			.bx-wrapper .bx-controls-direction a {
				position: absolute;
				top: 50%;
				margin-top: -16px;
				outline: 0;
				width: 32px;
				height: 32px;
				text-indent: -9999px;
				z-index: 9999;
			}

			.bx-wrapper .bx-controls-direction a.disabled {
				display: none;
			}

			/* AUTO CONTROLS (START / STOP) */

			.bx-wrapper .bx-controls-auto {
				text-align: center;
			}

			.bx-wrapper .bx-controls-auto .bx-start {
				display: block;
				text-indent: -9999px;
				width: 10px;
				height: 11px;
				outline: 0;
				background: url(<?php echo $SITEURL; ?>plugins/i18n_gallery/images/bxslider/controls.png) -86px -11px no-repeat;
				margin: 0 3px;
			}

			.bx-wrapper .bx-controls-auto .bx-start:hover,
			.bx-wrapper .bx-controls-auto .bx-start.active {
				background-position: -86px 0;
			}

			.bx-wrapper .bx-controls-auto .bx-stop {
				display: block;
				text-indent: -9999px;
				width: 9px;
				height: 11px;
				outline: 0;
				background: url(<?php echo $SITEURL; ?>plugins/i18n_gallery/images/bxslider/controls.png) -86px -44px no-repeat;
				margin: 0 3px;
			}

			.bx-wrapper .bx-controls-auto .bx-stop:hover,
			.bx-wrapper .bx-controls-auto .bx-stop.active {
				background-position: -86px -33px;
			}

			/* PAGER WITH AUTO-CONTROLS HYBRID LAYOUT */

			.bx-wrapper .bx-controls.bx-has-controls-auto.bx-has-pager .bx-pager {
				text-align: left;
				width: 80%;
			}

			.bx-wrapper .bx-controls.bx-has-controls-auto.bx-has-pager .bx-controls-auto {
				right: 0;
				width: 35px;
			}

			/* IMAGE CAPTIONS */

			.bx-wrapper .bx-caption {
				position: absolute;
				bottom: 0;
				left: 0;
				background: #666\9;
				background: rgba(80, 80, 80, 0.75);
				width: 100%;
			}

			.bx-wrapper .bx-caption span {
				color: #fff;
				font-family: Arial;
				display: block;
				font-size: .85em;
				padding: 10px;
			}		
		</style>
	<?php
	}
}
?>

<?php
function i18n_gallery_bxslider_content($gallery, $pic) {
	global $SITEURL;
	$id = i18n_gallery_id($gallery);
	?>
	<div id="gallery-bxslider-<?php echo $id; ?>" class="gallery gallery-bxslider gallery-<?php echo $id; ?>">
		<?php
			$count = count($gallery['items']);
			
			for ($i=0; $i<$count; $i++) {
				$item = $gallery['items'][$i];
				$descr = @$item['_description'];
				
				if ($descr && !preg_match('/^(<p>|<p |<div>|<div ).*/', $descr)) {
					$descr = '<p>'.$descr.'</p>';
				}
				?>
					<div class="gallery-slide">
						<img src="<?php i18n_gallery_image_link($gallery,$item); ?>" <?php if (@$item['_title']) echo 'title="'.htmlspecialchars($item['_title']).'"'; ?> alt=""/>
					</div>
				<?php
			}
		?>
	</div>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('.gallery-bxslider').bxSlider({
				auto : true,
				mode : <?php echo @$gallery['effect'] ? json_encode($gallery['effect']) : 'horizontal'; ?>,
				speed : 1000,
				pause: <?php echo @$gallery['interval'] ? intval(@$gallery['interval']) : 4000; ?>,
				captions : true
			});
		});		
	</script>
	<?php
}
?>
