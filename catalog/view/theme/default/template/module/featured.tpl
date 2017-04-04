<div class="content">
                <div class="container">
<div class="block-5">

<h2><?php echo $heading_title; ?></h2>
  
      <?php foreach ($products as $product) { ?>
     
    
       
       <a href="<?php echo $product['href']; ?>"> 
<div class="block-5-1"><?php if ($product['thumb']) { ?><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
        <?php } ?>
        <div class="block-5-1-bot"><span><?php echo $product['name']; ?></span></div>
      </div>
</a>

      <?php } ?>
  
  </div>
</div>
  </div>

















