<?php echo $header; ?>
      <div id="content">   
          
        <div class="wrapper">
            <div class="container">
                <?php echo $column_left; ?>
                <div class="prod-right">
				<?php echo $column_right; ?>
                </div>
              <div class="block-7">
                        <div class="block-7-1 block-7-1-new">
                            <h1><?php echo $heading_title; ?></h1>
							<?php if(!empty($description)){?>
							<?php  echo $description; ?>
							<?php }else{ ?>
                            <p>
                                <span>«Ренессанс Крым» — это молодая успешно развивающаяся компания, предоставляющая широкий спектр услуг на рынке недвижимости Севастополя и Крыму. В компетенцию нашего агентства входит организация покупки, продажи и обмена недвижимости в Севастополе и Крыму. Сегменты рынка: недвижимость первичного и вторичного рынка, дома, дачи,элитная и коммерческая недвижимость, с помощью специалистов «Ренессанс Крым», доступны нашим клиентам.
                                 Компания «Ренессанс Крым» работает, и развивает партнерские отношения с застройщиками Севастополя. Такое сотрудничество позволяет предлагать нашим клиентам выгодные условия, специальные программы и эксклюзивные предложения по приобретению квартир в строящихся домах в разных районах города. Благодаря работе наших специалистов вы сможете в максимально короткие сроки получить полную информацию о строящихся объектах, застройщиках и ценовой политике первичного рынке Севастополя, приобрести квартиру в новостройке в желаемом районе Севастополя.</span>
                            </p>
							<?php } ?>
                        </div>
						<div class="block-7-2">
                            <a href="/index.php?route=information/information&information_id=69"><div class="block-4-1-info">
                            <img src="/image/data/img-4-1.jpg" alt="" />
                            <div class="block-4-1-bot-info" margin-top: 20%;>СОПРОВОЖДЕНИЕ СДЕЛКИ</div>
						</div></a>
                        </div>
              </div>
			  <div class="block-3">
                        <h2>Районы</h2>
						<?php $i = 0; ?>
						<?php foreach($category_area_sale as $sale){ ?>
						<?php if($category_id == 20 || $category_id == $sale){ ?>
						<?php if(++$i == 2) break; ?>
						<?php foreach($areas_sale as $area){ ?>
                        <a href="<?php echo $area["path"]; ?>">
						<div class="block-3-1">
                            <?php if($area["image"]){ ?><img src="<?php echo HTTP_IMAGE . '/' . $area["image"]; ?>" alt="" /><?php }else{?><img src="/catalog/view/theme/default/img/nophoto_area.png" alt="Нет изображения"/>
							<?php } ?>
                            <div class="block-3-1-bot"><?php echo $area["name"]; ?></div>
						</div></a>
						 <?php } ?>
						 <?php } ?>
						 <?php } ?>
						 <?php foreach($category_area_rent as $rent){ ?>
						 <?php if($category_id == 18 || $category_id == $rent){ ?>
						 <?php if(++$i == 2) break; ?>
						 <?php foreach($areas_rent as $area){ ?>
                        <a href="<?php echo $area["path"]; ?>">
						<div class="block-3-1">
                            <?php if($area["image"]){ ?><img src="<?php echo HTTP_IMAGE . '/' . $area["image"]; ?>" alt="" /><?php }else{?><img src="/catalog/view/theme/default/img/nophoto_area.png" alt="Нет изображения"/>
							<?php } ?>
                            <div class="block-3-1-bot"><?php echo $area["name"]; ?></div>
						</div></a>
						 <?php } ?>
						 <?php } ?>
						 <?php } ?>
					</div>
                <div class="block-8" >
				<h2><?php echo $heading_title; ?></h2>
				<?php if ($products) { ?>
  <ul class="block-8-1">
  <div class="product-list">
    <?php foreach ($products as $product) { ?>
        <li>
           <a href="<?php echo $product['href']; ?>"> <?php if ($product['thumb']) { ?>
                <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>"/>
            <?php } else { ?>
                <img src="/catalog/view/theme/default/img/nophoto.png" alt="Нет изображения"/>
            <?php } ?>
                    <?php if (!$product['special']) { ?>
                        <div class="cena">Цена <?php echo $product['rub']; ?> <span>руб</span></div>
                    <?php } else { ?>
                        <?php if ($product['currency_id'] == 1){ ?>
                           <div class="cena"><strike> Цена <?php echo $product['rub']; ?><span>руб</span></strike> Цена <?php echo $product['special_rub']; ?> <span>руб</span></div>
                        <?php } ?>
                    <?php } ?>
          <p class="bold"> <?php echo $product['name']; ?></p>
          <?php $i = 0; ?>
          <?php foreach($category_area_rent as $rent){ ?>
          <?php if($category_id == 18 || $category_id == $rent){ ?>
          <?php if(++$i == 2) break; ?>
		  <p>Комнат: <?php if(!empty($product['number_of_rooms_value']["option_value"])){echo $product['number_of_rooms_value']["option_value"];}else{ echo '-';} ?> 
		  | Мест: <?php if(!empty($product['number_of_beds_value']["option_value"])){echo $product['number_of_beds_value']["option_value"];}else{ echo '-';} ?> 
		  | Этаж: <?php if(!empty($product['floor']["option_value"])){echo $product['floor']["option_value"];}else{ echo '-';}?></p></a>
          <?php }else{ ?>
		  <p></p></a>
		   <?php } ?>
		  <?php } ?>
    <?php } ?>
	 </li>
	 </div>
  </ul>
  <?php } ?>
                        <?php if($minimum_limit > 10){ ?>
						<div class="pagination"><?php echo $pagination; ?></div>
						<?php } ?>
                    </div>
            </div>
           <?php echo $content_bottom; ?>
          </div>
     </div>
<?php echo $footer; ?>
<script type="text/javascript"><!--
function display(view) {
	if (view == 'list') {
		jQuery('.product-grid').attr('class', 'product-list');
		
		jQuery('.product-list > div').each(function(index, element) {
			html  = '<div class="right">';
			html += '  <div class="cart">' + jQuery(element).find('.cart').html() + '</div>';
			html += '  <div class="wishlist">' + jQuery(element).find('.wishlist').html() + '</div>';
			html += '  <div class="compare">' + jQuery(element).find('.compare').html() + '</div>';
			html += '</div>';			
			
			html += '<div class="left">';
			
			var image = jQuery(element).find('.image').html();
			
			if (image != null) { 
				html += '<div class="image">' + image + '</div>';
			}
			
			var price = jQuery(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
					
			html += '  <div class="name">' + jQuery(element).find('.name').html() + '</div>';
			html += '  <div class="description">' + jQuery(element).find('.description').html() + '</div>';
			
			var rating = jQuery(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
				
			html += '</div>';

						
			jQuery(element).html(html);
		});		
		
		jQuery('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
		
		jQuery.cookie('display', 'list'); 
	} else {
		jQuery('.product-list').attr('class', 'product-grid');
		
		jQuery('.product-grid > div').each(function(index, element) {
			html = '';
			
			var image = jQuery(element).find('.image').html();
			
			if (image != null) {
				html += '<div class="image">' + image + '</div>';
			}
			
			html += '<div class="name">' + jQuery(element).find('.name').html() + '</div>';
			html += '<div class="description">' + jQuery(element).find('.description').html() + '</div>';
			
			var price = jQuery(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
			
			var rating = jQuery(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
						
			html += '<div class="cart">' + jQuery(element).find('.cart').html() + '</div>';
			html += '<div class="wishlist">' + jQuery(element).find('.wishlist').html() + '</div>';
			html += '<div class="compare">' + jQuery(element).find('.compare').html() + '</div>';
			
			jQuery(element).html(html);
		});	
					
		jQuery('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');
		
		jQuery.cookie('display', 'grid');
	}
}

view = jQuery.cookie('display');

if (view) {
	display(view);
} else {
	display('list');
}
//--></script>

<script>
	jQuery('.read-more').readmore({
		maxHeight: 250,
		moreLink: '<a class="hidden-text" href="#">Подробнее</a>',
		lessLink: '<a class="hidden-text" href="#">Свернуть</a>'
	});
</script>