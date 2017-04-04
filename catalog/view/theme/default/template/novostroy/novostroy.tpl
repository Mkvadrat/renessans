<?php echo $header; ?>

	<div id="important">
		<div class="list">
<?php foreach($object_description as $object){ ?>	
		<div class="col">
		<div class="container">
			<span class="img"><a href="floor-1-object-1-1.html"><img src="catalog/view/theme/default/img/imp-min-1.png" alt=""></a></span>
			<span class="desc">
				<h3><?php echo $object["object_1_title"];?></h3>
				<p><?php echo $object["object_1_description"];?></p></br>
				<div class="button"><a href="floor-1-object-1-1.html">Подробнее</a></div>
			</span>
		</div>
		</div>

		<div class="col">
		<div class="container">
			<span class="img"><a href="floor-4-object-2-1.html"><img src="catalog/view/theme/default/img/imp-min-2.png" alt=""></a></span>
			<span class="desc">
				<h3><?php echo $object["object_2_title"];?></h3>
				<?php echo $object["object_2_description"];?>
				<div class="button"><a href="floor-4-object-2-1.html">Подробнее</a></div>
			</span>
		</div>		
		</div>		
		
		<div class="col">
		<div class="container">
			<span class="img"><a href="floor-1-object-3-1.html"><img src="catalog/view/theme/default/img/imp-min-3.png" alt=""></a></span>
			<span class="desc">
				<h3><?php echo $object["object_3_title"];?></h3>
				<?php echo $object["object_3_description"];?>
				<div class="button"><a href="floor-1-object-3-1.html">Подробнее</a></div>
			</span>
		</div>		
		</div>		
		
		<div class="col">
		<div class="container">
			<span class="img"><a href="floor-1-object-1-1.html"><img src="catalog/view/theme/default/img/imp-min-4.png" alt=""></a></span>
			<span class="desc">
				<h3><?php echo $object["object_4_title"];?></h3>
				<?php echo $object["object_4_description"];?>
				<div class="button"><a href="floor-1-object-1-1.html">Подробнее</a></div>
			</span>
		</div>
		</div>

		<div class="col">
		<div class="container">
			<span class="img"><a href="floor-1-object-5-1.html"><img src="catalog/view/theme/default/img/imp-min-5.png" alt=""></a></span>
			<span class="desc">
				<h3><?php echo $object["object_5_title"];?></h3>
				<?php echo $object["object_5_description"];?>
				<div class="button"><a href="floor-1-object-5-1.html">Подробнее</a></div>
			</span>
		</div>
		</div>

		<div class="col">
		<div class="container">
			<span class="img"><a href="floor-1-object-6-1.html"><img src="catalog/view/theme/default/img/imp-min-6.png" alt=""></a></span>
			<span class="desc">
				<h3><?php echo $object["object_6_title"];?></h3>
				<?php echo $object["object_6_description"];?>
				<div class="button"><a href="floor-1-object-6-1.html">Подробнее</a></div>
			</span>
		</div>		
		</div>	
<?php } ?>		
		</div>

<div class="container">

<div class="form">
<form method="post" enctype="multipart/form-data" id="form-3">

<h3>Напишите нам и мы Вам перезвоним</h3>

<input type="hidden" id="form_id" name="form_id"/></br>

<input type="text" required id="wsf_name" placeholder="Введите Ваше имя" name="wsf_name"/></br>

<input type="text"  required name="wsf_phone" placeholder="Введите Ваш телефон" value="<?php echo $phone; ?>" /></br>

<input type="text" name="wsf_email" placeholder="Введите Ваш e-mail" value="<?php echo $email; ?>" /></br>
						
<input type="submit" value="отправить">

</form>
</div>
</div>
		
</div>
	
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