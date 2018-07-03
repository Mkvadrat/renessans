<?php
// HTTP
define('HTTP_SERVER', 'http://renessans-krim.location/');
define('HTTP_IMAGE', 'http://renessans-krim.location/image/');
define('HTTP_ADMIN', 'http://renessans-krim.location/admin/');

// HTTPS
define('HTTPS_SERVER', 'http://renessans-krim.location/');
define('HTTPS_IMAGE', 'http://renessans-krim.location/image/');
/*
// DIR
define('DIR_APPLICATION', 'C:\Server\domains\rc.seomax.loc\public_html/catalog/');
define('DIR_SYSTEM', 'C:\Server\domains\rc.seomax.loc\public_html/system/');
define('DIR_DATABASE', 'C:\Server\domains\rc.seomax.loc\public_html/system/database/');
define('DIR_LANGUAGE', 'C:\Server\domains\rc.seomax.loc\public_html/catalog/language/');
define('DIR_TEMPLATE', 'C:\Server\domains\rc.seomax.loc\public_html/catalog/view/theme/');
define('DIR_CONFIG', 'C:\Server\domains\rc.seomax.loc\public_html/system/config/');
define('DIR_IMAGE', 'C:\Server\domains\rc.seomax.loc\public_html/image/');
define('DIR_CACHE', 'C:\Server\domains\rc.seomax.loc\public_html/system/cache/');
define('DIR_DOWNLOAD', 'C:\Server\domains\rc.seomax.loc\public_html/download/');
define('DIR_LOGS', 'C:\Server\domains\rc.seomax.loc\public_html/system/logs/');
*/

/*Усовершенствованный конфиг*/
// DIR
define('DIR_APPLICATION', $_SERVER['DOCUMENT_ROOT']. '/catalog/');
define('DIR_SYSTEM', $_SERVER['DOCUMENT_ROOT']. '/system/');
define('DIR_DATABASE', $_SERVER['DOCUMENT_ROOT']. '/system/database/');
define('DIR_LANGUAGE', $_SERVER['DOCUMENT_ROOT']. '/catalog/language/');
define('DIR_TEMPLATE', $_SERVER['DOCUMENT_ROOT']. '/catalog/view/theme/');
define('DIR_CONFIG', $_SERVER['DOCUMENT_ROOT']. '/system/config/');
define('DIR_IMAGE', $_SERVER['DOCUMENT_ROOT']. '/image/');
define('DIR_CACHE', $_SERVER['DOCUMENT_ROOT']. '/system/cache/');
define('DIR_DOWNLOAD', $_SERVER['DOCUMENT_ROOT']. '/download/');
define('DIR_LOGS', $_SERVER['DOCUMENT_ROOT']. '/system/logs/');
define('DIR_SITEMAP', $_SERVER['DOCUMENT_ROOT']. '/sitemap/');
/*Усовершенствованный конфиг*/

// DB
define('DB_DRIVER', 'mysqliz');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1234');
define('DB_DATABASE', 'renessans');
define('DB_PREFIX', '');
?>