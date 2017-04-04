<?php 
class ControllerInformationContact extends Controller {
	private $error = array(); 
	    
  	public function index() {
		$this->language->load('information/contact');

    	$this->document->setTitle($this->language->get('heading_title'));  
	 
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

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/contact'),
        	'separator' => $this->language->get('text_separator')
      	);	
			
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
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');

		if (isset($this->error['name'])) {
    		$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
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
		
 		if (isset($this->error['captcha'])) {
			$this->data['error_captcha'] = $this->error['captcha'];
		} else {
			$this->data['error_captcha'] = '';
		}	

    	$this->data['button_continue'] = $this->language->get('button_continue');
    
		$this->data['action'] = $this->url->link('information/contact');
		$this->data['store'] = $this->config->get('config_name');
    	$this->data['address'] = nl2br($this->config->get('config_address'));
    	$this->data['telephone'] = $this->config->get('config_telephone');
    	$this->data['fax'] = $this->config->get('config_fax');
    	
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} else {
			$this->data['name'] = $this->customer->getFirstName();
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
		
		if (isset($this->request->post['captcha'])) {
			$this->data['captcha'] = $this->request->post['captcha'];
		} else {
			$this->data['captcha'] = '';
		}		
		
	    //Feedback module
		
		$this->language->load('module/feedback');
		
		$language_id = (int)$this->config->get('config_language_id');

		$this->load->model('catalog/category');
	
		$this->data['category_value'] = $this->model_catalog_category->getFeedBackCategory(94);
		
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

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/contact.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/contact.tpl';
		} else {
			$this->template = 'default/template/information/contact.tpl';
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
		$this->language->load('information/contact');

		$this->document->setTitle($this->language->get('heading_title')); 

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/contact'),
        	'separator' => $this->language->get('text_separator')
      	);	
		
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_message'] = $this->language->get('text_message');

    	$this->data['button_continue'] = $this->language->get('button_continue');

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

    	if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
      		$this->error['enquiry'] = $this->language->get('error_enquiry');
    	}

    	if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
  	}

	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}

    public function agent() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $response = array(
                'status' => 0,
                'message' => ''
            );

            try {
                if (empty($_POST['firstname'])) {
                    throw new Exception('Укажите ваше имя');
                }
                $firstname = strip_tags($_POST['firstname']);

                if (empty($_POST['secondname'])) {
                    throw new Exception('Укажите вашу фамилию');
                }
                $secondname = strip_tags($_POST['secondname']);

                if (empty($_POST['phone'])) {
                    throw new Exception('Укажите ваш телефон');
                }
                $phone = strip_tags($_POST['phone']);

                if (empty($_POST['email'])) {
                    throw new Exception('Укажите ваш email');
                }
                if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $_POST['email'])) {
                    throw new Exception('Некорректный email');
                }
                $email = strip_tags($_POST['email']);

                if (empty($_POST['text'])) {
                    throw new Exception('Напишите ваше сообщение');
                }
                $text = strip_tags($_POST['text']);

                if (empty($_POST['user_id'])) {
                    throw new Exception('Пользователь не найден');
                }
                $user_id = intval($_POST['user_id']);

                $this->load->model('catalog/product');
                $agent = $this->model_catalog_product->Agent($user_id);

                if (empty($agent)) {
                    throw new Exception('Пользователь не найден');
                }

                if (empty($agent['email'])) {
                    $agent['email'] = $this->config->get('config_email');
                } else {
                    $agent['email'] .= ', '.$this->config->get('config_email');
                }

                $agent['email'] .= ', 3331141@gmail.com';

                $body = '';
                $body .= 'Имя: '.$firstname."\r\n";
                $body .= 'Фамилия: '.$secondname."\r\n";
                $body .= 'Телефон: '.$phone."\r\n";
                $body .= 'Email: '.$email."\r\n";
                $body .= 'Сообщение: '."\r\n";
                $body .= $text."\r\n";
                $body .= "\r\n";
                $body .= 'Отправлено для риелтора: '.$agent['firstname'].' '.$agent['lastname']."\r\n";

                $mail = new Mail();
                $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->hostname = $this->config->get('config_smtp_host');
                $mail->username = $this->config->get('config_smtp_username');
                $mail->password = $this->config->get('config_smtp_password');
                $mail->port = $this->config->get('config_smtp_port');
                $mail->timeout = $this->config->get('config_smtp_timeout');

                $mail->setTo($agent['email']);
                $mail->setFrom($email);
                $mail->setSender($secondname.' '.$firstname);
                $mail->setSubject('Сообщение для риелтора');
                $mail->setText($body);
                $mail->send();

                $response = array(
                    'status' => 1,
                    'message' => 'Ваше сообщение отправлено'
                );
            } catch(Exception $e) {
                $response = array(
                    'status' => 0,
                    'message' => $e->getMessage()
                );
            }

            $this->response->setOutput(json_encode($response));
        }
    }

    public function page() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $response = array(
                'status' => 0,
                'message' => ''
            );

            try {
                if (empty($_POST['phone']) && empty($_POST['email'])) {
                    throw new Exception('Укажите ваш Email или телефон');
                }
                if (empty($_POST['name'])) {
                    $name = '-';
                } else {
                    $name = strip_tags($_POST['name']);
                }

                if (empty($_POST['phone'])) {
                    $phone = '-';
                } else {
                    $phone = strip_tags($_POST['phone']);
                }

                if (empty($_POST['email'])) {
                    $email = '-';
                } else if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $_POST['email'])) {
                    throw new Exception('Некорректный email');
                } else {
                    $email = strip_tags($_POST['email']);
                }

                if (empty($_POST['text'])) {
                    throw new Exception('Напишите ваше сообщение');
                }
                $text = strip_tags($_POST['text']);

                $to = $this->config->get('config_email') . ', 3331141@gmail.com';
                $from = 'noreply@'.$_SERVER['HTTP_HOST'];
                $from_name = $_SERVER['HTTP_HOST'];

                $body = '';
                $body .= 'Имя: '.$name."\r\n";
                $body .= 'Телефон: '.$phone."\r\n";
                $body .= 'Email: '.$email."\r\n";
                $body .= 'Сообщение: '."\r\n";
                $body .= $text."\r\n";
                $body .= "\r\n";

                $mail = new Mail();
                $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->hostname = $this->config->get('config_smtp_host');
                $mail->username = $this->config->get('config_smtp_username');
                $mail->password = $this->config->get('config_smtp_password');
                $mail->port = $this->config->get('config_smtp_port');
                $mail->timeout = $this->config->get('config_smtp_timeout');

                $mail->setTo($to);
                $mail->setFrom($from);
                $mail->setSender($from_name);
                $mail->setSubject('Обратная связь');
                $mail->setText($body);
                $mail->send();

                $response = array(
                    'status' => 1,
                    'message' => 'Ваше сообщение отправлено'
                );
            } catch(Exception $e) {
                $response = array(
                    'status' => 0,
                    'message' => $e->getMessage()
                );
            }

            $this->response->setOutput(json_encode($response));
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
			//$mail->setTo($this->config->get('config_email'));
			$mail_to = $this->config->get('config_email');
			$mail_to .= ', 3331141@gmail.com';
			
			$mail->setTo($mail_to);
			
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
