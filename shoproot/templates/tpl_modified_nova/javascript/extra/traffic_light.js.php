<?php
/* ------------------------------------------------------------------------------------------------------------------
   $Id: traffic_light.js.php (path: /templates/tpl_modified_responsive/javascript/extra/)
   
   CSS Produkt- & Attributlagerampel v1.4 (2023-12-13)
  
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
$(function() {
 let $osl = $('.touch .po_row_table_label');
 $osl.click(function() {
   let $this = $(this);
   $('.nr-tooltip', this).animate({'left':'30%', 'opacity':1}, 200, function() {
   $this.parents('.po_row_table_item').siblings().find('.nr-tooltip').css({'left':'90%','opacity':'0'});
   });
 });
});
</script>
<?php
    }
  }
}
?>