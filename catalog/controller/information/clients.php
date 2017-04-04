<?php 
class ControllerInformationClients extends Controller {
	private $error = array(); 
	    
  	public function index() {
		
		$this->language->load('information/clients');
		
		$this->data['action'] = HTTP_SERVER . 'index.php?route=module/feedback/feedback';
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo($this->config->get('config_email'));
	  		$mail->setFrom($this->request->post['email']);
	  		$mail->setSender($this->request->post['name']);
	  		$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
	  		$mail->setText(strip_tags(html_entity_decode($this->request->post['enquiry'], ENT_QUOTES, 'UTF-8')));
      		$mail->send();

	  		$this->redirect($this->url->link('information/contact/success'));
    	}
			
    	$this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['phone_number_one'] = $this->config->get('config_telephone_number_one');
        $this->data['phone_number_two'] = $this->config->get('config_telephone_number_two');
        $this->data['phone_mobile'] = $this->config->get('config_telephone_mobile');
        $this->data['address'] = $this->config->get('config_address');  
        $this->data['email'] =  $this->config->get('config_email');  
    	$this->data['text_location'] = $this->language->get('text_location');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['text_address'] = $this->language->get('text_address');
    	$this->data['text_telephone'] = $this->language->get('text_telephone');
    	$this->data['text_fax'] = $this->language->get('text_fax');

    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');

		if (isset($this->error['name'])) {
    		$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		
		if (isset($this->error['phone'])) {
    		$this->data['error_phone'] = $this->error['phone'];
		} else {
			$this->data['error_phone'] = '';
		}
		
		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}		
		
		if (isset($this->error['enquiry'])) {
			$this->data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$this->data['error_enquiry'] = '';
		}		
		
    	$this->data['button_continue'] = $this->language->get('button_continue');
    
		//$this->data['action'] = $this->url->link('information/clients');
		$this->data['store'] = $this->config->get('config_name');
    	$this->data['address'] = nl2br($this->config->get('config_address'));
    	$this->data['telephone'] = $this->config->get('config_telephone');
    	$this->data['fax'] = $this->config->get('config_fax');
    	
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} else {
			$this->data['name'] = $this->customer->getFirstName();
		}
		
		if (isset($this->request->post['phone'])) {
			$this->data['phone'] = $this->request->post['phone'];
		} else {
			$this->data['phone'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = $this->customer->getEmail();
		}
		
		if (isset($this->request->post['enquiry'])) {
			$this->data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$this->data['enquiry'] = '';
		}
		
	
		
		
		
		
		
		
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/clients.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/clients.tpl';
		} else {
			$this->template = 'default/template/information/clients.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
				
 		$this->response->setOutput($this->render());		
  	}
	
	public function success() {
    	$this->data['continue'] = $this->url->link('common/home');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
				
 		$this->response->setOutput($this->render()); 
	}
	
	private function validate() {
    	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}
		
		if(!preg_match("/^[0-9]{10,10}+$/", $this->request->post['phone'])){
			$this->error['phone'] = $this->language->get('error_phone');	
		}

    	if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
      		$this->error['enquiry'] = $this->language->get('error_enquiry');
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
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
			$mail->setTo($this->config->get('config_email'));
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
			$this->redirect($this->url->link('information/contact/success'));
	    }
	}
}
?>
