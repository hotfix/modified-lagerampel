<?php
/* ------------------------------------------------------------------------------------------------------------------
   $Id: traffic_lights.php
   
   CSS Produkt- & Attributlagerampel v1.4 (2023-12-13)
  
   Authors:
   -------------------
     awids (www.awids.de)
     web28 (www.rpa-com.de)
     noRiddle (www.revilonetz.de)
     
   ----------------------------------------------------------------------------------------------------------------*/

defined( '_VALID_XTC' ) or die( 'Direct Access to this location is not allowed.' );

if (!class_exists('traffic_lights')) {
    class traffic_lights
    {
        var $code, $title, $description, $enabled;

        function __construct() {
            $this->code = 'traffic_lights';
            $this->properties['process_key'] = true;
            $this->properties['btn_edit'] = MODULE_TRAFFIC_LIGHTS_TEXT_BTN;
            $this->title = defined('MODULE_TRAFFIC_LIGHTS_TEXT_TITLE') ? MODULE_TRAFFIC_LIGHTS_TEXT_TITLE : 'CSS Produkt- & Attributlagerampel v1.3 (ab Shopversion 2.x.x.x)';
            $this->description = defined('MODULE_TRAFFIC_LIGHTS_TEXT_DESCRIPTION') ? MODULE_TRAFFIC_LIGHTS_TEXT_DESCRIPTION : 'Lagerampel f&uuml;r Artikel und Attribute';
            $this->enabled = ((defined('MODULE_TRAFFIC_LIGHTS_STATUS') && MODULE_TRAFFIC_LIGHTS_STATUS == 'true') ? true : false);
            $this->sort_order = defined('MODULE_TRAFFIC_LIGHTS_SORT_ORDER') ? MODULE_TRAFFIC_LIGHTS_SORT_ORDER : 0;
        }

        function process($file) {
        }

        function display() {
            return array('text' => 
                    '<br>' . xtc_button(BUTTON_REVIEW_APPROVE) . '&nbsp;' .
                    xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_MODULE_EXPORT, 'set=' . $_GET['set'] . '&module='.$this->code))
                    );
        }

        function check() {
            if(!isset($this->_check)) {
              $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_TRAFFIC_LIGHTS_STATUS'");
              $this->_check = xtc_db_num_rows($check_query);
            }
            return $this->_check;
        }

        function install() {
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_STATUS', 'true',  '6', '1', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_LISTING', 'true',  '6', '2', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_LISTING_LIGHT', 'light',  '6', '3', 'xtc_cfg_select_option(array(\'light\', \'text\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_INFO', 'true',  '6', '4', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_INFO_LIGHT', 'light',  '6', '5', 'xtc_cfg_select_option(array(\'light\', \'text\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_ATTRIBUTES', 'true',  '6', '6', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_FLOW_IN', 'true',  '6', '7', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_SHOW_STOCK', 'true',  '6', '8', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_STOCK_RED_YELL', '2',  '6', '21', '', now())");
			xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_TRAFFIC_LIGHTS_STOCK_GREEN', '5',  '6', '22', '', now())");
        }

        function remove() {
            xtc_db_query("DELETE from " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE 'MODULE_TRAFFIC_LIGHTS_%'");
        }

        function keys() {
            return array('MODULE_TRAFFIC_LIGHTS_STATUS',
            			 'MODULE_TRAFFIC_LIGHTS_LISTING',
            			 'MODULE_TRAFFIC_LIGHTS_LISTING_LIGHT',
            			 'MODULE_TRAFFIC_LIGHTS_INFO',
            			 'MODULE_TRAFFIC_LIGHTS_INFO_LIGHT',
            			 'MODULE_TRAFFIC_LIGHTS_ATTRIBUTES',
            			 'MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_FLOW_IN',
            			 'MODULE_TRAFFIC_LIGHTS_ATTRIBUTES_SHOW_STOCK',
            			 'MODULE_TRAFFIC_LIGHTS_STOCK_RED_YELL',
            			 'MODULE_TRAFFIC_LIGHTS_STOCK_GREEN');
        }
        
    }
}
?>
