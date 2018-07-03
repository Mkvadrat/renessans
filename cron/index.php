<?php

	header('Content-Type: text/html; charset=utf-8');
		
	$items = '';
	$ids = array();
	
	$items = file_get_contents_curl('https://base.realtnavi.ru/xml/61d89184f26ad5a186e05c37cc7cdfb1?site');

	if($items) {
		foreach($items->offer as $item){	
			if($item{'internal-id'}){
				$internal_id = json_decode( json_encode($item{'internal-id'}) , 1);
			  
				foreach($internal_id as $id){
					$ids = $id;
				}
			}
						
			if($item->{'image'} && $internal_id){
				$da = include_once  '../config.php';

				include_once  DIR_SYSTEM . 'library/imageimport/WideImage.php';
				
				$image_to_name_array = array();
					
				$folder_id = array();
				
				foreach($item->{'image'} as $image){
					$obj_to_array = json_decode( json_encode($image) , 1);

					foreach($obj_to_array as $link){
						$image_to_name_array[] = basename($link);
						
						$image_name = basename($link);
					
						foreach($internal_id as $id){
							$folder_id = $id;
							
							$dir = DIR_IMAGE . 'data/imagexml/' . $id . '/';
					  
							if(!file_exists($dir)){
								mkdir($dir, 0755);
							}
		
							if(!file_exists($dir . $image_name)){
								$img = WideImage::load($link);
							  
								$ext = explode('.', $image_name);
								$ext_parts = isset($ext[1]) ? $ext[1] : null;
							  
								switch($ext_parts){
									case 'jpeg': 
										$img->saveToFile($dir . $image_name,75);
									break;
									case 'jpg':
										$img->saveToFile($dir . $image_name,75);
									break;
									case 'png':
										$img->saveToFile($dir . $image_name,7);
									break;
								} 
							}
						}
					}
				}
			}
		}
	}

	
	function file_get_contents_curl($url){
		// Get the data from the URL
		$ch = curl_init();
	  
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_FAILONERROR,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		
		$xmlData = curl_exec($ch);
		
		curl_close($ch);
		
		// Load the XML
		$xml = simplexml_load_string($xmlData);
		
		return $xml;
	}
	
