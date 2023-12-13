<?php
/* ------------------------------------------------------------------------------------------------------------------
   $Id: function.traffic_light.php
   
   CSS Produkt- & Attributlagerampel v1.4 (2023-12-13)
  
   Authors:
   -------------------
     awids (www.awids.de)
     web28 (www.rpa-com.de)
     noRiddle (www.revilonetz.de)
     
   Calls:	
   -------------------
     product_info: 		{traffic_light stock=$PRODUCTS_QUANTITY modul='info'}
     product_listing: 	{traffic_light stock=$module_data.PRODUCTS_QUANTITY modul='listing'}
     attributes: 		{traffic_light stock=$item_data.STOCK modul='attributes'}
     
   ----------------------------------------------------------------------------------------------------------------*/

function smarty_function_traffic_light($params, &$smarty) {
  
  $html = '';
  $modul = isset($params['modul']) ? $params['modul'] : '';
  
  if (defined('MODULE_TRAFFIC_LIGHTS_STATUS') && MODULE_TRAFFIC_LIGHTS_STATUS == 'true') {
  
    if (constant('MODULE_TRAFFIC_LIGHTS_ATTRIBUTES') == 'true' && $modul == 'attributes') {

      $stock = isset($params['stock']) ? $params['stock'] : false;
      $flow_in = defined('MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_FLOW_IN') && MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_FLOW_IN == 'true' ? true : false;
      $show_stock = defined('MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_SHOW_STOCK') && MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_SHOW_STOCK == 'true' ? ' | '.$stock : '';
  	  
      if ($stock === false) {
        return false;
      }
      
      if ($stock < MODULE_TRAFFIC_LIGHTS_STOCK_RED_YELL) {
          $stock_info = '<span class="traff-light"><strong>'.MODULE_TRAFFIC_LIGHTS_STOCK.':</strong> <span class="tl zero-tl"></span><span class="tl zero-tl"></span><span class="tl red-tl"></span>'.(($flow_in == true) ? '<span class="nr-tooltip red-tl" aria-label="'.MODULE_TRAFFIC_LIGHTS_STOCK.'">'.MODULE_TRAFFIC_LIGHTS_QTY_RED.$show_stock.'</span>' : '').'</span>';
          $html .= $stock_info;
      } elseif ($stock >= MODULE_TRAFFIC_LIGHTS_STOCK_RED_YELL && $stock < MODULE_TRAFFIC_LIGHTS_STOCK_GREEN) {
          $stock_info = '<span class="traff-light"><strong>'.MODULE_TRAFFIC_LIGHTS_STOCK.':</strong> <span class="tl zero-tl"></span><span class="tl yell-tl"></span><span class="tl zero-tl"></span>'.(($flow_in == true) ? '<span class="nr-tooltip yell-tl yell-txt" aria-label="'.MODULE_TRAFFIC_LIGHTS_STOCK.'">'.MODULE_TRAFFIC_LIGHTS_QTY_YELL.$show_stock.'</span>' : '').'</span>';
          $html .= $stock_info;
      } elseif ($stock >= MODULE_TRAFFIC_LIGHTS_STOCK_GREEN) {
          $stock_info = '<span class="traff-light"><strong>'.MODULE_TRAFFIC_LIGHTS_STOCK.':</strong> <span class="tl green-tl"></span><span class="tl zero-tl"></span><span class="tl zero-tl"></span>'.(($flow_in == true) ? '<span class="nr-tooltip green-tl" aria-label="'.MODULE_TRAFFIC_LIGHTS_STOCK.'">'.MODULE_TRAFFIC_LIGHTS_QTY_GREEN.$show_stock.'</span>' : '').'</span>';
          $html .= $stock_info;
      }
      
      return $html;

    } elseif (constant('MODULE_TRAFFIC_LIGHTS_'.strtoupper($modul)) == 'true'  && $modul != 'attributes') {
    
      $stock = isset($params['stock']) ? $params['stock'] : false;
      if ($stock === false) {
        return false;
      }
      
      $tag = isset($params['tag']) ? $params['tag'] : '';
      $class = isset($params['class']) ? ' class="'.$params['class'].'"' : '';
      $style = isset($params['style']) ? $params['style'] : 'light';
      $brackets = isset($params['brackets']) ? $params['brackets'] : false;
      $show_stocktext = isset($params['show_stocktext']) ? $params['show_stocktext'] : true;
     
      $show_qty = false;

      if ($modul && defined('MODULE_TRAFFIC_LIGHTS_'.strtoupper($modul).'_LIGHT')) {
         $style = constant('MODULE_TRAFFIC_LIGHTS_'.strtoupper($modul).'_LIGHT');
      }
      
      $html = $show_stocktext ? '<span class="stocktext"><strong>'.MODULE_TRAFFIC_LIGHTS_STOCK.': </strong></span>' : '';
      
      if ($style == 'light' && !$brackets) {
          $stock_info = '<span class="tl green-tl"></span><span class="tl yell-tl"></span><span class="tl red-tl"></span>';
      } else {
          $stock_info = '<span class="stock-txt"><strong>#stock_title#</strong></span>';
      }
      
      $stock_title = '<span title="#stock_title#" aria-label="#stock_title#">#stock_info#</span>';
      $stock_title = $brackets ? str_replace('#stock_info#',' (#stock_info#)',$stock_title) : $stock_title;
      
      if ($stock < MODULE_TRAFFIC_LIGHTS_STOCK_RED_YELL) {
          $stock_txt = MODULE_TRAFFIC_LIGHTS_QTY_RED. ($show_qty ? ' '. $stock : '');
          $stock_info = str_replace(array('tl green-tl','tl yell-tl','stock-txt','#stock_title#'),array('tl zero-tl','tl zero-tl','red-txt',$stock_txt),$stock_info);
          $html .= str_replace(array('#stock_title#','#stock_info#'),array($stock_txt,$stock_info),$stock_title);
      } elseif ($stock >= MODULE_TRAFFIC_LIGHTS_STOCK_RED_YELL && $stock < MODULE_TRAFFIC_LIGHTS_STOCK_GREEN) {
          $stock_txt = MODULE_TRAFFIC_LIGHTS_QTY_YELL . ($show_qty ? ' '. $stock : '');
          $stock_info = str_replace(array('tl green-tl','stock-txt','tl red-tl','#stock_title#'),array('tl zero-tl','yell-txt','tl zero-tl',$stock_txt),$stock_info);
          $html .= str_replace(array('#stock_title#','#stock_info#'),array($stock_txt,$stock_info),$stock_title); 
      } elseif ($stock >= MODULE_TRAFFIC_LIGHTS_STOCK_GREEN) {
          $stock_txt = MODULE_TRAFFIC_LIGHTS_QTY_GREEN. ($show_qty ? ' '. $stock : '');
          $stock_info = str_replace(array('stock-txt','tl yell-tl','tl red-tl','#stock_title#'),array('green-txt','tl zero-tl','tl zero-tl',$stock_txt),$stock_info);
          $html .= str_replace(array('#stock_title#','#stock_info#'),array($stock_txt,$stock_info),$stock_title); 
      }
      
      $html = $tag ? '<'.$tag.$class.$style.'>'.$html.'</'.$tag.'>' : $html;
      return $html;
    } 
    
  } 
  
  return false;
}
