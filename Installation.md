﻿# Installationsanleitung 

CSS Produkt- & Attributlagerampel v1.4 (2023-12-13)
Authors:
- awids (www.awids.de)
- web28 (www.rpa-com.de)
- noRiddle (www.revilonetz.de)


## Schritt 1 : Dateiupload
      
Laden Sie alle Dateien aus dem Ordner `/shoproot` ins Root Ihres Shops. 
Es werden hierbei keine Dateien überschrieben.

## Schritt 2 : Modul im Template einbinden
      
### CSS

Öffnen Sie die Datei `/templates/tpl_modified_responsive/css/general_bottom.css.php` und erweitern das Array:

``` php
$css_array = array(
  DIR_TMPL_CSS.'jquery.colorbox.css',
  DIR_TMPL_CSS.'jquery.alerts.css',
  DIR_TMPL_CSS.'jquery.bxslider.css',    
);
``` 

um folgenden Eintrag:

``` php   
DIR_TMPL_CSS.'trafficlight.css',    
``` 

### JAVASCRIPT - optional, wenn kein /extra/-Ordner vorhanden!!!

Öffnen Sie die Datei /templates/tpl_modified_responsive/javascript/general_bottom.js.php und suchen folgenden Eintrag:

``` php
<?php if (strstr($PHP_SELF, FILENAME_PRODUCT_INFO )) { ?>
``` 

Fügen Sie im nachfolgenden Bereich an gewünschter Stelle folgende Scripts ein:

``` js
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
``` 


### TEMPLATE-DATEIEN
   
a) Produktdetailseite / Productinfo

Öffnen Sie die folgenden Dateien:

- `/templates/tpl_modified_responsive/module/product_info/product_info_tabs_v1.html`
- `/templates/tpl_modified_responsive/module/product_info/product_info_v1.html`
- `/templates/tpl_modified_responsive/module/product_info/product_info_x_accordion_v1.html`


Fügen Sie jeweils an gewünschter Stelle, z. B. NACH 

```
{if $PRODUCTS_MODEL != ''}<div class="pd_inforow"><strong>{#model#}</strong> {$PRODUCTS_MODEL}<meta itemprop="model" content="{$PRODUCTS_MODEL}" /></div>{/if}  
```

folgendes ein:

```
{if !isset($MODULE_product_options) || $MODULE_product_options == ''}<div class="pd_inforow">{traffic_light stock=$PRODUCTS_QUANTITY modul='info'}</div>{/if}
```

b) Produktlisting / Product listing

Öffnen Sie die folgenden Dateien:

- `/templates/tpl_modified_responsive/module/includes/product_info_include.html`
- `/templates/tpl_modified_responsive/module/includes/product_listing_include.html`

Ersetzen Sie: 

```
  <div class="lb_shipping">{if $module_data.PRODUCTS_SHIPPING_NAME}{#text_shippingtime#} {if $module_data.PRODUCTS_SHIPPING_IMAGE}<span class="lb_shipping_image"><img src="{$module_data.PRODUCTS_SHIPPING_IMAGE}" alt="{$module_data.PRODUCTS_SHIPPING_NAME|onlytext}" /></span>{/if}{$module_data.PRODUCTS_SHIPPING_NAME_LINK}{else}&nbsp;{/if}</div>
```

mit:

```
  <div class="lb_shipping">{if $module_data.PRODUCTS_SHIPPING_NAME}{#text_shippingtime#} {if $module_data.PRODUCTS_SHIPPING_IMAGE}<span class="lb_shipping_image"><img src="{$module_data.PRODUCTS_SHIPPING_IMAGE}" alt="{$module_data.PRODUCTS_SHIPPING_NAME|onlytext}" /></span>{/if}{$module_data.PRODUCTS_SHIPPING_NAME_LINK}{else}&nbsp;{/if}<br />{traffic_light stock=$module_data.PRODUCTS_QUANTITY modul='listing'}</div>
```

bzw. fügen bei einem anderen Template an gewünschter Stelle ein:

```
  <br />{traffic_light stock=$module_data.PRODUCTS_QUANTITY modul='listing'}
```

Ersetzen Sie: 

```
  <div class="lr_shipping">{if $module_data.PRODUCTS_SHIPPING_NAME}{#text_shippingtime#} {if $module_data.PRODUCTS_SHIPPING_IMAGE}<span class="lr_shipping_image"><img src="{$module_data.PRODUCTS_SHIPPING_IMAGE}" alt="{$module_data.PRODUCTS_SHIPPING_NAME|onlytext}" /></span>{/if}{$module_data.PRODUCTS_SHIPPING_NAME_LINK}{else}&nbsp;{/if}</div>
```

mit:

```
  <div class="lr_shipping">{if $module_data.PRODUCTS_SHIPPING_NAME}{#text_shippingtime#} {if $module_data.PRODUCTS_SHIPPING_IMAGE}<span class="lr_shipping_image"><img src="{$module_data.PRODUCTS_SHIPPING_IMAGE}" alt="{$module_data.PRODUCTS_SHIPPING_NAME|onlytext}" /></span>{/if}{$module_data.PRODUCTS_SHIPPING_NAME_LINK}{else}&nbsp;{/if}<br />{traffic_light stock=$module_data.PRODUCTS_QUANTITY modul='listing'}</div>
```

bzw. fügen bei einem anderen Template an gewünschter Stelle ein:

```
  <br />{traffic_light stock=$module_data.PRODUCTS_QUANTITY modul='listing'}
```

c) Attribute

Öffnen Sie folgende Dateien:    

- `/templates/tpl_modified_responsive/module/product_options/product_options_selection.html`

  Suchen Sie:

```  
{if $item_data.PRICE != '' }<span class="options_selection_price">{$item_data.PREFIX}{$item_data.PRICE}</span>{/if}
```

und fügen die Ampel wie folgt an/ein:
```
{if $item_data.PRICE != '' }<span class="options_selection_price">{$item_data.PREFIX}{$item_data.PRICE}</span>{/if}{traffic_light stock=$item_data.STOCK modul='attributes'}
```

 bzw. fügen Sie bei einem anderen Template an passender Stelle folgendes ein:
  
```
{traffic_light stock=$item_data.STOCK modul='attributes'}
```

- `/templates/tpl_modified_responsive/module/product_optioins/table_listing.html`

Ersetzen Sie:

```
<span class="label_row2">{#model#} {$item_data.MODEL}</span>
```

mit:

```
<span class="label_row2">{#model#} {$item_data.MODEL}{traffic_light stock=$item_data.STOCK modul='attributes'}</span>
```

 bzw. fügen Sie bei einem anderen Template an passender Stelle folgendes ein:

```  
{traffic_light stock=$item_data.STOCK modul='attributes'}
```


## Schritt 3 : Modul installieren

Installieren Sie nun im Admin-Backend unter Module > System Module das zugehörige Modul zur Lagerampel und nehmen die gewünschten Einstellungen vor. 
