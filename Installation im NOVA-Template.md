# Installation im NOVA-Template 


CSS Produkt- & Attributlagerampel v1.4 (2023-12-13)

Authors:

- awids (www.awids.de)
- web28 (www.rpa-com.de)
- noRiddle (www.revilonetz.de)


## Schritt 1 : Dateiupload

Laden Sie alle Dateien aus dem Ordner /shoproot ins Root Ihres Shops. Es werden hierbei keine Dateien überschrieben.

## Schritt 2 : Modul im Template einbinden

### CSS

Öffnen Sie die Datei `/templates/tpl_modified_nova/css/general_bottom.css.php` und erweitern das Array:

```
$css_array = array(
[...],
DIR_TMPL_CSS.'cookieconsent.css',
);
```

um folgenden Eintrag:

```
DIR_TMPL_CSS.'trafficlight.css', // css_product_attribut_lagerampel for tpl_modified-nova
```

### JAVASCRIPT

Öffnen Sie die Datei `/templates/tpl_modified_nova/javascript/general_bottom.js.php` und suchen folgenden Eintrag:

```
// you can add your template specific js scripts here
defined('DIR_TMPL_JS') OR define('DIR_TMPL_JS', DIR_TMPL.'javascript/');
?>
```

Fügen Sie DANACH folgendes Script ein:

```
<?php // BOF: css_product_attribut_lagerampel for tpl_modified-nova ?>
<script>
with (document.documentElement) {
className += 'js';
}
if (('ontouchstart' in document.documentElement)) {
document.documentElement.className += ' touch';
} else {
document.documentElement.className += ' no-touch';
}
</script>
<?php // EOF: css_product_attribut_lagerampel for tpl_modified-nova ?>
```

### TEMPLATE-DATEIEN

a) Produktdetailseite / Productinfo

Öffnen Sie die folgenden Dateien:

- `/templates/tpl_modified_nova/module/product_info/product_info_v1_tabs.html`
- `/templates/tpl_modified_nova/module/product_info/product_info_v2_accordion.html`
- `/templates/tpl_modified_nova/module/product_info/product_info_v3_plain.html`

Fügen Sie jeweils NACH:

```
{if $PRODUCTS_MANUFACTURERS_MODEL != ''}<div class="pd_heading_inforow"><strong>{#products_manufacturer_model#}</strong> {$PRODUCTS_MANUFACTURERS_MODEL}</div>{/if}  
```

folgendes ein:

```
  {* BOC: css_product_attribut_lagerampel for tpl_modified-nova *}
  {if "MODULE_TRAFFIC_LIGHTS_STATUS"|defined && $smarty.const.MODULE_TRAFFIC_LIGHTS_STATUS == 'true'}
    {if !isset($MODULE_product_options) || $MODULE_product_options == ''}
      <div class="pd_heading_inforow">{traffic_light stock=$PRODUCTS_QUANTITY modul='info'}</div>
    {/if}
  {/if}
  {* EOC: css_product_attribut_lagerampel for tpl_modified-nova *}
```

b) Produktlisting / Product listing

Öffnen Sie die Datei: `/templates/tpl_modified_nova/module/includes/product_box.html`

Fügen Sie VOR: 

```
{if isset($module_data.PRODUCTS_REVIEWS_COUNT)}
```

folgendes ein: 

```
  {* BOC: css_product_attribut_lagerampel for tpl_modified-nova *}
  {if "MODULE_TRAFFIC_LIGHTS_STATUS"|defined && $smarty.const.MODULE_TRAFFIC_LIGHTS_STATUS == 'true'}
    <div class="lb_shipping">{traffic_light stock=$module_data.PRODUCTS_QUANTITY modul='listing'}</div>
  {/if}
  {* EOC: css_product_attribut_lagerampel for tpl_modified-nova *}

```


Öffnen Sie die Datei: `/templates/tpl_modified_nova/module/includes/product_row.html`

Fügen Sie VOR: 

```
{if $smarty.const.SHOW_BUTTON_BUY_NOW != 'false'}
```

folgendes ein: 

```
  {* BOC: css_product_attribut_lagerampel for tpl_modified-nova *}
  {if "MODULE_TRAFFIC_LIGHTS_STATUS"|defined && $smarty.const.MODULE_TRAFFIC_LIGHTS_STATUS == 'true'}
    <div class="lr_shipping">{traffic_light stock=$module_data.PRODUCTS_QUANTITY modul='listing'}</div>
  {/if}
  {* EOC: css_product_attribut_lagerampel for tpl_modified-nova *}
```

c) Attribute

Öffnen Sie folgende Datei: `/templates/tpl_modified_nova/module/product_options/product_options_v2_table.html`

Suchen Sie:

```
</label>
```

und fügen die Ampel wie folgt DAVOR ein:

```
  {* BOC: css_product_attribut_lagerampel for tpl_modified-nova *}
    {if "MODULE_TRAFFIC_LIGHTS_STATUS"|defined && $smarty.const.MODULE_TRAFFIC_LIGHTS_STATUS == 'true'}
      <span class="po_row_table_label">{traffic_light stock=$item_data.STOCK modul='attributes'}</span>
    {/if}
  {* EOC: css_product_attribut_lagerampel for tpl_modified-nova *}
```  

## Schritt 3 : Modul installieren

Installieren Sie nun im Admin-Backend unter Module > System Module das zugehörige Modul zur Lagerampel und nehmen die gewünschten Einstellungen vor. 
