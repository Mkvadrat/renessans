 <div class="content"> 
    <div class="container">
		 <div class="module_case">
		 <div class="title_testimonial_module"><?php echo $testimonial_title; ?></div>
            <?php foreach ($testimonials as $testimonial) { ?>
			<div class="in_module_case">
                <div class="name_module_case"><?php echo $testimonial['name'] ?></div>
                <div class="date_module_case"><?php echo $testimonial['date_added']; ?></div>
                <div class="descr_module_case"><?php echo $testimonial['description'] ; ?></div>
			</div>
            <?php } ?>
	    <div class="button_module_testimonial">
		    <a class="button_view_all_module" href="<?php echo $showall_url;?>"><?php echo $show_testimonial; ?></a>
            <a class="button_retain_module" href="<?php echo $sent_url;?>"><?php echo $button_send; ?></a>
        </div>
		 </div>
        </div>
    </div>
</div>