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
                        <?php if ($product['currency_id'] == 1): ?>
                            <div class="cena"><strike> Цена <?php echo $product['rub']; ?><span>руб</span></strike> Цена <?php echo $product['special_rub']; ?> <span>руб</span></div>
                        <?php endif; ?>
                    <?php } ?>
          <p class="bold"> <?php echo $product['name']; ?></p>
	<?php if($category_id == '18'){ ?>
		  <p>Комнат: <?php if(!empty($product['number_of_rooms_value']["option_value"])){echo $product['number_of_rooms_value']["option_value"];}else{ echo '-';} ?> 
		  | Мест: <?php if(!empty($product['number_of_beds_value']["option_value"])){echo $product['number_of_beds_value']["option_value"];}else{ echo '-';} ?> 
		  | Этаж: <?php if(!empty($product['floor']["option_value"])){echo $product['floor']["option_value"];}else{ echo '-';}?></p></a>
    <?php }else{ ?>
	<p></p></a>
	<?php } ?>
	<?php } ?>
	 </li>