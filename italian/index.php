<?php
$action = 'live'; //local //dev //live

if($action == 'local'){
    define("SITEURL",'http://localhost/sigma-comics');
    define("BASEURL",'/sigma-comics');
  }else if($action == 'dev'){
    define("SITEURL",'https://sigmacomics.com');
    define("BASEURL",'/sigma-comics');
  }else{
    define("SITEURL",'https://sigmacomics.com');
    define("BASEURL",'');
  }

header('Location: '.constant("SITEURL"));
exit();
?>