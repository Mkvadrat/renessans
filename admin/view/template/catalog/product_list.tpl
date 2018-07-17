<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?>:&nbsp;
         <select name="filter_category_id" onchange="filter();">
            <option value="">&nbsp;</option>
            <?php foreach($categories as $c) { ?>
            <option value="<?php echo $c['category_id']?>" <?php echo ($c['category_id'] == $filter_category_id ? 'selected' : '') ?>><?php echo $c['name'] ?></option>
            <?php } ?>
         </select>&nbsp;<img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_product_category; ?>" style="float:right;padding-top:5px;" />
	  </h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="center" id="image_object"><?php echo $column_image; ?></td>
              <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_name; ?>" /> <?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
							<td class="left">
								<?php if ($sort == 'p.date_modified') { ?>
									<a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $date_modify; ?></a>
								<?php } else { ?>
									<a href="<?php echo $sort_date_modified; ?>"><?php echo $date_modify; ?></a>
								<?php } ?>
							</td>
							
							<td class="left">Объект (квартира, комната, дом, участок)</td>
							<td class="left">Количество комнат</td>
							<td class="left">Адрес объекта</td>
							<td class="left">Район (Балаклавский/Нахимоский/Ленинский/Гагаринский)</td>
							<td class="left">Этаж</td>
							<td class="left">Этажность</td>
							<td class="left">Площадь кухни (м²)</td>
							<td class="left">Площадь комнат (м²)</td>
							<td class="left">Жилая площадь (м²)</td>
							<td class="left">Общая площадь (м²)</td>
							
							<?php if($getblock){ ?>
							<td class="left">Агент</td>
							<?php } ?>
							
              <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_model; ?>" /> <?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
                <?php } ?></td>
              <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_price; ?>" /> <?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                <?php } ?></td>
              <!--<td class="right"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_quantity; ?>" /> <?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
                <?php } ?></td>-->
              <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_status; ?>" /> <?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
		  <tfoot>
			<tr>
			  <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			  <td class="center" id="image_object"><strong><?php echo $column_image; ?></strong></td>
			  <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_name; ?>" /> <strong><?php echo $column_name; ?></strong></td>
			  <td class="left"><strong><?php echo $date_modify; ?></strong></td>
			  <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_model; ?>" /> <strong><?php echo $column_model; ?></strong></td>
			  <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_price; ?>" /> <strong><?php echo $column_price; ?></strong></td>
			  <!--<td class="right"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_quantity; ?>" /> <strong><?php echo $column_quantity; ?></strong></td>-->
			  <td class="left"><img src="view/image/information.png" width="15" height="15" hspace="10" border="0" align="absmiddle" class="tooltip" title="<?php echo $info_status; ?>" /> <strong><?php echo $column_status; ?></strong></td>
			  <td align="right"><div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>&nbsp;&nbsp;<a onclick="$('#form').submit();" class="button"><?php echo $button_delete; ?></a></div></td>
			</tr>
		  </tfoot>
          <tbody>
            <tr class="filter">
              <td></td>
              <td></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
							<td><input type="text" name="filter_date" value="<?php echo $filter_date; ?>" /></td>
							<td><input type="text" name="type_object" value="<?php echo $type_object; ?>" /> </td>
							<td><input type="text" name="rooms_count" value="<?php echo $rooms_count; ?>" /> </td>
							<td><input type="text" name="address_object" value="<?php echo $address_object; ?>" /> </td>
							<td><input type="text" name="area_object" value="<?php echo $area_object; ?>" /> </td>
							<td><input type="text" name="floor_object" value="<?php echo $floor_object; ?>" /> </td>
							<td><input type="text" name="storeys_object" value="<?php echo $storeys_object; ?>" /> </td>
							<td><input type="text" name="kitchen_area" value="<?php echo $kitchen_area; ?>" /> </td>
							<td><input type="text" name="rooms_area" value="<?php echo $rooms_area; ?>" /> </td>
							<td><input type="text" name="live_area" value="<?php echo $live_area; ?>" /> </td>
							<td><input type="text" name="total_area" value="<?php echo $total_area; ?>" /> </td>
							
							<?php if($getblock){ ?>
							<td><select name="product_agent">
								<option value="">Все</option>
								<?php if ($all_agents) { ?>
								<?php foreach($all_agents as $agents){ ?>
								<?php if($curent_agent == $agents['user_id']){ ?>
								<option value="<?php echo $agents['user_id']; ?>" selected="selected"><?php echo $agents['firstname'] . ' ' .  $agents['lastname'];  ?></option>
								<?php }else{ ?>
								<option value="<?php echo $agents['user_id']; ?>"><?php echo $agents['firstname'] . ' ' .  $agents['lastname'];  ?></option>
								<?php } ?>

								<?php } ?>
								<?php } ?>
                </select>
							</td>
							<?php } ?>
							
              <td><input type="text" name="filter_model" value="<?php echo $filter_model; ?>" /></td>
              <td align="left"><input type="text" name="filter_price" value="<?php echo $filter_price; ?>" size="8"/></td>
              <!--<td align="right"><input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" style="text-align: right;" /></td>-->
              <td><select name="filter_status">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($product['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?></td>
              <td class="center" id="image_object"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left">
			    <input type="text" name="name" value="<?php echo $product['name']; ?>" size="40" id="name<?php echo $product['product_id']; ?>" />&nbsp;&nbsp;<a onclick="updateName(<?php echo $product['product_id']; ?>);$(this).fadeTo(250, 0.2);$(this).fadeTo(150, 0.5);"><img align="absmiddle" class="tooltip" src="view/image/disketa.png" alt="" title="<?php echo $text_save; ?>"/></a>
			  </td>
			  <td class="left" id="date_modify"><?php if($product['date_modify']){ ?><?php echo $product['date_modify']; ?><?php } ?></td>
				<!--OPTIONS-->
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 13){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 43){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 117){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 116){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 29){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 28){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 24){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 113){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 23){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($product['options']){ ?>
					<?php foreach ($product['options'] as $options) { ?>
						<?php if($options['option_id'] == 141){ ?>
						<?php echo $options['option_value']; ?>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</td>
				
				<?php if($getblock){ ?>
				<td class="center">
					<?php if($product['agents']){ ?>
					 <?php echo $product['agents']['name'] . ' ' . $product['agents']['surname'] ?>
					<?php } ?>
				</td>
				<?php } ?>
				
				<!--OPTIONS-->
        <td class="left">
			    <input type="text" name="model" value="<?php echo $product['model']; ?>" size="20" id="model<?php echo $product['product_id']; ?>" />&nbsp;&nbsp;<a onclick="updateModel(<?php echo $product['product_id']; ?>);$(this).fadeTo(250, 0.2);$(this).fadeTo(150, 0.5);"><img align="absmiddle" class="tooltip" src="view/image/disketa_prod.png" alt="" title="<?php echo $text_save; ?>"/></a>
			  </td>
        <td class="left">
			    <input type="text" name="price" value="<?php echo $product['price']; ?>" size="10" id="price<?php echo $product['product_id']; ?>" />&nbsp;&nbsp;<a onclick="updatePrice(<?php echo $product['product_id']; ?>);$(this).fadeTo(250, 0.2);$(this).fadeTo(150, 0.5);"><img align="absmiddle" class="tooltip" src="view/image/disketa_price.png" alt="" title="<?php echo $text_save; ?>"/></a>
  			</td>
			  <!--<td class="right">
				<span class="ajax-edit" id="quantity-<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">
				<input type="text" value="<?php echo $product['quantity']; ?>" size="5">
				<div style="margin-top:5px;"></div>
				<a onclick="save_quantity(<?php echo $product['product_id']; ?>)"><?php echo $text_save; ?></a>&nbsp
				<a onclick="close_quantity(<?php echo $product['product_id']; ?>)"; return false;><?php echo $text_close; ?></a>
				</span>
				<?php if ($product['quantity'] <= 0) { ?>
                <span style="color: #FF0000;"><?php echo $product['quantity']; ?></span>
                <?php } elseif ($product['quantity'] <= 5) { ?>
                <span style="color: #FFA500;"><?php echo $product['quantity']; ?></span>
                <?php } else { ?>
                <span style="color: #008000;"><?php echo $product['quantity']; ?></span>
                <?php } ?></td>-->
              <td style="text-align: center;"><a class="ajaxcolumnen button" id="status-<?php echo $product['product_id']; ?>"><?php echo $product['status']; ?></a></td>
              <td class="right"><?php foreach ($product['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
<script type="text/javascript"><!--
$(document).ready(function() {
    $('.ajax-edit').each(function(index, wrapper) {
        $(this).siblings().click(function() {
            $(wrapper).show();
            $(wrapper).siblings().hide();
        })
    });
})

function save_quantity(id) {
    var input_quantity = $('#quantity-'+id+' input');
    var quantity = $(input_quantity).val();
    $(quantity).css('cursor','progress');
    $.ajax({
        url: 'index.php?route=catalog/product/saveQuantity&product_id='+id+'&quantity='+quantity+'&token=<?php echo $token; ?>',
        dataType: 'html',
        data: {},
        success: function(quantity) { 
            $('#quantity-'+id).next().html(quantity);
            close_quantity(id);
        }
    });
    $(input_quantity).css('cursor','default');
}

function close_quantity(id) {
    $('.ajax-edit input').blur();
    $('#quantity-'+id).siblings().show();
    $('#quantity-'+id).hide(500);
}

function filter() {
	url = 'index.php?route=catalog/product&token=<?php echo $token; ?>';
	
	var filter_category_id = $('select[name=\'filter_category_id\']').attr('value');

	if (filter_category_id) {
		url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_date = $('input[name=\'filter_date\']').attr('value');
	
	if (filter_date) {
		url += '&filter_date=' + encodeURIComponent(filter_date);
	}
	
	
	//options
	var type_object = $('input[name=\'type_object\']').attr('value');
	
	if (type_object) {
		url += '&type_object=' + encodeURIComponent(type_object);
	}
	
	var rooms_count = $('input[name=\'rooms_count\']').attr('value');
	
	if (rooms_count) {
		url += '&rooms_count=' + encodeURIComponent(rooms_count);
	}
	
	var address_object = $('input[name=\'address_object\']').attr('value');
	
	if (address_object) {
		url += '&address_object=' + encodeURIComponent(address_object);
	}
	
	var area_object = $('input[name=\'area_object\']').attr('value');
	
	if (area_object) {
		url += '&area_object=' + encodeURIComponent(area_object);
	}
	
	var floor_object = $('input[name=\'floor_object\']').attr('value');
	
	if (floor_object) {
		url += '&floor_object=' + encodeURIComponent(floor_object);
	}
	
	var storeys_object = $('input[name=\'storeys_object\']').attr('value');
	
	if (storeys_object) {
		url += '&storeys_object=' + encodeURIComponent(storeys_object);
	}
	
	var kitchen_area = $('input[name=\'kitchen_area\']').attr('value');
	
	if (kitchen_area) {
		url += '&kitchen_area=' + encodeURIComponent(kitchen_area);
	}
	
	var rooms_area = $('input[name=\'rooms_area\']').attr('value');
	
	if (rooms_area) {
		url += '&rooms_area=' + encodeURIComponent(rooms_area);
	}
	
	var live_area = $('input[name=\'live_area\']').attr('value');
	
	if (live_area) {
		url += '&live_area=' + encodeURIComponent(live_area);
	}
	
	var total_area = $('input[name=\'total_area\']').attr('value');
	
	if (total_area) {
		url += '&total_area=' + encodeURIComponent(total_area);
	}
	
	var product_agent = $('select[name=\'product_agent\']').attr('value');
	
	if (product_agent) {
		url += '&product_agent=' + encodeURIComponent(product_agent);
	}
	//options
	
	
	
	var filter_model = $('input[name=\'filter_model\']').attr('value');
	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_price = $('input[name=\'filter_price\']').attr('value');
	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}
	
	var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
	
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
	}
});

//filter date
$('input[name=\'filter_date\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_date=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.date_modified,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_date\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
	}
});

$('input[name=\'filter_model\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.model,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_model\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
	}
});
//--></script> 
<script type="text/javascript"><!--
$('.ajaxcolumnen').click(function() {
	var object_id=$(this).attr('id');
	$.ajax({
		url: 'index.php?route=catalog/product/setatten&token=<?php echo $token; ?>',
		type: 'get',
		data: {object_id:object_id},
		dataType: 'html',
		success: function(html) {
			if(html!=''){				
				$('#'+object_id).html(html);
			}
		}
	});
});

/*$("img.tooltip").tooltip({
	track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});*/
//--></script> 
<script type="text/javascript"><!--
function updateName(product_id) {
	var name = $('#name' + product_id).val();
	$.post('index.php?route=catalog/product/name&token=<?php echo $token; ?>', 'name=' + name + '&product_id=' + product_id);
}

function updateModel(product_id) {
	var model = $('#model' + product_id).val();
	$.post('index.php?route=catalog/product/model&token=<?php echo $token; ?>', 'model=' + model + '&product_id=' + product_id);
}

function updatePrice(product_id) {
	var price = $('#price' + product_id).val();
	$.post('index.php?route=catalog/product/price&token=<?php echo $token; ?>', 'price=' + price + '&product_id=' + product_id);
}
//--></script>
<?php echo $footer; ?>