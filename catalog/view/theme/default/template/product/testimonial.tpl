<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
 <div class="content"> 
    <div class="container">
        <div class="title_testimonial"><?php echo $heading_title; ?></div>	
    <?php if (true/*$testimonials*/) { ?>
      <?php foreach ($testimonials as $testimonial) { ?>
        <div class="main_case">
		    <div class="in_case">
                <div class="left_column"><?php echo $testimonial['name']; ?>, <?php echo $testimonial['city']; ?></div>
                <div class="right_column"><?php echo $testimonial['date_added']; ?></div>
                <div class="descr_testimonial"><?php echo $testimonial['description']; ?></div>
		    </div>
        </div>
      <?php } ?>
    	<?php if ( isset($pagination)) { ?>
    		<div class="pagination_testimonial"><?php echo $pagination;?></div>
    		<div class="buttons"><a class="button_testimonial" href="<?php echo $write_url;?>" title="<?php echo $write;?>"><?php echo $write;?></a></div>
    	<?php }?>
    <?php } ?>
</div>
</div>
<?php echo $footer; ?> 