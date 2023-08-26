<?php
/* ------------------------------------------------------------------------------------------------------------------
   $Id: traffic_light.js.php (path: /templates/tpl_modified_responsive/javascript/extra/)
   
   CSS Produkt- & Attributlagerampel v1.3 (2023-08-26)
  
   Authors:
   -------------------
     awids (www.awids.de)
     web28 (www.rpa-com.de)
     noRiddle (www.revilonetz.de)
     
   ----------------------------------------------------------------------------------------------------------------*/

if (strstr($PHP_SELF, FILENAME_PRODUCT_INFO )) {
  if (defined('MODULE_TRAFFIC_LIGHTS_STATUS') && MODULE_TRAFFIC_LIGHTS_STATUS == 'true') {
    if (defined('MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_FLOW_IN') && MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_FLOW_IN == 'true') {
?>
	   <script>
	    /*<![CDATA[*/
	     with(document.documentElement){className += 'js'}
	     if (('ontouchstart' in document.documentElement)) {document.documentElement.className += ' touch';} else {document.documentElement.className += ' no-touch';}
	    /*]]>*/
	   </script>
	
	   <script>
	   $(function() {
	     var $osl = $('.touch .options_selection label');
	     $osl.click(function() {
	       var $this = $(this);
	       $('.nr-tooltip', this).animate({'right':'30%', 'opacity':1}, 200, function() {
	       $this.parent().siblings().find('.nr-tooltip').css({'right':'90%','opacity':'0'});
	       });
	     });
	   });
	   </script>
<?php
    }
  }
}
?>