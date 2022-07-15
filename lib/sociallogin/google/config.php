<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
//session_start();

define('PROJECT_NAME', 'D$CMS');

/* make sure the url end with a trailing slash */
define("SITE_URL", "http://autorent-me.com");
/* the page where you will be redirected for authorzation */
define("REDIRECT_URL", "http://autorent-me.com/lib/sociallogin/google/google_login.php");

/* * ***** Google related activities start ** */
define("CLIENT_ID", "864181123090-qblc10pa0o4ldnbjsud8r6pl5s9dhmrj.apps.googleusercontent.com");
define("CLIENT_SECRET", "_-VLtEUSFeFOHyxxERb-kjsO");

/* permission */
define("SCOPE", 'https://www.googleapis.com/auth/userinfo.email ' .
	'https://www.googleapis.com/auth/userinfo.profile');

/* logout both from google and your site **/
//define("LOGOUT_URL", "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=". urlencode(SITE_URL."logout.php"));
/* * ***** Google related activities end ** */
?>
