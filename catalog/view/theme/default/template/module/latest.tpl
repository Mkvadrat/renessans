<?php if (($setting['position'] == 'content_top') || ($setting['position'] == 'content_bottom')){ ?>
<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
	    <?php if ($product['special']) { ?>
		  <div class="sale"><?php echo $product['percent']; ?>%</div>
        <?php } ?>
	    <?php if ($product['thumb']) { ?>
	    <div class="boxgrid caption">
         <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
       
        </div>
		<?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
       
       
       
	    <div id="<?php echo $product['product_id']; ?>" class="reveal-modal">
	     <div class="modal">
		  
		   <a class="close-reveal-modal"></a>
		 </div>
		</div>
	  </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php }  ?>
