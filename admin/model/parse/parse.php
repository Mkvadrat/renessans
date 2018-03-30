<?php
class ModelParseParse extends Model {
    //Model
    public function addObject($data){   
        
        $message_data = array();

        foreach($data as $data){
            $existing_model = $this->getModel($data['ids']);

            if(!in_array($data['ids'], $existing_model) && $data['ids']){
                
               if($data['prices']['currency'] == 'RUB'){
                    $currency_id = '1';
                }else{
                    $currency_id = '2';
                }
                                
                $sql = ("INSERT INTO " . DB_PREFIX . "product SET model = '" . $data['ids'] . "', agent = '26', sku = '', upc = '', ean = '', lat_lng = '" . $data['location']['coordinate'] . "', jan = '', isbn = '', mpn = '',
                        location = '', quantity = '1', minimum = '1', subtract = '1', stock_status_id = '7', date_available = NOW(), manufacturer_id = '', shipping = '', price = " . (float)$data['prices']['value'] . ",
                        currency_id = " . $currency_id . ", points = '', weight = '', weight_class_id = '', length = '', width = '', height = '', length_class_id = '', status = '1', tax_class_id = '', sort_order = '',
                        date_added = NOW(), date_modified = NOW()");
                    
                $dbsql = $this->db->query($sql);
                
                if($dbsql){
                    $product_id = $this->getCurentId();
                }
                
                if($data['images']){
                    $checking_image = isset($data['images']['name'][0]) ? $data['images']['name'][0] : null;
                    
                    $image = 'data/imagexml/' . $data['images']['folder'] . '/' . $checking_image;
                    
                    $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $image . "' WHERE product_id = '" . (int)$product_id . "'");
                }
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '1', name = '" . $data['info']['title'] . "',
                                description = '" . $data['info']['description'] . "', meta_description = '', meta_keyword = '', seo_title = '" . $data['info']['title'] . "',
                                seo_h1 = '" . $data['info']['title'] . "', tag = ''");
                                
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '0'");
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '0', layout_id = '0'");
                
                if($data['images']){
                    foreach($data['images']['name'] as $key => $images){
                        $image = 'data/imagexml/' . $data['images']['folder'] . '/' . $images;
                        
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $image . "', sort_order = '" . $key . "'");
                    }
                }
                
                if($data['types'] || $data['location']['sub_locality_name']){
                    $sup_name = mb_convert_case($data['types'], MB_CASE_TITLE, "UTF-8");
                    
                    $search_cat = $this->db->query("SELECT category_id, name FROM " . DB_PREFIX . "category_description");
                    foreach($search_cat->rows as $cvalue){
                        if($sup_name == $cvalue['name']){
                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$cvalue['category_id'] . "', main_category = '" . (int)$cvalue['category_id'] . "'");
                        }                       
                    }
                }
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $data['ids'] . "'");
                
               
                $this->addOption($product_id, $data['options']);
                
            }

            $message_data[] = array(
                'id' => $data['ids'],
                'title' => $data['info']['title']
            );
        }
        
        return $message_data;
    }
    
    public function addOption($product_id, $options){
        //внесение названия опций которых нет в бд
        $option_exists = $this->getOption();
        
        $opt_exists = array();
        
        if(!empty($option_exists)){
            $opt_exists = $option_exists;
        }
        
        if($options){
            foreach($options as $option){
                if(!in_array($option['name'], $opt_exists)){
                    
                    $this->insertOptionName($option['name']);
                    
                    if($option['name'] == 'Мебель' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Мебель' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '-'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '+'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Наличие телефона' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Наличие телефона' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Водопровод' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Водопровод' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Интернет' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Интернет' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '-'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '+'){
                        $value = 'Да';
                    }else{
                        $value = $option['value'];
                    }

                    $option_id = $this->getOptionId($option['name']);

                    $this->insertProductOption($product_id, $option_id[0], $value);
                }
                
                if(in_array($option['name'], $opt_exists)){
                    if($option['name'] == 'Мебель' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Мебель' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '-'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '+'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Наличие телефона' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Наличие телефона' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Водопровод' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Водопровод' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Интернет' && $option['value'] == '0'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Интернет' && $option['value'] == '1'){
                        $value = 'Да';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '-'){
                        $value = 'Нет';
                    }elseif($option['name'] == 'Признак новостройки' && $option['value'] == '+'){
                        $value = 'Да';
                    }else{
                        $value = $option['value'];
                    }

                    $option_id = $this->getOptionId($option['name']);

                    $this->insertProductOption($product_id, $option_id[0], $value);       
                    //$this->insertOptionValue($option_id[0], $value);
                }
            }
        } 
    }
    
    public function insertOptionName($value){
        $dbsql = $this->db->query("INSERT INTO `" . DB_PREFIX . "option` SET type = 'text', sort_order = '0'");
                        
        if($dbsql){
            $option_id = $this->getCurentOptionId();
        }
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "option_description SET option_id = '" . (int)$option_id . "', language_id = '1', name = '" . $value . "'");
        
        return $option_id;
    }
    
    public function insertOptionValue($option_id, $value){
        $dbsql = $this->db->query("INSERT INTO " . DB_PREFIX . "option_value SET option_id = '" . (int)$option_id . "', image = 'no_image.jpg', sort_order = '0'");
        
        if($dbsql){
            $current_option_value_id = $this->getCurentOptionValueId();
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "option_value_description SET option_value_id = '" . (int)$current_option_value_id . "', language_id = '1', option_id = '" . (int)$option_id . "', name = '" . $value . "'");
    }
    
    public function insertProductOption($product_id, $option_id, $value){
        $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$option_id . "', option_value = '" . $value . "', required = '1', product_sort_option_id = '0'");		
    }

    //Model
    public function getModel($model_id){        
        $query = $this->db->query("SELECT model FROM " . DB_PREFIX . "product WHERE model = '" . (int)$model_id . "'");
            
        return $query->row;
    }
    
    //Model
    public function getCurentId(){      
        $query = $this->db->query("SELECT MAX(product_id) FROM  " . DB_PREFIX . "product");
                
        $curent_id = $query->row['MAX(product_id)'];
        
        $product_id = $curent_id;
        
        return $product_id;
    }

    public function getCurentOptionId(){
        $query = $this->db->query("SELECT MAX(option_id) FROM `" . DB_PREFIX . "option`");

        $curent_id = $query->row['MAX(option_id)'];
        
        $option_id = $curent_id;
        
        return $option_id;
    }
    
    public function getCurentOptionValueId(){ 
        $query = $this->db->query("SELECT MAX(option_value_id) FROM  " . DB_PREFIX . "option_value");
                
        $curent_id = $query->row['MAX(option_value_id)'];
        
        $option_value_id = $curent_id;
        
        return $option_value_id;
    }
    
    public function getCurentProductOptionId(){ 
        $query = $this->db->query("SELECT MAX(product_option_id) FROM  " . DB_PREFIX . "product_option");
                
        $curent_id = $query->row['MAX(product_option_id)'];
        
        $product_option_id = $curent_id;
        
        return $product_option_id;
    }
    
    public function getOption(){
        $search_opt = $this->db->query("SELECT option_id, name FROM " . DB_PREFIX . "option_description WHERE language_id = '1'");
        
        $options_exist = array();
        
        if($search_opt){
            foreach($search_opt->rows as $curent_opt){
                $options_exist[] = $curent_opt['name'];
            }
        }
        
        return $options_exist;
    }
    
    public function getOptionId($nameoption){
        $search_opt = $this->db->query("SELECT option_id, name FROM " . DB_PREFIX . "option_description WHERE language_id = '1' AND name = '" . $nameoption . "'");
        
        if($search_opt){
            foreach($search_opt->rows as $curent_opt){
                $options_exist[] = (int)$curent_opt['option_id'];
            }
        }
        
        return $options_exist;
    }
}