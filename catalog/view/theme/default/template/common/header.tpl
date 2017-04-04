<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
<link rel="stylesheet" id='camera-css' media="all" type="text/css" href="catalog/view/theme/default/stylesheet/camera.css" />
<link rel="stylesheet"  type="text/css" href="catalog/view/theme/default/stylesheet/ion.rangeSlider.css" />
<link rel="stylesheet"  type="text/css" href="catalog/view/theme/default/stylesheet/ion.rangeSlider.skinHTML5.css" />
<link rel="stylesheet"  type="text/css" href="catalog/view/theme/default/stylesheet/sweetalert.css" />
<link type='text/css' href='catalog/view/theme/default/Call_me/contact.css' rel='stylesheet' media='screen' />

<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type='text/javascript' src='catalog/view/javascript/js/tabs.js'></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/sweetalert.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/sweetalert-dev.js"></script>
<script type='text/javascript' src='catalog/view/theme/default/Call_me/jquery.simplemodal.js'></script>
<script type='text/javascript' src='catalog/view/theme/default/Call_me/contact.js'></script>
<script src="catalog/view/javascript/js/ion.rangeSlider.js"></script>

<!--Фильтр-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/filterpro.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/filterpro-mega.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.loadmask.css" />
<script type='text/javascript' src='catalog/view/javascript/jquery/jquery.deserialize.min.js'></script>
<script type='text/javascript' src='catalog/view/javascript/jquery/jquery.loadmask.min.js'></script>
<script type='text/javascript' src='catalog/view/javascript/jquery/jquery.tmpl.min.js'></script>
<script type='text/javascript' src='catalog/view/javascript/filterpro.min.js'></script>
<!--Фильтр-->

<!--Слайдер акции-->
<script type='text/javascript' src='catalog/view/javascript/js/jquery.mobile.customized.min.js'></script>
<script type='text/javascript' src='catalog/view/javascript/js/jquery.easing.1.3.js'></script> 
<script type='text/javascript' src='catalog/view/javascript/js/camera.min.js'></script> 
<!--Слайдер акции-->

<!--Слайдер на главной-->
<script type='text/javascript' src='catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js'></script>
<script type='text/javascript' src='catalog/view/javascript/layerslider/jquery.themepunch.revolution.js'></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sliderlayer/css/typo.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/sliderlayer/css/settings.css" />
<!--Слайдер на главной-->

<!--Форма обратной связи-->
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery.jbcallme.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery.jbcallme.css">
<!--Форма обратной связи-->

<!--Анкета (модальная форма о нас)-->
<script type='text/javascript' src='catalog/view/javascript/jquery/fancybox/jquery.fancybox.js'></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/fancybox/jquery.fancybox.css" />
<!--Анкета (модальная форма о нас)-->

<!--Форма обратной связи с агентом-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.fs.boxer.css" />
<script type='text/javascript' src='catalog/view/javascript/js/jquery.fs.boxer.js'></script> 
<!--Форма обратной связи с агентом-->

<!--Рекомендуемые в карточке объекта-->
<script src="catalog/view/javascript/jquery/bxslider/jquery.bxslider.min.js"></script>
<script src="catalog/view/javascript/jquery/bxslider/jquery.bxslider.js"></script>
<link rel="stylesheet" href="catalog/view/javascript/jquery/bxslider/jquery.bxslider.css" />
<!--Рекомендуемые в карточке объекта-->

<!--Галерея карточка объекта-->
<script src="catalog/view/javascript/jquery/tiksluscarousel/js/tiksluscarousel.js"></script>
<script src="catalog/view/javascript/jquery/tiksluscarousel/js/rainbow.min.js"></script>
<!--<link rel="stylesheet" href="catalog/view/javascript/jquery/tiksluscarousel/css/normalize.css" />-->
<link rel="stylesheet" href="catalog/view/javascript/jquery/tiksluscarousel/css/tiksluscarousel.css" />
<link rel="stylesheet" href="catalog/view/javascript/jquery/tiksluscarousel/css/github.css" />
<link rel="stylesheet" href="catalog/view/javascript/jquery/tiksluscarousel/css/animate.css" />
<!--Галерея карточка объекта-->

<!--Всплывающие окна в разделе новострой-->
<script type='text/javascript' src='/catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js'></script>
<script type='text/javascript' src='/catalog/view/javascript/jquery/colorbox/jquery.colorbox.js'></script>
<link rel="stylesheet" href="/catalog/view/javascript/jquery/colorbox/colorbox.css" />
<!--Всплывающие окна в разделе новострой-->

<!--Кнопки соцсетей yandex-->
<!--<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js" async="async"></script>-->
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<!--Кнопки соцсетей yandex-->

<?php echo $google_analytics; ?>

<!-- =========================== Favicons =============================== -->
<p class="p1"><link rel="apple-touch-icon" sizes="57x57" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-57x57.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="60x60" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-60x60.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="72x72" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-72x72.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="76x76" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-76x76.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="114x114" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-114x114.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="120x120" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-120x120.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="144x144" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-144x144.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="152x152" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-152x152.png"&gt;</p>
<p class="p1"><link rel="apple-touch-icon" sizes="180x180" href="<?php echo HTTP_IMAGE?>data/favicons/apple-touch-icon-180x180.png"&gt;</p>
<p class="p1"><link rel="icon" type="image/png" href="<?php echo HTTP_IMAGE?>data/favicons/favicon-32x32.png" sizes="32x32"&gt;</p>
<p class="p1"><link rel="icon" type="image/png" href="<?php echo HTTP_IMAGE?>data/favicons/android-chrome-192x192.png" sizes="192x192"&gt;</p>
<p class="p1"><link rel="icon" type="image/png" href="<?php echo HTTP_IMAGE?>data/favicons/favicon-96x96.png" sizes="96x96"&gt;</p>
<p class="p1"><link rel="icon" type="image/png" href="<?php echo HTTP_IMAGE?>data/favicons/favicon-16x16.png" sizes="16x16"&gt;</p>
<p class="p1"><link rel="manifest" href="<?php echo HTTP_IMAGE?>data/favicons/manifest.json"&gt;</p>
<p class="p1"><link rel="mask-icon" href="<?php echo HTTP_IMAGE?>data/favicons/safari-pinned-tab.svg" color="#5bbad5"&gt;</p>
<p class="p1"><link name="msapplication-TileColor" content="#da532c"&gt;</p>
<p class="p1"><link name="msapplication-TileImage" content="<?php echo HTTP_IMAGE?>data/favicons/mstile-144x144.png"&gt;</p>
<p class="p1"><link name="theme-color" content="#ffffff"&gt;</p>
<!-- =========================== Favicons =============================== -->

</head>
<body>
    <!-- =========================== Header =============================== -->
	<div class="wrapper">
            <header>
                <div class="container">
                    <div class="head-block-left">
                        <div class="header-adress">
                            <p>299011, Севастополь, ул. Гоголя, 31</p>
						</div>
                        <div class="header-phone">
                            <p>+7 (8692) 54-39-21<br/> +7 (978) 727–03–33</p>
						</div>
                        <a href="#" class="callme_button">СВЯЗАТЬСЯ С НАМИ</a>
					</div>
                    <div class="head-block-center">
				<a href="<?php echo $home; ?>">
					<img class="logo-head" src="<?php echo $logo; ?>" alt="">
				</a>
			</div>
                    <div class="head-block-right">
                        <div class="header-phone-mob">
                            <p>8-800-775-70-37</p>
						</div>
                        <div class="header-mail">
                            <p>renessans-krim@mail.ru</p>
						</div>
						<div class="wrap-icon">
                            <span class="tooltip anim" tabindex="0">
                                <img class="head-icon tooltip anim" src="catalog/view/theme/default/img/icon-3.png" tabindex="0" alt="" />
                                <span>renessans-krim</span>
							</span>
                            <span class="tooltip anim" tabindex="0">
                                <img class="head-icon tooltip anim" src="catalog/view/theme/default/img/icon-2.png" tabindex="0" alt="" />
                                <span>+79787177313</span>
							</span>
                            <span class="tooltip anim" tabindex="0">
                                <img class="head-icon tooltip anim" src="catalog/view/theme/default/img/icon-1.png" tabindex="0" alt="" />
                                <span>+79787270333</span>
							</span>
						</div>
					</div>
				</div>
			</header><!-- header -->
            <nav>
                <div class="container">
                    <div class="menu-wrapper">
                        <ul class="menu">
			<li><a href="<?php echo $about ;?>">О Нас</a></li>
			<li><a href="<?php echo $sales ;?>">Продажа</a></li>
			<li><a href="<?php echo $arenda ;?>">Аренда</a></li>
			<li><a href="http://renessans-krim.ru/novostroy/important.html">Новостройки</a></li>
			<li><a href="<?php echo $services; ?>">Услуги</a></li>
			<li><a href="<?php echo $importent; ?>">Важное</a></li>
			<li><a href="http://renessans-krim.ru/contact/">Контакты</a></li>
		</ul>
					</div>
				</div>
			</nav>

