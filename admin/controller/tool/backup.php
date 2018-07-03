<?php 
class ControllerToolBackup extends Controller { 
	private $error = array();
	
	public function index() {		
		$this->load->language('tool/backup');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/backup');
				
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->user->hasPermission('modify', 'tool/backup')) {
			if (is_uploaded_file($this->request->files['import']['tmp_name'])) {
				move_uploaded_file($this->request->files["import"]["tmp_name"], DIR_DUMP . $this->request->files["import"]["name"]);
				
				$content = DIR_DUMP . $this->request->files["import"]["name"];
			} else {
				$content = false;
			}
			
			if ($content) {
				$this->importer($content);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$this->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$filename = $this->remotedumper();
				
				$sfilename = $filename;
				
				$this->remoteimporter($sfilename);
				
				unlink($sfilename);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$this->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		
		$this->data['entry_restore'] = $this->language->get('entry_restore');
		$this->data['entry_backup'] = $this->language->get('entry_backup');
		 
		$this->data['button_backup'] = $this->language->get('button_backup');
		$this->data['button_restore'] = $this->language->get('button_restore');
		
		if (isset($this->session->data['error'])) {
    		$this->data['error_warning'] = $this->session->data['error'];
    
			unset($this->session->data['error']);
 		} elseif (isset($this->error['warning'])) {
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
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),     		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['restore'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['backup'] = $this->url->link('tool/backup/backup', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('tool/backup');
			
		$this->template = 'tool/backup.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function backup() {
		$this->load->language('tool/backup');
		
		if (!isset($this->request->post['backup'])) {
			$this->session->data['error'] = $this->language->get('error_backup');
			
			$this->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));
		} elseif ($this->user->hasPermission('modify', 'tool/backup')) {

			$backup = $this->dumper();
			
			if($backup){
				$this->file_force_download($backup);
				
				$this->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));			
			}
		} else {
			$this->session->data['error'] = $this->language->get('error_permission');
			
			$this->redirect($this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL'));			
		}
	}
	
	private function dumper(){
		include_once  DIR_SYSTEM . 'library/dumper/dumper.php';
			
		$world_dumper = Shuttle_Dumper::create(array(
			'host' => DB_HOSTNAME,
			'username' => DB_USERNAME,
			'password' => DB_PASSWORD,
			'db_name' => DB_DATABASE,		));
		// dump the database to plain text file
		//$world_dumper->dump('world.sql');
		
		// send the output to gziped file:
		$path = DIR_DUMP . date('Y-m-d_H-i-s', time()).'_backup.sql.gz';
		
		$return = $world_dumper->dump($path);
		
		return $path;
	}
	
    private function remotedumper(){
		include_once  DIR_SYSTEM . 'library/dumper/dumper.php';
			
		$world_dumper = Shuttle_Dumper::create(array(
			'host' => DB_HOSTNAME,
			'username' => DB_USERNAME,
			'password' => DB_PASSWORD,
			'db_name' => DB_DATABASE,		));
		// dump the database to plain text file
		//$world_dumper->dump('world.sql');
		
		// send the output to gziped file:
		$path = DIR_DUMP . date('Y-m-d_H-i-s', time()).'_backup.sql.gz';
		
		$return = $world_dumper->dump($path);
		
		return $path;
	}
	
	private function importer($file){
		include_once  DIR_SYSTEM . 'library/dumper/MySQLImport.php';
		
		$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		
		$import = new MySQLImport($db);
		$import->load($file);
	}
	
	private function remoteimporter($file){
		include_once  DIR_SYSTEM . 'library/dumper/MySQLImport.php';
		
		$db = new mysqli(RDB_HOSTNAME, RDB_USERNAME, RDB_PASSWORD, RDB_DATABASE);
		
		$import = new MySQLImport($db);
		$import->load($file);
	}
	
	private function file_force_download($file) {
		if (file_exists($file)) {
		  // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
		  // если этого не сделать файл будет читаться в память полностью!
		  if (ob_get_level()) {
			ob_end_clean();
		  }
		  // заставляем браузер показать окно сохранения файла
		  header('Content-Description: File Transfer');
		  header('Content-Type: application/octet-stream');
		  header('Content-Disposition: attachment; filename=' . basename($file));
		  header('Content-Transfer-Encoding: binary');
		  header('Expires: 0');
		  header('Cache-Control: must-revalidate');
		  header('Pragma: public');
		  header('Content-Length: ' . filesize($file));
		  // читаем файл и отправляем его пользователю
		  if ($fd = fopen($file, 'rb')) {
			while (!feof($fd)) {
			  print fread($fd, 1024);
			}
			fclose($fd);
		  }
		  exit;
		}
	}
}
?>