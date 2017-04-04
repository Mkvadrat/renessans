<?php echo $header; ?>

<div id="content">

<div class="import-block">
	<div class="import-content">
	<?php foreach($getinfo as $info){ ?>
	<?php if($info["information_id"] == 79){ ?>
		<?php if(!empty($info["image"])){ ?><img src="<?php echo HTTP_IMAGE . $info["image"]; ?>"><?php }else{ ?><img src="<?php echo $no_image; ?>"><?php } ?>
		<div class="text-imp">
			<h3><?php echo $info["title"]; ?></h3>
			<?php echo $info["description"]; ?>
			<a href="<?php echo $article_1; ?>">Подробнее</a>
		</div>
	<?php } ?>
	<?php } ?>
	</div>
</div>

<div class="import-block">
	<div class="import-content">
	<?php foreach($getinfo as $info){ ?>
	<?php if($info["information_id"] == 80){ ?>
		<?php if(!empty($info["image"])){ ?><img src="<?php echo HTTP_IMAGE . $info["image"]; ?>"><?php }else{ ?><img src="<?php echo $no_image; ?>"><?php } ?>
		<div class="text-imp">
			<h3><?php echo $info["title"]; ?></h3>
			<?php echo $info["description"]; ?>
			<a href="<?php echo $article_2; ?>">Подробнее</a>
		</div>
	<?php } ?>
	<?php } ?>
	</div>	
</div>

<div class="import-block">
	<div class="import-content">
	<?php foreach($getinfo as $info){ ?>
	<?php if($info["information_id"] == 81){ ?>	
		<?php if(!empty($info["image"])){ ?><img src="<?php echo HTTP_IMAGE . $info["image"]; ?>"><?php }else{ ?><img src="<?php echo $no_image; ?>"><?php } ?>
		<div class="text-imp">
			<h3><?php echo $info["title"]; ?></h3>
			<?php echo $info["description"]; ?>
			<a href="<?php echo $article_3; ?>">Подробнее</a>
		</div>
	<?php } ?>
	<?php } ?>
	</div>	
</div>

<div class="import-block">
	<div class="import-content">
	<?php foreach($getinfo as $info){ ?>
	<?php if($info["information_id"] == 82){ ?>	
		<?php if(!empty($info["image"])){ ?><img src="<?php echo HTTP_IMAGE . $info["image"]; ?>"><?php }else{ ?><img src="<?php echo $no_image; ?>"><?php } ?>
		<div class="text-imp">
			<h3><?php echo $info["title"]; ?></h3>
			<?php echo $info["description"]; ?>
			<a href="<?php echo $article_4; ?>">Подробнее</a>
		</div>
	<?php } ?>
	<?php } ?>
	</div>
</div>

<div class="import-block">
	<div class="import-content">
	<?php foreach($getinfo as $info){ ?>
	<?php if($info["information_id"] == 83){ ?>	
		<?php if(!empty($info["image"])){ ?><img src="<?php echo HTTP_IMAGE . $info["image"]; ?>"><?php }else{ ?><img src="<?php echo $no_image; ?>"><?php } ?>
		<div class="text-imp">
			<h3><?php echo $info["title"]; ?></h3>
			<?php echo $info["description"]; ?>
			<a href="<?php echo $article_5; ?>">Подробнее</a>
		</div>
	<?php } ?>	
	<?php } ?>	
	</div>
</div>

<div class="import-block">
	<div class="import-content">
	<?php foreach($getinfo as $info){ ?>
	<?php if($info["information_id"] == 86){ ?>	
		<?php if(!empty($info["image"])){ ?><img src="<?php echo HTTP_IMAGE . $info["image"]; ?>"><?php }else{ ?><img src="<?php echo $no_image; ?>"><?php } ?>
		<div class="text-imp">
			<h3><?php echo $info["title"]; ?></h3>
			<?php echo $info["description"]; ?>
			<a href="<?php echo $article_6; ?>">Подробнее</a>
		</div>
	<?php } ?>
    <?php } ?>		
	</div>
</div>

<div class="import-block">
	<div class="import-content">
	<?php foreach($getinfo as $info){ ?>
	<?php if($info["information_id"] == 85){ ?>	
		<?php if(!empty($info["image"])){ ?><img src="<?php echo HTTP_IMAGE . $info["image"]; ?>"><?php }else{ ?><img src="<?php echo $no_image; ?>"><?php } ?>
		<div class="text-imp">
			<h3><?php echo $info["title"]; ?></h3>
			<?php echo $info["description"]; ?>
			<a href="<?php echo $article_7; ?>">Подробнее</a>
		</div>
	<?php } ?>
    <?php } ?>			
	</div>	
</div>

<div class="content content-imp">
<div class="container">
	
<form class="bf" method="post" enctype="multipart/form-data" id="form-3">

<h2>Напишите нам и мы Вас перезвоним</h2>

<input type="hidden" id="form_id" name="form_id"/>

<input type="text" required id="wsf_name" placeholder="Введите Ваше имя" name="wsf_name"/>

<input type="text"  required name="wsf_phone" placeholder="Введите Ваш телефон" value="<?php echo $phone; ?>" />

<input type="text" name="wsf_email" placeholder="Введите Ваш e-mail" value="<?php echo $email; ?>" />
						
<input type="submit" value="отправить" class="sub">

</form>

</div></div>
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