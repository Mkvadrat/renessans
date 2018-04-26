<?php  
class ControllerModuleMapobject extends Controller {
	protected function index($setting) {
		//len and model
		$this->language->load('module/mapobject');
		$this->load->model('catalog/category');
		$this->load->model('tool/object');
		$this->load->model('tool/image'); 
		$this->load->model('catalog/product');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
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

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = '1000';
		}
		
		if (isset($this->request->get['path'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);
			
			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);
			}		
			$category_id = (int)array_pop($parts);
		} else {
			$category_id = 0;
		}
		
		$category_info = $this->model_catalog_category->getCategory($category_id);
		
		if ($category_info) {
			$this->data['products'] = array();

			$data = array(
				'filter_category_id' => $category_id, 
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
			
			$product_total = $this->model_catalog_product->getTotalProducts($data);

            $results = $this->model_catalog_product->getProducts($data);

			foreach ($results as $result) {
				
				if(!empty($result['lat_lng'])){
					$lat_lng = $result['lat_lng'];
				}else{
					$lat_lng = '44.616687, 33.525432';
				}
				
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], 60, 60);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 60, 60);
				}
				
				$this->data['products'][] = array(
					'product_id'  => $result['product_id'],
					'image' => $image,
					'href' => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id']),
					'name'  => utf8_substr(strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 0, 60),
					'lat_lng' =>  $lat_lng
                );
			}
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mapobject.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/mapobject.tpl';
		} else {
			$this->template = 'default/template/module/mapobject.tpl';
		}
		
		$this->render();
  	}
}
?>