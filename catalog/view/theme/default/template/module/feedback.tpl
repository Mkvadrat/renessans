<div class="content">
                <div class="container">
                    <div class="block-1-1">
						<h1>Нужен надежный риэлтор?</h1>
                        <div class="block-1-left">
                            <p align="justify">Агентство недвижимости "Ренессанс Крым" – профессиональный помощник и консультант по вопросам покупки, продажи и аренды недвижимости в Севастополе и Крыму. Представляя Ваши интересы как покупателя или арендатора, мы предлагаем полную и достоверную информацию, способствуя быстрому поиску объекта. Представляя Ваши интересы как собственника или арендодателя, мы поможем продать или сдать в аренду объект недвижимости на наиболее выгодных для Вас условиях.</p>
						</div>
                        <div class="block-1-right">
                            <p>оставьте заявку и мы с вами свяжемся</p>
							
                            <form class="main" method="post" enctype="multipart/form-data" id="form-2">
		                     <input type="hidden" id="form_id" name="form_id"/>
							 <?php if (isset($setting['name'])) { ?>
                                <div class="field">
                                    <label for="n">Имя*</label>
					               	<input type="text" required id="wsf_name" name="wsf_name" placeholder="Введите имя" />
								</div>
								<?php } ?>
								<?php if (isset($setting['phone'])) { ?>
                                <div class="field">
                                    <label for="ln" >Телефон*</label>
						           <input type="text"  required name="wsf_phone" value="<?php echo $phone; ?>" placeholder="Введите телефон" />
								</div>
								<?php } ?>
								или
								<?php if (isset($setting['email'])) { ?>
                                <div class="field">
                                    <label for="a" >e-mail</label>
						        <input type="text" name="wsf_email" value="<?php echo $email; ?>" placeholder="Введите E-mail" />

								</div>
								<?php } ?>
								<?php if (isset($setting['text'])) { ?>
                                <div class="field">
                                    <label for="a">Тип недвижимости</label>
						            <select class="wsf_enquiry" name="wsf_enquiry">
									<?php foreach($category_value as $category_values){ ?>
                                        <option value="<?php echo $category_values['name']; ?>"><?php echo $category_values['name']; ?></option>
										<?php } ?>
									</select>
									</div>
                                    <?php } ?>
										
                                <button class="form-but" type="submit">Отправить</button>
							</form>
						</div>
					</div>
</div>
					</div>
<script>
document.getElementById('form-2').addEventListener('submit', function(evt){
  var http = new XMLHttpRequest(), f = this;
  evt.preventDefault();
  http.open("POST", "<?php echo $action; ?>", true);
  http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  http.send( <?php if (isset($setting['name'])) { ?> "wsf_name=" + f.wsf_name.value <?php } ?> <?php if (isset($setting['email'])) { ?> + "&wsf_email=" + f.wsf_email.value <?php } ?> <?php if (isset($setting['phone'])) { ?> + "&wsf_phone=" + f.wsf_phone.value<?php } ?> <?php if (isset($setting['text'])) { ?> + "&wsf_enquiry=" + f.wsf_enquiry.value<?php } ?>);
  http.onreadystatechange = function() {
    if (http.readyState == 4 && http.status == 200) {
      swal(f.wsf_name.value + ', Ваше сообщение получено.\nНаши специалисты ответят Вам в течении 2-х часов.\nБлагодарим за интерес к нашей фирме!'); 
      f.wsf_name.removeAttribute('value'); // очистить поле сообщения (две строки)
	 <?php if (isset($setting['name'])) { ?> f.wsf_name.value = ''; <?php } ?>
	 <?php if (isset($setting['email'])) { ?> f.wsf_email.value = ''; <?php } ?>
	 <?php if (isset($setting['phone'])) { ?> f.wsf_phone.value = ''; <?php } ?>
     <?php if (isset($setting['text'])) { ?> f.wsf_enquiry.value=''; <?php } ?>
    }
  }
  http.onerror = function() {
      swal(f.nameFF.value + ', Извините, данные не были переданы'); 
  }
}, false);
</script>	