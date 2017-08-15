<?php echo $header; ?>
 <?php echo $column_left; ?>
  <?php echo $column_right; ?>
   <?php echo $content_top; ?>

<div class="content">
   <div class="container">
        <div class="title-about"><center>О нас</center></div><br/>
<center><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/eleanor.png" alt="eleanor"></center>
           <div class="block-content">
                <!--<div class="block_left">	
                        <p><strong>АН "РЕНЕССАНС КРЫМ" — успешная компания с многолетним опытом в предоставлении широкого спектра услуг по купле, продаже или обмену любой недвижимости на рынке недвижимости Севастополя и Крыма.</strong></p>
                        <p><strong>С нашей помощью вы можете купить, продать или обменять любую недвижимость на первичном и вторичном рынке, включая дома, дачи, участки, элитную и коммерческую недвижимость. Кроме того, мы предоставляем нашим клиентам полное юридическое сопровождение сделки и любые консультации. Если Вы хотите выгодно продать, купить или обменять недвижимость в Севастополе и Крыму, обращайтесь в агенство "Ренессанс Крым".</strong></p>
                        <p><strong>Наши профессиональные специалисты подберут Вам наилучшие варианты по реальным ценам для покупки недвижимости в Севастополе, помогут выгодно продать Вашу недвижимость или обменять ее, и все это в кратчайшие сроки на выгодных условиях.</strong></p>
				</div>

                <div class="block_right">
<p><strong>Кроме того, АН "Ренессанс Крым" постоянно развивает партнерские отношения с застройщиками Севастополя, поэтому мы можем предложить нашим клиентам квартиры в строящихся домах на хороших условиях, а также специальные программы и экслюзивные предложения по преобретению квартир.</strong></p>	
                         <p><strong>Мы всегда предоставляем нашим клиентам полную информацию о строящихся обьектах и их застройщиках, а также реальную ценовую политику первичного рынка Севастополя. </strong></p>
                        <p><strong>Коллектив АН "Ренессанс Крым" — это команда профессионалов и единомышленников, в которой преданность общему делу сочетается с индивидуальным стремлением к самореализации. Мы уверены, что успех каждого является залогом успеха компании в целом.</strong></p>
                </div>-->
				<?php foreach($about_us as $about){ ?>
				<?php  echo $about['description']; ?>
				<?php } ?>
            </div>

    </div>
</div>

<div class="content">
    <div class="container">
				
        <div class="table_left">
            <table border="0">	
                <tr>
                    <td>
                      <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/eleanor_thumb.png" alt="eleanor_thumb">
                    </td>
                    <td>
                      <p id="name">Горбач Элеонора</p>
                      <p id="name">Александровна</p>
                      <p id="position">директор агентства недвижимости</p>
                      <p id="company">"Ренессанс Крым"</p>
                      <p id="telefon">+7 (978) 727–03–33</p>
                      <a class="anketa-button" href="#inline1">Посмотреть анкету</a>
                    </td>
                </tr>
                <tr>
                    <td>
                       <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/alisa_thumb.png" alt="alisa_thumb">
                    </td>
                    <td>
                       <p id="name">Алиса</p>
                       <p id="position">риелтор агентства</p>
                        <p id="company">"Ренессанс Крым"</p>
                       <p id="telefon">+7 (978) 717–73–13</p>
                       <a class="anketa-button" href="#inline3">Посмотреть анкету</a>
                    </td>
                </tr>
				<tr>
                    <td>
                       <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/evgenia.jpg" alt="evgenia_thumb">
                    </td>
                    <td>
                       <p id="name">Евгения</p>
                       <p id="position">риелтор агентства</p>
                        <p id="company">"Ренессанс Крым"</p>
                       <p id="telefon">+7 (978) 717–72–88</p>
                       <a class="anketa-button" href="#inline5">Посмотреть анкету</a>
                    </td>
                </tr>
				<tr>
                    <td>
                       <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/irina-f.jpg" alt="irina-f_thumb">
                    </td>
                    <td>
                       <p id="name">Ирина</p>
                       <p id="position">риелтор агентства</p>
                        <p id="company">"Ренессанс Крым"</p>
                       <p id="telefon">+7 (978) 114–14–35</p>
                       <a class="anketa-button" href="#inline7">Посмотреть анкету</a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="table_right">
            <table border="0">	
                <tr>
                    <td>
                        <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/anna_thumb.png" alt="anna_thumb">
                    </td>
                    <td>
                        <p id="name">Анна</p>
                        <p id="position">риелтор агентства</p>
                        <p id="company">"Ренессанс Крым"</p>
                        <p id="telefon">+7 (978) 717–73–13</p>
                        <a class="anketa-button" href="#inline2">Посмотреть анкету</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/evgeni_thumb.png" alt="evgeni_thumb">
                    </td>
                    <td>
                        <p id="name">Евгений</p>
                        <p id="position">риелтор агентства</p>
                        <p id="company">"Ренессанс Крым"</p>
                        <p id="telefon">+7 (978) 717–73–30</p>
                        <a class="anketa-button" href="#inline4">Посмотреть анкету</a>
                    </td>
                </tr>
				<tr>
                    <td>
                       <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/artem.jpg" alt="artem_thumb">
                    </td>
                    <td>
                       <p id="name">Артем</p>
                       <p id="position">риелтор агентства</p>
                        <p id="company">"Ренессанс Крым"</p>
                       <p id="telefon">+7 (978) 717–73–44</p>
                       <a class="anketa-button" href="#inline6">Посмотреть анкету</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        
                    </td>
                </tr>
            </table>	
			
        </div>
    </div>
</div>
<center><p><a class="mail_renessans" href="mailto:renessans-krim@mail.ru">renessans-krim@mail.ru</a></p>
                        <br/>
                        <p id="company-regards">С уважением АН "Ренессанс-Крым"</p>
                        <br/>
                        <p id="telefon-company">Тел. +7 (978)717–73–13,&nbsp;&nbsp;&nbsp;+7 (978)727–03–33,&nbsp;&nbsp;&nbsp;+7 (978)71–7-72-44</p></center>
<!--Слоган-->
                        <!--<center><h3>Основной принцип работы нашей компании <br/>"Надежность! Опыт! Профессионализм!".</h3></center><br/>
						<div><center><p id="text-block-2">И ежедневно мы стараемся безукоризненно ему следовать. <br/>А это значит, что обратившись за услугами в АН "Ренессанс Крым", вы получите полную и качественную помощь по продаже,<br/> покупке или обмену любой недвижимости в Севастополе и Крыму.</p>
						<p id="text-block-3">Доверившись опыту специалистов нашей компании, Вы полностью останетесь довольны результатом,<br/> а наше с Вами сотрудничество станет долгосрочным.</p></center></div>-->
<?php foreach($about_us as $about){ ?>
<?php  echo $about['tagline']; ?>
<?php } ?>
<!--Слоган-->
<div class="content">
    <div class="container">
        <div class="block-form">
                     <p>Напишите нам и мы Вам перезвоним</p>
            <form class="about-form" method="post" enctype="multipart/form-data" id="form-3">
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
</div>


<!--=================================================================Анкета 1=========================================================================-->
<div id="inline1" style="width:800px;display: none;overflow-x:none;">
    <div class="content">
        <div class="container">
            <div class="block_certif">
                    <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/eleonora_popup.png" alt="eleonora_popup">
                    <p id="inf_user">ФИО:</p>
                    <p id="inf_user_full">Гоpбач Элеонора<br/>Александровна</p>
                    <p id="inf_user">Предприятие:</p>
                    <p id="inf_user_full">ООО "Ренессанс-Крым"</p>
                    <p id="inf_user">Сертификаты:</p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_005.png" alt="scan_005"></p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_004.png" alt="scan_004"></p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_003.png" alt="scan_003"></p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_002.png" alt="scan_002"></p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_001.png" alt="scan_001"></p><br/>
					<span style="font-family: Arial,sans-serif; font-size: 16px; font-weight: regular; font-style: italic; line-height: 18px;"><a href="http://reestr.rgr.ru">Проверить сертификаты</a></span>
            </div>

            <div class="block_inf_employee">
                    <p id="anketa">Анкета</p>
                    <p id="inf_2">Должность:</p>
                    <p id="anketa_2">директор агентства недвижимости "Ренессанс-Крым"</p>
                    <p id="inf_2">Квалификация:</p>
                    <p id="anketa_2">брокер</p>
                    <p id="inf_2">Субъект Федерации:</p>
                    <p id="anketa_2">Населенный пункт: г. Севастополь</p>
                    <p id="inf_2">Телефон(личный мобильный):</p>
                    <p id="anketa_2">+7 (978) 727–03–33</p>
                    <p id="inf_2">Эл. почта:</p>
                    <p id="anketa_2">renessans-krim@mail.ru</p>
                    <p id="inf_2">Образование:</p>
                    <p id="anketa_2">высшее</p>
                    <p id="inf_2">Название учебного заведения:</p>
                    <p id="anketa_2">Международный Институт Управления,<br/>Бизнеса и Права(факультет Менеджмента);<br/>Таврический Национальный университет<br/>им.Вернадского (факультет Психологии)</p>
                    <p id="inf_2">Общественная деятельность:</p>
                    <p id="anketa_2">Член Комиссии по разрешению споров при Органе по<br/>сертификации Ассоциации "Недвижимость<br/>Севастополя.</p>
            </div>
        </div>
    </div>
</div>

<!--=================================================================Анкета 1=========================================================================-->

<!--=================================================================Анкета 2=========================================================================-->

<div id="inline3" style="width:666px;display: none;overflow-x:none;">
		<div class="content">
        <div class="container">
            <div class="block_certif">
                    <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/alisa_thumb.png" alt="eleonora_popup">
                    <p id="inf_user">ФИО:</p>
                    <p id="inf_user_full">Политицкая Алиса</p>
                    <p id="inf_user">Предприятие:</p>
                    <p id="inf_user_full">ООО "Ренессанс-Крым"</p>
            </div>

            <div class="block_inf_employee">
                    <p id="anketa">Анкета</p>
                    <p id="inf_2">Должность:</p>
                    <p id="anketa_2">риелтор агентства "Ренессанс Крым"</p>
                    <p id="inf_2">Телефон(личный мобильный):</p>
                    <p id="anketa_2">+7 (978) 717–73–13</p>
                    <p id="inf_2">Эл. почта:</p>
                    <p id="anketa_2">renessans-krim@mail.ru</p>
					<p id="inf_user">Сертификат:</p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_007.png" width="300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <br/>
					<span style="font-family: Arial,sans-serif; font-size: 16px; font-weight: regular; font-style: italic; line-height: 18px;"><a href="http://reestr.rgr.ru">Проверить сертификат</a></span></div>
            </div>
        </div>
</div>

<div id="inline5" style="width:666px;display: none;overflow-x:none;">
		<div class="content">
        <div class="container">
            <div class="block_certif">
                    <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/evgenia.jpg" alt="evgenia_popup">
                    <p id="inf_user">ФИО:</p>
                    <p id="inf_user_full">Коноваленко Евгения</p>
                    <p id="inf_user">Предприятие:</p>
                    <p id="inf_user_full">ООО "Ренессанс-Крым"</p>
            </div>

            <div class="block_inf_employee">
                    <p id="anketa">Анкета</p>
                    <p id="inf_2">Должность:</p>
                    <p id="anketa_2">риелтор агентства "Ренессанс Крым"</p>
                    <p id="inf_2">Телефон(личный мобильный):</p>
                    <p id="anketa_2">+7 (978) 717–72–88</p>
                    <p id="inf_2">Эл. почта:</p>
                    <p id="anketa_2">renessans-krim@mail.ru</p>
					<p id="inf_user">Сертификат:</p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_evgenia.jpg" width="300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <br/>
					<span style="font-family: Arial,sans-serif; font-size: 16px; font-weight: regular; font-style: italic; line-height: 18px;"><a href="http://reestr.rgr.ru">Проверить сертификат</a></span>
            </div>
			</div>
        </div>
</div>

<div id="inline6" style="width:666px;display: none;overflow-x:none;">
		<div class="content">
        <div class="container">
            <div class="block_certif">
                    <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/artem.jpg" alt="artem_popup">
                    <p id="inf_user">ФИО:</p>
                    <p id="inf_user_full">Кацай Артем</p>
                    <p id="inf_user">Предприятие:</p>
                    <p id="inf_user_full">ООО "Ренессанс-Крым"</p>
            </div>

            <div class="block_inf_employee">
                    <p id="anketa">Анкета</p>
                    <p id="inf_2">Должность:</p>
                    <p id="anketa_2">риелтор агентства "Ренессанс Крым"</p>
                    <p id="inf_2">Телефон(личный мобильный):</p>
                    <p id="anketa_2">+7 (978) 717–73–44</p>
					 <p id="inf_2">Эл. почта:</p>
                    <p id="anketa_2">renessans-krim@mail.ru</p>
					<p id="inf_user">Сертификат:</p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_artem.jpg" width="300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <br/>
					<span style="font-family: Arial,sans-serif; font-size: 16px; font-weight: regular; font-style: italic; line-height: 18px;"><a href="http://reestr.rgr.ru">Проверить сертификат</a></span></div>
            </div>
        </div>
</div>

<div id="inline7" style="width:666px;display: none;overflow-x:none;">
		<div class="content">
        <div class="container">
            <div class="block_certif">
                    <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/irina-f.jpg" alt="irina-f_popup">
                    <p id="inf_user">ФИО:</p>
                    <p id="inf_user_full">Федорова Ирина</p>
                    <p id="inf_user">Предприятие:</p>
                    <p id="inf_user_full">ООО "Ренессанс-Крым"</p>
            </div>

            <div class="block_inf_employee">
                    <p id="anketa">Анкета</p>
                    <p id="inf_2">Должность:</p>
                    <p id="anketa_2">риелтор агентства "Ренессанс Крым"</p>
                    <p id="inf_2">Телефон(личный мобильный):</p>
                    <p id="anketa_2">+7 (978) 114–14–35</p>
					 <p id="inf_2">Эл. почта:</p>
                    <p id="anketa_2">renessans-krim@mail.ru</p>
					<p id="inf_user">Сертификат:</p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_irina_f.jpg" width="300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <br/>
					<span style="font-family: Arial,sans-serif; font-size: 16px; font-weight: regular; font-style: italic; line-height: 18px;"><a href="http://reestr.rgr.ru">Проверить сертификат</a></span></div>
            </div>
        </div>
</div>

<div id="inline2" style="width:800px;display: none;overflow-x:none;">
	<div class="content">
        <div class="container">
            <div class="block_certif">
                    <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/anna_thumb.png" alt="eleonora_popup">
                    <p id="inf_user">ФИО:</p>
                    <p id="inf_user_full">Кузьменко Анна</p>
                    <p id="inf_user">Предприятие:</p>
                    <p id="inf_user_full">ООО "Ренессанс-Крым"</p>
					<p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_008.png" width="250"></p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/Scan_anna_k.jpg" width="200"></p><br/>
					<span style="font-family: Arial,sans-serif; font-size: 16px; font-weight: regular; font-style: italic; line-height: 18px;"><a href="http://reestr.rgr.ru">Проверить сертификаты</a></span></p>
            </div>

            <div class="block_inf_employee">
                    <p id="anketa">Анкета</p>
                    <p id="inf_2">Должность:</p>
                    <p id="anketa_2">риелтор агентства "Ренессанс Крым"</p>
                    <p id="inf_2">Телефон(личный мобильный):</p>
                    <p id="anketa_2">+7 (978) 717–73–13</p>
                    <p id="inf_2">Эл. почта:</p>
                    <p id="anketa_2">renessans-krim@mail.ru</p>
			</div>
        </div>
	</div>
</div>

<div id="inline4" style="width:800px;display: none;overflow-x:none;">
	<div class="content">
        <div class="container">
            <div class="block_certif">
                    <img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/evgeni_thumb.png" alt="evgeni_thumb">
                    <p id="inf_user">ФИО:</p>
                    <p id="inf_user_full">Боярский Евгений</p>
                    <p id="inf_user">Предприятие:</p>
                    <p id="inf_user_full">ООО "Ренессанс-Крым"</p>
					<p id="inf_user">Сертификаты:</p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/scan_009.png" width="250"></p>
                    <p id="certif"><img src="<?php echo HTTP_IMAGE?>/data/ABOUT_US/POPUP/Scan_evg_b.jpg" width="200"></p><br/>
					<span style="font-family: Arial,sans-serif; font-size: 16px; font-weight: regular; font-style: italic; line-height: 18px;"><a href="http://reestr.rgr.ru">Проверить сертификаты</a></span></p>
            </div>

            <div class="block_inf_employee" align="left">
                    <p id="anketa">Анкета</p>
                    <p id="inf_2">Должность:</p>
                    <p id="anketa_2">риелтор агентства "Ренессанс Крым"</p>
                    <p id="inf_2">Телефон(личный мобильный):</p>
                    <p id="anketa_2">+7 (978) 717–73–30</p>
                    <p id="inf_2">Эл. почта:</p>
                    <p id="anketa_2">renessans-krim@mail.ru</p>
			</div>
        </div>
    </div>
</div>

</div><!-- End content -->
	</div><!-- End content-holder -->
	
<?php echo $content_bottom; ?>
 <?php echo $footer; ?>

<script>
document.getElementById('form-3').addEventListener('submit', function(evt){
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
<!--Анкета--> 
<script type="text/javascript">
jQuery(document).ready(function() {
	  jQuery('.anketa-button').fancybox();
});
</script>	
<!--Анкета--> 