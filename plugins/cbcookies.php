<?php
/*
Name: To acept cookies
Description: It is for to acept cookies of web and continue in web.
Version:1.0
Author: Cumbe
Author URI: http://cumbe.260mb.org/
*/

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile,
	'Cumbe_cookies',
	'1.2',
	'Cumbe',
	'http://cumbe.260mb.org/',
	'Description: To accept cookies of web.',
	'plugins', //page type
	'cb_cookies_bend'
);

//set internationalization
global $LANG;
  i18n_merge('cbcookies', $LANG);
  i18n_merge('cbcookies', 'en_US');

//add css to head
add_action('theme-header','cb_cookies_css');

//add to accept cookies 
add_action('theme-footer','cb_cookies');

//añadimos al sidebar de la pestaña plugin
add_action('plugins-sidebar','createSideMenu', array('cbcookies', $i18n['cbcookies/name']));


///////////////////////////////////////////
//   Function that add css file 
//   
//   it uses hook "theme-header"
///////////////////////////////////////////
function cb_cookies_css(){
   global $SITEURL;
   echo '<link href="'.$SITEURL.'plugins/cbcookies/cbcookies.css" rel="stylesheet" type="text/css" />';
}

////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////

///////////////////////////////////////////
//   
//   BACKEND of COOKIES
//   
///////////////////////////////////////////
function cb_cookies_bend(){
	global $SITEURL;
	global $i18n, $LANG;

	//cbcookies
	$log_name = 'cbcookies.xml';
	$log_path = GSDATAOTHERPATH.'cbcookies/';
	$log_file = $log_path . $log_name;

	//check exists dir $log_path;
	//if don't > create.
	if(!is_dir($log_path)){
		@mkdir($log_path, 0755);
	}
	
	$ndVal= array();
	//save data of form
	//check $log_file
	if ( !file_exists($log_file) ) {
		$ndVal[0] = i18n_r('cbcookies/message');
		$ndVal[1] = strtolower(i18n_r('cbcookies/cbtop'));
		$ndVal[2] = "";
		$ndVal[3] = "365";
		$ndVal[4] = "1-".i18n_r('cbcookies/cbdays');

		$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><entry></entry>');
		$thislog = $xml->addChild('sett');
		$cdata = $thislog->addChild('cbcook_msg',$ndVal[0]);   //ndVal=0 text of message
		$cdata = $thislog->addChild('cbcook_pos',$ndVal[1]);  //ndVal=1 possition of message in web
		$cdata = $thislog->addChild('cbcook_page', ''); //ndVal=2 page of more information
		$cdata = $thislog->addChild('cbcook_time','365');  //ndVal=3 how many time?
		$cdata = $thislog->addChild('cbcook_scale',$ndVal[4]);   //ndVal=4 format time: days, hours,minutes...
		XMLsave($xml, $log_file);    

	} else {
		//call data of settings
		$domDocument = new DomDocument();
		$domDocument->load($log_file);

		//filter with DOMXPath
		$xpath = new DOMXPath($domDocument);
		$filex = 1;
		$num=0;
		$n=0; 
		$verN = $xpath->query('sett');			
		$num = $verN->length;           
		if ($num > 0){	
			$dNdList = $verN->item(0)->getElementsByTagName( "*" );
			foreach ($dNdList as $node){
				$ndVal[$n]= $node->nodeValue;
				$n++;
			}
		}
	}


	echo '<br /><h3 style="font-size: 16px;">'.strtoupper(i18n_r('cbcookies/setting')).'</h3>'."\n";


////////////////////////////////////////
//      Edit SETTINGS                 //
////////////////////////////////////////
?>
	<script type="text/javascript">
<!--
       		function ncselect(id,texto){
              		var frm=document.getElementById(id);
	              	frm.value = texto;
	        }	            
-->
	</script>
<?php


	$n = 0;
	if (@$_GET['sett']== 'y' and isset($_POST['cbcook-submit'])) {
		$ndVal = $_POST['q_sett'];
		if ($num > 0){	
			foreach ($dNdList as $node){				$node->nodeValue = trim($ndVal[$n]);
				$n++;
			}
			$domDocument->save($log_file);
			echo '<span style="float: right; text-align: center; font-family: Georgia,Times,Times New Roman,serif; font-size: 16px; font-weight: bold;">'.i18n_r('cbcookies/cbchsav').'</span><br />'."\n";
		}
	}

	//select days, hours,...
	$optiondt = '';
	$fmdt[1] = i18n_r('cbcookies/cbdays');
	$fmdt[2] = i18n_r('cbcookies/cbhours');
	$fmdt[3] = i18n_r('cbcookies/cbminutes');
	$fmdt[4] = i18n_r('cbcookies/cbseconds');
	for ($q=1; $q<=4; $q++){
		if ($q == substr($ndVal[4],0,1)){ 
			$optiondt.='<OPTION VALUE="'.$q.'-'.$fmdt[$q].'" SELECTED>'.$fmdt[$q].'</OPTION>'."\n";
		} else {
			$optiondt.='<OPTION VALUE="'.$q.'-'.$fmdt[$q].'">'.$fmdt[$q].'</OPTION>'."\n";
		}
	}

	//select messages
	$optionmsg = '';
	$optionmsg .= '<OPTION VALUE="'.i18n_r('cbcookies/message').'" SELECTED>'.i18n_r('cbcookies/message').'</OPTION>'."\n";
	$optionmsg .= '<OPTION VALUE="'.i18n_r('cbcookies/message1').'" >'.i18n_r('cbcookies/message1').'</OPTION>'."\n";
	$optionmsg .= '<OPTION VALUE="'.i18n_r('cbcookies/message2').'" >'.i18n_r('cbcookies/message2').'</OPTION>'."\n";
////////////////////////////////////////
//      Form SETTINGS                 //
////////////////////////////////////////
	echo '<form name="formulario" action="load.php?id=cbcookies&amp;action=setting&amp;sett=y" method="post">'."\n";
		//Text of message
		echo '<div style="float: left; width: 95%;">'."\n";
	        	echo '<p><label>'.i18n_r('cbcookies/message_lb').':</label>'."\n";
           		echo '<SELECT NAME="sett[0]" style="border: 1px solid #AAAAAA; border-radius: 2px 2px 2px 2px; text-align: left; padding-right: 1px; width: 90%;" onclick="javascript:ncselect(&quot;txtmsg&quot;, this.value)">'."\n";
        	        	echo $optionmsg;
        	   	echo '</SELECT></p>'."\n";
	        	echo '<p><TEXTAREA id="txtmsg" style="border: 1px solid #AAAAAA; border-radius: 2px 2px 2px 2px; height: 40px; margin: 0 0 0 3px; width: 100%; text-align: left;" type="text" name="q_sett[0]">'.$ndVal[0].'</TEXTAREA></p>'."\n";
		echo '</div>'."\n";
		
                echo '<div style="clear: left;"></div>'."\n";

		//position of message (top or bottom)
		echo '<div style="float: left; width: 50%;">'."\n";
           		echo '<p><label>'.i18n_r('cbcookies/pos_message').'</label>'."\n";
			echo '<INPUT style="margin-left: 30px; vertical-align: middle;" type="radio" name="q_sett[1]" value="top"';
                   	if ($ndVal[1] == 'top') {
                       		echo 'CHECKED';
                   	}
                	echo ' />'.i18n_r('cbcookies/cbtop');
	 		echo '<span style="margin-left: 30px;">&nbsp;</span>';
			echo '<INPUT style="vertical-align: middle;" type="radio" name="q_sett[1]" value="bottom"';
                   	if ($ndVal[1] == 'bottom') {
                       		echo 'CHECKED';
                   	}
                	echo ' />'.i18n_r('cbcookies/cbbottom');
           		echo '</p>'."\n";
		echo '</div>'."\n";        

		//page with 'more information' of cookies
           	echo '<div style="float: left; width: 50%;">'."\n";
           		echo '<p>';
	           	echo '<label>'.i18n_r('cbcookies/page_more').':</label>'."\n";
           		echo '<SELECT NAME="q_sett[2]" style="border: 1px solid #AAAAAA; border-radius: 2px 2px 2px 2px; text-align: left; padding-right: 1px; width: 90%;">'."\n";
                        	$pages_nm = $ndVal[2];
                        	$pages = get_available_pages();
          			echo '<option value=""> </option>'."\n";
                       		foreach ($pages as $page) {
                             		if ($pages_nm == $page['slug']) {
          				  echo '<option value="'.$page['slug'].'" SELECTED>'.$page['slug'].'</option>'."\n";
		             		} else {
			        	  echo '<option value="'.$page['slug'].'">'.$page['slug'].'</option>'."\n";
      			     		}
 				}
	           	echo '</SELECT></p>'."\n";
	        echo '</div>'."\n";  

                echo '<div style="clear: left;"></div>'."\n";

		//time of cookie   
		echo '<div style="float: left; width: 50%;">'."\n";
	        	echo '<p><label>'.i18n_r('cbcookies/time_cookie').':</label>'."\n".'<INPUT style="border: 1px solid #AAAAAA; border-radius: 2px 2px 2px 2px; margin: 0 0 0 3px; padding-left: 3px; padding-top: 2px; width: 88%; text-align: left;" type="text" name="q_sett[3]" value="'.$ndVal[3].'"></p>'."\n";
		echo '</div>'."\n";   
		echo '<div style="float: left; width: 50%;">'."\n";
	           	echo '<p><label>'.i18n_r('cbcookies/cbscale').':</label>'."\n";
        	   	echo '<SELECT NAME="q_sett[4]" style="border: 1px solid #AAAAAA; border-radius: 2px 2px 2px 2px; text-align: left; padding-right: 1px; width: 90%;">'."\n";
        	        	echo $optiondt;
        	   	echo '</SELECT></p>'."\n";
		echo '</div>'."\n";

		echo '&nbsp;<input type="submit" style="margin-left: 7px; width: 60px;" value="'.i18n_r('cbcookies/cbSave').'" id="cbcookform" name="cbcook-submit" />'."\n";

	echo '</form>';

    


}
///////////////////////////////////////////
//   Function that add message 
//    of 'Accept' cookies to all pages
//   
//   it uses hook "theme-footer"
//    (it is neccesary to use in template 
//     the function "get_footer()" )
///////////////////////////////////////////
function cb_cookies() {
	if (!isset($_COOKIE['acceptco'])){
		global $i18n;

		$log_name = 'cbcookies.xml';
		$log_path = GSDATAOTHERPATH.'cbcookies/';
		$log_file = $log_path . $log_name;
	
		if (file_exists($log_file)) {

			$domDocument = new DomDocument();
			$domDocument->load($log_file);

			//DOMXPath to filter
			$xpath = new DOMXPath($domDocument);
			$num=0;
			$verN = $xpath->query('sett');			
			$num = $verN->length;
			if ($num > 0){	
				$dNdList = $verN->item(0)->getElementsByTagName( "cbcook_msg" );
				$cbmessage = $dNdList->item(0)->nodeValue;
				$dNdList = $verN->item(0)->getElementsByTagName( "cbcook_pos" );
				$cbposition = $dNdList->item(0)->nodeValue;
				$dNdList = $verN->item(0)->getElementsByTagName( "cbcook_page" );
				$cbpage = $dNdList->item(0)->nodeValue;
				$dNdList = $verN->item(0)->getElementsByTagName( "cbcook_time" );
				$cbtime = $dNdList->item(0)->nodeValue;
				$dNdList = $verN->item(0)->getElementsByTagName( "cbcook_scale" );
				$cbscale = substr($dNdList->item(0)->nodeValue,0,1);
			}

		} else {
			$xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><entry></entry>');
			$thislog = $xml->addChild('sett');
			$cdata = $thislog->addChild('cbcook_msg',i18n_r('cbcookies/message'));//ndVal=0 text of 	message
			$cdata = $thislog->addChild('cbcook_pos',strtolower(i18n_r('cbcookies/cbtop'))); //ndVal=1 possition of message in web
			$cdata = $thislog->addChild('cbcook_page', ''); //ndVal=2 page of more information
			$cdata = $thislog->addChild('cbcook_time','365');  //ndVal=3 how many time?
			$cdata = $thislog->addChild('cbcook_scale',"1-".i18n_r('cbcookies/cbdays'));   //ndVal=4 format time: days, hours,minutes...
			XMLsave($xml, $log_file); 

			$cbmessage = i18n_r('cbcookies/message');
        	        $cbposition = strtolower(i18n_r('cbcookies/cbtop'));
        	        $cbpage = '';
        	        $cbtime = '365';
			$cbscale = "1";

		}
/*
days= days*24*60*60*1000
hours= hours*60*60*1000
minutes= minutes*60*1000
seconds= seconds*1000
*/
		$fmtm[1] = 24*60*60*1000;		
		$fmtm[2] = 60*60*1000;
		$fmtm[5] = 60*1000;
		$fmtm[4] = 1000;

		$cbcookies_w = 'cbcookies-'.$cbposition;
		$cbtmp = $cbtime * $fmtm[$cbscale];
?>
		<script type="text/javascript">
        
		function acceptco(id, ident){
		   if (ident == "cbcookies"){
                	var frm=document.getElementById(id);
                	if(frm.style.display=="block"){
 				var fecha = new Date();
				tiempo = <?php echo $cbtmp; ?>;
				fecha.setTime(fecha.getTime() + tiempo);
				document.cookie = "acceptco" + ' = ' + escape("Y") + ((tiempo == null) ? "" : "; expires = " + fecha.toGMTString()) +"; path=/";
                	        frm.style.display="none";
                	}
		   }
		}  	            
       
		</script>
<?php

		echo '<div id="'.$cbcookies_w.'" style="display: block;">'.$cbmessage.'&nbsp;&nbsp;<a class="btn btn-primary" id="cbcookies_accept" href="javascript:acceptco(&quot;'.$cbcookies_w.'&quot;, &quot;cbcookies&quot;)" >'.$i18n['cbcookies/accept'].'</a>&nbsp;&nbsp;';
		if (trim($cbpage) != ''){
			$P_lnk = find_url($cbpage,'');
			echo '<a id="cbcookies_more" href="'.$P_lnk.'">'.$i18n['cbcookies/more_in'].'</a>';
		}
		echo '</div>';
	}

}

 
?>
