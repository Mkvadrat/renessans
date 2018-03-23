<?php
class ModelParseParse extends Model {
    //Model
    public function addObject($data){   
        
        $message_data = array();
        
        $option_exists = $this->getOption();
        
        foreach($data as $data){
          
            $existing_model = $this->getModel($data['ids']);

            if(!in_array($data['ids'], $existing_model) && $data['ids']){
                
                /*if($data['prices']['currency'] == 'RUB'){
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
                    foreach($data['images'] as $image){
                        $checking_image = isset($image[0]) ? $image[0] : null;
                        
                        $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $checking_image . "' WHERE product_id = '" . (int)$product_id . "'");
                    }
                }
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '1', name = '" . $data['info']['title'] . "',
                                description = '" . $data['info']['description'] . "', meta_description = '', meta_keyword = '', seo_title = '" . $data['info']['title'] . "',
                                seo_h1 = '" . $data['info']['title'] . "', tag = ''");
                                
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '0'");
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '0', layout_id = '0'");
                
                if($data['images']){
                    foreach($data['images'] as $key => $images){
                        foreach($images as  $image){
                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $image . "', sort_order = '" . $key . "'");
                        }
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
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $data['ids'] . "'");*/
                
                
                //внесение названия опций которых нет в бд
                if($data['options'][0]){
                    foreach($data['options'][0] as $options){
                        if($options){
                            if(!in_array($options['name'], $option_exists)){
                                var_dump($options['name']);
                                
                                /*if(is_array($array)){
                                $datas = array_unique($array);
                                var_dump($datas);
                                }*/
                                
                                
                                /*$dbsql = $this->db->query("INSERT INTO `" . DB_PREFIX . "option` SET type = 'text', sort_order = '0'");
                                
                                if($dbsql){
                                    $option_id = $this->getCurentOptionId();
                                }
                                
                                $this->db->query("INSERT INTO " . DB_PREFIX . "option_description SET option_id = '" . (int)$option_id . "', language_id = '1', name = '" . $options['name'] . "'");*/
                            }
                        }
                    }
                }
                
                
                
                /*if($data['options'][0]){
                    foreach($data['options'][0] as $options){
                        if($options){
                            foreach($search_opt->rows as $name_opt){
                                
                                if($name_opt['name'] == $options['name']){
                                    //var_dump($options['name']);
                                }else{
                                    //var_dump($options['name']);
                                }
                                
                                $dbsql = $this->db->query("INSERT INTO `" . DB_PREFIX . "option` SET type = 'text', sort_order = '0'");
                                
                                if($dbsql){
                                    $option_id = $this->getCurentOptionId();
                                }
                                
                                $this->db->query("INSERT INTO " . DB_PREFIX . "option_description SET option_id = '" . (int)$option_id . "', language_id = '1', name = '" . $options['name'] . "'");
                            }
                            
                            if(!array_search($name_opt['name'], $options)){
                            
                                var_dump($options['name']);
                           
                            
                            }
                       
                           
                        }
                        
                       
                    }
                    
                   
                    
                }*/
                
                
            }
            
               
                

                
             
                
                /*$message_data[] = array(
                    'id' => $object['id'],
                    'title' => $object['title']
                );*/
                
                //$model_id = $object['id'];

        }
        

        
        
        
        return $message_data;
    }

    public function addOption($options){
        $i=0;
        foreach($options as $nameoption => $valueoption){
            $i++;
            $name = $this->getNameOption($nameoption);
            
            //if($nameoption != $name){
            
            $sql = ("INSERT INTO " . DB_PREFIX . "ocfilter_option SET status = '1', sort_order = '" . (int)$i . "', type = 'select', grouping = '0', selectbox = '0', color = '0', image = '0'");
            
            $dbsql = $this->db->query($sql);
            
            if($dbsql){
                $option_id = $this->getCurentOptionId();
            }
            
            $this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_description SET option_id = '" . (int)$option_id . "', language_id = '1', name = '" . $nameoption . "', description = '', postfix = ''");
            
            $this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_to_store SET option_id = '" . (int)$option_id . "', store_id = '0'");
            
            $this->db->query("UPDATE " . DB_PREFIX . "ocfilter_option SET `keyword` = '" . $this->translit($nameoption) . "' WHERE option_id = '" . (int)$option_id . "'");

            //Значения опций
            $sql = ("INSERT INTO " . DB_PREFIX . "ocfilter_option_value SET option_id = '" . (int)$option_id . "', sort_order = '" . (int)$i . "', `keyword` = '" . $this->translit($valueoption) . "', parse_keyword = '" . $this->translit($nameoption) . "', color = '', image = ''");

            $dbsql = $this->db->query($sql);
            
            if($dbsql){
              $value_id = $this->getCurentOptionValueId();
            }
            
            $this->db->query("INSERT INTO " . DB_PREFIX . "ocfilter_option_value_description SET value_id = '" . $value_id . "', option_id = '" . (int)$option_id . "', language_id = '1', name = '" . $valueoption . "'");

            //}
        }
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
    
    public function getOption(){
        $search_opt = $this->db->query("SELECT option_id, name FROM " . DB_PREFIX . "option_description WHERE language_id = '1'");
        
        if($search_opt){
            foreach($search_opt->rows as $curent_opt){
                $options_exist[] = $curent_opt['name'];
            }
        }
        
        return $options_exist;
        
    }

    public function getCurentOptionValueId(){ 
        $query = $this->db->query("SELECT MAX(value_id) FROM  " . DB_PREFIX . "ocfilter_option_value");
                
        $curent_id = $query->row['MAX(value_id)'];
        
        $value_id = $curent_id;
        
        return $value_id;
    }

    public function getNameOption($noption){
        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "ocfilter_option_description WHERE name = '" . $noption . "'");
                
        $name = $query->row;
        
        return $name;
    }

    public function translit($string) {
        $replace = array(
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'ґ' => 'g',
            'д' => 'd',
            'е' => 'e',
            'є' => 'je',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'і' => 'i',
            'ї' => 'ji',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'ts',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ъ' => '',
            'ы' => 'y',
            'ь' => '',
            'э' => 'e',
            'ю' => 'ju',
            'я' => 'ja',
            
            ' ' => '-',
            '+' => 'plus'
        );
        
        $string = mb_strtolower($string, 'UTF-8');
        $string = strtr($string, $replace);
        $string = preg_replace('![^a-zа-яёйъ0-9]+!isu', '-', $string);
        $string = preg_replace('!\-{2,}!si', '-', $string);
        
        return $string;
    }
}