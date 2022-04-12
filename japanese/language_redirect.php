<?php
$action = 'live'; //local //dev //live
define("__ROOT__",dirname(dirname(__FILE__))."/japanese");
if($action == 'local'){
	define("SITEURL_JAPANESE",'http://localhost/sigma-comics/japanese');
	define("BASEURL_JAPANESE",'/sigma-comics');
  }else if($action == 'dev'){
	define("SITEURL_JAPANESE",'https://sigmacomics.com/japanese');
	define("BASEURL_JAPANESE",'/sigma-comics');
  }else{
	define("SITEURL_JAPANESE",'https://sigmacomics.com/japanese');
	define("BASEURL_JAPANESE",'');
  }
?>