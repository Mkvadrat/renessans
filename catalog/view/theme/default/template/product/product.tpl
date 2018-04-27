 <?php
  $price_str='';
  if ($price) {
      if (!$special) {
        $price_str .= $rub.' руб. / '.$price.' $';
      } else {
          if ($currency_id == 1) {
              $price_str .= '<strike>'.$rub.' руб.</strike> / '.$special_rub.' руб.';
          } else {
            $price_str .= '<strike>'.$price.' $</strike> / '.$special.' $';
          }
      }
  }

if ($root_category == 94) {
    $add_specification_options_ids = array(
        22 => 'Стадия строительства',
        18 => ' Срок сдачи',
    );

    $specification_options_ids = $add_specification_options_ids + $specification_options_ids;
}

$main_extra_options = array(
    19 => array(
      'type' => 'text',
      'name' => 'Цена',
      'option_value' => $price_str
    )
);
$location_extra_options = array(
    17 => array(
        'type' => 'text',
        'name' => 'Карта',
        'option_value' => '<a href="javascript:void(0)" onclick="show_map();"><img src="/catalog/view/theme/default/images/map_icon.png" /></a>'
    )
);
$specification_extra_options = array();

$main_options = array();
$location_options = array();
$specification_options = array();
$other_options = array();
$_main_options = array();
$_location_options = array();
$_specification_options = array();
$_other_options = array();

$structure_option_id = 47;
$structure = '';

if ($all_options) {
    $main_options_ids = array();
    $location_options_ids = array();
    $specification_options_ids = array();
    foreach($all_options as $option) {
        if ($option['sort_order']>=2000) {
            $main_options_ids[$option['option_id']] = $option['name'];
        } else if ($option['sort_order']>=1000 && $option['sort_order']<2000) {
            $location_options_ids[$option['option_id']] = $option['name'];
        } else {
            $specification_options_ids[$option['option_id']] = $option['name'];
        }
    }
}

if ($options) {
    foreach ($options as $option) {
        //if (empty($option['required'])) continue;
        if (array_key_exists($option['option_id'], $main_options_ids)) {
            $_main_options[$option['option_id']]=$option;
        } else if (array_key_exists($option['option_id'], $location_options_ids)) {
            $_location_options[$option['option_id']]=$option;
        } else if (array_key_exists($option['option_id'], $specification_options_ids)) {
            $_specification_options[$option['option_id']]=$option;
        } else if ($option['option_id'] == $structure_option_id) {
            $structure = $option['option_value'];
        } else {
            $_other_options[$option['option_id']]=$option;
        }
    }

    foreach ($main_options_ids as $option_id=>$option_name) {
        if (array_key_exists($option_id,$_main_options)) {
            if (empty($_main_options[$option_id]['required'])) continue;
            $main_options[]=$_main_options[$option_id];
        } else {
            $main_options[]=array(
                'option_id' => $option_id,
                'type' => 'text',
                'name' => $option_name,
                'option_value' => ''
            );
        }
    }
    foreach ($location_options_ids as $option_id=>$option_name) {
        if (array_key_exists($option_id,$_location_options)) {
            if (empty($_location_options[$option_id]['required'])) continue;
            $location_options[]=$_location_options[$option_id];
        } else {
            $location_options[]=array(
                'option_id' => $option_id,
                'type' => 'text',
                'name' => $option_name,
                'option_value' => ''
            );
        }
    }
    foreach ($specification_options_ids as $option_id=>$option_name) {
        if (array_key_exists($option_id,$_specification_options)) {
            if (empty($_specification_options[$option_id]['required'])) continue;
            $specification_options[]=$_specification_options[$option_id];
        } else {
            $specification_options[]=array(
                'option_id' => $option_id,
                'type' => 'text',
                'name' => $option_name,
                'option_value' => ''
            );
        }
    }
}

function template_include_extra_options(&$options,&$extra_options) {
    $_options = array();
    foreach($options as $option) {
        $_options[]=$option;
        if (array_key_exists($option['option_id'], $extra_options)) {
            $_options[]=$extra_options[$option['option_id']];
            $extra_options[$option['option_id']] = null;
        }
    }
    $options = $_options;
    $_options = null;
    foreach ($extra_options as $option) {
        if (!$option) continue;
        $options[]=$option;
    }
}

function template_render_options_row($option, $tr = true) {
    $html = '';
    if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox') {
        if ($tr) $html.='<tr>';
        $html.='<td><dt>'.$option['name'].'</dt></td>';
        $html.='<td><dt>';
        foreach ($option['option_value'] as $option_value) {
            $html.='<div>'.$option_value['name'].'</div>';
        }
        $html.='</dt></td>';
        if ($tr) $html.='</tr>';
    }
    if ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
        if ($option['type'] == 'date') $option['option_value'] = date('d.m.Y',strtotime($option['option_value']));
        if ($option['type'] == 'datetime') $option['option_value'] = date('d.m.Y H:i:s',strtotime($option['option_value']));
        if ($tr) $html.='';
        $html.='<td><dt>'.$option['name'].'</dt></td>';
        $html.='<td><dd>'.$option['option_value'].'</dd></td>';
        if ($tr) $html.='</tr>';
    }
    if ($option['type'] == 'image') {
        if ($tr) $html.='<tr>';
        $html.='<td>'.$option['name'].'</td>';
        $html.='<td>';
        foreach ($option['option_value'] as $option_value) {
            $html.='<div><img src="'.$option_value['image'].'" alt="'.$option_value['name'].'" /></div>';
        }
        $html.='</td>';
        if ($tr) $html.='</tr>';
    }
    return $html;
}

template_include_extra_options($main_options, $main_extra_options);
template_include_extra_options($location_options, $location_extra_options);
template_include_extra_options($specification_options, $specification_extra_options);
?>

<?php echo $header; ?><?php echo $column_right; ?>
<?php echo $content_top; ?>
			
 <div class="content"> 
<div class="container">
<div class="breadcrumbs">
<ul>
    <?php
    $count = count($breadcrumbs);
    $i=1;
    foreach ($breadcrumbs as $breadcrumb) {
     if($i!=$count){
     ?>

<li> <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
     <?php
      }
     else{
     ?><li><?php echo $breadcrumb['text']; ?></li>
     <?php }
        $i++;
     } ?>
</ul>
  </div>
<div class="header-inf-object">
  <h3 class="zag-arend"><?php echo $heading_title; ?></h3>
  <ul class="text-ar">
						<li>Адрес:<span>
						<?php if(!empty($ean)){ ?>
			            <?php echo $ean; ?>
			            <?php }else{ echo '-';} ?>
						</span></li>
						<li>Комнат:<span>
						<?php if(!empty($number_of_rooms_value)){
						foreach($number_of_rooms_value as $number_of_rooms){
						echo $number_of_rooms;
						}
						}else{ echo '-';}
						?></span></li>
						<!--<li>Мест:<span>
						<?php if(!empty($number_of_beds_value)){
						foreach($number_of_beds_value as $number_of_beds){
						echo $number_of_beds;
						}
						}else{ echo '-';}
						?></span></li>-->
					</ul>
  
<p class="print"><a onClick="javascript:CallPrint('print-content');">Распечатать<br> объект</a></p>
</div>

<div class="gallery">
<?php if ($images) { ?>
<div id="fruits">
<ul>
    <?php foreach ($images as $image) { ?>
    <li><img src="<?php echo $image['popup']; ?>" /></li>
    <?php } ?>
</ul>
</div>

<script language="javascript">
jQuery(document).ready(function(){
	jQuery("#fruits").tiksluscarousel({width:1200,height:480,nav:'dots',current:0,type:'slide', navIcons: false, autoPlay:true, autoplayInterval: 5000,});
});
</script>

<?php } ?>
<?php if ($video) { ?>
			<style>
			    .prod-col-right-vid iframe {
                    width: 1200px !important;
                    height: 461px !important;
                }
		    </style>
            <div class="prod-col-right-vid">
                <?php echo $video ?>
            </div>
<?php } ?>
</div>
          
  <div class="block-9">
					<div class="block-9-1">
						<div id="wrapper-tab">

	<ul class="tabs tabs1">
		<li class="t1" style="cursor: pointer;"><a>Основные</a></li>
		<li class="t2" style="cursor: pointer;"><a>Дополнительно</a></li>
		<li class="t3" style="cursor: pointer;"><a>На карте</a></li>
		<li class="t4" style="cursor: pointer;"><a>Описание</a></li>
	</ul>

	<div class="t1" id="main">
		<div class="col-wrap">
		<div class="col-1">
			<dl class="horizontal">
			<dt>id объявления:</dt>
			<dd><!--42741--><?php echo $model ?></dd>
			<dt>Цена:</dt>
			<dd><!--2500 руб--><?php echo $price_str; ?></dd>
			<dt>Адрес:</dt>
			<dd><?php if(!empty($ean)){ ?>
			<?php echo $ean; ?>
			<?php }else{ echo '-';} ?></dd>
			<dt>Показать на карте:</dt>
			<dd><?php if (!empty($location_options)) { ?>
            <?php foreach ($location_options as $option) { ?>
                <?php echo $option['option_value']; ?>
            <?php } ?>
            <?php } ?>
			</dd>
			<?php if(!empty($plans)) { ?>
			<dt>План:</dt>
			<?php foreach ($plans as $plan) { ?>
			<dd><a class="plan-view" href="#plan"><img src="<?php echo $plan['plan_object']; ?>" style="width: 190px; height: 200px;" /></a></dd>
			<?php } ?>
			<?php } ?>
			</dl>
		</div>
		<div class="col-2">
		<dl class="horizontal">
		<?php foreach ($get_option_required as $option) { ?>
		<dt><?php echo $option["name"]; ?></dt>
		<?php if (!empty($option["option_value"])) { ?>
		<dd><?php echo $option["option_value"]; ?></dd>
		<?php }else{ echo '<dd>-</dd>'; } ?>
		<?php } ?>
		</dl>
		</div>
		 </div>
	      </div>

	<div class="t2">
		<div class="col-wrap">
		<?php 
			if(count($get_attribute_value) >= 8){
			$column_size_3 = 'id="column_size_3"';
		    }
		?>
		
		<?php if(!empty($attribute_groups)){?>
		<?php $sectionsCols = array_chunk($attribute_groups, ceil(count($attribute_groups) / 3)); ?> 
		<?php } ?> 
        
		<div class="t2-col-1" <?php //echo $column_size_3; ?>>	
        <?php if(!empty($sectionsCols[0])){?>		
	        <ul>
			<?php foreach($sectionsCols[0] as $attribute_group){ ?>
		    <p class="t2-col-1-column-1"><?php echo $attribute_group["name"]; ?></p>
			<?php foreach($attribute_group['attribute'] as $attribute){ ?>
			<li><?php echo $attribute["name"]; ?></li>
			<?php } ?> 
			<?php } ?> 
		    </ul>
	    <?php } ?>
		</div>
		 
        <div class="t2-col-2">
		<?php if(!empty($sectionsCols[1])){?>
			<ul>
			<?php foreach($sectionsCols[1] as $attribute_group){ ?>
		    <p class="t2-col-1-column-1"><?php echo $attribute_group["name"]; ?></p>
			<?php foreach($attribute_group['attribute'] as $attribute){ ?>
			<li><?php echo $attribute["name"]; ?></li>
			<?php } ?> 
			<?php } ?> 
		    </ul>
		<?php } ?> 
		</div>
        
		<div class="t2-col-3">
		<?php if(!empty($sectionsCols[2])){?>
			<ul>
			<?php foreach($sectionsCols[2] as $attribute_group){ ?>
		    <p class="t2-col-1-column-1"><?php echo $attribute_group["name"]; ?></p>
			<?php foreach($attribute_group['attribute'] as $attribute){ ?>
			<li><?php echo $attribute["name"]; ?></li>
			<?php } ?> 
			<?php } ?> 
		    </ul>
		<?php } ?> 
		</div>
        
		</div>
	</div>

	<div class="t3" id="maps">
		<div class="wrap-karta-tabs">
          <div id="map" style="width:600px; height:300px"></div>
                <script src="http://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
                <?php if(/*$ean ||*/ $lat_lng){ ?>
                    <script type="text/javascript">
                        var myMap;
						
                        ymaps.ready(init);
                        function init()
                        {
						<?php /*if($ean){ */?>
						    //ymaps.geocode('<?php /*echo $ean;*/ ?>', {
                                //results: 1
                            //})
						<?php //}else{ ?>
                        var myCoords = [<?php echo $lat_lng; ?>];  
                        var myGeocoder = ymaps.geocode(myCoords);
                        myGeocoder
						<?php //} ?>
						.then(
                                function (res)
                                {
                                    var firstGeoObject = res.geoObjects.get(0),
                                        myMap = new ymaps.Map
                                        ("map",
                                            {
                                                center: firstGeoObject.geometry.getCoordinates(),
                                                zoom: 15
                                            }
                                        );
                                    var myPlacemark = new ymaps.Placemark
                                    (
                                        firstGeoObject.geometry.getCoordinates(),
                                        {
                                            iconContent: ''
                                        },
                                        {
                                            preset: 'twirl#blueStretchyIcon'
                                        }
                                    );
                                    myMap.geoObjects.add(myPlacemark);
                                    myMap.controls.add(new ymaps.control.ZoomControl()).add(new ymaps.control.ScaleLine()).add('typeSelector');
                                },
                                function (err)
                                {
                                    alert(err.message);
                                }
                            );
                        }
                    </script>
  	            <?php } ?>	    
	    </div>
	</div>

	<div class="t4">
		<ul class="wrap-otz">
			<li>
				<?php echo $description; ?>
			</li>
		</ul>
	</div>
</div>	
					</div>
					<div class="block-9-2">
						<p>Объект опубликовал</p>
						<div class="wrap-ob">
						<?php foreach($inf_agent as $information){ ?>
						<?php if(!empty($information["image"])){ ?>
						<img src="<?php echo HTTP_IMAGE?><?php echo $information["image"]; ?>" alt="">
						<?php }else {?><img src="<?php echo HTTP_IMAGE?>data/img-ob.jpg" alt="">
						<?php } ?>
						<?php if(!empty($information["firstname"]) || !empty($information["lastname"])){ ?>
							<p class="ob-name"><?php echo $information["firstname"] .' '. $information["lastname"]; ?></p>
						<?php }else {?><p class="ob-name">Имя не указано</p>
						<?php } ?>
						<?php if(!empty($information["phone_1"]) ){ ?>
							<p class="ob-tel"><?php echo $information["phone_1"]; ?></p>
					    <?php }else {?><p class="ob-tel">Телефон не указан</p>
						<?php } ?>
						<?php if(!empty($information["phone_2"]) ){ ?>
							<p class="ob-tel"><?php echo $information["phone_2"]; ?></p>
						<?php }else {?><p class="ob-tel">Телефон не указан</p>
						<?php } ?>
						<?php if(!empty($information["email"]) ){ ?>
							<p class="ob-mail"><?php echo $information["email"]; ?></p>
						<?php }else {?><p class="ob-mail">Email не указан</p>
						<?php } ?>
						<?php } ?>
						</div>
						<!--<a class="vse-ob" href="#">Все объявления <span>(64)</span></a>-->
						<a href="#otpr-s" class="sing-in" id="soob-ob">Послать сообщение</a>
						<input type="hidden" name="agent-user-id" value="<?php echo $agent['user_id'] ?>" readonly="readonly" />
					</div>
					<?php if(!empty($social_button)){?>
					<!--<div class="social_button"><div class="ya-share2" data-services="<?php echo $social_button;?>" data-counter></div></div>-->
					<div class="social_button"><div class="ya-share2" data-services="<?php echo $social_button;?>"></div></div>
					<?php } ?>
				</div>			

<?php if (!empty($products)) { ?>
<div class="row bg-slider-prod">
    <div class="object-similar">
        <h3>похожие объекты</h3>
        <div class="slider5">
            <?php foreach($products as $product) { ?>
            <div class="slide">
                <a href="<?php echo $product['href'] ?>">
                    <div class="slider2-img">
                        <?php if ($product['thumb']) { ?>
                            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>"/>
                        <?php } else { ?>
                            <img src="/catalog/view/theme/default/img/nophoto.png" alt="Нет изображения"/>
                        <?php } ?>
                        <div class="slider2-img-text">
                            <?php if (!$product['special']) { ?>
                                <?php echo $product['rub']; ?> руб. / <?php echo $product['price']; ?> $
                                <!--<?php echo $product['price']; ?> $-->
                            <?php } else { ?>
                                <span class="price-old"><?php echo $product['price']; ?></span>--> <span class="price-new"><?php echo $product['special']; ?></span>
                            <?php } ?>
                        </div>
                        <!--<div class="slider2-img-av"><img src="<?php echo (!empty($product['agent']['image']) ? $product['agent']['image'] : '/catalog/view/theme/default/img/agent.png'); ?>" alt=""/></div>-->
                    </div>
                </a>
                <p class="slider2-text1"><?php echo $product['name'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery('.slider5').bxSlider({
            slideWidth: 300,
            minSlides: 2,
            maxSlides: 2,
            moveSlides: 1,
            pager: false,
            slideMargin: 60
        });
    });
</script>
<?php } ?>

<?php echo $content_bottom; ?>

</div>
    </div>
<?php echo $footer; ?>
<div id="print-content" style="display:none;">
<div class="print-page">
            <div class="print_image">
            <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
			</div>
			<dl class="horizontal">
			<dt>id объявления:</dt>
			<dd><!--42741--><?php echo $model ?></dd>
			<dt>Цена:</dt>
			<dd><!--2500 руб--><?php echo $price_str; ?></dd>
			<dt>Адрес:</dt>
			<dd><?php if(!empty($ean)){ ?>
			<?php echo $ean; ?>
			<?php }else{ echo '-';} ?></dd>
			<dt>Показать на карте:</dt>
			<dd><?php if (!empty($location_options)) { ?>
            <?php foreach ($location_options as $option) { ?>
                <?php echo $option['option_value']; ?>
            <?php } ?>
            <?php } ?>
			</dd>
			</dl>
		<dl class="horizontal">
		<?php foreach ($get_option_required as $option) { ?>
		<dt><?php echo $option["name"]; ?></dt>
		<?php if (!empty($option["option_value"])) { ?>
		<dd><?php echo $option["option_value"]; ?></dd>
		<?php }else{ echo '<dd>-</dd>'; } ?>
		<?php } ?>
		</dl>
		<br>
		<ul class="wrap-otz"><li><?php echo $description; ?></li></ul>
</div>
</div>

<div id="otpr-s" style="display:none;">
    <form class="in-r" rel="agent-message-form" action="index.php?route=information/contact/agent">
        <p class="in-zag">ОТПРАВИТЬ СООБЩЕНИЕ РИЕЛТОРУ</p>
        <div class="form-message"></div>
        <div class="wrap-cont-in">
            <div class="wrap-cont-in-left">
                <label>Имя<span>*</span></label>
                <input type="text" name="firstname">
                <label>Телефон<span>*</span></label>
                <input type="text" name="phone">
            </div>
            <div class="wrap-cont-in-right">
                <label>Фамилия<span>*</span></label>
                <input type="text" name="secondname">
                <label>Email<span>*</span></label>
                <input type="text" name="email">
            </div>
            <label>Сообщение<span>*</span></label>
            <textarea name="text"></textarea>
            <div class="cont-in-b">
                <p>*поля обязательно к заполнению</p>
                <input class="but-in" type="submit" value="ОТПРАВИТЬ СООБЩЕНИЕ">
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    var OLD_JQUERY = jQuery.noConflict();
    OLD_JQUERY(".sing-in").boxer({
        fixed: true,
        callback: function() {

        }
    });

</script>

<script type="text/javascript">
    var OLD_JQUERY = jQuery.noConflict();
    OLD_JQUERY(document).ready(function(){
        OLD_JQUERY('body').on('submit', 'form[rel=agent-message-form]', function(e){
            e.stopPropagation();
            e.preventDefault();

            var data = OLD_JQUERY(this).serialize();

            if (OLD_JQUERY('input[name=agent-user-id]').length) {
                data += '&user_id='+OLD_JQUERY('input[name=agent-user-id]').val();
            }

            OLD_JQUERY.post(
               OLD_JQUERY(this).attr('action'),
                data,
                function(response) {
                    if (!response) return;
                    if (response.status) {
                        OLD_JQUERY('form[rel=agent-message-form]').find('.form-message').html('<div class="message">'+response.message+'</div>');
                        window.setTimeout("OLD_JQUERY('.boxer-close').trigger('click');",3000);
                    } else {
                        OLD_JQUERY('form[rel=agent-message-form]').find('.form-message').html('<div class="error">'+response.message+'</div>');
                    }
                },
                'json'
            )
        });
    });

</script>

<script language="javascript">
function CallPrint(strid)
{
 var prtContent = document.getElementById(strid);
 var prtCSS = '<link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/stylesheet.css" />';
 var prtCSS = '<link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/stylesheet.css" />';
 var WinPrint = window.open('','','left=0,top=0,width=1000,height=800,toolbar=0,scrollbars=1,status=0');
 WinPrint.document.write('<div id="print" class="contentpane">');
 WinPrint.document.write(prtCSS);
 WinPrint.document.write(prtContent.innerHTML);
 WinPrint.document.write('</div>');
 WinPrint.document.close();
 WinPrint.focus();
 WinPrint.print();
 WinPrint.close();
 //prtContent.innerHTML=strOldOne;
}
</script>

<script>
    jQuery(document).ready(function(){
window.onload = function () {
    jQuery(".t1").addClass('tab-current');
   };
    });
</script>

<script type="text/javascript">
    function show_map() {
        //jQuery('body, html').animate({'scrollTop':jQuery('#map').offset().top},400);
		jQuery('#main').hide();
		jQuery(".t3").show();
		jQuery(".t1").removeClass('tab-current');
		jQuery(".t3").addClass('tab-current');
		jQuery(jQuery(".t1").attr('href')).fadeIn();	
    }
</script>
		
<script>
    var OLD_JQUERY = jQuery.noConflict();
    (function($) {
$(function () {

        $("#range2").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 50000,
            from: 10000,
            to: 40000,
            type: 'double',
            step: 1,
            prefix: "$",
            grid: true
        });
	$("#range3").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 1,
            max: 11,
            from: 2,
            to: 10,
            type: 'double',
            step: 1,
            prefix: "",
            grid: true
        });

    });
    })(OLD_JQUERY )
</script>

<!--План объекта--> 
<script type="text/javascript">
jQuery(document).ready(function() {
	  jQuery('.plan-view').fancybox();
});
</script>	
<!--План объекта--> 

<div id="plan" style="display: none;">
<img src="<?php echo $plan['plan_object']; ?>" /> 
</div>