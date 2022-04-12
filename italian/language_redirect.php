<?php
$action = 'live'; //local //dev //live
define("__ROOT__",dirname(dirname(__FILE__))."/italian");
if($action == 'local'){
	define("SITEURL_ITALIAN",'http://localhost/sigma-comics/italian');
	define("BASEURL_ITALIAN",'/sigma-comics');
  }else if($action == 'dev'){
	define("SITEURL_ITALIAN",'https://sigmacomics.com/italian');
	define("SITEURL_ITALIAN",'/sigma-comics');
  }else{
	define("SITEURL_ITALIAN",'https://sigmacomics.com/italian');
	define("BASEURL_ITALIAN",'');
  }
?>