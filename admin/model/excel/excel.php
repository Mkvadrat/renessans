<?php
class ModelExcelExcel extends Model {
    public function getProducts(){
        $data = array();
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product AS p 
                                    JOIN " . DB_PREFIX . "product_description AS pd 
                                    ON (p.product_id = pd.product_id)
                                    /*AND p.status = 1*/ ORDER BY p.date_modified ASC");
        
        foreach($query->rows as $result) {
            $data[] = array(
                'product_id'       => $result['product_id'],
				'name'             => $result['name'],
				'seo_title'		   => $result['seo_title'],
				'description'      => $result['description'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'seo_h1'		   => $result['seo_h1'],
				'tag'              => $result['tag'],
				'model'            => $result['model'],
                'agent'            => $result['agent'],
				'sku'              => $result['sku'],
				'upc'              => $result['upc'],
				'ean'              => $result['ean'],
				'lat_lng'          => $result['lat_lng'],
				'jan'              => $result['jan'],
				'isbn'             => $result['isbn'],
				'mpn'              => $result['mpn'],
				'location'         => $result['location'],
				'image'            => $result['image'],
				'price'            => $result['price'],
				'currency_id'      => $result['currency_id'],
                'tax_class_id'     => $result['tax_class_id'],
				'status'           => $result['status'],
				'date_added'       => $result['date_added'],
				'date_modified'    => $result['date_modified'],
            );
        }

        return $data;
    }
    
    public function Agent($user_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");

        return $query->row;
    }
    
    public function getCategory($product_id){
        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "category AS c JOIN " . DB_PREFIX . "category_description AS cd JOIN " . DB_PREFIX . "product_to_category AS ptc ON (c.category_id = cd.category_id) AND (c.category_id = ptc.category_id) AND ptc.product_id = '" . $product_id . "'");
        
        $data = array();
        
        foreach($query->rows as $result) {
            $data[] =  array(
                'name' => $result['name'],
            );
            
        }
        
        return $data;
    }
    
    public function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($product_option_query->rows as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
			
				$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");
				
				foreach ($product_option_value_query->rows as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'name'                    => $product_option_value['name'],
						'image'                   => $product_option_value['image'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']
					);
				}
									
				$product_option_data[] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option_value_data,
					'required'          => $product_option['required']
				);
			} else {
				$product_option_data[] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option['option_value'],
					'required'          => $product_option['required']
				);				
			}
      	}

		return $product_option_data;
	}
}