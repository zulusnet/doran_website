<?php
/****************************************************
* @Plugin Name: Google Map
* @Description: This plugin displays a map of Google Maps on your website.
* @File: 		googlemap.php
* @Package:		GetSimple Google Map Plugin v2
* @Date:		1 apr 2012
* @Version:		googlemap 2.0 / GetSimple 3.0+
* @Autor:		singulae
* @Autor URI: 	http://www.singulae.com/
*
*****************************************************/


# get correct id for plugin
$gmap_thisfile  = basename(__FILE__, ".php");
$gmap_file = GSDATAOTHERPATH.$gmap_thisfile.'.xml';



# add in this plugin's language file
i18n_merge($gmap_thisfile);

# Get config 'show in'.. 
if(!defined('GMAPSHOWINPAGES'))	{ define('GMAPSHOWINPAGES', 0); 	}; 
if(!defined('GMAPINCOMPONENT'))	{ define('GMAPINCOMPONENT', 0); 	};

$GMAPSHOWIN = (GMAPSHOWINPAGES == 0) ? 'plugins' : 'pages';
 
# register plugin
register_plugin(
	$gmap_thisfile, 												# ID of plugin, should be filename minus php
	'Google Map', 													# Title of plugin 
	'2.0', 															# Version of plugin
	'singulae',														# Author of plugin
	'http://www.singulae.com/',		 								# Author URL
	i18n_r($gmap_thisfile.'/DESCRIP'),							 	# Plugin Description
	$GMAPSHOWIN, 													# Page type of plugin
	'gmap_show_config' 	 											# Function that displays content
);


# activate filter
add_filter('content','gmap_show'); 



# hooks
add_action('index-pretemplate','gmap_include_check', GMAPINCOMPONENT);
add_action($GMAPSHOWIN.'-sidebar','createSideMenu',array($gmap_thisfile,'Google Map'));


# functions

/*
 **************** FRONT-END *************
 */

/* _________________________________________________________________________
 * Crea código JS en HEAD para mostrar los mapas.
 * Create JS in HEAD to show maps.
 */
 
function gmap_header($contcomp = false)
{

	global $content,$gmap_config,$SITEURL;
	
	$gmap_config 	= gmap_getXMLdata();	
	$maps 	  		= count($gmap_config);	
	$contents 		= strip_decode($content);

	
	for($i=0;$i<$maps;$i++){
		$patron = '/\(%googlemap:'.$gmap_config[$i]['id'].'%\)/i';
		$pagemaps[] = (preg_match($patron, $contents)>0) ? $gmap_config[$i]['id'] : 0;
		
		// check components content
		if ($contcomp !== false){
			$pagemaps[] =  (strpos($contcomp, 'gmap_'.$gmap_config[$i]['id']) !== false  )? $gmap_config[$i]['id'] : 0;
		};
		
	};
		
	
	$gmap_script	= "";
	$gmap_result 	= "\n".'<!-- Google map Plugin : start -->'	
					
					. "\n".'<script language="javascript" type="text/javascript">'
					. "\n".'//<![CDATA['
					. "\n".' if (typeof jQuery == "undefined") {'
					. "\n".'  document.writeln(\'<script type="text\/javascript" language="javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"><\/script>\');'
					. "\n".' };'
					. "\n".' [js]'
					. "\n".'//]]>'	
					. "\n".'</script>'
					. "\n".'<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>'	
					. "\n".'<script type="text/javascript" src="'.$SITEURL.'plugins/googlemap/js/jquery.gomap-1.3.2.min.js"></script>'
					. "\n".'<script language="javascript" type="text/javascript">'
					. "\n".'//<![CDATA['
					. "\n".' $jQ = jQuery;'
					. "\n".' $jQ(document).ready(function()'
					. "\n".' {'
					. "\n".'  [code]'
					. "\n".' });'
					. "\n".'//]]>'					
					. "\n".'</script>'
					. "\n".'<!-- Google map Plugin : end -->'."\n";
	
	$GETIMGSIZEJS ="";/*esto esta aquí porque da error si se llama a map_header() desde un componenete..21/2/2012*/
	
	// Recorre mapas guardados buscando coincidencias 
	// con los mapas que deban mostrarse en la página.
	for($i=0;$i<$maps;$i++)
	{	
		// Busca coincidencia con los mapas de la página		
		$pm = count($pagemaps);	
		for($x=0;$x<$pm;$x++)
		{

			// Check
			if((string)$pagemaps[$x] == (string)$gmap_config[$i]['id'])
			{
			
				$gmap_config[$i]['controls_pan'] 	 = ($gmap_config[$i]['controls_pan'] == 1) 		? 'true' : 'false' ;
				$gmap_config[$i]['controls_zoom'] 	 = ($gmap_config[$i]['controls_zoom'] == 1) 	? 'true' : 'false' ;
				$gmap_config[$i]['controls_mtype'] 	 = ($gmap_config[$i]['controls_mtype'] == 1) 	? 'true' : 'false' ;
				$gmap_config[$i]['controls_scale'] 	 = ($gmap_config[$i]['controls_scale'] == 1) 	? 'true' : 'false' ;
				$gmap_config[$i]['controls_streetv'] = ($gmap_config[$i]['controls_streetv'] == 1) 	? 'true' : 'false' ;
			

				// If getimasize() php function don't works: Get img size with javascript
				$GETIMGSIZEJS ="\n".' function gmap_getimgSize(imgpath){'
					. "\n".'    if(!imgpath) {return false;};'
					. "\n".'    var mkImg = new Image();'
					. "\n".'    mkImg.src = imgpath;'
					. "\n".'    return mkImg;'
					. "\n".' };'
					. "\n".' // Imgs';
					
			
				// Construct js options map
				$gmap_script .=''
				."\n".'  // idmap: '.(string)$gmap_config[$i]['id']
				."\n".'  var ops_'.(string)$gmap_config[$i]['id'].' = {';
				
				// general
				$gmap_script .=''
				."\n".'	scrollwheel: '.$gmap_config[$i]['controls_pan'].','
				."\n".'	maptype: "'.$gmap_config[$i]["maptype"].'",'
				."\n".'	address: "'.$gmap_config[$i]["address"].'",'
				."\n".'	zoom: '.$gmap_config[$i]["zoom"].','								
				."\n".'	oneInfoWindow: false';
				$gmap_script .=',';
				
				// Controls
				$gmap_script .=''
				."\n".'	panControl: '.$gmap_config[$i]['controls_pan'].','
				."\n".'	zoomControl: '.$gmap_config[$i]['controls_zoom'].','
				."\n".'	mapTypeControl: '.$gmap_config[$i]['controls_mtype'].','
				."\n".'	scaleControl: '.$gmap_config[$i]['controls_scale'].','
				."\n".'	streetViewControl: '.$gmap_config[$i]['controls_streetv']
				."\n".'';
				
				$gmap_script .='	,';
				
				// MARKERS				
				// add marker default
				
				$gmap_config[$i]["anchors"][] = array(	'address'	=> $gmap_config[$i]["address"],
														'image' 	=> $gmap_config[$i]["image"],
														'imagepos'	=> $gmap_config[$i]["imagepos"],
														'shadow' 	=> $gmap_config[$i]["shadow"],
														'shadowpos'	=> $gmap_config[$i]["shadowpos"],
														'infotxt'	=> $gmap_config[$i]["infotxt"],
														'popup'		=> $gmap_config[$i]["popup"]);
				
				$a = count($gmap_config[$i]["anchors"]);
				
				if($a>0){ 
					$gmap_script .="\n".'	markers:['; 				
				
					for($z=0;$z<$a;$z++){
					
						$popval = ($gmap_config[$i]["anchors"][$z]['popup']==1) ? 'true' : 'false';
						
						$gmap_script .= ($z>0) ? "\n".'	 ,'	  : '' ;					
						$gmap_script .=''
						."\n".'	 {'
						."\n".'	  address: "'.$gmap_config[$i]["anchors"][$z]['address'].'",'
						."\n".'	  html:{content:\''.addslashes(str_replace(array("\r\n", "\r", "\n"), "<br />",$gmap_config[$i]["anchors"][$z]["infotxt"])).'\',popup: '.$popval.'}';

						
						if(gmap_issetvar($gmap_config[$i]["anchors"][$z]['image'])){
						
						
							// gets the size of the images. This information was not asked to the user
							$imgsize = @getimagesize($gmap_config[$i]["anchors"][$z]['image']);							
							
							// call js if an error occurred with getimagesize()							
							if(!isset($imgsize[1]) || $imgsize[1]==NULL || $imgsize[1]=="" || $imgsize[1]=="undefined"){ 							
								$mkname = (string)$gmap_config[$i]['id'].'_mk'.$z;
								$GETIMGSIZEJS .= "\n ".$mkname.' = gmap_getimgSize(\''.$gmap_config[$i]["anchors"][$z]['image'].'\');';														
								$imgsize = array("$mkname.width","$mkname.height");								
							};
							
							// image axis position
							$iconanchorxy = getPosxy($imgsize,$gmap_config[$i]["anchors"][$z]['imagepos']);	
							
							
							
							// gets the size of the images. This information was not asked to the user
							$shadowsize = @getimagesize($gmap_config[$i]["anchors"][$z]['shadow']);							
							
							// call js if an error occurred with getimagesize()							
							if(!isset($shadowsize[1]) || $shadowsize[1]==NULL || $shadowsize[1]=="" || $shadowsize[1]=="undefined"){ 							
								$mkshwname = (string)$gmap_config[$i]['id'].'_mkshw'.$z;
								$GETIMGSIZEJS .= "\n ".$mkshwname.' = gmap_getimgSize(\''.$gmap_config[$i]["anchors"][$z]['shadow'].'\');';								
								$shadowsize = array("$mkshwname.width","$mkshwname.height");
							};
							
							// shadow axis position
							$shadowanchorxy = getPosxy($shadowsize,$gmap_config[$i]["anchors"][$z]['shadowpos']);

							$gmap_script .=','
							."\n".'	  icon: {'
							."\n".'	    image:new google.maps.MarkerImage ('
							."\n".'	    	\''.$gmap_config[$i]["anchors"][$z]['image'].'\','
							."\n".'	    	new google.maps.Size('.$imgsize[0].','.$imgsize[1].'),'		
							."\n".'	    	new google.maps.Point(0,0),'						
							."\n".'	    	new google.maps.Point('.$iconanchorxy[0].','.$iconanchorxy[1].')'
							."\n".'	  	),'							
							."\n".'	    shadow:new google.maps.MarkerImage ('
							."\n".'	    	\''.$gmap_config[$i]["anchors"][$z]['shadow'].'\','
							."\n".'	    	new google.maps.Size('.$shadowsize[0].','.$shadowsize[1].'),'		
							."\n".'	    	new google.maps.Point(0,0),'						
							."\n".'	    	new google.maps.Point('.$shadowanchorxy[0].','.$shadowanchorxy[1].')'
							."\n".'	  	)'						
							."\n".'	  }';								
						};
						$gmap_script .="\n".'	 }';							
					};			
					$gmap_script .="\n".'	 ]'; 
				};
				

				// Icon	
				if(gmap_issetvar($gmap_config[$i]['icon_image_img'])){

					// gets the size of the images. This information was not asked to the user
					$icnsize = @getimagesize($gmap_config[$i]['icon_image_img']);

					// call js if an error occurred with getimagesize()
					if(!isset($icnsize) || $icnsize==NULL || $icnsize[1]==""  || $icnsize[1]=="undefined" || $icnsize[1]==0){ 					
						$icname = (string)$gmap_config[$i]['id'].'_ic';
						$GETIMGSIZEJS .= "\n ".$icname.' = gmap_getimgSize(\''.$gmap_config[$i]['icon_image_img'].'\');';						
						$icnsize = array("$icname.width","$icname.height");
					};
					// image axis position
					$mkiconanchorxy = getPosxy($icnsize,$gmap_config[$i]['icon_image_pos']);
					
					
					
					// gets the size of the images. This information was not asked to the user
					$shasize = @getimagesize($gmap_config[$i]['icon_shadow_img']);
					
					// call js if an error occurred with getimagesize()
					if(!isset($shasize) || $shasize==NULL  || $shasize[1]=="" || $shasize[1]=="undefined" || $shasize[1]==0){ 					
						$shname = (string)$gmap_config[$i]['id'].'_sh';					
						$GETIMGSIZEJS .= "\n ".$shname.' = gmap_getimgSize(\''.$gmap_config[$i]['icon_shadow_img'].'\');';						
						$shasize = array("$shname.width","$shname.height");
					};					
					// shadow axis position
					$mkshadowanchorxy = getPosxy($shasize,$gmap_config[$i]['icon_shadowpos']);
					
					
					$gmap_script .= "\n".'	,'
					."\n".'	icon: {'
					."\n".'	  image:new google.maps.MarkerImage ('
					."\n".'	   \''.$gmap_config[$i]['icon_image_img'].'\','
					."\n".'	   new google.maps.Size('.$icnsize[0].','.$icnsize[1].'),'		
					."\n".'	   new google.maps.Point(0,0),'						
					."\n".'	   new google.maps.Point('.$mkiconanchorxy[0].','.$mkiconanchorxy[1].')'
					."\n".'	 ),'							
					."\n".'	  shadow:new google.maps.MarkerImage ('
					."\n".'	   \''.$gmap_config[$i]['icon_shadow_img'].'\','
					."\n".'	   new google.maps.Size('.$shasize[0].','.$shasize[1].'),'		
					."\n".'	   new google.maps.Point(0,0),'						
					."\n".'	   new google.maps.Point('.$mkshadowanchorxy[0].','.$mkshadowanchorxy[1].')'
					."\n".'	 )'						
					."\n".'	}';
					
				};


				// end options
				$gmap_script .="\n".'  };';
				
				// call jquery
				$gmap_script .=''
				."\n".'  $jQ("#gmap_'.$gmap_config[$i]['id'].'").css({"width":'.$gmap_config[$i]['width'].',"height":'.$gmap_config[$i]['height'].'}).goMap(ops_'.(string)$gmap_config[$i]['id'].');';

			};
		}; 
	}; 

	// Pintamos JS en HEAD
	if($maps > 0 && $GETIMGSIZEJS != ""){

		$patron = '[js]';
		$gmap_result = str_replace($patron,$GETIMGSIZEJS,$gmap_result); 
		
		$patron = '[code]';	
		$gmap_result = str_replace($patron,$gmap_script,$gmap_result);  
		echo  $gmap_result."\n";
	};
};



/* __________________________________________________________________________________
 * Obtiene datos XML. Si el archivo no existe carga los datos por defecto.
 * Get XML data. If file not exists, load default data.
 */

function gmap_getXMLdata(){

	global $gmap_file, $error;
  
	if (file_exists($gmap_file)) {
	
		$gmap = array();		
		
		if(!$x = @getXML($gmap_file)){$x=0; $error = i18n_r('CHMOD_ERROR');return false;};
		
		$c=count($x->map);		
		
		for($i=0;$i<$c;$i++){
		
			$gmap[$i]['id']		 		= $x->map[$i]->id;
			$gmap[$i]['width']		 	= $x->map[$i]->width;
			$gmap[$i]['height']		 	= $x->map[$i]->height;
			$gmap[$i]['address']		= $x->map[$i]->address;
			$gmap[$i]['zoom']  			= $x->map[$i]->zoom;
			$gmap[$i]['maptype']  		= $x->map[$i]->maptype;			
			$gmap[$i]['image']			= $x->map[$i]->image;	
			$gmap[$i]['imagepos']		= $x->map[$i]->imagepos;	
			$gmap[$i]['shadow']			= $x->map[$i]->shadow;	
			$gmap[$i]['shadowpos']		= $x->map[$i]->shadowpos;
			$gmap[$i]['infotxt']		= $x->map[$i]->infotxt;	
			$gmap[$i]['popup']			= $x->map[$i]->popup;

			$h = count((string)$x->map[$i]->children('anchors'));

			for($a=0;$a<$h;$a++){
			
				$z = count($x->map[$i]->anchors[$a]);				
				for($b=0;$b<$z;$b++){
					$gmap[$i]['anchors'][] = array('address'	=> $x->map[$i]->anchors[$a]->anchor[$b]->address,
													'image'		=> $x->map[$i]->anchors[$a]->anchor[$b]->image,
													'imagepos'	=> $x->map[$i]->anchors[$a]->anchor[$b]->imagepos,
													'shadow'	=> $x->map[$i]->anchors[$a]->anchor[$b]->shadow,
													'shadowpos'	=> $x->map[$i]->anchors[$a]->anchor[$b]->shadowpos,
													'infotxt'	=> $x->map[$i]->anchors[$a]->anchor[$b]->infotxt,
													'popup'		=> $x->map[$i]->anchors[$a]->anchor[$b]->popup);													
				};
			};
			$gmap[$i]['icon_image_img']  	= $x->map[$i]->icon_image_img;
			$gmap[$i]['icon_image_pos']  	= $x->map[$i]->icon_image_pos;
			$gmap[$i]['icon_shadow_img']  	= $x->map[$i]->icon_shadow_img;
			$gmap[$i]['icon_shadowpos']  	= $x->map[$i]->icon_shadowpos;
			
			$gmap[$i]['controls_pan'] 		= $x->map[$i]->controls_pan;
			$gmap[$i]['controls_zoom'] 		= $x->map[$i]->controls_zoom;
			$gmap[$i]['controls_mtype'] 	= $x->map[$i]->controls_mtype;
			$gmap[$i]['controls_scale'] 	= $x->map[$i]->controls_scale;
			$gmap[$i]['controls_streetv'] 	= $x->map[$i]->controls_streetv;
		};
		
	// default xml data
	} else {
		$gmap[0]['id']		 			= "myMap";
		$gmap[0]['width']		 		= 600;
		$gmap[0]['height']		 		= 400;
		$gmap[0]['address']				= "Granollers, Barcelona, Spain";
		$gmap[0]['zoom'] 				= 12;
		$gmap[0]['maptype']  			= "ROADMAP";
	
		$gmap[0]['image']				= "http://www.singulae.com/public/getsimple/data/uploads/icons/singulae.png";
		$gmap[0]['imagepos']			= "cent-bot";
		
		$gmap[0]['shadow']				= "http://www.singulae.com/public/getsimple/data/uploads/icons/shadow.png";
		$gmap[0]['shadowpos']			= "left-bot";
		
		$gmap[0]['infotxt']				= '<a href="http://www.singulae.com/" target="_blank">www.singulae.com</a>';
		$gmap[0]['popup']				= 1;
		$gmap[0]['anchors'][]			= array('address'	=> 'Lli&ccedil;&agrave; de Munt, Barcelona, Spain',
												'image' 	=> 'http://www.singulae.com/public/getsimple/data/uploads/icons/alien.png',
												'imagepos'	=> 'cent-bot',	
												'shadow' 	=> 'http://www.singulae.com/public/getsimple/data/uploads/icons/shadow.png',
												'shadowpos'	=> 'left-bot',												
												'infotxt'	=> 'Hello GetSimple!',
												'popup'		=> 0);
		$gmap[0]['icon_image_img']  	= "http://www.singulae.com/public/getsimple/data/uploads/icons/bomber-2.png";
		$gmap[0]['icon_image_pos']  	= "cent-bot";
		$gmap[0]['icon_shadow_img']		= "http://www.singulae.com/public/getsimple/data/uploads/icons/shadow.png";
		$gmap[0]['icon_shadowpos']  	= "left-bot";
		$gmap[0]['controls_pan'] 		= 1;
		$gmap[0]['controls_zoom'] 		= 1;
		$gmap[0]['controls_mtype'] 		= 1;
		$gmap[0]['controls_scale'] 		= 1;
		$gmap[0]['controls_streetv']	= 1;
		
	};
	
	return $gmap;
};


/*
 **************** BACK-END *************
 */

/* __________________________________________________________________________________
 * Limpia y comprueba variables.
 * Clean and check vars.
 */

function gmap_clevar($val = false){
	if(!isset($val)){ $val = ''; };
	return $val;
};

function gmap_issetvar($val = false){
	 $test=false;
	 if(isset($val)){ if($val != '' && $val != NULL){  $test=true;}; };	 
	 return $test;	
};


/* __________________________________________________________________________________
 * Human-readable format xml
 * for debug..
 */

function formatXml($archivoXml) {
    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;
    $doc->load($archivoXml);
    $doc->save($archivoXml);
};


/* __________________________________________________________________________________
 * Checkea si existe la etiquteta %googlemap% en la página y añade 'add_action'.
 * Checks if exists tag %googlemap% in page and  add 'add_action'.
 */
 
function gmap_include_check($contcomp = false) {
	global $data_index;	
	
	// comprueba en contenido de componentes
	if( $contcomp ){ 
		$contcomp = get_components_content(); 
		if (strpos($contcomp, 'gmap_') == false  ){ $contcomp = false; };
	};
	
	// si no hay mapas en contenido ni en componentes: devulve false
	if (strpos($data_index->content, '(%googlemap') == false AND $contcomp == false){  return false; };
	
	// todo ok
	add_action('theme-header','gmap_header',$contcomp);
};


/* __________________________________________________________________________________
 * Sustituye etiqueta %googlemap% por el mapa.
 * Replace tag %googlemap% by map.
 */
 
 function gmap_show($contents){ 
  
    global $gmap_config;
	
    $tmpContent = $contents;;
	$maps 		= count($gmap_config);

	for($i=0;$i<$maps;$i++){
		$patron = '/\(%googlemap:'.$gmap_config[$i]['id'].'%\)/i';
		$div ='<div id="gmap_'.$gmap_config[$i]['id'].'"></div>';
		$tmpContent = preg_replace($patron,$div,$tmpContent);  
	};	
	return $tmpContent;
};



/**
 * Get components contents
 *

 */
function get_components_content() {
	$contcomp = "";
	if (file_exists(GSDATAOTHERPATH.'components.xml')) {
		$data = getXML(GSDATAOTHERPATH.'components.xml');
		$components = $data->item;
		if (count($components) != 0) {			
			foreach ($components as $component) {				 
				$contcomp .= strip_decode($component->value); 				
			};		
		};
	};
	return $contcomp;
};




/* __________________________________________________________________________________
 * Calcula posicion de icono y sombra
 * 
 */
 
function getPosxy($imgsize,$eje){

$w = (int) $imgsize[0];
$h = (int) $imgsize[1];
(string) $eje;

switch ($eje) {
    case "left-top":
        $x = 0;
		$y = 0;
        break;
	case "cent-top":
		$x = (int)($w/2);
		$y = 0;
		break;
    case "right-top":
		$x = $w;
		$y = 0;
		break;
	case "left-med":
		$x = 0;
		$y = (int)($h/2);
		break;
	case "cent-med":
		$x = (int)($w/2);
		$y = (int)($h/2);
		break;
	case "right-med":
		$x = $w;
		$y = (int)($h/2);
		break;
	case "left-bot":
		$x = 0;
		$y = $h;
		break;
	case "cent-bot":
		$x = (int)($w/2);
		$y = $h;
		break;
	case "right-bot":
		$x = $w;
		$y = $h;
		break;
	default:
		$x = (int)($w/2);
		$y = $h;
};

	$result = array($x,$y);	
	return $result ;
};



/* __________________________________________________________________________________
 * Plantilla/form marcadores.
 * Template/form markers.
 */

function draw_anchor($data_anchor,$i=0)
{
	global $gmap_thisfile;
	
	if(is_array($data_anchor)){
	
	$IDname = $data_anchor[0];	
	$style 	= 'style="display:block;"';
	if($IDname == "TEMP"){ $style = 'style="display:none;"';};	
	
	$gmap_anchor =' '."\n".'<div class="clear"></div>
		<div class="anchor" '.$style.'>'."\n"
			
			."\n".'<p style="height:5px;margin:10px 0 0 0;border-bottom:1px dotted #9EA3A8;float:none;"></p>'
			."\n".'<p class="clear"></p>'."\n"
			
			."\n".'<!-- delAnchor -->'
			."\n".'<div class="edit-nav" style="height:15px;margin:10px 0 0 0;">'
			."\n".'	<a href="javascript:void(0);" class="soft delAnchor">&times;</a>'
			."\n".'</div>'
		
			."\n".'<p class="clear"></p>'
					
			."\n".'<label for="gmap_anchor_addr">'.i18n_r($gmap_thisfile."/ADDRESS").'</label>'
			."\n".'<input  name="gmap_anchor_'.$IDname.'['.$i.'][address]"  type="text" class="text textanchor" value="'.$data_anchor[1].'"/>'

			."\n".'<p class="clear"></p>'
			
			."\n".'<p style="margin:0 15px 0 0;">'			
			."\n".'<label for="gmap_anchor_image">'.i18n_r($gmap_thisfile."/IMAGE").'</label>'
			."\n".'<input  name="gmap_anchor_'.$IDname.'['.$i.'][image]"  type="text" class="text semiextraanchor" value="'.$data_anchor[2].'" />'
			."\n".'</p>';

			// add axis selector
			$gmap_anchor .=	  draw_axis_selector("gmap_anchor_".$IDname."[".$i."][imagepos]", $data_anchor[3],1); 
				
			$gmap_anchor .=''
			."\n".'<p style="margin:0 15px 0 0;">'			
			."\n".'<label for="gmap_anchor_shadow">'.i18n_r($gmap_thisfile."/IMAGE").'</label>'
			."\n".'<input  name="gmap_anchor_'.$IDname.'['.$i.'][shadow]"  type="text" class="text semiextraanchor" value="'.$data_anchor[4].'" />'
			."\n".'</p>';

			// add axis selector			
			$gmap_anchor .=	  draw_axis_selector("gmap_anchor_".$IDname."[".$i."][shadowpos]", $data_anchor[5],1); 

			
			$gmap_anchor .=''
			."\n".'<p style="margin:0 20px 0 0;">'
			."\n".'<label for="gmap_anchor_infotxt">'.i18n_r($gmap_thisfile."/INFO").'</label>'
			."\n".'<textarea name="gmap_anchor_'.$IDname.'['.$i.'][infotxt]" style="width:400px">'.$data_anchor[6].'</textarea>'
			."\n".'</p>';


			$checked = '';		
	
			if(isset($data_anchor[7])){
				$checked = ( $data_anchor[7] == 1 ) ? 'checked="checked"' : '';		
				
			};
			
			$gmap_anchor .=''
			."\n".'<p style="margin:0;">'
			."\n".'	<label for="gmap_popup" class="popuplabel font-med">'
			."\n".'	<input type="checkbox" class="popupinput" name="gmap_anchor_'.$IDname.'['.$i.'][popup]" value="1" '.$checked .'/>'
			."\n".' '.i18n_r($gmap_thisfile."/POPUP").'</label>'
			."\n".'</p>';

			$gmap_anchor .= ""
			."\n".'<div class="clear"></div>'
			."\n".'</div>'
			."\n".'<div class="clear"></div>';
				
		echo $gmap_anchor;
	};
};

function draw_axis_selector($name, $value, $return=0){

	global $gmap_thisfile;
	
	$html = '
	<!-- -------  -->	
	<div class="boxEje">		
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="left-top"';	if($value == "left-top"){ $html .= 'checked="checked"'; };
	$html .='></div>'."\n";	
	$html .='
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="cent-top"';	if($value == "cent-top"){ $html .= 'checked="checked"'; };
	$html .='></div>'."\n";	
	$html .='
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="right-top"'; if($value == "right-top"){$html .= 'checked="checked"'; };
	$html .='></div>'."\n";	
	$html .='
		<div class="clear"></div>		
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="left-med"'; if($value == "left-med"){$html .= 'checked="checked"'; };
	$html .='></div>'."\n";	
	$html .='
		<div class="radio" >
		<input type="radio" class="axiscenter" name="'.$name.'" value="cent-med"'; if($value == "cent-med"){$html .= 'checked="checked"'; };
	$html .='></div>'."\n";	
	$html .='
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="right-med"'; if($value == "right-med"){$html .= 'checked="checked"'; };
	$html .='></div>'."\n";	
	$html .='
		<div class="clear"></div>		
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="left-bot"'; if($value == "left-bot"){$html .= 'checked="checked"'; };
	$html .='></div>'."\n";
	$html .='
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="cent-bot"'; if($value == "cent-bot"){$html .= 'checked="checked"'; };
	$html .='></div>'."\n";
	$html .='
		<div class="radio" >
		<input type="radio" name="'.$name.'" value="right-bot"'; if($value == "right-bot"){$html .= 'checked="checked"'; };
	$html .='></div>'."\n";		
	$html .='
		</div>
		<p style="margin:16px 0 0 0;"><label for="gmap_shadowpos_" class="font-med posxylabel">'.i18n_r($gmap_thisfile."/ICO_IMAGE_POS").'</label></p>
		<div class="clear"></div>
		
		
		<!-- ----- -->
		';
	if($return == 1){
		return $html;
	}else{	
		echo $html;
	};

};

/* __________________________________________________________________________________
 * Formulario de configuración del plugin.
 * Form Plugin configuration.
 */
 
function gmap_show_config() 
{
	global $gmap_file, $gmap_config, $gmap_thisfile, $success, $error, $LANG;

	i18n_merge('googlemap') || i18n_merge('googlemap','en_US');

	// submitted form
	if (isset($_POST['submit'])) {
	
		$gmap_config = array();
	
		$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="ISO-8859-15"?><maps></maps>');

		for ($i=0; isset($_POST['gmap_id'][$i]); $i++) {
		
			$nom = $_POST['gmap_id'][$i];

			// RECOGE DATA
			$gmap_config[$i]['id'] 					= gmap_clevar($_POST['gmap_id'][$i]);
			$gmap_config[$i]['width'] 				= gmap_clevar($_POST["gmap_width_$nom"]);
			$gmap_config[$i]['height'] 				= gmap_clevar($_POST["gmap_height_$nom"]);
			$gmap_config[$i]['zoom'] 				= gmap_clevar($_POST["gmap_zoom_$nom"]);
			$gmap_config[$i]['address'] 			= gmap_clevar($_POST["gmap_addr_$nom"]);
			$gmap_config[$i]['maptype']				= gmap_clevar($_POST["gmap_maptype_$nom"]);	
			$gmap_config[$i]['image']				= gmap_clevar($_POST["gmap_image_$nom"]);
			$gmap_config[$i]['imagepos']			= gmap_clevar($_POST["gmap_imagepos_$nom"]);
			$gmap_config[$i]['shadow']				= gmap_clevar($_POST["gmap_shadow_$nom"]);
			$gmap_config[$i]['shadowpos']			= gmap_clevar($_POST["gmap_shadowpos_$nom"]);
			$gmap_config[$i]['infotxt']				= gmap_clevar($_POST["gmap_infotxt_$nom"]);	
			$gmap_config[$i]['popup']				= (isset($_POST["gmap_popup_$nom"])) ? 1 : 0;	
			$gmap_config[$i]['icon_image_img']  	= gmap_clevar($_POST["gmap_icon_image_img_$nom"]);			
			$gmap_config[$i]['icon_image_pos']  	= gmap_clevar($_POST["gmap_icon_image_pos_$nom"]);
			$gmap_config[$i]['icon_shadow_img']  	= gmap_clevar($_POST["gmap_icon_shadow_img_$nom"]);
			$gmap_config[$i]['icon_shadowpos']  	= gmap_clevar($_POST["gmap_icon_shadowpos_$nom"]) ;
			


			
			if ( isset( $_POST["gmap_anchor_".$nom] ) ){
				if (  count( $_POST["gmap_anchor_$nom"])>0  ){			
			
					$anch= count( $_POST["gmap_anchor_$nom"]);

					for($z=0;$z<$anch;$z++){
					
						$gmap_config[$i]['anchors'][] = array('address'		=> (isset($_POST["gmap_anchor_$nom"][$z]['address'])) ? $_POST["gmap_anchor_$nom"][$z]['address'] : 0 ,
															  'image'  		=> (isset($_POST["gmap_anchor_$nom"][$z]['image'])) ? $_POST["gmap_anchor_$nom"][$z]['image'] : 0 ,
															  'imagepos'	=> (isset($_POST["gmap_anchor_$nom"][$z]['imagepos'])) ? $_POST["gmap_anchor_$nom"][$z]['imagepos'] : 0 ,
															  'shadow'  	=> (isset($_POST["gmap_anchor_$nom"][$z]['shadow'])) ? $_POST["gmap_anchor_$nom"][$z]['shadow'] : 0 ,
															  'shadowpos'	=> (isset($_POST["gmap_anchor_$nom"][$z]['shadowpos'])) ? $_POST["gmap_anchor_$nom"][$z]['shadowpos'] : 0 ,														  
															  'infotxt'		=> (isset($_POST["gmap_anchor_$nom"][$z]['infotxt'])) ? $_POST["gmap_anchor_$nom"][$z]['infotxt'] : 0 ,
															  'popup'		=> (isset($_POST["gmap_anchor_$nom"][$z]['popup'])) ? 1 : 0 );
					};
				};
			};

			$gmap_config[$i]['controls_pan']  		= (isset($_POST["gmap_controls_pan_$nom"])) 	? 1 : 0;
			$gmap_config[$i]['controls_zoom']  		= (isset($_POST["gmap_controls_zoom_$nom"])) 	? 1 : 0;
			$gmap_config[$i]['controls_mtype']  	= (isset($_POST["gmap_controls_mtype_$nom"])) 	? 1 : 0;
			$gmap_config[$i]['controls_scale']  	= (isset($_POST["gmap_controls_scale_$nom"])) 	? 1 : 0;
			$gmap_config[$i]['controls_streetv']	= (isset($_POST["gmap_controls_streetv_$nom"])) ? 1 : 0;

		
			
			// CREATE XML
			$item = $xml->addChild('map');
			$item->addChild('id')			->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['id']), 	ENT_QUOTES));
			$item->addChild('width')		->addCData($gmap_config[$i]['width']);
			$item->addChild('height')		->addCData($gmap_config[$i]['height']);
			$item->addChild('address')		->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['address']),ENT_QUOTES,"ISO-8859-15"));
			$item->addChild('zoom')			->addCData($gmap_config[$i]['zoom']);
			$item->addChild('maptype')		->addCData($gmap_config[$i]['maptype']);			
			$item->addChild('image')  		->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['image']), 	ENT_QUOTES,"ISO-8859-15"));
			$item->addChild('imagepos')		->addCData($gmap_config[$i]['imagepos']);
			$item->addChild('shadow')  		->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['shadow']), 	ENT_QUOTES,"ISO-8859-15"));
			$item->addChild('shadowpos')	->addCData($gmap_config[$i]['shadowpos']);
			$item->addChild('infotxt')		->addCData($gmap_config[$i]['infotxt']);
			$item->addChild('popup')		->addCData($gmap_config[$i]['popup']);

			// Add anchors
			if(isset($gmap_config[$i]['anchors'])){
				if(count( $gmap_config[$i]['anchors'])>0){
							$anchors = $item->addChild('anchors');			
				};
			};
			
			if ( isset( $_POST["gmap_anchor_".$nom] ) ){
				if (  count( $gmap_config[$i]['anchors'])>0 ){
				
					$ans = count( $gmap_config[$i]['anchors']);

					
					for($a=0;$a<$ans;$a++){	
					
						if(gmap_issetvar($gmap_config[$i]['anchors'][$a]['address'])){					
							if(strlen($gmap_config[$i]['anchors'][$a]['address']) > 0){

							$anchor = $anchors->addChild('anchor');
							$anchor->addChild('address')	->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['anchors'][$a]['address']), ENT_QUOTES,"ISO-8859-15"));
							$anchor->addChild('image')  	->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['anchors'][$a]['image']), 	ENT_QUOTES,"ISO-8859-15"));
							$anchor->addChild('imagepos')	->addCData($gmap_config[$i]['anchors'][$a]['imagepos']);
							$anchor->addChild('shadow')  	->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['anchors'][$a]['shadow']), 	ENT_QUOTES,"ISO-8859-15"));
							$anchor->addChild('shadowpos')	->addCData($gmap_config[$i]['anchors'][$a]['shadowpos']);					
							$anchor->addChild('infotxt')	->addCData($gmap_config[$i]['anchors'][$a]['infotxt']);
							$anchor->addChild('popup')		->addCData($gmap_config[$i]['anchors'][$a]['popup']);
							};
						};
					};
				};
			};
			
			$item->addChild('icon_image_img')	->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['icon_image_img']),   ENT_QUOTES,"ISO-8859-15"));
			$item->addChild('icon_image_pos')	->addCData(stripslashes($gmap_config[$i]['icon_image_pos']));
			$item->addChild('icon_shadow_img')	->addCData(htmlspecialchars(stripslashes($gmap_config[$i]['icon_shadow_img']), ENT_QUOTES,"ISO-8859-15"));
			$item->addChild('icon_shadowpos')	->addCData(stripslashes($gmap_config[$i]['icon_shadowpos']));			
			$item->addChild('controls_pan')		->addCData($gmap_config[$i]['controls_pan']);
			$item->addChild('controls_zoom')	->addCData($gmap_config[$i]['controls_zoom']);
			$item->addChild('controls_mtype')	->addCData($gmap_config[$i]['controls_mtype']);
			$item->addChild('controls_scale')	->addCData($gmap_config[$i]['controls_scale']);
			$item->addChild('controls_streetv')	->addCData($gmap_config[$i]['controls_streetv']);
				
		};
		
	

		
		// Save
		if(!XMLsave($xml, $gmap_file)){
			$error = i18n_r('CHMOD_ERROR');
		}else{
			$success = i18n_r('SETTINGS_UPDATED');
			
			/* Human-readable format. For debug..
			formatXml($gmap_file);
			*/
		};
		
	}else{
		$gmap_config = gmap_getXMLdata();
	};


	// Show success
	if($success) { 
		echo '<br/><div class="updated"><b>'. $success .'</b></div>';
	};
	if($error) { 
		echo '<br/><div class="error"><b>'. $error .'</b></div>';
	};
	
	?>

		
	<script type="text/javascript">
		var gmap_msgs= new Array();
		gmap_msgs['msg_del_map']     = '<?php i18n($gmap_thisfile."/DEL_MAP_QUEST");?>';
		gmap_msgs['msg_del_anchor']  = '<?php i18n($gmap_thisfile."/DEL_ANCHOR_QUEST");?>';
		gmap_msgs['msg_id_exists']   = '<?php i18n($gmap_thisfile.'/ALERT_ID_EXISTS');?>';
		gmap_msgs['YES']             = '<?php i18n('YES');?>';
		gmap_msgs['NO']              = '<?php i18n('NO');?>';
	</script>

	<link rel="stylesheet" type="text/css" media="all" href="../plugins/googlemap/css/styles.css"/>	
	<script language="javascript" type="text/javascript" src="../plugins/googlemap/js/jquery.scripts.js"></script>
	
	<script type="text/javascript">
	//<![CDATA[

	//]]>
	</script>
		

	<div id="googlemapPlugin">
	<ul id="event-log" />
		<form method="post" name="formmap" action="<?php echo $_SERVER ['REQUEST_URI'];?>">  
		
		<h3 class="floated"><?php i18n($gmap_thisfile.'/TITLE');?></h3>

		<div class="edit-nav clearfix">
			<a href="#" class="ops" name="gmap_how"><?php i18n($gmap_thisfile.'/HOW');?></a>		
		</div>
		
		 <div class="clear"/></div>
		
		
		<div id="gmap_how">
			 
			<fieldset style="font-weight:normal;">
				<legend><?php i18n($gmap_thisfile.'/HOW');?></legend>
				<ul>
					<li><?php i18n($gmap_thisfile.'/HOW1');?></li>
					<li><?php i18n($gmap_thisfile.'/HOW2');?></li>
					<li><?php i18n($gmap_thisfile.'/HOW3');?></li>
					<li><?php i18n($gmap_thisfile.'/HOW4');?></li>
				</ul>
				<p class="font-med"><?php i18n($gmap_thisfile.'/BONUS_INFO');?></p>
			</fieldset>	
		</div>


		<!-- -->
		
		  
		  <p class="clear"/>&nbsp;</p>

		  <div class="edit-nav" style="height:30px;margin:0 0 20px 0;">
		  <a href="#" id="addMap" style="float:left;"><?php i18n($gmap_thisfile.'/ADD_NEW_MAP_BT');?></a>
		  </div>
		  
			<?php
			$maps = count($gmap_config);
			for($i=0;$i<$maps;$i++){
			$id = $gmap_config[$i]['id'];
			?>
			
			<div class="gmapbox" id="gmapbox_<?php echo $id;?>">		

				<div class="edit-nav" style="height:15px;margin:0;">
					<h3  style="float:left;"><?php i18n($gmap_thisfile.'/TIT_MAP');?><i> #<?php echo $gmap_config[$i]['id']; ?></i></h3>
					<a href="javascript:void(0);" class="soft delMap" id="delmap_<?php echo $id;?>">&times;</a>
				</div>
				
				<p class="clear"></p>
				<div class="basic">
					<p style="margin:0 15px 0 0;">
						<label for="gmap_id"><?php i18n($gmap_thisfile.'/ID');?></label>
						<input  name="gmap_id[]" type="text" class="text medium idmap" value="<?php echo $gmap_config[$i]['id']; ?>"/>
					</p>
					<p style="margin:0 15px 0 0;">
						<label for="gmap_width"><?php i18n($gmap_thisfile.'/WIDTH');?></label>
						<input name="gmap_width_<?php echo $id;?>" type="text" class="text mini mooc-n" value="<?php echo $gmap_config[$i]['width']; ?>"/>
					</p>
					<p style="margin:0 15px 0 0;">
						<label for="gmap_height"><?php i18n($gmap_thisfile.'/HEIGHT');?></label>
						<input name="gmap_height_<?php echo $id;?>" type="text" class="text mini mooc-n" value="<?php echo $gmap_config[$i]['height']; ?>"/>
					</p>
					<p style="margin:0">
						<label for="gma_zoom"><?php i18n($gmap_thisfile.'/ZOOM');?></label>
						<input  name="gmap_zoom_<?php echo $id;?>" class="text mini mooc-n" type="text" value="<?php echo $gmap_config[$i]['zoom']; ?>"/>
					</p>					
					<p class="clear"></p>	

					<p style="margin:0;width:100%">
						<label for="gmap_addr"><?php i18n($gmap_thisfile.'/ADDRESS');?></label>
						<input name="gmap_addr_<?php echo $id;?>"  type="text" class="text" value="<?php echo $gmap_config[$i]['address']; ?>"/>
					</p>
					<p class="clear"></p>	
			
					<p style="margin:0 15px 0 0;">	
						<label for="gmap_image"><?php i18n($gmap_thisfile.'/IMAGE');?></label>
						<input  name="gmap_image_<?php echo $id;?>"  type="text" class="text semiextra" value="<?php echo $gmap_config[$i]['image']; ?>" />
					</p>

					<?php // add axis selector
						  draw_axis_selector("gmap_imagepos_".$id, $gmap_config[$i]['imagepos']); 
					?>
			
					<div class="clear"></div>
					
					<p style="margin:0 15px 0 0;">
						<label for="gmap_shadow"><?php i18n($gmap_thisfile.'/SHADOW');?></label>
						<input  name="gmap_shadow_<?php echo $id;?>" type="text"  class="text semiextra" value="<?php echo $gmap_config[$i]['shadow']; ?>" />
					</p>
					
					
					<?php // add axis selector
						  draw_axis_selector("gmap_shadowpos_".$id, $gmap_config[$i]['shadowpos']); 
					?>
					
					
					<p style="margin:0 15px 0 0;">	
						<label for="gmap_infotxt"><?php i18n($gmap_thisfile.'/INFO');?></label>
						<textarea name="gmap_infotxt_<?php echo $id;?>"><?php echo $gmap_config[$i]['infotxt']; ?></textarea>
					</p>	
					

					<p style="margin:0;">	
						<label for="gmap_popup" class="popuplabel font-med">
						<input type="checkbox"  class="popupinput" name="gmap_popup_<?php echo $id;?>" value="1" <?php if($gmap_config[$i]['popup']==1){ echo 'checked="checked"';};	?>/>
						<?php i18n($gmap_thisfile.'/POPUP');?></label>
					</p>
				</div>
				
				<!-- advanced settings -->
				
				<p class="clear"></p>			
				<div class="edit-nav" style="height:15px;margin:30px 0 0 0;">
				  <a href="#" class="advanced_bot soft" style="float:left;"><?php i18n($gmap_thisfile.'/ADV_SETTINGS_BT');?></a>
				  <p class="linesep"></p>
				</div>
				
				<p class="clear"></p>
				<div class="advanced">
				
					<p>&nbsp;</p>					

					
					<fieldset>
						<legend><?php i18n($gmap_thisfile.'/ANCHORS');?></legend>	
						<div class="edit-nav" style="height:25px;margin:0;">
							<a href="#" class="addAnchor"><?php i18n($gmap_thisfile.'/ADD_NEW_ANCHOR_BT');?></a><p style="float:left;font-size:100%;font-weight:normal;margin-left:20px"><?php i18n($gmap_thisfile.'/ADD_NEW_ANCHOR_TX');?></p>
						</div>
						<div class="clear"></div>
						<?php 
						// Anchors		

						$anchors = (!isset($gmap_config[$i]['anchors'])) ? 0 : count($gmap_config[$i]['anchors']);

						for($a=0;$a<$anchors;$a++){					
						
							$anchor_addrs   	= (isset($gmap_config[$i]['anchors'][$a]['address'])) 		? $gmap_config[$i]['anchors'][$a]['address'] 	: "";
							$anchor_image   	= (isset($gmap_config[$i]['anchors'][$a]['image']))   		? $gmap_config[$i]['anchors'][$a]['image']   	: "";
							$anchor_imagepos 	= (isset($gmap_config[$i]['anchors'][$a]['imagepos'])) 		? $gmap_config[$i]['anchors'][$a]['imagepos'] 	: "cent-med";
							$anchor_shadow   	= (isset($gmap_config[$i]['anchors'][$a]['shadow']))   		? $gmap_config[$i]['anchors'][$a]['shadow']   	: "";
							$anchor_shadowpos 	= (isset($gmap_config[$i]['anchors'][$a]['shadowpos'])) 	? $gmap_config[$i]['anchors'][$a]['shadowpos'] 	: "cent-med";
							$anchor_text    	= (isset($gmap_config[$i]['anchors'][$a]['infotxt'])) 		? $gmap_config[$i]['anchors'][$a]['infotxt'] 	: "";
							$anchor_popup    	= (isset($gmap_config[$i]['anchors'][$a]['popup'])) 		? $gmap_config[$i]['anchors'][$a]['popup']		: 0;
						
							
							$data_anchor = array($id,$anchor_addrs,$anchor_image,$anchor_imagepos,$anchor_shadow,$anchor_shadowpos,$anchor_text,$anchor_popup );
							draw_anchor($data_anchor,$a);
							
							
						};
						// End Anchors
						?>
		
					</fieldset>
					
					<p class="clear"></p>
					
					<fieldset>
						<legend><?php i18n($gmap_thisfile.'/ICON');?></legend>	
						<p style="margin:0 15px 0 0;"><label for="gmap_icon_image_img"><?php i18n($gmap_thisfile.'/IMAGE');?></label><input name="gmap_icon_image_img_<?php echo $id;?>"  type="text" class="text semi" value="<?php echo $gmap_config[$i]['icon_image_img']; ?>" /></p>
						
						<?php // add axis selector
						  draw_axis_selector("gmap_icon_image_pos_".$id, $gmap_config[$i]['icon_image_pos']); 
						?>   
						<p class="clear"></p>
						
						<p style="margin:0 15px 0 0;"><label for="gmap_icon_shadow_img"><?php i18n($gmap_thisfile.'/SHADOW');?></label><input  name="gmap_icon_shadow_img_<?php echo $id;?>" type="text"  class="text semi" value="<?php echo $gmap_config[$i]['icon_shadow_img']; ?>" /></p>
						
						<?php // add axis selector
						  draw_axis_selector("gmap_icon_shadowpos_".$id, $gmap_config[$i]['icon_shadowpos']); 
						?>
					</fieldset>				
					
					<p class="clear"></p>
					
					<fieldset>
						<legend><?php i18n($gmap_thisfile.'/MAPTYPE');?></legend>	
						<label for="ROADMAP"><input type="radio" class="radiocontrol" name="gmap_maptype_<?php echo $id;?>" value="ROADMAP" <?php if($gmap_config[$i]['maptype']=="ROADMAP"){ echo 'checked="checked"';}; ?>/><?php i18n($gmap_thisfile.'/ROADMAP');?><span> <?php i18n($gmap_thisfile.'/DESC_ROADMAP');?></span></label>
						<label for="SATELLITE"><input type="radio" class="radiocontrol"  name="gmap_maptype_<?php echo $id;?>" value="SATELLITE" <?php if($gmap_config[$i]['maptype']=="SATELLITE"){ echo 'checked="checked"';};	?>/><?php i18n($gmap_thisfile.'/SATELLITE');?><span> <?php i18n($gmap_thisfile.'/DESC_SATELLITE');?></span></label>
						<label for="HYBRID"><input type="radio" class="radiocontrol"  name="gmap_maptype_<?php echo $id;?>" value="HYBRID" <?php if($gmap_config[$i]['maptype']=="HYBRID"){ echo 'checked="checked"';};	?>/><?php i18n($gmap_thisfile.'/HYBRID');?><span> <?php i18n($gmap_thisfile.'/DESC_HYBRID');?></span></label>
						<label for="TERRAIN"><input type="radio" class="radiocontrol"  name="gmap_maptype_<?php echo $id;?>" value="TERRAIN" <?php if($gmap_config[$i]['maptype']=="TERRAIN"){ echo 'checked="checked"';};	?>/><?php i18n($gmap_thisfile.'/TERRAIN');?><span> <?php i18n($gmap_thisfile.'/DESC_TERRAIN');?></span></label>
					</fieldset>
					
					<p class="clear"></p>
					<fieldset name="CONTROLS" class="CONTROLS">
						<legend><?php i18n($gmap_thisfile.'/CONTROLS');?></legend>	
						
						<label for="PAN">
						<input type="checkbox" name="gmap_controls_pan_<?php echo $id;?>" value="1" <?php if($gmap_config[$i]['controls_pan']==1){ echo 'checked="checked"';};	?>/>
						<?php i18n($gmap_thisfile.'/CTRL_PAN');?>
						</label>
						
						<label for="ZOOM">
						<input type="checkbox" name="gmap_controls_zoom_<?php echo $id;?>" value="1" <?php if($gmap_config[$i]['controls_zoom']==1){ echo 'checked="checked"';};	?>/>
						<?php i18n($gmap_thisfile.'/CTRL_ZOOM');?>
						</label>
						
						<label for="MTYPE">
						<input type="checkbox" name="gmap_controls_mtype_<?php echo $id;?>" value="1" <?php if($gmap_config[$i]['controls_mtype']==1){ echo 'checked="checked"';};	?>/>
						<?php i18n($gmap_thisfile.'/CTRL_MAPTYPE');?>
						</label>
						
						<p class="clear"></p>
						
						<label for="SCALE">
						<input type="checkbox" name="gmap_controls_scale_<?php echo $id;?>" value="1" <?php if($gmap_config[$i]['controls_scale']==1){ echo 'checked="checked"';};	?>/>
						<?php i18n($gmap_thisfile.'/CTRL_SCALE');?>
						</label>
						
						<label for="STREETV">
						<input type="checkbox" name="gmap_controls_streetv_<?php echo $id;?>" value="1"<?php if($gmap_config[$i]['controls_streetv']==1){ echo 'checked="checked"';};	?>/>
						<?php i18n($gmap_thisfile.'/CTRL_STREETW');?>
						</label>
						
						
					</fieldset>
					
				</div>
			</div>
			
			<?php
			};
			?>
			
			<p>&nbsp;</p>
			<p class="submit"><input type="submit" class="submit" value="<?php i18n('BTN_SAVESETTINGS'); ?>" name="submit" /></p>
			
			<!--    Anchor template    -->
			<?php draw_anchor(array("TEMP",false,false,false,false,false,false,false)); ?>
			<!-- --------------------- -->
			
		</form>

	</div>

<?php

}; // End function gmap_show_config()

?>