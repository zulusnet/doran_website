/****************************************************
*
* @File: 		jquery.scripts.js
* @Package:		GetSimple Google Map Plugin v2
* @Subject:		Javascript file
* @Date:		1 apr 2012
* @Version:		googlemap 2.0 / GetSimple 3.0+
* @Autor:		Singulae
* @Autor URI: 	http://www.singulae.com
*
*****************************************************/




/* __________________________________________________________________________________
 * Document Ready..
 */
jQuery(document).ready(function() { 

 
	// Caracteres permitidos para ID MAPA	
	// Allowed chars for ID MAP
	 $('.idmap').filter_input({regex:'[0-9a-zA-Z\-]', live:true});


	// Input radio personalizados
	// Custom input radio
	$(".radio").rciStyle();

	
	// Esconde botón de borrar si sólo hay un mapa
	if($('.delMap').length==1){$('.delMap').hide(); };

	
	// Añade boton de Guardar en columna derecha
	// Add Save button in right column
	var btsubmt = $("form[name='formmap'] p.submit").html();
	$("#sidebar").append('<p id="submit_sidebar" style="margin-left:12px" >'+btsubmt+'</p>');

	// click submit
	$("#submit_sidebar input.submit").live("click", function() {
		$("form[name='formmap'] input.submit").trigger('click');
	});
	
	
	// EXPAND/COLLAPSE advanced settings
	 $(".advanced_bot").live("click", function($e) {
        $e.preventDefault();
        $($(this).parent().parent().find('.advanced')).slideToggle('fast');
        $(this).toggleClass('current');
    });
	
	// EXPAND/COLLAPSE options
	$(".edit-nav a.ops").live("click", function($e) {
        $e.preventDefault();
		name = $(this).attr('name');
        $($(this).parent().parent().find('#'+name)).slideToggle('fast');
        $(this).toggleClass('current');
    });
	

	// ADD MAP
	gMapFuncs.addMap();
	
	// DELETE MAP
	gMapFuncs.deleteMap();

	
	// CHANGE ID event
	gMapFuncs.changeIDevent();
	
  
	// ADD new ANCHOR
	gMapFuncs.addAnchor();	
	
	
	// DELETE ANCHOR
	gMapFuncs.deleteAnchor();
	

});

/* __________________________________________________________________________________
 * Funciones para gestión e interface de Google Map en admin
 * Functions for management and interface in admin
 */
var gMapFuncs = {


	/* __________________________________________________________________________________
	 * Añade nuevo mapa.
	 * Add new map.
	 */
	addMap: function(){	

		$('#addMap').click(function(e){				

			e.preventDefault();	
			
			//disable this button	
			var thisbt = $(this);		
			if($(thisbt).attr("disabled")){return false;};		
			$(thisbt).attr("disabled", "disabled"); 		
			
			// show del button
			if($('.delMap').length==1){	$('.delMap').show(); };
			
			// prepare clone
			var box = $('.gmapbox')[0];
			var rand = gMapFuncs.generarID();		
			var newid = "gmapbox_"+rand;
			
			var arrRadios =  $(box).find(':input[type="radio"]:checked').get();
			
			$(box).clone().hide().attr('id',newid).changeval(rand).insertBefore(box).slideDown('normal',function(){ 
			
				// add jQuery DELETE & CHANGE ID events actions to new element
				gMapFuncs.deleteMap(); 			
				gMapFuncs.changeIDevent();		
				gMapFuncs.addAnchor();		
				
				// call blur event (that rename all elements)
				$(this).find("input[name^=gmap_id]").blur();			
			
				// put checked
				$(arrRadios).attr('checked','checked');
				
				
				// enable this button
				$(thisbt).removeAttr("disabled"); 
				
						
				// refresh axis selectors	
				$(this).find('.radio').rciStyle();

			});
			// Sets defaults
			// clear fields
			$('#'+newid).find(':input[type="text"]:not(input[name="gmap_id[]"])').val('');
			$('#'+newid).find('textarea').val('');
			//controls
			$('#'+newid).find(':input[type="checkbox"]').attr('checked','checked');
			//maptype
			$('#'+newid).find('.radiocontrol:first').attr('checked','checked');
			//axis
			$('#'+newid).find('.axiscenter').attr('checked','checked');
			// delete anchors copied		
			$('#'+newid).find('.anchor').remove();
			// print title
			$('#'+newid).find('h3 i').html("#"+rand);		
		});
	},


	/* __________________________________________________________________________________
	 * Borra mapa.
	 * Delete map.
	 */
	deleteMap: function(){	
			
		$('.delMap').click(function(e){	
			e.preventDefault();		
			if($('.delMap').length>1){
				var el = $(this).parent().parent().attr('id');
				var idsplit = el.split('_');
				var id = idsplit[1];				
				$('#gmapbox_'+id).slideUp('normal',function(){
					$('#gmapbox_'+id).remove();	
					if($('.delMap').length==1){$('.delMap').hide(); };
				});
			};
		}).confirm({
			msg:'<span style="margin-right:10px;font-weight:bold">'+gmap_msgs['msg_del_map']+'</span>',
			wrapper: '<div style="text-align:right;line-height:140%;color:#2f424b;"></div>',
			timeout:3000,
			dialogShow:'fadeIn',
			dialogSpeed:'fast',
			buttons: {ok:gmap_msgs['YES'],cancel:gmap_msgs['NO'],separator:'  '}
		});
	},



	/* __________________________________________________________________________________
	 * Añade marcador.
	 * Add marker.
	 */
	addAnchor: function(){

		// ADD new ANCHOR
		$('.addAnchor').click(function(e){		
			e.preventDefault();	

			// show delete bot
			var anchors =  $(this).parent().parent().find('.anchor');
			var bots 	= $(anchors).children().find('.delAnchor');
			
			if(bots.length==1){	$(bots).show(); };
			
			// blocked add new anchor if last created is empty
			var firstAnchor  =  $(this).parent().parent().find('.anchor:first');
			var firstAddress = $(firstAnchor).find('input:first').val();

			if($(firstAnchor).length >0){
				if( firstAddress.length <= 0 ){
				return false;};
			};
			
			// add
			var header 	= $(this).parent();
			var box 	= $('.anchor:last');

			var map		= $(this).parent().parent().parent().parent();
			var idmap  	= $(map).attr('id');
			
			var posIni 	= idmap.lastIndexOf("_");
			var idname	= idmap.substring(posIni+1);

			$(box).clone().hide().insertAfter(header).slideDown('normal',function(){
				// add jQuery DELETE actions to new element
				gMapFuncs.deleteAnchor();				

				// change input names
				var thisAnchor = $(this).parent().parent().parent().parent().find('.anchor:first');
				var indx = bots.length;
				
				// refresh axis selectors
				$(thisAnchor).find('.radio').rciStyle();
						
				$(thisAnchor).each(function(index){
					$(this).find(':input[type="text"],:input[type="radio"],textarea').each(function(e) {			
						if( $(this).attr('name') ){					
							var name = $(this).attr('name');						
							//change name
							posIni 	= name.lastIndexOf("_");	
							posFin 	= name.indexOf("[");
							id 		= name.substring(posIni+1,posFin);
							$(this).attr('name',name.replace(id,idname)); 										
						};	
					});	
				});	
				
				//refresh names array index
				gMapFuncs.refreshAnchorsIndex();

				// select default
				$('.anchor:first').find('.radio').children('.axiscenter:eq(0)').parent().rciHandle();	
				$('.anchor:first').find('.radio').children('.axiscenter:eq(1)').parent().rciHandle();
			
			}).find(':input[type="text"]').val('');		
		});
	},



	/* __________________________________________________________________________________
	 * Borra marcador.
	 * Delete marker.
	 */
	deleteAnchor: function(){
			
		$('.delAnchor').click(function(e){	
			e.preventDefault();	
			
			var elnum = $(this).parent().parent().parent().find('.delAnchor').length;
			var el = $(this).parent().parent();
			
			if( elnum >0){			
				$(el).slideUp('normal',function(){

					$(el).remove();
					
					//refresh names array index
					gMapFuncs.refreshAnchorsIndex();
				});	
			};

		}).confirm({
			msg:'<span style="margin-right:10px;font-weight:bold">'+gmap_msgs['msg_del_anchor']+'</span>',
			wrapper: '<div style="text-align:right;line-height:140%;color:#2f424b;"></div>',
			timeout:3000,
			dialogShow:'fadeIn',
			dialogSpeed:'fast',
			buttons: {ok:gmap_msgs['YES'],cancel:gmap_msgs['NO'],separator:'  '}
		});
	},


	/* __________________________________________________________________________________
	 * Función auxiliar. Actualiza indice de array de inputs del ancla.
	 * Auxiliar function. Update array index of anchor inputs.
	 */
	refreshAnchorsIndex: function (){
		//refresh names array index
		$('.anchor').each(function(idx){			
			$(this).find(':input[type="text"],:input[type="radio"],textarea').each(function(e) {					
				if( $(this).attr('name') ){								
					name = $(this).attr('name');
					posIni 	= name.indexOf("[");	
					posFin 	= name.indexOf("]");
					id 		= name.substring(posIni+1,posFin);						
					$(this).attr('name',name.replace(id,idx)); 											
				};
			});
		});				
	},



	/* __________________________________________________________________________________
	 * Detecta cambio de idmap. Actualiza título y nombres de campos.
	 * Detect changes of idmap. Update title and field names.
	 */
	changeIDevent: function(){

		// Detect CHANGE ID MAP	
		
		$('.idmap')
			// Comprueba cambios en idname
			// Check changes on idname
			.blur(function(){
			
				var el = $(this);
				var txt = $(this).val();	

				var change = true;

				if(!txt){
				 $(el).val($(el).attr('id'));
				 change = false;
				 };
				 
				//checks others id
				var fields = $('.idmap');
				$.each(fields, function(i, field){
					if(field.value == txt) {	
						if($(field).attr('id') != $(el).attr('id')){ alert(gmap_msgs['msg_id_exists']); $(el).val($(el).attr('id'));change = false;};				
					};
				});

				// change tit		
				if(change){ 
					$(this).parent().parent().parent().find('.edit-nav h3 i').text("#"+txt);			
					$(this).parent().parent().parent().attr("id","gmapbox_"+txt);

					// Change name fields (put idmap value)
					var mp = $(this).parent().parent().parent().children();
					
					$(mp).each(function(index){
						$(this).find('*').each(function(e) {			
							if( $(this).attr('name') ){					
								var name = $(this).attr('name');
								
								if( name !="gmap_id[]" ){
									//change name
									posIni 	= name.lastIndexOf("_");	
									posFin 	= name.indexOf("[");
									if(posFin<1){
										id 	= name.substring(posIni+1);
									}else{
										id 	= name.substring(posIni+1,posFin);
									}
									$(this).attr('name',name.replace(id,txt)); 						
								};
							};
						});
					});	
				};
			});
	},



	/* __________________________________________________________________________________
	 * Genera string aleatorio.
	 * Generate random string.
	 */
	generarID: function() {
		var caracs ="1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		var leng = 5; 
		var total = caracs.length;
		var clave="";
	  
		for(a=0;a<leng;a++){
		clave+=caracs.charAt(parseInt(total*Math.random(1)));
		}
		return clave;
	 }
	 
	 
};




/* __________________________________________________________________________________
 * Función en jquery externa para cambiar valor.
 * External jquery function for changing value.
 */
 jQuery.fn.changeval = function(str){
	return this.each(function(){
			$(this).find(':input[name^=gmap_id]:first').attr('value',str);
			$(this).find(':input[name^=gmap_id]:first').attr('id',str);	
	});
};




/* __________________________________________________________________________________
 * BACK-END PLUGINS
 */


/**
 * Confirm plugin 1.3
 *
 * Copyright (c) 2007 Nadia Alramli (http://nadiana.com/)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * For more docs and examples visit:
 * http://nadiana.com/jquery-confirm-plugin
 * For comments, suggestions or bug reporting,
 * email me at: http://nadiana.com/contact/
 */
jQuery.fn.confirm=function(a){var d="once",c="never";a=jQuery.extend({msg:"Are you sure?",stopAfter:c,wrapper:"<span></span>",eventType:"click",dialogShow:"show",dialogSpeed:"",timeout:0},a);a.stopAfter=a.stopAfter.toLowerCase();if(!a.stopAfter in[c,d,"ok","cancel"])a.stopAfter=c;a.buttons=jQuery.extend({ok:"Yes",cancel:"No",wrapper:'<a href="#"></a>',separator:"/"},a.buttons);var b=a.eventType;return this.each(function(){var e=this,c=jQuery(e),h,k=function(){var a=jQuery.data(e,"events");if(!a&&e.href){c.bind("click",function(){document.location=e.href});a=jQuery.data(e,"events")}else if(!a)return;e._handlers=[];for(var d in a[b])e._handlers.push(a[b][d])},j=jQuery(a.buttons.wrapper).append(a.buttons.ok).click(function(){a.timeout!=0&&clearTimeout(h);c.unbind(b,f);c.show();g.hide();e._handlers!=undefined&&jQuery.each(e._handlers,function(){c.click(this.handler)});c.click();if(a.stopAfter!="ok"&&a.stopAfter!=d){c.unbind(b);c.one(b,f)}return false}),i=jQuery(a.buttons.wrapper).append(a.buttons.cancel).click(function(){a.timeout!=0&&clearTimeout(h);if(a.stopAfter!="cancel"&&a.stopAfter!=d)c.one(b,f);c.show();g.hide();return false});if(a.buttons.cls){j.addClass(a.buttons.cls);i.addClass(a.buttons.cls)}var g=jQuery(a.wrapper).append(a.msg).append(i).append(a.buttons.separator).append(j),f=function(){jQuery(this).hide();a.dialogShow!="show"&&g.hide();g.insertBefore(this);g[a.dialogShow](a.dialogSpeed);if(a.timeout!=0){clearTimeout(h);h=setTimeout(function(){i.click();c.one(b,f)},a.timeout)}return false};k();c.unbind(b);e._confirm=f;e._confirmEvent=b;c.one(b,f)})};




/**
 * jQuery Custom Radio-buttons and Checkbox; basically it's styling/theming for Checkbox and Radiobutton elements in forms
 * By Dharmavirsinh Jhala - dharmavir@gmail.com
 * Date of Release: 13th March 10
 * Version: 0.8
 * http://archive.plugins.jquery.com/project/Fancy-Radio-Checkbox
 * http://blogs.digitss.com/javascript/jquery-javascript/jquery-fancy-custom-radio-and-checkbox/
 *
*/
jQuery.fn.extend({rciStyle:function(){$.each($(this),function(){if($(this).find('input').length>0){$(this).attr("spec",'rcihold');var elm=$(this).find('input').get(0);$(elm).bind('change.rci',function(){var leml=$(this).get(0);var div=$(this).closest('[spec=rcihold]').get(0);if($(div).data('type')=='radio'){$(leml).rciCheck(div);$.each($("input[name='"+$(leml).attr("name")+"']"),function(){if(leml!=this)$(this).rciUncheck(-1)})}else{if($(div).data("checked")==true){$(leml).rciUncheck(div);}else{ $(leml).rciCheck(div)}}});var elmType=$(elm).attr("type");var elmHeight=12;var elmChecked=($(this).find('input:checked').length>0);$(this).children().css('display','none');$(this).data('type',elmType);$(this).data('checked',elmChecked);$(this).data('height',elmHeight);$(this).data('over',false);$(this).rciClear()}});$(this).mousedown(function(){$(this).rciEffect()});$(this).mouseup(function(){$(this).rciHandle()});$(this).mouseover(function(){$(this).data('over',true);$(this).rciHover()});$(this).mouseout(function(){$(this).data('over',false);$(this).rciClear()})},rciClear:function(){if($(this).data("checked")==true){$(this).css({backgroundPosition:"center -"+($(this).data("height")*3)+"px"})}else{$(this).css({backgroundPosition:"center 0"})}},rciEffect:function(){if($(this).data("checked")==true){$(this).css({backgroundPosition:"center -"+($(this).data("height")*5)+"px"})}else{$(this).css({backgroundPosition:"center -"+($(this).data("height")*2)+"px"})}},rciHover:function(){if($(this).data("checked")==true){$(this).css({backgroundPosition:"center -"+($(this).data("height")*3)+"px"})}else{$(this).css({backgroundPosition:"center -"+($(this).data("height")*1)+"px"})}},rciHandle:function(){var elm=$(this).find('input').get(0);if($(this).data('type')=='radio'){$(elm).rciCheck(this);$.each($("input[name='"+$(elm).attr("name")+"']"),function(){if(elm!=this)$(this).rciUncheck(-1)});$(elm).change()}else{if($(this).data("checked")==true)$(elm).rciUncheck(this);else $(elm).rciCheck(this)}},rciCheck:function(div){$(this).attr("checked",true);if($(div).data('over')){$(div).data('checked',true).css({backgroundPosition:"center -"+($(div).data("height")*3)+"px"})}else{$(div).data('checked',true).css({backgroundPosition:"center -"+($(div).data("height")*3)+"px"})}},rciUncheck:function(div){$(this).attr("checked",false);if(div!=-1){if($(div).data('over')){$(div).data('checked',false).css({backgroundPosition:"center -"+($(div).data("height")*1)+"px"})}else{$(div).data('checked',false).css({backgroundPosition:"center 0"})}}else{$(this).closest('[spec=rcihold]').data("checked",false).css({backgroundPosition:"center 0"})}}});



/**
 * JQuery plugin for input text field filtering
 * Author - Rudolf Naprstek
 * Website - http://www.thimbleopensource.com/tutorials-snippets/jquery-plugin-filter-text-input
 * Version - 1.2.0
 * Release - 20th November 2010
 * Thanks to Niko Halink from ARGH!media for bugfix!
*/
(function($){$.fn.extend({filter_input:function(options){var defaults={regex:".*",live:false};var options=$.extend(defaults,options);var regex=new RegExp(options.regex);function filter_input_function(event){var key=event.charCode?event.charCode:event.keyCode?event.keyCode:0;if(key==8||key==9||key==13||key==35||key==36||key==37||key==39||key==46){if($.browser.mozilla){if(event.charCode==0&&event.keyCode==key){return true}}};var string=String.fromCharCode(key);if(regex.test(string)){return true};return false};if(options.live){$(this).live('keypress',filter_input_function)}else{return this.each(function(){var input=$(this);input.unbind('keypress').keypress(filter_input_function)})}}})})(jQuery);


		