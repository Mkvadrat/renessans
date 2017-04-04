<?php echo $header; ?>
 <div class="content"> 
    <div class="container">
        <div class="title_testimonial"><?php echo $heading_title; ?></div>	
  	<div class="backfeed_testimonial">
  	<div class="text_testimonial"><p><?php echo $text_conditions ?></p></div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="testimonial">
	<div class="content_testimonial">
            <input type="text" placeholder="Введите Ваше имя" name="name" value="<?php echo $name; ?>" /><br/>
            <input type="text" placeholder="Введите Ваше Email" name="email" value="<?php echo $email; ?>" /><br/>
			<input type="text" placeholder="Введите Ваш телефон" name="phone" value="<?php echo $phone; ?>" /><br/>
			<input type="text" placeholder="Введите Ваш город" name="city" value="<?php echo $city; ?>" /><br/>
            <textarea name="description" placeholder="Введите Ваш отзыв" rows="10" class="required"></textarea><br/>
              <?php if ($error_enquiry) { ?>
              <span class="error"><?php echo $error_enquiry; ?></span>
              <?php } ?>
	</div>
    <div class="button_form_testimonial">
        <a style="float:none;cursor:pointer" onclick="jQuery('#testimonial').submit();" class="button_send_testimonial"><span><?php echo $button_send; ?></span></a>
		<a class="button_view_all_testimonial" href="<?php echo $showall_url;?>"><span><?php echo $show_all; ?></span></a>
    </div>
    </div>
    </form>
  </div>
</div>
<?php echo $footer; ?> 