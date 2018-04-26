<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<base href="<?php echo $base; ?>" />
	<script type="text/javascript" src="view/javascript/imagemanager/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="view/javascript/imagemanager/jquery/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="view/javascript/imagemanager/jquery/jquery-ui.css">
	
	<script type="text/javascript" src="view/javascript/imagemanager/elFinder/js/elfinder.full.js"></script>
	<link type="text/css" href="view/javascript/imagemanager/elFinder/css/elfinder.full.css" rel="stylesheet" />
	<link type="text/css" href="view/javascript/imagemanager/elFinder/css/theme.css" rel="stylesheet" />
	
	<!-- ADD ELFINDER LANGUAGE -->
	<script type="text/javascript" src="view/javascript/imagemanager/elFinder/js/i18n/elfinder.ru.js"></script>
		
	<!-- elFinder initialization (REQUIRED) -->
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#elfinder').elfinder({
				'url': 'index.php?route=common/filemanager/init&token=<?php echo $token; ?>',  // connector URL (REQUIRED)
				'height': 480,
				'lang': '<?php echo $language;?>',
				'resizable': false,
				'dragUploadAllow':true,
				'destroyOnClose': false,
				'commandsOptions': {
				  'getfile': {
					'multiple': true,
				  }
				},
				'getFileCallback': function(files, fm) {
					if(count(files) > 1){
						$.each(files, function(item, file) {
							if ((file.read && file.hash)) {
								$.ajax({
									url: 'index.php?route=common/filemanager/getTmb&thumb=' + encodeURIComponent(fm.path(file.hash)) + '&token=<?php echo $token; ?>',
									method: 'POST',
									dataType: 'json',
									async: false,
									success: function(data) {
										parent.addImages(data.thumb, fm.path(file.hash), item);
										parent.$('#dialog').dialog('close');
									}
								});
							}
						});
					}else{
						<?php if ($fckeditor) { ?>
							$.each(files, function(item, file) {						
								window.opener.CKEDITOR.tools.callFunction(<?php echo $fckeditor; ?>, file.url);
								self.close();
							});
						<?php }else{ ?>
							$.each(files, function(item, file) {						
								if ((file.read && file.hash)) {
									$.ajax({
										url: 'index.php?route=common/filemanager/getTmb&thumb=' + encodeURIComponent(fm.path(file.hash)) + '&token=<?php echo $token; ?>',
										method: 'POST',
										dataType: 'json',
										success: function(data) {
											parent.$('#<?php echo $field; ?>').attr('value', fm.path(file.hash));
											parent.$('#dialog').dialog('close');
										}
									});
								}
							});
						<?php } ?>
					}
				},
				'uiOptions': {
					'toolbar': [
						['back', 'forward'],
						['reload'],
						['home', 'up'],
						['mkdir', 'upload'],
						['open', 'download', 'getfile'],
						['info'],
						['quicklook'],
						['copy', 'cut', 'paste'],
						['rm'],
						['duplicate', 'rename', 'edit'],
						['extract', 'archive'],
						['search'],
						['view'],
						['help']
					]
				},
				'contextmenu': {
					'cwd': ['reload', 'back', '|', 'upload', 'mkdir', 'paste', '|', 'info']
				}
			});
			
			function count(object) {
			  var count = 0; 
			  for(var prs in object){ 
					   if(object.hasOwnProperty(prs)) count++;
			  } 
			  return count; 
			}
		});	
	</script>
</head>
<body>

<div id="elfinder"></div>

</body>
</html>