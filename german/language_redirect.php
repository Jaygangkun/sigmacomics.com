<?php
$action = 'live'; //local //dev //live
define("__ROOT__",dirname(dirname(__FILE__))."/german");
if($action == 'local'){
	define("SITEURL_GERMAN",'http://localhost/sigma-comics/german');
	define("BASEURL_GERMAN",'/sigma-comics');
  }else if($action == 'dev'){
	define("SITEURL_GERMAN",'https://sigmacomics.com/german');
	define("BASEURL_GERMAN",'/sigma-comics');
  }else{
	define("SITEURL_GERMAN",'https://sigmacomics.com/german');
	define("BASEURL_GERMAN",'');
  }
?>