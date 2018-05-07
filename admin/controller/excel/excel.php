<?php
class ControllerExcelExcel extends Controller {
	public function index() {
		$this->load->language('excel/excel');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		//len
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		//text
		$this->data['text_button'] = $this->language->get('text_button');
		
		//button
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_excel'] = $this->language->get('button_excel');
		
		//breadcrumbs		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('excel/excel', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->export();

			$this->redirect($this->url->link('excel/excel', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['action'] = $this->url->link('excel/excel', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];
						 				
		$this->template = 'excel/excel.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function export(){
		$this->load->model('excel/excel');
		
		$this->load->model('localisation/currency');
		
		$products = array();
		
		$data = $this->model_excel_excel->getProducts();

		foreach($data as $result){
			$agent_data = $this->model_excel_excel->Agent($result['agent']);
			
			$category_data = $this->model_excel_excel->getCategory($result['product_id']);
			
			$options_data = $this->model_excel_excel->getProductOptions($result['product_id']);
			
			$kitchen = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Площадь кухни (м²)'){
					$kitchen = $options_array['option_value'];
				}
			}
			
			if(!empty($kitchen)){
				$kitchen_n_e = $kitchen;
			}else{
				$kitchen_n_e = '';
			}
			
			$area_rooms = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Площадь комнат (м²)'){
					$area_rooms = $options_array['option_value'];
				}
			}
			
			if(!empty($area_rooms)){
				$area_rooms_n_e = $area_rooms;
			}else{
				$area_rooms_n_e = '';
			}
			
			$live = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Жилая площадь (м²)'){
					$live = $options_array['option_value'];
				}
			}
			
			if(!empty($live)){
				$live_n_e = $live;
			}else{
				$live_n_e = '';
			}
			
			$total = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Жилая площадь (м²)'){
					$total = $options_array['option_value'];
				}
			}
			
			if(!empty($total)){
				$total_n_e = $total;
			}else{
				$total_n_e = '';
			}
			
			$type = array();
			$types = array();
			
			foreach($options_data as $options_array){
				foreach($category_data as $category){
					if($options_array['name'] == 'Тип недвижимости'){
						$type = $options_array['option_value'];
					}
					if(in_array('Квартиры', $category)){
						$types = 'Квартира';
					}
					if(in_array('Дома', $category)){
						$types = 'Дома';
					}
					if(in_array('Апартаменты', $category)){
						$types = 'Апартаменты';
					}
					if(in_array('Номер', $category)){
						$types = 'Номер';
					}
					if(in_array('Коммерческая недвижимость', $category)){
						$types = 'Коммерческая недвижимость';
					}
					if(in_array('Земельные участки', $category)){
						$types = 'Земельные участки';
					}
				}
			}
			
			if(!empty($type)){
				$type_building = $type;
			}elseif(!empty($types)){
				$type_building = $types;
			}else{
				$type_building = '';
			}
				
			$district = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Район'){
					$district = $options_array['option_value'];
				}
			}
			
			if(!empty($district)){
				$district_n_e = $district;
			}else{
				$district_n_e = '';
			}
			
			$street = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Улица'){
					$street = $options_array['option_value'];
				}
			}
			
			if(!empty($street)){
				$street_n_e = $street;
			}else{
				$street_n_e = '';
			}
			
			$rooms = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Количество комнат'){
					$rooms = $options_array['option_value'];
				}
			}
			
			if(!empty($rooms)){
				$rooms_n_e = $rooms;
			}else{
				$rooms_n_e = '';
			}
			
			$floor = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Этаж'){
					$floor = $options_array['option_value'];
				}
			}
			
			if(!empty($floor)){
				$floor_n_e = $floor;
			}else{
				$floor_n_e = '';
			}
			
			$storeys = array();
			
			foreach($options_data as $options_array){
				if($options_array['name'] == 'Этажность'){
					$storeys = $options_array['option_value'];
				}
			}
			
			if(!empty($storeys)){
				$storeys_n_e = $storeys;
			}else{
				$storeys_n_e = '';
			}
			
			if($result['currency_id'] == 1){
				$currency = 'RUB';
			}else{
				$currency = 'USD';
			}
			
			if($result['status'] == 1){
				$status = 'Включен';
			}else{
				$status = 'Выключен';
			}
			
			if(!empty($agent_data['lastname'])){
				$agent = $agent_data['lastname'] . ' ' . $agent_data['firstname'];
			}elseif(!empty($agent_data['firstname'])){
				$agent = $agent_data['firstname'];
			}else{
				$agent = '';
			}

			$products[] = array(
				'product_id'    => $result['product_id'],
				'model'	        => $result['model'],
				'date_modified' => $this->normalizeDate($result['date_modified']),
				'type'          => $type_building,
				'street'        => html_entity_decode($street_n_e, ENT_QUOTES, "UTF-8"),
				'district'      => $district_n_e,
				'rooms'			=> $rooms_n_e,
				'floor'		    => $floor_n_e,
				'storeys'       => $storeys_n_e,
				'kitchen'       => $kitchen_n_e,
				'area_rooms'    => $area_rooms_n_e,
				'live'          => $live_n_e,
				'total'			=> $total_n_e,
				'price'         => $this->currency->format($result['price']) . ' ' . $currency,
				'agent'         => $agent,
				'status'		=> $status
			);
		}
		

		date_default_timezone_set('Europe/London');
		if (PHP_SAPI == 'cli') die('This example should only be run from a Web Browser');
		require_once(DIR_SYSTEM . '/library/phpexcel/Classes/PHPExcel.php');
		require_once(DIR_SYSTEM . '/library/phpexcel/Classes/PHPExcel/Writer/Excel2007.php');
		// Создаем объект класса PHPExcel
		$xls = new PHPExcel();
		// Устанавливаем индекс активного листа
		$xls->setActiveSheetIndex(0);
		// Получаем активный лист
		$sheet = $xls->getActiveSheet();

		$rowNumber = 2; 
		$col_A = 'A';
		$col_B = 'B';
		$col_C = 'C';
		$col_D = 'D';
		$col_E = 'E';
		$col_F = 'F';
		$col_G = 'G';
		$col_H = 'H';
		$col_I = 'I';
		$col_J = 'J';
		$col_K = 'K';
		$col_L = 'L';
		$col_M = 'M';
		$col_N = 'N';
		$col_O = 'O';
		$col_P = 'P';
		
		foreach($products as $product){
			
			//Стили
			$sheet->getColumnDimension('A')->setWidth(15);
			$sheet->getStyle('A')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('B')->setWidth(20);
			$sheet->getStyle('B')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('C')->setWidth(20);
			$sheet->getStyle('C')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('D')->setWidth(18);
			$sheet->getStyle('D')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('E')->setWidth(20);
			$sheet->getStyle('E')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('F')->setWidth(15);
			$sheet->getStyle('F')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('G')->setWidth(20);
			$sheet->getStyle('G')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('H')->setWidth(20);
			$sheet->getStyle('H')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('I')->setWidth(20);
			$sheet->getStyle('I')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('J')->setWidth(20);
			$sheet->getStyle('J')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('K')->setWidth(20);
			$sheet->getStyle('K')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('L')->setWidth(20);
			$sheet->getStyle('L')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('M')->setWidth(20);
			$sheet->getStyle('M')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('N')->setWidth(20);
			$sheet->getStyle('N')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('O')->setWidth(20);
			$sheet->getStyle('O')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getColumnDimension('P')->setWidth(20);
			$sheet->getStyle('P')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			
			$sheet->getStyle($col_A.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_B.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_C.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_D.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_E.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_F.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_G.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_H.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_I.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_J.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_K.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_L.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_M.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_N.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_O.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$sheet->getStyle($col_P.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			
			//Шапка
			$sheet->setCellValue('A1', 'Код (или порядковый номер)');
			$sheet->setCellValue('B1', 'Дата подачи объекта в рекламу');
			$sheet->setCellValue('C1', 'Объект (квартира, комната, дом, участок)');
			$sheet->setCellValue('D1', 'Адрес объекта');
			$sheet->setCellValue('E1', 'Район (Балаклавский/Нахимоский/Ленинский/Гагаринский)');
			$sheet->setCellValue('F1', 'Кол-во комнат');
			$sheet->setCellValue('G1', 'Этаж');
			$sheet->setCellValue('H1', 'Этажность');
			$sheet->setCellValue('I1', 'Площадь кухни (м²)');
			$sheet->setCellValue('J1', 'Площадь комнат (м²)');
			$sheet->setCellValue('K1', 'Жилая площадь (м²)');
			$sheet->setCellValue('L1', 'Общая площадь (м²)');
			$sheet->setCellValue('M1', 'Стоимость объекта');
			$sheet->setCellValue('N1', 'Сотрудник');
			$sheet->setCellValue('O1', 'Статус');
			$sheet->setCellValue('P1', 'Комментарий');
			
			$sheet->setCellValue($col_A.$rowNumber, $product['model']);
			$sheet->setCellValue($col_B.$rowNumber, $product['date_modified']);
			$sheet->setCellValue($col_C.$rowNumber, $product['type']);
			$sheet->setCellValue($col_D.$rowNumber, $product['street']);
			$sheet->setCellValue($col_E.$rowNumber, $product['district']);
			$sheet->setCellValue($col_F.$rowNumber, $product['rooms']);
			$sheet->setCellValue($col_G.$rowNumber, $product['floor']);
			$sheet->setCellValue($col_H.$rowNumber, $product['storeys']);
			$sheet->setCellValue($col_I.$rowNumber, $product['kitchen']);
			$sheet->setCellValue($col_J.$rowNumber, $product['area_rooms']);
			$sheet->setCellValue($col_K.$rowNumber, $product['live']);
			$sheet->setCellValue($col_L.$rowNumber, $product['total']);
			$sheet->setCellValue($col_M.$rowNumber, $product['price']);
			$sheet->setCellValue($col_N.$rowNumber, $product['agent']);
			$sheet->setCellValue($col_O.$rowNumber, $product['status']);

			$rowNumber++;
		}
		
		// Выводим HTTP-заголовки
		header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
		header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
		header ( "Cache-Control: no-cache, must-revalidate" );
		header ( "Pragma: no-cache" );
		header ( "Content-type: application/vnd.ms-excel" );
		header ( "Content-Disposition: attachment; filename=list-object-'" . $this->generate_value(7) . "'.xls" );
		
	   // Выводим содержимое файла
		$objWriter = new PHPExcel_Writer_Excel5($xls);
		$objWriter->save('php://output');
	}
	
	private function normalizeDate($date){
		$ex = explode(" ", $date);
		$date = explode("-", $ex[0]); 
		$time = explode(":", $ex[1]); 
		//$timestamp = mktime($time['0'], $time['1'], $time['2'], $date['1'], $date['2'], $date['0']);
		return $date = $date['2'] . '.' . $date['1'] . '.' . $date['0'];
		//return date("d F Y", $timestamp);
	}
	
	private function generate_value($number){
		$arr = array('a','b','c','d','e','f',
					 'g','h','i','j','k','l',
					 'm','n','o','p','r','s',
					 't','u','v','x','y','z',
					 'A','B','C','D','E','F',
					 'G','H','I','J','K','L',
					 'M','N','O','P','R','S',
					 'T','U','V','X','Y','Z',
					 '1','2','3','4','5','6',
					 '7','8','9','0'
		);
		
		// Генерируем пароль
		$pass = "";
		
		for($i = 0; $i < $number; $i++){
		  // Вычисляем случайный индекс массива
		  $index = rand(0, count($arr) - 1);
		  $pass .= $arr[$index];
		}
		
		return $pass;
	}
}