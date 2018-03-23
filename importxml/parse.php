<?php
class Parse{
  public $xml;

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

//Controller
public function getParse(){
  $data = array();
  $ids = array();
  $types = array();
  $location = array();
  $agents = array();
  $prices = array();
  $images = array();
  $info = array();
  $options = array();
  
  if(@fopen($this->xml, "r")) {
    $items = $this->file_get_contents_curl($this->xml);
    
    foreach($items->offer as $item ){
      if($item{'internal-id'}){
        $internal_id = json_decode( json_encode($item{'internal-id'}) , 1);
        
        foreach($internal_id as $id){
          $ids = $id;
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
          $localitys = json_decode( json_encode($obj_info->{'locality-name'}) , 1);
          $sub_localitys = json_decode( json_encode($obj_info->{'sub-locality-name'}) , 1);

          foreach($localitys as $locality){
            $locality_name = $locality;
          }
          
          foreach($sub_localitys as $sub_locality){
            $sub_locality_name = $sub_locality;
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
          $names = json_decode( json_encode($agent->{'name'}) , 1);
          $phones = json_decode( json_encode($agent->{'phone'}) , 1);
          $emails = json_decode( json_encode($agent->{'email'}) , 1);
          
          foreach($names as $ag_name){
            $name = $ag_name;
          }
          
          foreach($phones as $ag_phone){
            $phone = $ag_phone;
          }
          
          foreach($emails as $ag_email){
            $email = $ag_email;
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
          $currencys = json_decode( json_encode($price->{'currency'}) , 1);
          $values = json_decode( json_encode($price->{'value'}) , 1);
          $periods = json_decode( json_encode($price->{'period'}) , 1);
  
          foreach($currencys as $ob_currency){
            $currency = $ob_currency;
          }
          
          foreach($values as $ob_value){
            $value = $ob_value;
          }
          
         foreach($periods as $ob_period){
            $period = $ob_period;
          }
          
          $prices = array(
            'currency' => $currency,
            'value'  => $value,
            'period' => $period,
          );
        }
      }
      
      if($item->{'image'} && $internal_id){
        
        include_once  'lib/WideImage.php';
        
        foreach($item->{'image'} as $image){
          $obj_to_array = json_decode( json_encode($image) , 1);
        
          foreach($obj_to_array as $link){
            
            $image_name = basename($link);
            
            foreach($internal_id as $id){
              $dir = __DIR__ . '/image/' . $id . '/';
              
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
              
              $images[] = array(
                'link' => 'importxml/image/'. $id . $image_name
              );
              
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
      if($item->{'deal-status'}){
        $deals_status = json_decode( json_encode($item->{'deal-status'}) , 1);
        foreach($deals_status as $deal_status){
          $deal_status = ['Тип сделки' => $deal_status]; ;
        }
      }
      
      if($item->{'room-furniture'}){
        $rooms_furniture = json_decode( json_encode($item->{'room-furniture'}) , 1);
        foreach($rooms_furniture as $room_furniture){
          $room_furniture = ['Наличие мебели' => $room_furniture]; ;
        }
      }
      
      if($item->{'bathroom-unit'}){
        $bathrooms_unit = json_decode( json_encode($item->{'bathroom-unit'}) , 1);
        foreach($bathrooms_unit as $bathroom_unit){
          $bathroom_unit = ['Тип санузла' => $bathroom_unit]; ;
        }
      }
    
      if($item->{'renovation'}){
        $renovations = json_decode( json_encode($item->{'renovation'}) , 1);
        foreach($renovations as $renovation){
          $renovation = ['Ремонт' => $renovation]; ;
        }
      }
      
      if($item->{'rooms'}){
        $rooms_vl = json_decode( json_encode($item->{'rooms'}) , 1);
        foreach($rooms_vl as $rooms){
          $rooms = ['Общее количество комнат в квартире' => $rooms]; ;
        }
      }
      
      if($item->{'floor'}){
        $floors = json_decode( json_encode($item->{'floor'}) , 1);
        foreach($floors as $floor){
          $floor = ['Этаж' => $floor]; ;
        }
      }
      
      if($item->{'floors-total'}){
        $floors_totals = json_decode( json_encode($item->{'floors-total'}) , 1);
        foreach($floors_totals as $floors_total){
          $floors_total = ['Общее количество этажей в доме' => $floors_total]; ;
        }
      }
      
      if($item->{'area'}){
        $areas = json_decode( json_encode($item->{'area'}) , 1);
        
        $value = $areas['value'] ? $areas['value'] : null;
        $unit = $areas['unit'] ? $areas['unit'] : null;
       
        $area = ['Общая площадь' => $value . $unit];
      }
      
      if($item->{'living-space'}){
        $living_spaces = json_decode( json_encode($item->{'living-space'}) , 1);
        
        $value = $living_spaces['value'] ? $living_spaces['value'] : null;
        $unit = $living_spaces['unit'] ? $living_spaces['unit'] : null;
       
        $living_space = ['Жилая площадь' => $value . $unit];
      }
      
      if($item->{'kitchen-space'}){
        $kitchen_spaces = json_decode( json_encode($item->{'kitchen-space'}) , 1);
        
        $value = $kitchen_spaces['value'] ? $kitchen_spaces['value'] : null;
        $unit = $kitchen_spaces['unit'] ? $kitchen_spaces['unit'] : null;
       
        $kitchen_space = ['Площадь кухни' => $value . $unit];
      }
      
      if($item->{'kitchen-space'}){
        $kitchen_spaces = json_decode( json_encode($item->{'kitchen-space'}) , 1);
        
        $value = $kitchen_spaces['value'] ? $kitchen_spaces['value'] : null;
        $unit = $kitchen_spaces['unit'] ? $kitchen_spaces['unit'] : null;
       
        $kitchen_space = ['Площадь кухни' => $value . $unit];
      }
      
      if($item->{'phone'}){
        $phones = json_decode( json_encode($item->{'phone'}) , 1);
        foreach($phones as $phone){
          $phone = ['Наличие телефона' => $phone]; ;
        }
      }
      
      if($item->{'balcony'}){
        $balconys = json_decode( json_encode($item->{'balcony'}) , 1);
        foreach($balconys as $balcony){
          $balcony = ['Тип балкона' => $balcony]; ;
        }
      }
      
      if($item->{'building-type'}){
        $building_types = json_decode( json_encode($item->{'building-type'}) , 1);
        foreach($building_types as $building_type){
          $building_type = ['Тип дома' => $building_type]; ;
        }
      }
      
      if($item->{'water-supply'}){
        $water_supplys = json_decode( json_encode($item->{'water-supply'}) , 1);
        foreach($water_supplys as $water_supply){
          $water_supply = ['Водопровод' => $water_supply]; ;
        }
      }
      
      if($item->{'internet'}){
        $internets = json_decode( json_encode($item->{'internet'}) , 1);
        foreach($internets as $internet){
          $internet = ['Наличие интернета' => $internet]; ;
        }
      }
      
      if($item->{'new-flat'}){
        $new_flats = json_decode( json_encode($item->{'new-flat'}) , 1);
        foreach($new_flats as $new_flat){
          $new_flat = ['Признак новостройки' => $new_flat]; ;
        }
      }
      
      if($item->{'agent-fee'}){
        $agent_feeds = json_decode( json_encode($item->{'agent-fee'}) , 1);
        foreach($agent_feeds as $ob_agent_feed){
          $agent_feed = ['Комиссия агента' => $ob_agent_feed];
        }
      }
        
      if($item->{'commission'}){
        $commissions = json_decode( json_encode($item->{'commission'}) , 1);
        foreach($commissions as $ob_commission){
          $commission = ['Комиссия' => $ob_commission]; ;
        }
      }
 
      $options[] = array(
        'deal_status' => $deal_status,
        'room_furniture' => $room_furniture,
        'bathroom_unit' => $bathroom_unit,
        'renovation' => $renovation,
        'rooms' => $rooms,
        'floor' => $floor,
        'floors_total' => $floors_total,
        'area' => $area,
        'kitchen_space' => $kitchen_space,
        'living_space' => $living_space,
        'phone' => $phone,
        'balcony' => $balcony,
        'building_type' => $building_type,
        'water_supply' => $water_supply,
        'internet' => $internet,
        'agent_feed' => $agent_feed,
        'commission' => $commission
      );
 
      $data[] = array(
        'ids' => $ids, 
        'types' => $types,
        'location' => $location, 
        'agents' => $agents,  
        'prices' => $prices, 
        'images' => $images, 
        'info' => $info,
        'options' => $options
      );
    }

  }else{
    echo "Отсутствует файл!";
  }
  
}
  
}











