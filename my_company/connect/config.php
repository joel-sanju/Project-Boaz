<?php

ini_set("default-charset", "UTF-8");


define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'my_company');




// Site Settings
$base_url_glob =  (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')? 'https://'  : 'http://';
$base_url_glob .=  $_SERVER['HTTP_HOST'].'/my_company';   //Remove   .'/real_esate' if not in  subfolder
//$base_url_glob .=  $_SERVER['HTTP_HOST'];


define('glob_version', '1.0'); 
define('glob_site_name', 'Example Site'); 
define('glob_site_url', $base_url_glob); 

define('glob_site_url_fd', 'example.com');  // example.com









//SMTP  Email Settings

define('smtp_secure', 'ssl');  //'tls';
define('smtp_port', '465');   //587;
define('smtp_host', 'example.com');
define('smtp_username', 'info@example.com');
define('smtp_password', 'Dnnsn8899');



date_default_timezone_set("America/Toronto");

