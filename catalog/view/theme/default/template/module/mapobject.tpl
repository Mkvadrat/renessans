<?php if($products){ ?>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<div class="fluid_container">
	<div class="objects-maps" id="object-skin">
		<div id="map" style="width: 735px; height: 428px"></div>
		<script type="text/javascript">
			ymaps.ready(init); // карта соберется после загрузки скрипта и элементов
			var myMap; // заглобалим переменную карты чтобы можно было ею вертеть из любого места
			function init () { // функция - собиралка карты и фигни
				myMap = new ymaps.Map("map", {
					center: [44.616687, 33.525432],
					zoom: 10,
					controls: ['zoomControl']
				});
				   
				var myGeoObjects = [];
				
				<?php $i = 0; ?>
				<?php foreach($products as $product){ ?>
				
				myGeoObjects[<?php echo $i; ?>] = new ymaps.Placemark([<?php echo $product['lat_lng']; ?>], { // Создаем метку с такими координатами и суем в переменную
								balloonContent: '<div class="ballon"><img src="<?php echo $product['image']; ?>" class="ll"/><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?><br><span>Подробнее</span></a><img class="close" onclick="myMap.balloon.close()" src="catalog/view/theme/default/img/close.png"/></div>' // сдесь содержимое балуна в формате html, все стили в css
							}, {
								iconLayout: 'default#image',
								iconImageHref: 'catalog/view/theme/default/img/icon.png', // картинка иконки
								iconImageSize: [64, 64], // размер иконки
								iconImageOffset: [-32, -64], // позиция иконки
								balloonContentSize: [270, 99], // размер нашего кастомного балуна в пикселях
								balloonLayout: "default#imageWithContent", // указываем что содержимое балуна кастомная херь
								balloonImageHref: 'catalog/view/theme/default/img/baloon2.png', // Картинка заднего фона балуна
								balloonImageOffset: [-65, -89], // смещание балуна, надо подогнать под стрелочку
								balloonImageSize: [260, 89], // размер картинки-бэкграунда балуна
								balloonShadow: false,
								balloonAutoPan: false // для фикса кривого выравнивания
							});
				<?php $i++ ?>
				<?php } ?>
											
				var clusterer = new ymaps.Clusterer({
					clusterDisableClickZoom: false,
					clusterOpenBalloonOnClick: false,
					// Устанавливаем стандартный макет балуна кластера "Карусель".
					clusterBalloonContentLayout: 'cluster#balloonCarousel',
					// Устанавливаем собственный макет.
					   //clusterBalloonItemContentLayout: customItemContentLayout,
					// Устанавливаем режим открытия балуна. 
					// В данном примере балун никогда не будет открываться в режиме панели.
					clusterBalloonPanelMaxMapArea: 0,
					// Устанавливаем размеры макета контента балуна (в пикселях).
					clusterBalloonContentLayoutWidth: 300,
					clusterBalloonContentLayoutHeight: 200,
					// Устанавливаем максимальное количество элементов в нижней панели на одной странице
					clusterBalloonPagerSize: 5
					// Настройка внешего вида нижней панели.
					// Режим marker рекомендуется использовать с небольшим количеством элементов.
					// clusterBalloonPagerType: 'marker',
					// Можно отключить зацикливание списка при навигации при помощи боковых стрелок.
					// clusterBalloonCycling: false,
					// Можно отключить отображение меню навигации.
					// clusterBalloonPagerVisible: false
				});
				
				clusterer.add(myGeoObjects);
				myMap.geoObjects.add(clusterer);
			}
		</script>
	</div>
</div>
<?php } ?>
			