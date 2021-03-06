<?php 
class ControllerCatalogProduct extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('catalog/product');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/product');
		
		$this->getList();
  	}
	
	public function setatten() {
		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		$output='';
		if(isset($this->request->get['object_id'])){
			$requestpart = explode('-',$this->request->get['object_id']);
			if(count($requestpart)==2){
				$column_name = $requestpart[0];
				$product_id = $requestpart[1];				
				$result = $this->model_catalog_product->getProduct($product_id);
				if($result[$column_name]){
					$this->model_catalog_product->setAttributeen($product_id, $column_name, 0);
				} else {
					$this->model_catalog_product->setAttributeen($product_id, $column_name, 1);
				}				
				$result = $this->model_catalog_product->getProduct($product_id);
				$output = $result[$column_name] ? $this->language->get('text_enabled') : $this->language->get('text_disabled');
			}
		}
		$this->response->setOutput($output);
	}
  
  	public function insert() {
    	$this->load->language('catalog/product');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/product');
		
	    /*Непонятное поле*/
		$this->data['discount_row'] = '';
        /*Непонятное поле*/
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			/*Кнопка применить*/
			//$this->model_catalog_product->addProduct($this->request->post);
			$product_id = $this->model_catalog_product->addProduct($this->request->post);
		    /*Кнопка применить*/
			
			/*Применение опций обьекта при его создании*/
			$this->addMainOption($product_id);
			/*Применение опций обьекта при его создании*/
			
			/*Применение атрибутов объекта при его создании*/
			$this->addMainAttributen($product_id, $this->request->post);
			/*Применение атрибутов объекта при его создании*/
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_category_id'])) {
				$url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
			}
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_date'])) {
				$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
			}
			
			//options
			if (isset($this->request->get['type_object'])) {
				$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['address_object'])) {
				$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
			}
						
			if (isset($this->request->get['area_object'])) {
				$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_count'])) {
				$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['floor_object'])) {
				$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['storeys_object'])) {
				$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['kitchen_area'])) {
				$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_area'])) {
				$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['live_area'])) {
				$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['total_area'])) {
				$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['product_agent'])) {
				$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
			}
			//options
			
			if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            }
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			/*Кнопка применить*/
			//$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			if(isset($this->request->post['save_continue']) and $this->request->post['save_continue']){
                $this->redirect(HTTPS_SERVER . 'index.php?route=catalog/product/insert&token=' . $this->session->data['token'].'&product_id='.$product_id);
				
            }else{
                $this->redirect(HTTPS_SERVER . 'index.php?route=catalog/product&token=' . $this->session->data['token'] . $url);
			}
			/*Кнопка применить*/
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('catalog/product');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/product');
		
	    /*Непонятное поле*/
		$this->data['discount_row'] = '';
        /*Непонятное поле*/
		
		$this->data['product_id']=$this->request->get['product_id'];
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			/*Кнопка применить*/
			$product_id=$this->request->get['product_id'];
			$this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);
			/*Кнопка применить*/
			
			/*Применение опций обьекта при его создании*/
			$this->addMainOption($this->request->get['product_id']);
			/*Применение опций обьекта при его создании*/
			
			/*Применение атрибутов объекта при его создании*/
			$this->addMainAttributen($this->request->get['product_id'], $this->request->post);
			/*Применение атрибутов объекта при его создании*/
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_date'])) {
				$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
			}
			
			//options
			if (isset($this->request->get['type_object'])) {
				$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['address_object'])) {
				$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
			}
						
			if (isset($this->request->get['area_object'])) {
				$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_count'])) {
				$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['floor_object'])) {
				$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['storeys_object'])) {
				$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['kitchen_area'])) {
				$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_area'])) {
				$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['live_area'])) {
				$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['total_area'])) {
				$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['product_agent'])) {
				$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
			}
			//options
			
			if (isset($this->request->get['filter_category'])) {
                $url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
            }
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			/*Кнопка применить*/
			//$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			if(isset($this->request->post['save_continue']) and $this->request->post['save_continue']){
                $this->redirect(HTTPS_SERVER . 'index.php?route=catalog/product/update&token=' . $this->session->data['token'].'&product_id='.$product_id);
            }else{
                $this->redirect(HTTPS_SERVER . 'index.php?route=catalog/product&token=' . $this->session->data['token'] . $url);
			}
			/*Кнопка применить*/
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('catalog/product');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/product');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_product->deleteProduct($product_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_date'])) {
				$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
			}
			
			//options
			if (isset($this->request->get['type_object'])) {
				$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['address_object'])) {
				$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
			}
						
			if (isset($this->request->get['area_object'])) {
				$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_count'])) {
				$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['floor_object'])) {
				$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['storeys_object'])) {
				$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['kitchen_area'])) {
				$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_area'])) {
				$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['live_area'])) {
				$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['total_area'])) {
				$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['product_agent'])) {
				$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
			}
			//options
			
			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('catalog/product');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/product');
		
	    /*Непонятное поле*/
		$this->data['discount_row'] = '';
        /*Непонятное поле*/
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_product->copyProduct($product_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_date'])) {
				$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
			}
			
			//options
			if (isset($this->request->get['type_object'])) {
				$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['address_object'])) {
				$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
			}
						
			if (isset($this->request->get['area_object'])) {
				$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_count'])) {
				$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['floor_object'])) {
				$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['storeys_object'])) {
				$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['kitchen_area'])) {
				$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['rooms_area'])) {
				$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['live_area'])) {
				$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['total_area'])) {
				$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['product_agent'])) {
				$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
			}
			//options
			
			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
			}
		  
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {	
	
		/*Непонятное поле*/
		$this->data['discount_row'] = '';
        /*Непонятное поле*/
		
		/* Блокирование доступа к формам*/
		$this->load->model('catalog/product');
		$getblocksomeform = $this->model_catalog_product->getBlockSomeForm($this->user->getUserName());
		$this->data['result_array'] = $getblocksomeform[0];
		$this->data['result'] = $this->data['result_array']['user_group_id'];
		
		if($this->data['result'] != 1 ){
			$this->data['getblock'] = false;
		}else{
			$this->data['getblock'] = true;
		}
		/* Блокирование доступа к формам*/
	
		if (isset($this->request->get['filter_category_id'])) {
			$filter_category_id = $this->request->get['filter_category_id'];
        } else {
	    	$filter_category_id = null;
	    }
        $url = '';
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->get['filter_date'])) {
			$filter_date = $this->request->get['filter_date'];
		} else {
			$filter_date = null;
		}
		
		//options
		if (isset($this->request->get['type_object'])) {
			$type_object = $this->request->get['type_object'];
		} else {
			$type_object = null;
		}

		if (isset($this->request->get['address_object'])) {
			$address_object = $this->request->get['address_object'];
		} else {
			$address_object = null;
		}
		
		if (isset($this->request->get['area_object'])) {
			$area_object = $this->request->get['area_object'];
		} else {
			$area_object = null;
		}
		
		if (isset($this->request->get['rooms_count'])) {
			$rooms_count = $this->request->get['rooms_count'];
		} else {
			$rooms_count = null;
		}
		
		if (isset($this->request->get['floor_object'])) {
			$floor_object = $this->request->get['floor_object'];
		} else {
			$floor_object = null;
		}
		
		if (isset($this->request->get['storeys_object'])) {
			$storeys_object = $this->request->get['storeys_object'];
		} else {
			$storeys_object = null;
		}
		
		if (isset($this->request->get['kitchen_area'])) {
			$kitchen_area = $this->request->get['kitchen_area'];
		} else {
			$kitchen_area = null;
		}
		
		if (isset($this->request->get['rooms_area'])) {
			$rooms_area = $this->request->get['rooms_area'];
		} else {
			$rooms_area = null;
		}
		
		if (isset($this->request->get['live_area'])) {
			$live_area = $this->request->get['live_area'];
		} else {
			$live_area = null;
		}
				
		if (isset($this->request->get['total_area'])) {
			$total_area = $this->request->get['total_area'];
		} else {
			$total_area = null;
		}
		
		if (isset($this->request->get['product_agent'])) {
			$product_agent = $this->request->get['product_agent'];
		} else {
			$product_agent = null;
		}
		//options
		
		if (isset($this->request->get['filter_category'])) {
			$filter_category = $this->request->get['filter_category'];
		} else {
			$filter_category = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}
		
		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
		}
		
		//options
		if (isset($this->request->get['type_object'])) {
			$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['address_object'])) {
			$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
		}
					
		if (isset($this->request->get['area_object'])) {
			$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_count'])) {
			$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['floor_object'])) {
			$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['storeys_object'])) {
			$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['kitchen_area'])) {
			$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_area'])) {
			$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['live_area'])) {
			$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['total_area'])) {
			$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['product_agent'])) {
			$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
		}
		//options
	
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}		

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
						
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('catalog/product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['products'] = array();

		$data = array(
			'filter_category_id' => $filter_category_id,
			'filter_name'	     => $filter_name,
			'filter_date'	     => $filter_date,
			//options
			'rooms_count'	     => $rooms_count,
			'address_object'	 => $address_object,
			'area_object'		 => $area_object,
			'type_object'	     => $type_object,
			'floor_object'	     => $floor_object,
			'storeys_object'	 => $storeys_object,
			'kitchen_area'	 	 => $kitchen_area,
			'rooms_area'	 	 => $rooms_area,
			'live_area'	 		 => $live_area,
			'total_area'	     => $total_area,
			'product_agent'	     => $product_agent,
			//options
			'filter_category' 	 => $filter_category,
			'filter_model'	  	 => $filter_model,
			'filter_price'	  	 => $filter_price,
			'filter_quantity' 	 => $filter_quantity,
			'filter_status'   	 => $filter_status,
			'sort'            	 => $sort,
			'order'           	 => $order,
			'start'           	 => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           	 => $this->config->get('config_admin_limit')
		);
		
		$this->load->model('tool/image');
		
		$product_total = $this->model_catalog_product->getTotalProducts($data);
			
		$results = $this->model_catalog_product->getProducts($data);
		
		$this->load->model('catalog/category');
		
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);
		
		$this->data['all_agents']  = array();
		
		$this->load->model('user/user');
		
		$this->data['all_agents'] = $this->model_user_user->getAgents(0);
						    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
			
			$category =  $this->model_catalog_product->getProductCategories($result['product_id']);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
	
			$special = false;
			
			$product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);
		
			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
					$special = $product_special['price'];
			
					break;
				}					
			}
			
			if($result['date_modified'] == 0000-00-00)
			{
				$date_modified = $this->language->get('date_modified');
			}else{
				$date_modified = date('d-m-Y', strtotime($result['date_modified']));
			}
			
			//options
			$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);			
			
			$this->data['product_options'] = array();
				
			foreach ($product_options as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					$product_option_value_data = array();
					
					foreach ($product_option['product_option_value'] as $product_option_value) {
						$product_option_value_data[] = array(
							'product_option_value_id' => $product_option_value['product_option_value_id'],
							'option_value_id'         => $product_option_value['option_value_id'],
							'quantity'                => $product_option_value['quantity'],
							'subtract'                => $product_option_value['subtract'],
							'price'                   => $product_option_value['price'],
							'price_prefix'            => $product_option_value['price_prefix'],
							'points'                  => $product_option_value['points'],
							'points_prefix'           => $product_option_value['points_prefix'],						
							'weight'                  => $product_option_value['weight'],
							'weight_prefix'           => $product_option_value['weight_prefix']	
						);						
					}
					
					$product_options[] = array(
						'product_option_id'    => $product_option['product_option_id'],
						'product_option_value' => $product_option_value_data,
						'option_id'            => $product_option['option_id'],
						'name'                 => $product_option['name'],
						'type'                 => $product_option['type'],
						'required'             => $product_option['required'],
						'product_sort_option_id'  => $product_option['product_sort_option_id']
					);				
				} 
			}
			
			$product_agents = $this->model_catalog_product->getProductByAgent($result['agent']);
			
			$agents_data = array();
			
			foreach($product_agents as $agent){
				$agents_data = array(
					'user_id' => $agent['user_id'],
					'name' 	  => isset($agent['firstname']) ? $agent['firstname'] : null,
					'surname' => isset($agent['lastname']) ? $agent['lastname'] : null
				);
			}
			
      		$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'category'   => $category,
				'date_modify'=> $date_modified,
				'special'    => $special,
				'image'      => $image,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => $action,
				'options'    => $product_options,
				'agents'     => $agents_data
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_save'] = $this->language->get('text_save');
		$this->data['text_close'] = $this->language->get('text_close');
			
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_name'] = $this->language->get('column_name');	
		$this->data['column_category'] = $this->language->get('column_category');		
		$this->data['column_model'] = $this->language->get('column_model');		
		$this->data['column_price'] = $this->language->get('column_price');		
		$this->data['column_quantity'] = $this->language->get('column_quantity');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');	
		$this->data['date_modify'] = $this->language->get('date_modify');	

		$this->data['info_product_category'] = $this->language->get('info_product_category');
		$this->data['info_name'] = $this->language->get('info_name');
		$this->data['info_category'] = $this->language->get('info_category');
		$this->data['info_categories'] = $this->language->get('info_categories');
		$this->data['info_model'] = $this->language->get('info_model');
		$this->data['info_price'] = $this->language->get('info_price');
		$this->data['info_quantity'] = $this->language->get('info_quantity');		
		$this->data['info_status'] = $this->language->get('info_status');
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
		}
		
		//options
		if (isset($this->request->get['type_object'])) {
			$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['address_object'])) {
			$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
		}
					
		if (isset($this->request->get['area_object'])) {
			$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_count'])) {
			$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['floor_object'])) {
			$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['storeys_object'])) {
			$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['kitchen_area'])) {
			$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_area'])) {
			$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['live_area'])) {
			$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['total_area'])) {
			$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['product_agent'])) {
			$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
		}
		//options
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_name'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$this->data['sort_date_modified'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.date_modified' . $url, 'SSL');
		$this->data['sort_category'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p2c.category' . $url, 'SSL');
		$this->data['sort_model'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$this->data['sort_price'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$this->data['sort_quantity'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
		}
		
		//options
		if (isset($this->request->get['type_object'])) {
			$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['address_object'])) {
			$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
		}
					
		if (isset($this->request->get['area_object'])) {
			$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_count'])) {
			$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['floor_object'])) {
			$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['storeys_object'])) {
			$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['kitchen_area'])) {
			$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_area'])) {
			$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['live_area'])) {
			$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['total_area'])) {
			$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['product_agent'])) {
			$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
		}
		//options
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
		
		$this->load->model('catalog/category');

        $this->data['categories'] = $this->model_catalog_category->getCategories(0);
        $this->data['filter_category_id'] = $filter_category_id;
	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_date'] = $filter_date;
		
		//options
		$this->data['type_object'] = $type_object;
		$this->data['address_object'] = $address_object;
		$this->data['area_object'] = $area_object;
		$this->data['rooms_count'] = $rooms_count;
		$this->data['floor_object'] = $floor_object;
		$this->data['storeys_object'] = $storeys_object;
		$this->data['kitchen_area'] = $kitchen_area;
		$this->data['rooms_area'] = $rooms_area;
		$this->data['live_area'] = $live_area;
		$this->data['total_area'] = $total_area;
		$this->data['product_agent'] = $product_agent;
		
		if (isset($this->request->get['product_agent'])) {
			$this->data['curent_agent'] = $this->request->get['product_agent'];
		} else {
			$this->data['curent_agent'] = null;
		}
		//options
		
		$this->data['filter_category'] = $filter_category;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_price'] = $filter_price;
		$this->data['filter_quantity'] = $filter_quantity;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/product_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['heading_title_product'] = $this->language->get('heading_title_product');
		
		/*Непонятное поле*/
		$this->data['discount_row'] = '';
        /*Непонятное поле*/
		
    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
    	$this->data['text_none'] = $this->language->get('text_none');
    	$this->data['text_yes'] = $this->language->get('text_yes');
    	$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$this->data['text_plus'] = $this->language->get('text_plus');
		$this->data['text_minus'] = $this->language->get('text_minus');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_option'] = $this->language->get('text_option');
		$this->data['text_option_value'] = $this->language->get('text_option_value');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_lat_lng'] = $this->language->get('entry_lat_lng');
    	$this->data['entry_model'] = $this->language->get('entry_model');
		$this->data['entry_sku'] = $this->language->get('entry_sku');
		$this->data['entry_upc'] = $this->language->get('entry_upc');
		$this->data['entry_ean'] = $this->language->get('entry_ean');
		$this->data['entry_jan'] = $this->language->get('entry_jan');
		$this->data['entry_isbn'] = $this->language->get('entry_isbn');
		$this->data['entry_mpn'] = $this->language->get('entry_mpn');
		$this->data['entry_location'] = $this->language->get('entry_location');
		$this->data['entry_minimum'] = $this->language->get('entry_minimum');
		$this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
    	$this->data['entry_shipping'] = $this->language->get('entry_shipping');
    	$this->data['entry_date_available'] = $this->language->get('entry_date_available');
    	$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_stock_status'] = $this->language->get('entry_stock_status');
    	$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$this->data['entry_points'] = $this->language->get('entry_points');
		$this->data['entry_option_points'] = $this->language->get('entry_option_points');
		$this->data['entry_subtract'] = $this->language->get('entry_subtract');
    	$this->data['entry_weight_class'] = $this->language->get('entry_weight_class');
    	$this->data['entry_weight'] = $this->language->get('entry_weight');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension');
		$this->data['entry_length'] = $this->language->get('entry_length');
    	$this->data['entry_image'] = $this->language->get('entry_image');
    	$this->data['entry_download'] = $this->language->get('entry_download');
    	$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_related'] = $this->language->get('entry_related');
		$this->data['entry_attribute'] = $this->language->get('entry_attribute');
		$this->data['entry_text'] = $this->language->get('entry_text');
		$this->data['entry_option'] = $this->language->get('entry_option');
		$this->data['entry_option_value'] = $this->language->get('entry_option_value');
		$this->data['entry_required'] = $this->language->get('entry_required');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_priority'] = $this->language->get('entry_priority');
		$this->data['entry_tag'] = $this->language->get('entry_tag');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_reward'] = $this->language->get('entry_reward');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_main_category'] = $this->language->get('entry_main_category');
		$this->data['entry_seo_title'] = $this->language->get('entry_seo_title');
		$this->data['entry_seo_h1'] = $this->language->get('entry_seo_h1');
		
		$this->data['info_sku'] = $this->language->get('info_sku');
		$this->data['info_upc'] = $this->language->get('info_upc');
		$this->data['info_ean'] = $this->language->get('info_ean');
		$this->data['info_jan'] = $this->language->get('info_jan');
		$this->data['info_isbn'] = $this->language->get('info_isbn');
		$this->data['info_mpn'] = $this->language->get('info_mpn');
		$this->data['info_minimum'] = $this->language->get('info_minimum');
		$this->data['info_stock_status'] = $this->language->get('info_stock_status');
		$this->data['info_shipping'] = $this->language->get('info_shipping');
		$this->data['info_keyword'] = $this->language->get('info_keyword');
		$this->data['info_image'] = $this->language->get('info_image');
		$this->data['info_manufacturer'] = $this->language->get('info_manufacturer');
		$this->data['info_main_category'] = $this->language->get('info_main_category');
		$this->data['info_category'] = $this->language->get('info_category');
		$this->data['info_download'] = $this->language->get('info_download');
		$this->data['info_related'] = $this->language->get('info_related');
		$this->data['info_attribute'] = $this->language->get('info_attribute');
		$this->data['info_points'] = $this->language->get('info_points');
		$this->data['info_related_no'] = $this->language->get('info_related_no');
				
    	$this->data['button_save'] = $this->language->get('button_save');
		/*Кнопка применить*/
		$this->data['button_save_continue'] = $this->language->get('button_save_continue');
		/*Кнопка применить*/
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_attribute'] = $this->language->get('button_add_attribute');
		$this->data['button_add_option'] = $this->language->get('button_add_option');
		$this->data['button_add_option_value'] = $this->language->get('button_add_option_value');
		$this->data['button_add_discount'] = $this->language->get('button_add_discount');
		$this->data['button_add_special'] = $this->language->get('button_add_special');
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_attribute'] = $this->language->get('tab_attribute');
		$this->data['tab_option'] = $this->language->get('tab_option');		
		$this->data['tab_discount'] = $this->language->get('tab_discount');
		$this->data['tab_special'] = $this->language->get('tab_special');
    	$this->data['tab_image'] = $this->language->get('tab_image');		
		$this->data['tab_links'] = $this->language->get('tab_links');
		$this->data['tab_reward'] = $this->language->get('tab_reward');
		$this->data['tab_design'] = $this->language->get('tab_design');
		
		/* Блокирование доступа к формам*/
		$this->load->model('catalog/product');
		$getblocksomeform = $this->model_catalog_product->getBlockSomeForm($this->user->getUserName());
		$this->data['result_array'] = $getblocksomeform[0];
		$this->data['result'] = $this->data['result_array']['user_group_id'];
		
		if($this->data['result'] != 1 ){
			$this->data['getblock'] = false;
		}else{
			$this->data['getblock'] = true;
		}
		/* Блокирование доступа к формам*/
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

 		if (isset($this->error['meta_description'])) {
			$this->data['error_meta_description'] = $this->error['meta_description'];
		}else{
			$this->data['error_meta_description'] = array();
		}		
   
   		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}	
		
   		if (isset($this->error['model'])) {
			$this->data['error_model'] = $this->error['model'];
		} else {
			$this->data['error_model'] = '';
		}		
     	
		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}	

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
		}
		
		//options
		if (isset($this->request->get['type_object'])) {
			$url .= '&type_object=' . urlencode(html_entity_decode($this->request->get['type_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['address_object'])) {
			$url .= '&address_object=' . urlencode(html_entity_decode($this->request->get['address_object'], ENT_QUOTES, 'UTF-8'));
		}
					
		if (isset($this->request->get['area_object'])) {
			$url .= '&area_object=' . urlencode(html_entity_decode($this->request->get['area_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_count'])) {
			$url .= '&rooms_count=' . urlencode(html_entity_decode($this->request->get['rooms_count'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['floor_object'])) {
			$url .= '&floor_object=' . urlencode(html_entity_decode($this->request->get['floor_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['storeys_object'])) {
			$url .= '&storeys_object=' . urlencode(html_entity_decode($this->request->get['storeys_object'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['kitchen_area'])) {
			$url .= '&kitchen_area=' . urlencode(html_entity_decode($this->request->get['kitchen_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['rooms_area'])) {
			$url .= '&rooms_area=' . urlencode(html_entity_decode($this->request->get['rooms_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['live_area'])) {
			$url .= '&live_area=' . urlencode(html_entity_decode($this->request->get['live_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['total_area'])) {
			$url .= '&total_area=' . urlencode(html_entity_decode($this->request->get['total_area'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['product_agent'])) {
			$url .= '&product_agent=' . urlencode(html_entity_decode($this->request->get['product_agent'], ENT_QUOTES, 'UTF-8'));
		}
		//options
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode(html_entity_decode($this->request->get['filter_category'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}	
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
								
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['product_id'])) {
			$this->data['action'] = $this->url->link('catalog/product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
    	}
		/*Выбор агента*/
		$this->load->model('user/user');
        $this->data['agents'] = $this->model_user_user->getAgents();
		/*Выбор агента*/

		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
				
		if (isset($this->request->post['product_description'])) {
			$this->data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$this->data['product_description'] = array();
		}
		
		if (isset($this->request->post['model'])) {
      		$this->data['model'] = $this->request->post['model'];
    	} elseif (!empty($product_info)) {
			$this->data['model'] = $product_info['model'];
		} else {
      		$this->data['model'] = '';
    	}

		if (isset($this->request->post['sku'])) {
      		$this->data['sku'] = $this->request->post['sku'];
    	} elseif (!empty($product_info)) {
			$this->data['sku'] = $product_info['sku'];
		} else {
      		$this->data['sku'] = '';
    	}
		
		if (isset($this->request->post['upc'])) {
      		$this->data['upc'] = $this->request->post['upc'];
    	} elseif (!empty($product_info)) {
			$this->data['upc'] = $product_info['upc'];
		} else {
      		$this->data['upc'] = '';
    	}
				
		if (isset($this->request->post['ean'])) {
      		$this->data['ean'] = $this->request->post['ean'];
    	} elseif (!empty($product_info)) {
			$this->data['ean'] = $product_info['ean'];
		} else {
      		$this->data['ean'] = '';
    	}
	
		if (isset($this->request->post['lat_lng'])) {
      		$this->data['lat_lng'] = $this->request->post['lat_lng'];
    	} elseif (!empty($product_info)) {
			$this->data['lat_lng'] = $product_info['lat_lng'];
		} else {
      		$this->data['lat_lng'] = '';
    	}
		
		/*Выбор агента*/
		if (isset($this->request->post['agent'])) {
            $this->data['agent'] = $this->request->post['agent'];
        } elseif (!empty($product_info)) {
            $this->data['agent'] = $product_info['agent'];
        } else {
            $this->data['agent'] = $this->user->getId();
        }

        $user = $this->model_user_user->getUser($this->user->getId());
        $this->data['user_group_id'] = $user['user_group_id'];
		/*Выбор агента*/
		
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
		if (isset($this->request->post['jan'])) {
      		$this->data['jan'] = $this->request->post['jan'];
    	} elseif (!empty($product_info)) {
			$this->data['jan'] = $product_info['jan'];
		} else {
      		$this->data['jan'] = '';
    	}
		
		
		
		if (isset($this->request->post['isbn'])) {
      		$this->data['isbn'] = $this->request->post['isbn'];
    	} elseif (!empty($product_info)) {
			$this->data['isbn'] = $product_info['isbn'];
		} else {
      		$this->data['isbn'] = '';
    	}
		
		if (isset($this->request->post['mpn'])) {
      		$this->data['mpn'] = $this->request->post['mpn'];
    	} elseif (!empty($product_info)) {
			$this->data['mpn'] = $product_info['mpn'];
		} else {
      		$this->data['mpn'] = '';
    	}								
		if (isset($this->request->post['location'])) {
      		$this->data['location'] = $this->request->post['location'];
    	} elseif (!empty($product_info)) {
			$this->data['location'] = $product_info['location'];
		} else {
      		$this->data['location'] = '';
    	}
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/

		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['product_store'])) {
			$this->data['product_store'] = $this->request->post['product_store'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_store'] = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
		} else {
			$this->data['product_store'] = array(0);
		}	
		
		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($product_info)) {
			$this->data['keyword'] = $product_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($product_info)) {
			$this->data['image'] = $product_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
	
		$this->load->model('catalog/manufacturer');
		
    	$this->data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();

    	if (isset($this->request->post['manufacturer_id'])) {
      		$this->data['manufacturer_id'] = $this->request->post['manufacturer_id'];
		} elseif (!empty($product_info)) {
			$this->data['manufacturer_id'] = $product_info['manufacturer_id'];
		} else {
      		$this->data['manufacturer_id'] = 0;
    	} 
		
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
    	if (isset($this->request->post['shipping'])) {
      		$this->data['shipping'] = $this->request->post['shipping'];
    	} elseif (!empty($product_info)) {
      		$this->data['shipping'] = $product_info['shipping'];
    	} else {
			$this->data['shipping'] = 1;
		}
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		
    	if (isset($this->request->post['price'])) {
      		$this->data['price'] = $this->request->post['price'];
    	} elseif (!empty($product_info)) {
			$this->data['price'] = $product_info['price'];
		} else {
      		$this->data['price'] = '';
    	}
		
		/*Выбор валюты*/
		$this->load->model('localisation/currency');

        if (isset($this->request->post['currency'])) {
            $this->data['currency'] = $this->request->post['currency'];
        } elseif (!empty($product_info)) {
            $this->data['currency'] = $product_info['currency_id'];
        } else {
            $this->data['currency'] = '';
            $currency_code = $this->config->get('config_currency');
            if (!empty($currency_code)) {
                $currency = $this->model_localisation_currency->getCurrencyByCode($currency_code);
                if ($currency) {
                    $this->data['currency'] = $currency['currency_id'];
                }
            }
        }

        $this->data['currencies'] = $this->model_localisation_currency->getCurrencies();
		/*Выбор валюты*/
			
		$this->load->model('localisation/tax_class');
		
		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
    	/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
		if (isset($this->request->post['tax_class_id'])) {
      		$this->data['tax_class_id'] = $this->request->post['tax_class_id'];
    	} elseif (!empty($product_info)) {
			$this->data['tax_class_id'] = $product_info['tax_class_id'];
		} else {
      		$this->data['tax_class_id'] = 0;
    	}
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		      	
		if (isset($this->request->post['date_available'])) {
       		$this->data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($product_info)) {
			$this->data['date_available'] = date('Y-m-d', strtotime($product_info['date_available']));
		} else {
			$this->data['date_available'] = date('Y-m-d');
		}
											
    	if (isset($this->request->post['quantity'])) {
      		$this->data['quantity'] = $this->request->post['quantity'];
    	} elseif (!empty($product_info)) {
      		$this->data['quantity'] = $product_info['quantity'];
    	} else {
			$this->data['quantity'] = 1;
		}
		
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
		if (isset($this->request->post['minimum'])) {
      		$this->data['minimum'] = $this->request->post['minimum'];
    	} elseif (!empty($product_info)) {
      		$this->data['minimum'] = $product_info['minimum'];
    	} else {
			$this->data['minimum'] = 1;
		}
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		
		/*if (isset($this->request->post['subtract'])) {
      		$this->data['subtract'] = $this->request->post['subtract'];
    	} elseif (!empty($product_info)) {
      		$this->data['subtract'] = $product_info['subtract'];
    	} else {
			$this->data['subtract'] = 1;
		}*/
		
		if (isset($this->request->post['sort_order'])) {
      		$this->data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (!empty($product_info)) {
      		$this->data['sort_order'] = $product_info['sort_order'];
    	} else {
			$this->data['sort_order'] = 1;
		}
		
		/*Видео на странице продукта*/
		if (isset($this->request->post['video'])) {
            $this->data['video'] = $this->request->post['video'];
        } elseif (!empty($product_info)) {
            $this->data['video'] = $product_info['video'];
        } else {
            $this->data['video'] = '';
        }
		/*Видео на странице продукта*/

		$this->load->model('localisation/stock_status');
		
		$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

    	/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
		if (isset($this->request->post['stock_status_id'])) {
      		$this->data['stock_status_id'] = $this->request->post['stock_status_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['stock_status_id'] = $product_info['stock_status_id'];
    	} else {
			$this->data['stock_status_id'] = $this->config->get('config_stock_status_id');
		}
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
				
    	if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} elseif (!empty($product_info)) {
			$this->data['status'] = $product_info['status'];
		} else {
      		$this->data['status'] = 1;
    	}
		
        /*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
    	if (isset($this->request->post['weight'])) {
      		$this->data['weight'] = $this->request->post['weight'];
		} elseif (!empty($product_info)) {
			$this->data['weight'] = $product_info['weight'];
    	} else {
      		$this->data['weight'] = '';
    	} 
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		
		$this->load->model('localisation/weight_class');
		
		$this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		
    	/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
		if (isset($this->request->post['weight_class_id'])) {
      		$this->data['weight_class_id'] = $this->request->post['weight_class_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['weight_class_id'] = $product_info['weight_class_id'];
		} else {
      		$this->data['weight_class_id'] = $this->config->get('config_weight_class_id');
    	}
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		
		if (isset($this->request->post['length'])) {
      		$this->data['length'] = $this->request->post['length'];
    	} elseif (!empty($product_info)) {
			$this->data['length'] = $product_info['length'];
		} else {
      		$this->data['length'] = '';
    	}
		
		if (isset($this->request->post['width'])) {
      		$this->data['width'] = $this->request->post['width'];
		} elseif (!empty($product_info)) {	
			$this->data['width'] = $product_info['width'];
    	} else {
      		$this->data['width'] = '';
    	}
		
		if (isset($this->request->post['height'])) {
      		$this->data['height'] = $this->request->post['height'];
		} elseif (!empty($product_info)) {
			$this->data['height'] = $product_info['height'];
    	} else {
      		$this->data['height'] = '';
    	}

		$this->load->model('localisation/length_class');
		
		$this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();
    	
		if (isset($this->request->post['length_class_id'])) {
      		$this->data['length_class_id'] = $this->request->post['length_class_id'];
    	} elseif (!empty($product_info)) {
      		$this->data['length_class_id'] = $product_info['length_class_id'];
    	} else {
      		$this->data['length_class_id'] = $this->config->get('config_length_class_id');
		}

		if (isset($this->request->post['product_attribute'])) {
			$this->data['product_attributes'] = $this->request->post['product_attribute'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_attributes'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
		} else {
			$this->data['product_attributes'] = array();
		}
		
		$this->load->model('catalog/option');
		
		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);			
		} else {
			$product_options = array();
		}			
		
		$this->data['product_options'] = array();
			
		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
				
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],						
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']	
					);						
				}
				
				$this->data['product_options'][] = array(
					'product_option_id'    => $product_option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'required'             => $product_option['required'],
					'product_sort_option_id'  => $product_option['product_sort_option_id']
				);				
			} else {
				$this->data['product_options'][] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option['option_value'],
					'required'          => $product_option['required'],
					'product_sort_option_id'  => $product_option['product_sort_option_id']
				);				
			}
		}
		
		$this->data['option_values'] = array();
		
		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($this->data['option_values'][$product_option['option_id']])) {
					$this->data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}
		
		$this->load->model('sale/customer_group');
		
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		
		if (isset($this->request->post['product_discount'])) {
			$this->data['product_discounts'] = $this->request->post['product_discount'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_discounts'] = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
		} else {
			$this->data['product_discounts'] = array();
		}

		if (isset($this->request->post['product_special'])) {
			$this->data['product_specials'] = $this->request->post['product_special'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_specials'] = $this->model_catalog_product->getProductSpecials($this->request->get['product_id']);
		} else {
			$this->data['product_specials'] = array();
		}
		
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
		} else {
			$product_images = array();
		}
		
		$this->data['product_images'] = array();
		
		foreach ($product_images as $product_image) {
			if ($product_image['image'] && file_exists(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
			} else {
				$image = 'no_image.jpg';
			}
			
			$this->data['product_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($image, 100, 100),
				'sort_order' => $product_image['sort_order']
			);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		
		/*Раздел в карточке продукта "Планировки"*/
		if (isset($this->request->post['product_plan'])) {
            $product_plans = $this->request->post['product_plan'];
        } elseif (isset($this->request->get['product_id'])) {
            $product_plans = $this->model_catalog_product->getProductPlans($this->request->get['product_id']);
        } else {
            $product_plans = array();
        }

        $this->data['product_plans'] = array();

        foreach ($product_plans as $product_plan) {
            if ($product_plan['image'] && file_exists(DIR_IMAGE . $product_plan['image'])) {
                $image = $product_plan['image'];
            } else {
                $image = 'no_image.jpg';
            }

            $this->data['product_plans'][] = array(
                'image'      => $image,
                'thumb'      => $this->model_tool_image->resize($image, 100, 100),
                'sort_order' => $product_plan['sort_order']
            );
        }
		/*Раздел в карточке продукта "Планировки"*/
		

		$this->load->model('catalog/download');
		
		$this->data['downloads'] = $this->model_catalog_download->getDownloads();
		
		if (isset($this->request->post['product_download'])) {
			$this->data['product_download'] = $this->request->post['product_download'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_download'] = $this->model_catalog_product->getProductDownloads($this->request->get['product_id']);
		} else {
			$this->data['product_download'] = array();
		}		
		
		$this->load->model('catalog/category');
				
		$categories = $this->model_catalog_category->getAllCategories();

		$this->data['categories'] = $this->getAllCategories($categories);
		
		if (isset($this->request->post['main_category_id'])) {
			$this->data['main_category_id'] = $this->request->post['main_category_id'];
		} elseif (isset($product_info)) {
			$this->data['main_category_id'] = $this->model_catalog_product->getProductMainCategoryId($this->request->get['product_id']);
		} else {
			$this->data['main_category_id'] = 0;
		}

		if (isset($this->request->post['product_category'])) {
			$this->data['product_category'] = $this->request->post['product_category'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_category'] = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
		} else {
			$this->data['product_category'] = array();
		}		
		
		if (isset($this->request->post['product_related'])) {
			$this->data['product_related'] = $this->request->post['product_related'];
		} elseif (isset($product_info)) {
			$this->data['product_related'] = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
		} else {
			$this->data['product_related'] = array();
		}
		
	    /*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
		/*
    	if (isset($this->request->post['points'])) {
      		$this->data['points'] = $this->request->post['points'];
    	} elseif (!empty($product_info)) {
			$this->data['points'] = $product_info['points'];
		} else {
      		$this->data['points'] = '';
    	}
		*/
		/*Оригинальный код с ocstore, вырезанный из-за ненадобности*/
						
		if (isset($this->request->post['product_reward'])) {
			$this->data['product_reward'] = $this->request->post['product_reward'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_reward'] = $this->model_catalog_product->getProductRewards($this->request->get['product_id']);
		} else {
			$this->data['product_reward'] = array();
		}
		
		if (isset($this->request->post['product_layout'])) {
			$this->data['product_layout'] = $this->request->post['product_layout'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_layout'] = $this->model_catalog_product->getProductLayouts($this->request->get['product_id']);
		} else {
			$this->data['product_layout'] = array();
		}

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
										
		$this->template = 'catalog/product_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'catalog/product')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	foreach ($this->request->post['product_description'] as $language_id => $value) {
      		if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
        		$this->error['name'][$language_id] = $this->language->get('error_name');
      		}
    	}
		
    	if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
      		$this->error['model'] = $this->language->get('error_model');
    	}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		/*Выбор валюты*/
		$currency_ok = false;
        $this->load->model('localisation/currency');
        $currencies = $this->model_localisation_currency->getCurrencies();
        foreach($currencies as $currency) {
            if ($currency['currency_id'] == $this->request->post['currency']) {
                $currency_ok = true;
                break;
            }
        }
        if (!$currency_ok) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
		/*Выбор валюты*/
				
    	if (!$this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}
	
  	private function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'catalog/product')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'catalog/product')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	
	public function option() {
		$output = ''; 
		
		$this->load->model('catalog/option');
		
		$results = $this->model_catalog_option->getOptionValues($this->request->get['option_id']);
		
		foreach ($results as $result) {
			$output .= '<option value="' . $result['option_value_id'] . '"';

			if (isset($this->request->get['option_value_id']) && ($this->request->get['option_value_id'] == $result['option_value_id'])) {
				$output .= ' selected="selected"';
			}

			$output .= '>' . $result['name'] . '</option>';
		}

		$this->response->setOutput($output);
	}
	
	public function name() {
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET name = '" . $this->request->post['name'] . "' WHERE product_id = '" . (int)$this->request->post['product_id'] . "'");
			$this->cache->delete('product');
        }
    }
	
	public function model() {
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET model = '" . $this->request->post['model'] . "' WHERE product_id = '" . (int)$this->request->post['product_id'] . "'");
			$this->cache->delete('product');
        }
    }
	
	public function price() {
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . (float)$this->request->post['price'] . "' WHERE product_id = '" . (int)$this->request->post['product_id'] . "'");
			$this->cache->delete('product');
        }
    }
	
	public function saveQuantity() {
        $id  = $this->request->get['product_id'];
        $quantity = $this->request->get['quantity'];

        $this->load->model('catalog/product');

        $this->response->setOutput($this->model_catalog_product->saveQuantity($id,$quantity));
    }
	
	public function category() {
		$this->load->model('catalog/product');
		
		if (isset($this->request->get['category_id'])) {
			$category_id = $this->request->get['category_id'];
		} else {
			$category_id = 0;
		}
		
		$product_data = array();
		
		$results = $this->model_catalog_product->getProductsByCategoryId($category_id);
		
		foreach ($results as $result) {
			$product_data[] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model']
			);
		}
		
		$this->response->setOutput(json_encode($product_data));
	}
	
	public function related() {
		$this->load->model('catalog/product');
		
		if (isset($this->request->post['product_related'])) {
			$products = $this->request->post['product_related'];
		} else {
			$products = array();
		}
	
		$product_data = array();
		
		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($product_info) {
				$product_data[] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name'],
					'model'      => $product_info['model']
				);
			}
		}		
		
		$this->response->setOutput(json_encode($product_data));
	}
		
	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_date']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('catalog/product');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['filter_date'])) {
				$filter_date = $this->request->get['filter_date'];
			} else {
				$filter_date = '';
			}
			
			if (isset($this->request->get['filter_category'])) {
				$filter_category = $this->request->get['filter_category'];
			} else {
				$filter_category = '';
			}
			
			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}
					
			if (isset($this->request->get['filter_category_id'])) {
				$filter_category_id = $this->request->get['filter_category_id'];
			} else {
				$filter_category_id = '';
			}
			
			if (isset($this->request->get['filter_sub_category'])) {
				$filter_sub_category = $this->request->get['filter_sub_category'];
			} else {
				$filter_sub_category = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			
					
			$data = array(
				'filter_name'         => $filter_name,
				'filter_date'         => $filter_date,
				'filter_model'        => $filter_model,
				'filter_category_id'  => $filter_category_id,
				'filter_sub_category' => $filter_sub_category,
				'start'               => 0,
				'limit'               => $limit
			);
			
			$results = $this->model_catalog_product->getProducts($data);
			
			foreach ($results as $result) {
				$option_data = array();
				
				$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);	
				
				foreach ($product_options as $product_option) {
					if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
						$option_value_data = array();
					
						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_data[] = array(
								'product_option_value_id' => $product_option_value['product_option_value_id'],
								'option_value_id'         => $product_option_value['option_value_id'],
								'name'                    => $product_option_value['name'],
								'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
								'price_prefix'            => $product_option_value['price_prefix']
							);	
						}
					
						$option_data[] = array(
							'product_option_id' => $product_option['product_option_id'],
							'option_id'         => $product_option['option_id'],
							'name'              => $product_option['name'],
							'type'              => $product_option['type'],
							'option_value'      => $option_value_data,
							'required'          => $product_option['required'],
							'product_sort_option_id'  => $product_option['product_sort_option_id']
						);	
					} else {
						$option_data[] = array(
							'product_option_id' => $product_option['product_option_id'],
							'option_id'         => $product_option['option_id'],
							'name'              => $product_option['name'],
							'type'              => $product_option['type'],
							'option_value'      => $product_option['option_value'],
							'required'          => $product_option['required'],
							'product_sort_option_id'  => $product_option['product_sort_option_id']
						);				
					}
				}
				
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'date_modified' => date("d-m-Y", strtotime($result['date_modified'])),
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	private function getAllCategories($categories, $parent_id = 0, $parent_name = '') {
		$output = array();

		if (array_key_exists($parent_id, $categories)) {
			if ($parent_name != '') {
				$parent_name .= $this->language->get('text_separator');
			}

			foreach ($categories[$parent_id] as $category) {
				$output[$category['category_id']] = array(
					'category_id' => $category['category_id'],
					'name'        => $parent_name . $category['name']
				);

				$output += $this->getAllCategories($categories, $category['category_id'], $parent_name . $category['name']);
			}
		}

		return $output;
	}
		
	/*Применение опций обьекта при его создании*/
	public function addMainOption($product_id){
		if($_REQUEST['main_option_value'] == 1){	
    	    $this->model_catalog_product->addMainOption($product_id, 1);
		}
	    if($_REQUEST['main_option_value'] == 2){	
    	    $this->model_catalog_product->addMainOption($product_id, 2);
		}
	    if($_REQUEST['main_option_value'] == 3){	
    	    $this->model_catalog_product->addMainOption($product_id, 3);
		}
	    if($_REQUEST['main_option_value'] == 4){	
    	    $this->model_catalog_product->addMainOption($product_id, 4);
		}
	}
	/*Применение опций обьекта при его создании*/
	
	/*Применение атрибутов объекта при его создании*/
	public function addMainAttributen($product_id, $language_id){
		if($_REQUEST['main_attributen_value'] == 1){	
    	    $this->model_catalog_product->addMainAttributen($product_id, $language_id, 1);
		}
		if($_REQUEST['main_attributen_value'] == 2){	
    	    $this->model_catalog_product->addMainAttributen($product_id, $language_id, 2);
		}
		if($_REQUEST['main_attributen_value'] == 3){	
    	    $this->model_catalog_product->addMainAttributen($product_id, $language_id, 3);
		}
		if($_REQUEST['main_attributen_value'] == 4){	
    	    $this->model_catalog_product->addMainAttributen($product_id, $language_id, 4);
		}
		if($_REQUEST['main_attributen_value'] == 5){	
    	    $this->model_catalog_product->addMainAttributen($product_id, $language_id, 5);
		}
	}
	/*Применение атрибутов объекта при его создании*/
}
?>