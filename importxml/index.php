<?php 
    header('Content-Type: text/html; charset=utf-8');
    
    require_once 'parse.php'; 

	$new_send = new Parse();
	
	$new_send->xml = "http://renessans-krim.loc/importxml/import/yrlsite.xml";
    
	$new_send->getParse();
?>