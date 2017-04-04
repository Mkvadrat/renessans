<?php
/**
* Controller for feedback module
*/
class ControllerModuleFeedback extends Controller {
	private $error = array();
	
	/**
	* @param array $setting
	* prepares values for feedback.tpl
	*/
	public function index($setting) {
		
		$this->data['i'] = $setting['id'];
		
		$this->language->load('module/feedback');
		
		$language_id = (int)$this->config->get('config_language_id');

		$this->data['setting'] = $setting;
			
		$this->load->model('catalog/category');
	
		$this->data['category_value'] = $this->model_catalog_category->getFeedBackCategory(20);
		
		$this->data['text_address'] = $this->language->get('text_address');
		$this->data['text_telephone'] = $this->language->get('text_telephone');
		$this->data['text_fax'] = $this->language->get('text_fax');
		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_phone'] = $this->language->get('entry_phone');
		$this->data['entry_email'] = $this->language->get('entry_email');

		$this->data['button_send_enquiry'] = $this->language->get('button_send_enquiry');
       
	    $this->data['action'] = HTTP_SERVER . 'index.php?route=module/feedback/feedback';
		$this->data['store'] = $this->config->get('config_name');
		$this->data['address'] = nl2br($this->config->get('config_address'));
		$this->data['telephone'] = $this->config->get('config_telephone');
		$this->data['fax'] = $this->config->get('config_fax');
		
		if (isset($this->request->post['wsf_name'])) {
			$this->data['name'] = $this->request->post['wsf_name'];
		} else {
			$this->data['name'] = '';
		}
		
		if (isset($this->request->post['wsf_phone'])) {
			$this->data['phone'] = $this->request->post['wsf_phone'];
		} else {
			$this->data['phone'] = '';
		}
		
		if (isset($this->request->post['wsf_email'])) {
			$this->data['email'] = $this->request->post['wsf_email'];
		} else {
			$this->data['email'] = '';
		}
		
		$this->id = 'webme_sidebar_feedback';
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/feedback.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/feedback.tpl';
		} else {
			$this->template = 'default/template/module/feedback.tpl';
		}
		
		$this->render();
	}

	
	public function feedback() {
		
		$this->language->load('module/feedback');
		
		if ($this->config->get('feedback_settings')) { 
			$settings = $this->config->get('feedback_settings');
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
			$mail_to = $this->config->get('config_email');
			$mail_to .= ', 3331141@gmail.com';
			
			$mail->setTo($mail_to);
			//$mail->setTo($this->config->get('config_email'));
			
			if (isset($this->request->post['wsf_email']) and !empty($this->request->post['wsf_email'])) {
				$mail->setFrom($this->request->post['wsf_email']);
			} else {
				$mail->setFrom($this->config->get('config_email'));
			}
			
			if (isset($this->request->post['wsf_name'])) {
				$setSender = $this->request->post['wsf_name'];
			} elseif (isset($this->request->post['wsf_email'])) {
				$setSender = $this->request->post['wsf_email'];
			} else {
				$setSender = 'Anonymous';
			}
			
			$mail->setSender($setSender);
			
			$mail->setSubject(sprintf($this->language->get('email_subject'), $setSender));
			
			$user_data = "";
			if (isset($this->request->post['wsf_name'])) {
				$user_data .= $this->language->get('entry_name')." ".$this->request->post['wsf_name']."\n";
			}
			if (isset($this->request->post['wsf_phone'])) {
				$user_data .= $this->language->get('entry_phone')." ".$this->request->post['wsf_phone']."\n";
			}
			if (isset($this->request->post['wsf_email'])) {
				$user_data .= $this->language->get('entry_email')." ".$this->request->post['wsf_email']."\n";
			}
			if (isset($this->request->post['wsf_enquiry'])) {
				$user_data .= "\n".$this->language->get('entry_enquiry')."\n";
				$enquiry = strip_tags(html_entity_decode($this->request->post['wsf_enquiry'], ENT_QUOTES, 'UTF-8'));
			} else {
				$enquiry = '';
			}
			
			$mail->setText($user_data.$enquiry);
			$mail->send();
			//$this->redirect($this->url->link('information/contact/success'));
			
			$output["success"] = "ok";
	    }
		
		echo json_encode($output);
	}
	
}
?>