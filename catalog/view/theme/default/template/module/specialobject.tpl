            <?php if(!empty($products)){?>
		    <div class="slider2">
                <div class="fluid_container">
                    <div class="camera_wrap camera_azure_skin" id="camera_wrap_2">
						<?php foreach ($products as $product) { ?>
						<?php if ($product['thumb']) { ?>
                        <div data-src="<?php echo $product['thumb']; ?>" data-link="<?php echo $product['href']; ?>">
						        <div class="camera_caption" id="option_information">
                                   <?php echo $product['name']; ?><span>Цена: <?php echo $product['special']; ?> руб  
								   |  Комнат: <?php if(!empty($product['number_of_rooms_value']["option_value"])){echo $product['number_of_rooms_value']["option_value"];}else{ echo '-';} ?>  
								   								</div>
						</div><!-- #camera_wrap_1 -->
						<?php }else{ ?> 
						    <div data-src="/catalog/view/theme/default/img/no-image-special.png" data-link="<?php echo $product['href']; ?>">
                                <div class="camera_caption" id="option_information">
                                   <?php echo $product['name']; ?><span>Цена: <?php echo $product['special']; ?> руб  
								   |  Комнат: <?php if(!empty($product['number_of_rooms_value']["option_value"])){echo $product['number_of_rooms_value']["option_value"];}else{ echo '-';} ?>  
								   								</div>
							</div>
							<?php } ?>
						<?php } ?>
					</div><!-- .fluid_container -->
                    <div class="ten"></div>
				</div>
            </div>
			<?php }else{ ?>
			<div class="slider2">
                <div class="fluid_container">
                    <div class="camera_wrap camera_azure_skin" id="camera_wrap_2">
						    <div data-src="/catalog/view/theme/default/img/no-image-special.png">
							    <div class="camera_caption" id="option_information">
                                   Объектов не найдено<span>Цена: - руб  
								   |  Комнат: - 
								   							    </div>
					        </div>
					</div><!-- #camera_wrap_1 -->
				</div><!-- .fluid_container -->
                <div class="ten"></div>
			</div>
			<?php } ?>
			
<script>
			jQuery(function(){
				jQuery('#camera_wrap_2').camera({
					height: '483px',
					thumbnails: false	
				});
			});
</script>	
