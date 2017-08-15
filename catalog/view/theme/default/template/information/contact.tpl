<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<?php echo $content_top; ?>
<div class="wrapper">
           
           
            <div class="content">
                <div class="container">
                    <div class="contact-karta">
                        <div class="contact-karta-left">
                            <p class="cont-zag-1">Наш адрес:</p>
                            <p>Севастополь,<br/>ул. Большая Морская, 30</p><br/>
                            <p class="cont-zag-2">Телефоны:</p>
							<p>Viber 79787270333</p>
                            <p>WhatsApp 79787270333</p>
                            <p>+7 (8692)54-39-21<br/>+7 (978)727-03-33<br/>+7 (978)717-73-13 офис-менеджер<br/>+7 (978)717-72-88 отдел аренды<br/>+7 (978)717-73-30 отдел продаж<br/>+7 (978)717-73-44 отдел продаж</p>
                            <p class="cont-zag-3">Электронная почта:</p>
                            <p>renessans-krim@mail.ru продажа</p>
                            <p>renessans_arenda@mail.ru apeнда</p>
                        </div>
                        <div class="contact-karta-right">
                            <p class="cont-zag-4">Мы на карте</p>
			<div class="wrap-karta">
			    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A653b1a4050fc4477bb8ebefda32851bfb73f2acd73feff1b4487ac751f13019c&amp;width=826&amp;height=330&amp;lang=ru_UA&amp;scroll=true"></script>
			</div>
                        </div>
                    </div>
                    <div class="contact-forma">
                        <p class="cont-zag-form">Напишите нам и мы Вам перезвоним</p>
			<form class="form-cont" method="post" enctype="multipart/form-data" id="form-4">
                            <input type="hidden" id="form_id" name="form_id"/>
                    <div class="field">
                            <input type="text" required id="wsf_name" placeholder="Введите Ваше имя" name="wsf_name"/>
                    </div>
                    <div class="field">
                            <input type="text"  required name="wsf_phone" placeholder="Введите Ваш телефон" value="<?php echo $phone; ?>" />
                    </div>
                    <div class="field">
                            <input type="text" name="wsf_email" placeholder="Введите Ваш e-mail" value="<?php echo $email; ?>" />
                    </div>							
                            <button class="form-but" type="submit">Отправить</button>
            </form>
                    </div>
                </div>
            </div><!-- content -->
</div>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>

<script>
document.getElementById('form-4').addEventListener('submit', function(evt){
  var http = new XMLHttpRequest(), f = this;
  evt.preventDefault();
  http.open("POST", "<?php echo $action; ?>", true);
  http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  http.send("wsf_name=" + f.wsf_name.value + "&wsf_email=" + f.wsf_email.value + "&wsf_phone=" + f.wsf_phone.value);
  http.onreadystatechange = function() {
    if (http.readyState == 4 && http.status == 200) {
      swal(f.wsf_name.value + ', Ваше сообщение получено.\nНаши специалисты ответят Вам в течении 2-х часов.\nБлагодарим за интерес к нашей фирме!'); 
      f.wsf_name.removeAttribute('value'); // очистить поле сообщения (две строки)
	  f.wsf_name.value = '';
	  f.wsf_email.value = '';
	  f.wsf_phone.value = '';
    }
  }
  http.onerror = function() {
      swal(f.nameFF.value + ', Извините, данные не были переданы'); 
  }
}, false);
</script>	