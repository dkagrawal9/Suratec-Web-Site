<?php
$config = include ('db.php');
require_once 'lang.php';
$dbHost = $config['host'];
$dbUser = $config['user'];
$dbPass = $config['password'];
$dbName = $config['dbname'];


$system_config = '1';

define('HEAD_LOGO_MINI', 'Suratec');
define('HEAD_LOGO', 'Suratec');
define('LOGO', '../img/nav-menu/logo.png');
define('TEXT_LOGO', 'Admin');
define('TITLE', 'Suratec');
// require_once 'connect.php'
define('CONTENT','CONTENT');
define('DESIGN', 'DESIGN');

define('GOOGLE_MAP_KEY', '');

define('e_mail', 'info@suratec.co.th');
define('pass_e_mail', 't!aw@5yU9Y!B');
define('from_e_mail', 'info@suratec.co.th');
define('Host_e_mail', 'mail.suratec.co.th');
define('link_e_mail', 'https://www.suratec.co.th/');
define('name_web_e_mail', 'www.suratec.co.th');


// time mathching
define('TIME_USER', 7);
define('TIME_SV_PHP', 0);
// $time_user = '7';
// $time_sv_php = '0';

//Set time zone-----------------------------
date_default_timezone_set("Asia/Bangkok");
$date_cre = new datetime();
$date = date_format($date_cre, 'Y-m-d H:i:s');
// $c_date->modify('+'.TIME_SV_PHP.' hour');
// $date = date_format($c_date, 'Y-m-d H:i:s');
//!-----------------------------------------

// reCAPTCHA
define('reCAPTCHA_CLIENT', '6LeyGL0UAAAAAPvipoLVvUCdBX-vPq6PP9qKjy_m');
define('reCAPTCHA_SERVER', '6LeyGL0UAAAAAAsl2VC-KboGCCB3kWJcSMnPewYm');

// ?>