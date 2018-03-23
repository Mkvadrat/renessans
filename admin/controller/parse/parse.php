<?php
class ControllerParseParse extends Controller {
	public function index() {
		$this->load->language('parse/parse');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		//len
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		//text
		$this->data['text_sitemap'] = $this->language->get('text_sitemap');
		
		//button
		$this->data['button_import'] = $this->language->get('button_import');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		//breadcrumbs		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('parse/parse', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		$this->data['action'] = $this->url->link('parse/parse', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			
			$message_data = $this->import();

			/*foreach($message_data as $value){
				$this->session->data['message'][] = array(
					'id' => $value['id'],
					'title' => $value['title']
				);
			}*/

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('parse/parse', 'token=' . $this->session->data['token'], 'SSL'));
		}
		 		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->template = 'parse/parse.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function import(){
		header('Content-Type: text/html; charset=utf-8');
		
		$this->load->model('parse/parse');
		
		$items = '';
		$data = array();
		$ids = array();
		$category = array();
		$types = array();
		$location = array();
		$agents = array();
		$prices = array();
		$images = array();
		$info = array();
		$options = array();
		
		/*if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$catalog_protocol = HTTPS_CATALOG;
		} else {
			$catalog_protocol = HTTP_CATALOG;
		}
		
		if (isset($this->request->post['sitemap']) && !$_FILES['userfile']['name']) {
			$sitemap = $catalog_protocol . 'sitemap/' . $this->request->post['sitemap'];
			if(@fopen($sitemap, "r")){
				$items = $this->file_get_contents_curl($sitemap);
			}
		}else*/
		if (isset($this->request->post['sitemap'])){
			$uploaddir = DIR_SITEMAP;
			$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
			$upload = move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
			$sitemap = DIR_SITEMAP . $_FILES['userfile']['name'];
			
			if(!empty($upload)){
				$items = simplexml_load_file($sitemap);
			}
		}
		
		//$item = 'http://renessans-krim.loc/sitemap/yrlsite.xml';
		//var_dump($items);
		if($items) {
			foreach($items->offer as $item){	
				if($item{'internal-id'}){
					$internal_id = json_decode( json_encode($item{'internal-id'}) , 1);
				  
					foreach($internal_id as $id){
						$ids = $id;
					}
				}
				
				if($item->{'category'}){
					$categorys = json_decode( json_encode($item->{'category'}) , 1);
				  
					foreach($categorys as $category){
						$category = $category;
					}
				}
			  
				if($item->{'type'}){
					$type = json_decode( json_encode($item->{'type'}) , 1);
					
					foreach($type as $kind){
						$types = $kind;
					}
				}
			  
				if($item->{'location'}){
					foreach($item->{'location'} as $obj_info){
						if($obj_info->{'locality-name'}){
							$localitys = json_decode( json_encode($obj_info->{'locality-name'}) , 1);
		  
							foreach($localitys as $locality){
								$locality_name = $locality;
							}
						}else{
							$localitys = '';
						}
						
						if($obj_info->{'sub-locality-name'}){
							$sub_localitys = json_decode( json_encode($obj_info->{'sub-locality-name'}) , 1);
							foreach($sub_localitys as $sub_locality){
								$sub_locality_name = $sub_locality;
							}
						}else{
							$sub_locality_name = '';
						}
					  
						$location = array(
							'coordinate' => $obj_info->{'latitude'} . ', ' . $obj_info->{'longitude'},
							'address'  => $obj_info->{'country'} . ', ' . $obj_info->{'region'} . ', ' . $obj_info->{'address'},
							'locality_name' => $locality_name,
							'sub_locality_name' => $sub_locality_name
						);
					}
				}
			
				if($item->{'sales-agent'}){
					foreach($item->{'sales-agent'} as $agent){
						if($agent->{'name'}){
							$names = json_decode( json_encode($agent->{'name'}) , 1);
							
							foreach($names as $ag_name){
								$name = $ag_name;
							}
						}else{
							$name = '';
						}
						
						if($agent->{'phone'}){
							$phones = json_decode( json_encode($agent->{'phone'}) , 1);
							
							foreach($phones as $ag_phone){
								$phone = $ag_phone;
							}
						}else{
							$phone = '';
						}
						
						if($agent->{'phone'}){
							$emails = json_decode( json_encode($agent->{'email'}) , 1);
							
							foreach($emails as $ag_email){
								$email = $ag_email;
							}
						}else{
							$email = '';
						}
			  
						$agents = array(
							'name'  => $name,
							'phone' => $phone,
							'email' => $ag_email
						);
					}
				}
			
				if($item->{'price'}){
					foreach($item->{'price'} as $price){
						if($price->{'currency'}){
							$currencys = json_decode( json_encode($price->{'currency'}) , 1);
		
							foreach($currencys as $ob_currency){
								$currency = $ob_currency;
							}
						}else{
							$currency = '';
						}
					  
						if($price->{'value'}){
							$values = json_decode( json_encode($price->{'value'}) , 1);
							
							foreach($values as $ob_value){
								$value = $ob_value;
							}
						}else{
							$value = '';
						}
					  
						if($price->{'period'}){
							$periods = json_decode( json_encode($price->{'period'}) , 1);
							
							foreach($periods as $ob_period){
								$period = $ob_period;
							}
						}else{
							$period = '';
						}
					  
						$prices = array(
							'currency' => $currency,
							'value'  => $value,
							'period' => $period,
						);
					}
				}
			
				if($item->{'image'} && $internal_id){
				  
					include_once  DIR_SYSTEM . 'library/imageimport/WideImage.php';
				  
					foreach($item->{'image'} as $image){
						$obj_to_array = json_decode( json_encode($image) , 1);
					
						foreach($obj_to_array as $link){
						
							$image_name = basename($link);
						
							foreach($internal_id as $id){
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
						  
								$images[] = array('data/imagexml/' . $id . '/' . $image_name);
						  
							}
						}
					}
				}
				
				if($item->{'description'}){
					foreach($item->{'description'} as $descr){
						$description = json_decode( json_encode($descr) , 1);
						foreach($description as $formated_descr){
							$title = $this->cutStr($formated_descr, '100');
							
							$info = array(
								'title' => $title,
								'description' => '<p>' . $formated_descr . '</p>'
							);
						}
					}
				}
				
				//Options
				$deal_status = array();
				$room_furniture = array();
				$bathroom_unit = array();
				$renovation = array();
				$rooms = array();
				$floor = array();
				$floors_total = array();
				$area = array();
				$kitchen_space = array();
				$living_space = array();
				$phone = array();
				$balcony = array();
				$building_type = array();
				$mortgage = array();
				$water_supply = array();
				$internet = array();
				$agent_feed = array();
				$commission = array();
				$with_pets = array();
				$with_children = array();
				$kitchen_furniture = array();
				$television = array();
				$washing_machine = array();
				$refrigerator = array();
				$gas_supply = array();
				
				if($item->{'deal-status'}){
					$deals_status = json_decode( json_encode($item->{'deal-status'}) , 1);
					foreach($deals_status as $deal_status){
						$deal_status = ['name'=>'Тип сделки','value'=>$deal_status];
					}
				}
				
				if($item->{'room-furniture'}){
					$rooms_furniture = json_decode( json_encode($item->{'room-furniture'}) , 1);
					foreach($rooms_furniture as $room_furniture){
						$room_furniture = ['name'=>'Мебель', 'value'=>$room_furniture];
					}
				}
				
				if($item->{'bathroom-unit'}){
					$bathrooms_unit = json_decode( json_encode($item->{'bathroom-unit'}) , 1);
					foreach($bathrooms_unit as $bathroom_unit){
						$bathroom_unit = ['name'=>'Тип санузла', 'value'=>$bathroom_unit];
					}
				}
			  
				if($item->{'renovation'}){
					$renovations = json_decode( json_encode($item->{'renovation'}) , 1);
					foreach($renovations as $renovation){
						$renovation = ['name'=>'Ремонт', 'value'=>$renovation];
					}
				}
				
				if($item->{'rooms'}){
					$rooms_vl = json_decode( json_encode($item->{'rooms'}) , 1);
					foreach($rooms_vl as $rooms){
						$rooms = ['name'=>'Количество комнат', 'value'=>$rooms];
					}
				}
				
				if($item->{'floor'}){
					$floors = json_decode( json_encode($item->{'floor'}) , 1);
					foreach($floors as $floor){
						$floor = ['name'=>'Этаж', 'value'=>$floor]; ;
					}
				}
				
				if($item->{'floors-total'}){
					$floors_totals = json_decode( json_encode($item->{'floors-total'}) , 1);
					foreach($floors_totals as $floors_total){
						$floors_total = ['name'=>'Количество этажей', 'value'=>$floors_total];
					}
				}
				
				if($item->{'area'}){
					$areas = json_decode( json_encode($item->{'area'}) , 1);
					
					$value = $areas['value'] ? $areas['value'] : null;
					$unit = $areas['unit'] ? $areas['unit'] : null;
				   
					$area = ['name'=>'Общая площадь', 'value'=>$value . $unit];
				}
				
				if($item->{'living-space'}){
					$living_spaces = json_decode( json_encode($item->{'living-space'}) , 1);
					
					$value = $living_spaces['value'] ? $living_spaces['value'] : null;
					$unit = $living_spaces['unit'] ? $living_spaces['unit'] : null;
				   
					$living_space = ['name'=>'Жилая площадь', 'value'=>$value . $unit];
				}
				
				if($item->{'kitchen-space'}){
					$kitchen_spaces = json_decode( json_encode($item->{'kitchen-space'}) , 1);
					
					$value = $kitchen_spaces['value'] ? $kitchen_spaces['value'] : null;
					$unit = $kitchen_spaces['unit'] ? $kitchen_spaces['unit'] : null;
				   
					$kitchen_space = ['name'=>'Площадь кухни', 'value'=>$value . $unit];
				}
				
				if($item->{'phone'}){
					$phones = json_decode( json_encode($item->{'phone'}) , 1);
					foreach($phones as $phone){
						$phone = ['name'=>'Наличие телефона', 'value'=>$phone];
					}
				}
				
				if($item->{'balcony'}){
					$balconys = json_decode( json_encode($item->{'balcony'}) , 1);
					foreach($balconys as $balcony){
						$balcony = ['name'=>'Тип балкона', 'value'=>$balcony];
					}
				}
				
				if($item->{'building-type'}){
					$building_types = json_decode( json_encode($item->{'building-type'}) , 1);
					foreach($building_types as $building_type){
						$building_type = ['name'=>'Тип дома', 'value'=>$building_type];
					}
				}
				
				if($item->{'mortgage'}){
					$mortgages = json_decode( json_encode($item->{'mortgage'}) , 1);
					foreach($mortgages as $mortgage){
						$mortgage = ['name'=>'Возможность ипотеки', 'value'=>$mortgage];
					}
				}
				
				if($item->{'water-supply'}){
					$water_supplys = json_decode( json_encode($item->{'water-supply'}) , 1);
					foreach($water_supplys as $water_supply){
						$water_supply = ['name'=>'Водопровод', 'value'=>$water_supply];
					}
				}
				
				if($item->{'internet'}){
					$internets = json_decode( json_encode($item->{'internet'}) , 1);
					foreach($internets as $internet){
						$internet = ['name'=>'Интернет', 'value'=>$internet];
					}
				}
				
				if($item->{'new-flat'}){
					$new_flats = json_decode( json_encode($item->{'new-flat'}) , 1);
					foreach($new_flats as $new_flat){
						$new_flat = ['name'=>'Признак новостройки', 'value'=>$new_flat];
					}
				}
				
				if($item->{'agent-fee'}){
					$agent_feeds = json_decode( json_encode($item->{'agent-fee'}) , 1);
					foreach($agent_feeds as $ob_agent_feed){
						$agent_feed = ['name'=>'Комиссия агента', 'value'=>$ob_agent_feed];
					}
				}
				  
				if($item->{'commission'}){
					$commissions = json_decode( json_encode($item->{'commission'}) , 1);
					foreach($commissions as $ob_commission){
						$commission = ['name'=>'Комиссия агентства', 'value'=>$ob_commission];
					}
				}
				
				if($item->{'with-pets'}){
					$withs_pets = json_decode( json_encode($item->{'with-pets'}) , 1);
					foreach($withs_pets as $with_pets){
						$with_pets = ['name'=>'Можно ли с животными', 'value'=>$with_pets];
					}
				}
				
				if($item->{'with-children'}){
					$with_childrens = json_decode( json_encode($item->{'with-children'}) , 1);
					foreach($with_childrens as $with_children){
						$with_children = ['name'=>'Можно ли с детьми', 'value'=>$with_children];
					}
				}
				
				if($item->{'kitchen-furniture'}){
					$kitchen_furnitures = json_decode( json_encode($item->{'kitchen-furniture'}) , 1);
					foreach($kitchen_furnitures as $kitchen_furniture){
						$kitchen_furniture = ['name'=>'Наличие мебели на кухне', 'value'=>$kitchen_furniture];
					}
				}
				
				if($item->{'television'}){
					$televisions = json_decode( json_encode($item->{'television'}) , 1);
					foreach($televisions as $television){
						$television = ['name'=>'Наличие телевизора', 'value'=>$television];
					}
				}
				
				if($item->{'washing-machine'}){
					$washing_machines = json_decode( json_encode($item->{'washing-machine'}) , 1);
					foreach($washing_machines as $washing_machine){
						$washing_machine = ['name'=>'Стиральная машина', 'value'=>$washing_machine];
					}
				}
				
				if($item->{'refrigerator'}){
					$refrigerators = json_decode( json_encode($item->{'refrigerator'}) , 1);
					foreach($refrigerators as $refrigerator){
						$refrigerator = ['name'=>'Холодильник', 'value'=>$refrigerator];
					}
				}
				
				if($item->{'gas-supply'}){
					$gas_supplys = json_decode( json_encode($item->{'gas-supply'}) , 1);
					foreach($gas_supplys as $gas_supply){
						$gas_supply = ['name'=>'Газ', 'value'=>$gas_supply];
					}
				}
		   
				$options[] = array(
					$deal_status,
					$room_furniture,
					$bathroom_unit,
					$renovation,
					$rooms,
					$floor,
					$floors_total,
					$area,
					$kitchen_space,
					$living_space,
					$phone,
					$balcony,
					$building_type,
					$mortgage,
					$water_supply,
					$internet,
					$agent_feed,
					$commission,
					$with_pets,
					$with_children,
					$kitchen_furniture,
					$television,
					$washing_machine,
					$refrigerator,
					$gas_supply
				);
		   
				$data[] = array(
					'ids' => $ids, 
					'types' => $types,
					'category' => $category,
					'location' => $location, 
					'agents' => $agents,  
					'prices' => $prices, 
					'images' => $images, 
					'info' => $info,
					'options' => $options
				);
			}
		}
		
		$message_data = $this->model_parse_parse->addObject($data);
		
		
		
		//var_dump($data);
	}
	
	//Controller
	public function file_get_contents_curl($url){
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
	
	/**
	 * Умная обрезка строки
	 * @param string $str - исходная строка
	 * @param int $lenght - желаемая длина результирующей строки
	 * @param string $end - завершение длинной строки
	 * @param string $charset - кодировка
	 * @param string $token - символ усечения
	 * @return string - обрезанная строка
	 */
	public function cutStr($str, $lenght = 100, $end = false, $charset = 'UTF-8', $token = '~') {
	  $str = strip_tags($str);
	  if (mb_strlen($str, $charset) >= $lenght) {
		  $wrap = wordwrap($str, $lenght, $token);
		  $str_cut = mb_substr($wrap, 0, mb_strpos($wrap, $token, 0, $charset), $charset);  
		  return $str_cut .= $end;
	  } else {
		  return $str;
	  }
	}
}