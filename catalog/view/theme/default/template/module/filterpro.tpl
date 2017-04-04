<?php if(true || $tags || $categories || $options || $manufacturers || $attributes || $price_slider) { ?>
<div class="prod-right">
<!--<div class="box-heading"><?php echo $heading_title; ?></div>-->

<form class="main-prod" id="filterpro" >

<input type="hidden" name="page" id="filterpro_page" value="0">
<input type="hidden" name="path" value="<?php echo $path ?>">
<input type="hidden" name="sort" id="filterpro_sort" value="">
<input type="hidden" name="order" id="filterpro_order" value="">
<input type="hidden" name="limit" id="filterpro_limit" value="">
<input type="hidden" name="route" value="<?php echo (isset($this->request->get['route']) ? $this->request->get['route'] : "");?>">
<input type="hidden" id="filterpro_container" value="<?php echo $filterpro_container?>">
<script type="text/javascript">
	function afterload(){
		<?php echo $filterpro_afterload; ?>
	}
</script>
<!------------------------------------------------Обязательные поля-----------------------------------------------> 
<!-----------------------------------------------Для раздела продажа---------------------------------------------->
<?php $i = 0; ?>
<?php foreach($category_area_sale as $sale){ ?>
<?php if($category_id == 20 || $category_id == $sale){?>
<?php if(++$i == 2) break; ?>
<div class="option_requred">

<!---------------------------------------------------Вывод опций--------------------------------------------------> 

<!--Блок вывода других обьектов из других категорий--> 
	<?php if($category_id !== false) { ?>
		<input type="hidden" name="category_id" value="<?php echo $category_id ?>">
	<?php } ?>
<!--Блок вывода других обьектов из других категорий--> 
<div class="field-prod">
<div  class="name_city">Тип объекта:</div>  
    <select class="selector" id="estate_type" name="estate_type" title="Тип недвижимости">
        <option value="0">Все</option>
        <?php foreach($estate_type_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<div class="field-prod">             
<div class="name_object">Местонахождение объекта:</div>       
    <select class="selector" id="city" name="city" title="Расположение">
        <option value="0">Все</option>
        <?php foreach($city_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<div class="field-prod">
<div class="name_object">Количество комнат:</div>  
    <select class="selector" id="rooms_value" name="rooms_value" title="Количество комнат">
        <option value="0">Все</option>
        <?php foreach($rooms_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<div class="field-prod">
<div class="name_object">Количество спальных мест:</div>  
    <select class="selector" id="number_of_beds" name="number_of_beds" title="Количество спальных мест">
        <option value="0">Все</option>
        <?php foreach($number_of_beds_value as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<!--
<div class="field-prod">
    <select class="selector" id="sale_type" name="sale_type" title="Тип сделки">
        <option value="0">Все</option>
        <?php foreach($sale_type_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>-->

<!---------------------------------------------------Вывод опций--------------------------------------------------> 

</div>
<div class="price_changed">

<!------------------------------------------------Вывод цены------------------------------------------------------> 
<div class="nonextra">
<div class="field-prod">
<div class="name_price">Диапазон цены:</div>  
    <select class="selector" id="budjet" title="Бюджет" onchange="set_filter_budjet()">
	    <option alt="0" value="250000000">Все</option>
        <option alt="0" value="3000000">до 3.000.000 руб.</option>
        <option alt="3000000" value="5000000">от 3.000.000 до 5.000.000 руб.</option>
        <option alt="5000000" value="7000000">от 5.000.000 до 7.000.000 руб.</option>
        <option alt="7000000" value="251000000">более 7.000.000 руб.</option>
    </select>
<input type="hidden" id="min_price" value="0" name="min_price" class="price_limit">
<input type="hidden" id="max_price" value="0" name="max_price" class="price_limit">
</div>
<!--<div class="prod-d" <?php if(!$price_slider) { echo 'style="display:none"';}?>>
    <p>Диапазон цены:</p>
	<span class="irs js-irs-0 irs-with-grid"><span class="irs"></span>
	<span class="irs-from" style="visibility: visible; left: 0%; width: 30%;"><input type="text" id="min_price" value="0" name="min_price" class="price_limit"></span>
	<span class="irs-to" style="visibility: visible; left: 63%; width: 30%;"><input type="text" id="max_price" value="0" name="max_price" class="price_limit"></span></span>
<div class="irs">
<div class="change_from">От</div><div class="irs-from"><input type="text" id="min_price" value="0" name="min_price" class="price_limit"></div>
<div class="change_to">До</div><div class="irs-to"><input type="text" id="max_price" value="0" name="max_price" class="price_limit"></div>
</div>
    <div class="slider-range"></div>
</div>-->
</div>
<div class="onlyextra">

</div>

<!------------------------------------------------Вывод цены-------------------------------------------------------> 

</div>
<div class="input_square">

<!------------------------------------------------Вывод площади-----------------------------------------------------> 

<div class="field-prod-text"><label for="n10">Площадь до:</label><input type="text" name="max_square_live" value="" id="max_square_live" />м2</div>

<!------------------------------------------------Вывод площади-----------------------------------------------------> 

</div>
<div class="foto_collage">

<!------------------------------------------------Вывод фотографий--------------------------------------------------> 

<input id="check-1" type="checkbox" name="with_photo" value="1" checked hidden />
<label for="check-1">Только с фото</label>

<!------------------------------------------------Вывод фотографий--------------------------------------------------> 

</div>

<!------------------------------------------------Обязательные поля----------------------------------------------->       

<div class="input_search">

<!------------------------------------------------Кнопка поиска-------------------------------------------------->      
 
<button class="form-but" onclick="setSort('sort=p.price&order=ASC');scroll(0,3000);jQuery('body, html').animate({'scrollTop':1770},700);return false;">Начать поиск</button> 

<!------------------------------------------------Кнопка поиска--------------------------------------------------> 

</div>

<!------------------------------------------------Кнопка больше параметров---------------------------------------> 

<!--<a href="javascript:void(0)" onclick="show_filter_extra_rows()" class="bolhe">Больше параметров</a>-->
<div class="invisible_filter">

<!------------------------------------------------Кнопка больше параметров---------------------------------------> 

<!-------------------------------------------Вывод опций в скрытом разделе---------------------------------------> 

<!--<div class="row extra-row filter-clear" id="invis_show">
<?php if($options) { ?>
<?php foreach($options as $option) { ?>
    <?php if($option['display'] == 'select') { ?>
<div class="field-prod-invis">	
<label for="n10"><?php echo $option['name']; ?></label>
    <select class="filtered selector" name="option_value[<?php echo $option['option_id']?>][]" title="<?php echo $option['name']; ?>">
        <option value=""><?php echo $text_all?></option>
        <?php foreach($option['option_values'] as $option_value) { ?>
        <option class="option_value" id="option_value_<?php echo $option_value['option_value_id']?>" value="<?php echo $option_value['option_value_id'] ?>"><?php echo $option_value['name']?></option>
        <?php }?>
    </select>
</div>
<?php } elseif($option['display'] == 'checkbox') { ?>
<div class="field-prod-invis">	
<label for="n10"><?php echo $option['name']; ?></label>
<table class="collapsible">
<?php foreach($option['option_values'] as $option_value) { ?>
<tr>
    <td>
        <input class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>" type="checkbox" name="option_value[<?php echo $option['option_id']?>][]" value="<?php echo $option_value['option_value_id']?>">
        <label class="radio_option" radio_option class="filtered option_value" for="option_value_<?php echo $option_value['option_value_id']?>"><?php echo $option_value['name']?></label>
    </td>
</tr>
<?php } ?>
</table>
</div>
<?php } elseif($option['display'] == 'radio') { ?>
<div class="field-prod-invis">	
<label class="radio_option" for="n10"><?php echo $option['name']; ?></label>
<table class="collapsible">
<?php foreach($option['option_values'] as $option_value) { ?>
<tr>
    <td>
        <input class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>" type="radio" name="option_value[<?php echo $option['option_id']?>][]" value="<?php echo $option_value['option_value_id']?>">
    </td>
    <td>
        <label class="none-margin" for="option_value_<?php echo $option_value['option_value_id']?>"><?php echo $option_value['name']?></label>
    </td>
</tr>
<?php } ?>
</table>
</div>
<?php } elseif($option['display'] == 'image') { ?>
<div>
<?php foreach($option['option_values'] as $option_value) { ?>
<input style="display: none;" class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>" type="checkbox" name="option_value[<?php echo $option['option_id']?>][]" value="<?php echo $option_value['option_value_id']?>">
<img src="<?php echo $option_value['thumb'];?>" onclick="$('#option_value_<?php echo $option_value['option_value_id']?>').click()"/>
<?php } ?>
</div>
<?php }?>
<?php } ?>
<?php } ?>
</div>-->
</div>  
<?php } ?>
<?php } ?>
<!-----------------------------------------------Для раздела продажа---------------------------------------------->

<!------------------------------------------------Для раздела аренда---------------------------------------------->
<?php $i = 0; ?>
<?php foreach($category_area_rent as $rent){ ?>
<?php if($category_id == 18 || $category_id == $rent){ ?>
<?php if(++$i == 2) break; ?>
<div class="option_requred">

<!---------------------------------------------------Вывод опций--------------------------------------------------> 

<!--Блок вывода других обьектов из других категорий--> 
	<?php if($category_id !== false) { ?>
		<input type="hidden" name="category_id" value="<?php echo $category_id ?>">
	<?php } ?>
<!--Блок вывода других обьектов из других категорий--> 
<div class="field-prod">
<div class="name_city">Тип объекта:</div>  
    <select class="selector" id="estate_type" name="estate_type" title="Тип недвижимости">
        <option value="0">Все</option>
        <?php foreach($estate_type_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<div class="field-prod">             
<div class="name_object">Местонахождение объекта:</div>       
    <select class="selector" id="city" name="city" title="Расположение">
        <option value="0">Все</option>
        <?php foreach($city_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<div class="field-prod">
<div class="name_object">Тип аренды:</div>  
    <select class="selector" id="type_rent" name="type_rent" title="Тип аренды">
        <option value="0">Все</option>
        <?php foreach($type_rent_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<div class="field-prod">
<div class="name_object">Количество комнат:</div>  
    <select class="selector" id="rooms_value" name="rooms_value" title="Количество комнат">
        <option value="0">Все</option>
        <?php foreach($rooms_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<div class="field-prod">
<div class="name_object">Количество спальных мест:</div>  
    <select class="selector" id="number_of_beds" name="number_of_beds" title="Количество спальных мест">
        <option value="0">Все</option>
        <?php foreach($number_of_beds_value as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>

<!--<div class="field-prod">
    <select class="selector" id="sale_type" name="sale_type" title="Тип сделки">
        <option value="0">Все</option>
        <?php foreach($sale_type_option_values as $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php } ?>
    </select>
</div>-->

<!---------------------------------------------------Вывод опций--------------------------------------------------> 

</div>
<div class="price_changed">

<!------------------------------------------------Вывод цены------------------------------------------------------> 
<div class="nonextra">
<div class="field-prod">
<div class="name_price">Диапазон цены:</div>  
    <select class="selector" id="budjet" title="Бюджет" onchange="set_filter_budjet()">
	    <option alt="0" value="100000">Все</option>
        <option alt="0" value="1000">до 1 000 руб.</option>
        <option alt="1000" value="3000">от 1 000 до 3 000 руб.</option>
        <option alt="3000" value="5000">от 3 000 000 до 5 000 руб.</option>
        <option alt="5000" value="15000">от 5 000 до 15 000 руб.</option>
		<option alt="15000" value="25000">от 15 000 до 25 000 руб.</option>
		<option alt="50000" value="110000">от 50 000 руб. и выше</option>
    </select>
<input type="hidden" id="min_price" value="0" name="min_price" class="price_limit">
<input type="hidden" id="max_price" value="0" name="max_price" class="price_limit">
</div>
<!--<div class="prod-d" <?php if(!$price_slider) { echo 'style="display:none"';}?>>
    <p>Диапазон цены:</p>
	<span class="irs js-irs-0 irs-with-grid"><span class="irs"></span>
	<span class="irs-from" style="visibility: visible; left: 0%; width: 30%;"><input type="text" id="min_price" value="0" name="min_price" class="price_limit"></span>
	<span class="irs-to" style="visibility: visible; left: 63%; width: 30%;"><input type="text" id="max_price" value="0" name="max_price" class="price_limit"></span></span>
<div class="irs">
<div class="change_from">От</div><div class="irs-from"><input type="text" id="min_price" value="0" name="min_price" class="price_limit"></div>
<div class="change_to">До</div><div class="irs-to"><input type="text" id="max_price" value="0" name="max_price" class="price_limit"></div>
</div>
    <div class="slider-range"></div>
</div>-->
</div>
<div class="onlyextra">

</div>


<!------------------------------------------------Вывод цены-------------------------------------------------------> 

</div>
<div class="input_square">

<!------------------------------------------------Вывод площади-----------------------------------------------------> 

<div class="field-prod-text"><label for="n10">Площадь до:</label><input type="text" name="max_square_live" value="" id="max_square_live" />м2</div>

<!------------------------------------------------Вывод площади-----------------------------------------------------> 

</div>
<div class="foto_collage">

<!------------------------------------------------Вывод фотографий--------------------------------------------------> 

<input id="check-1" type="checkbox" name="with_photo" value="1" checked hidden />
<label for="check-1">Только с фото</label>

<!------------------------------------------------Вывод фотографий--------------------------------------------------> 

</div>

<!------------------------------------------------Обязательные поля----------------------------------------------->       

<div class="input_search">

<!------------------------------------------------Кнопка поиска-------------------------------------------------->      
 
<button id="search_button" class="form-but" onclick="setSort('sort=p.price&order=ASC');scroll(0,3000);jQuery('body, html').animate({'scrollTop':1770},700);return false;">Начать поиск</button> 

<!------------------------------------------------Кнопка поиска--------------------------------------------------> 

</div>

<!------------------------------------------------Кнопка больше параметров---------------------------------------> 

<!--<a href="javascript:void(0)" onclick="show_filter_extra_rows()" class="bolhe">Больше параметров</a> Раскомментировать для доп. опций-->
<div class="invisible_filter">

<!------------------------------------------------Кнопка больше параметров---------------------------------------> 

<!-------------------------------------------Вывод опций в скрытом разделе---------------------------------------> 

<!--<div class="row extra-row filter-clear" id="invis_show">
<?php if($options) { ?>
<?php foreach($options as $option) { ?>
    <?php if($option['display'] == 'select') { ?>
<div class="field-prod-invis">	
<label for="n10"><?php echo $option['name']; ?></label>
    <select class="filtered selector" name="option_value[<?php echo $option['option_id']?>][]" title="<?php echo $option['name']; ?>">
        <option value=""><?php echo $text_all?></option>
        <?php foreach($option['option_values'] as $option_value) { ?>
        <option class="option_value" id="option_value_<?php echo $option_value['option_value_id']?>" value="<?php echo $option_value['option_value_id'] ?>"><?php echo $option_value['name']?></option>
        <?php }?>
    </select>
</div>
<?php } elseif($option['display'] == 'checkbox') { ?>
<div class="field-prod-invis">	
<label for="n10"><?php echo $option['name']; ?></label>
<table class="collapsible">
<?php foreach($option['option_values'] as $option_value) { ?>
<tr>
    <td>
        <input class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>" type="checkbox" name="option_value[<?php echo $option['option_id']?>][]" value="<?php echo $option_value['option_value_id']?>">
        <label class="radio_option" radio_option class="filtered option_value" for="option_value_<?php echo $option_value['option_value_id']?>"><?php echo $option_value['name']?></label>
    </td>
</tr>
<?php } ?>
</table>
</div>
<?php } elseif($option['display'] == 'radio') { ?>
<div class="field-prod-invis">	
<label class="radio_option" for="n10"><?php echo $option['name']; ?></label>
<table class="collapsible">
<?php foreach($option['option_values'] as $option_value) { ?>
<tr>
    <td>
        <input class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>" type="radio" name="option_value[<?php echo $option['option_id']?>][]" value="<?php echo $option_value['option_value_id']?>">
    </td>
    <td>
        <label class="none-margin" for="option_value_<?php echo $option_value['option_value_id']?>"><?php echo $option_value['name']?></label>
    </td>
</tr>
<?php } ?>
</table>
</div>
<?php } elseif($option['display'] == 'image') { ?>
<div>
<?php foreach($option['option_values'] as $option_value) { ?>
<input style="display: none;" class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>" type="checkbox" name="option_value[<?php echo $option['option_id']?>][]" value="<?php echo $option_value['option_value_id']?>">
<img src="<?php echo $option_value['thumb'];?>" onclick="$('#option_value_<?php echo $option_value['option_value_id']?>').click()"/>
<?php } ?>
</div>
<?php }?>
<?php } ?>
<?php } ?>
</div>-->
</div>  
<?php } ?>
<?php } ?>
<!------------------------------------------------Для раздела аренда---------------------------------------------->

<!-------------------------------------------Вывод опций в скрытом разделе--------------------------------------->   
<div class="row extra-row filter-clear">
    <i id="pricesort" style="display:none;" data-sort="sort=p.price&order=ASC"></i>
    <i id="valutesort_rub" style="display:none;" data-valute-rub="rub"></i>
	<i id="valutesort_usd" style="display:none;" data-valute-usd="usd"></i>
</div>
</form>
</div>

<script>
    function setSort(data){
        jQuery('#pricesort').attr('data-sort',data);
        //valuta = jQuery( "input:radio[name=valute]:checked" ).val();
        jQuery('#valutesort_rub').attr('data-valute-rub');
		jQuery('#valutesort_usd').attr('data-valute-usd');
        //jQuery("#filterpro .filtered").trigger("change");
        iF();
    }

    function setLimit(data){
        jQuery('#pricesort').attr('data-limit',data);
        iF();
    }

    function show_filter_extra_rows() {
        if (jQuery('#filterpro .extra-row').css('display')=='none') {
            jQuery('#filterpro .extra-row').slideDown();
			jQuery('#invis_show').addClass('bg-prodaga-right-down');
			jQuery(".invisible_filter").addClass('bg-color');
			
            jQuery('#filterpro .nonextra').hide();
            jQuery('#filterpro .onlyextra').show();
        } else {
            jQuery('#filterpro .extra-row').slideUp();
			jQuery('#invis_show').removeClass('bg-prodaga-right-down');
			//jQuery(".invisible_filter").removeClass('bg-color');
            jQuery('#filterpro .nonextra').show();
            jQuery('#filterpro .onlyextra').hide();
        }
    }
/* очистка фильтра
    function reset_filter_form() {
        jQuery('#filterpro').get(0).reset();

        jQuery('select.selector').each(function(){
            jQuery(this).selecter('update');
        });
    }
*/
    function set_filter_budjet() {
        var price = jQuery('select#budjet').val();
		var optionSelected = jQuery('select#budjet').find('option:selected').attr('alt');
        jQuery('#filterpro #min_price').val(optionSelected);
        jQuery('#filterpro #max_price').val(price);
        jQuery('#filterpro [name=valute][value=rub]').attr('checked','checked');
        //setSort('sort=p.price&order=ASC');
    }
</script>
<?php } ?>
