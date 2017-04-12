<?PHP  header("Content-Type: text/html; charset=utf-8");?>

<?php

/*
 * SimpleModal Contact Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: contact-dist.php 254 2010-07-23 05:14:44Z emartin24 $
 *
 */
   
//sql запрос в базу для почты

 // DB

include $_SERVER['DOCUMENT_ROOT'].'/config.php';

  $db = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);

  mysql_select_db(DB_DATABASE ,$db);

  $sql = mysql_query("SELECT `value` FROM" . DB_PREFIX . "`setting` WHERE `group` = 'config' AND `key` = 'config_email'" ,$db);

  while ($tablerows = mysql_fetch_row($sql))
  {
  $email = $tablerows[0];
  }


  mysql_close($db);

  
// User settings
$to = $email . ', 3331141@gmail.com';

// Include extra form fields and/or submitter data?
// false = do not include
$extra = array(
	"form_subject"	=> true,
	"form_cc"		=> false,
	"ip"			=> false,
	"user_agent"	=> false
);

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none'>
	<div class='contact-content'>
		<div class='contact-title'>ОБРАТНЫЙ ЗВОНОК:</div>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form action='#' style='display:none'>
			<input type='text' id='contact-name' class='contact-input' placeholder='Имя' name='name' tabindex='1001' />
			<input type='text' id='contact-email' class='contact-input' name='phone' placeholder='Номер телефона' tabindex='1002' />";

	if ($extra["form_subject"]) {
		$output .= "
			<label for='contact-subject'>Удобное для звонка время:</label>
			<input type='text' id='contact-subject' class='contact-input' placeholder='17:30 - 20:00' name='time' value='' tabindex='1003' />";
	}

	$output .= "
			<label for='contact-message'>Примечание:</label>
			<!--<input id='contact-message' class='contact-input' name='message' tabindex='1004' />-->
			<textarea id='contact-message' class='contact-input' name='message' tabindex='1004' /></textarea>
			<br/>";

	$output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>Заказать звонок</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Отменить</button>
			<br/>
			<input type='hidden' name='token' value='" . smcf_token($to) . "'/>
		</form>
	</div>
</div>";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$time = isset($_POST["time"]) ? $_POST["time"] : $time;
	$message = isset($_POST["message"]) ? $_POST["message"] : "";
	$cc = isset($_POST["cc"]) ? $_POST["cc"] : "";
	$token = isset($_POST["token"]) ? $_POST["token"] : "";

	// make sure the token matches
	if ($token === smcf_token($to)) {
		smcf_send($name, $phone, $time, $message, $cc);
		echo "Ваше сообщение успешно отослано.";
	}
	else {
		echo "Unfortunately, your message could not be verified.";
	}
}

function smcf_token($s) {
	return md5("smcf-" . $s . date("WY"));
}

// Validate and send email
function smcf_send($name, $phone, $time, $message, $cc) {
	global $to, $extra, $subject;

	// Filter and validate fields
	$name = $name;
	$time = $time;
	$subject = $name .' '.'-'.' '. "заказал обратный звонок!";
	$phone = $phone;
	
		$time .= "";
		$message .= "";
		$email = $to;
		$cc = 0; // do not CC "sender"
	

	// Add additional info to the message
	/*if ($extra["ip"]) {
		$message .= "\n\nIP: " . $_SERVER["REMOTE_ADDR"];
	}
	if ($extra["user_agent"]) {
		$message .= "\n\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
	}*/

	// Set and wordwrap message body
	$body .= "Имя отправителя: $name\n\n";
	$body .= "Телефон: $phone\n\n";
	$body .= "Удобное для звонка время: $time\n\n";
	$body .= "Примечание: $message";
	$body = wordwrap($body, 70);

	// Build header
	$email = $headers; 
	$headers = "From: $phone <$headers\n>";
	if ($cc == 1) {
		$headers .= "Cc: $name\n";
	}
	$headers .= "X-Mailer: PHP/SimpleModalContactForm";

	// UTF-8
	//if (function_exists('mb_encode_mimeheader')) {
	//	$subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
	//}
    
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/plain; charset=utf-8\n";
	$headers .= "Content-Transfer-Encoding: quoted-printable\n";

	// Send email
	@mail($to, $subject, $body, $headers) or 
		die("Unfortunately, a server issue prevented delivery of your message.");
}

// Remove any un-safe values to prevent email injection
function smcf_filter($value) {
	$pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
	$value = preg_replace($pattern, "", $value);
	return $value;
}



exit;

?>