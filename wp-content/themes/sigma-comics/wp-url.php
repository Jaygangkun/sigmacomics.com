<?php
$action = 'live'; //local //dev //live
$language_wp = $_SESSION['lang'];

if($action == 'local'){

  switch($language_wp){
    case  "es_ES":
      define("SITEURL",'http://localhost/sigma-comics/spanish');
    default:
      define("SITEURL",'http://localhost/sigma-comics');
  }
  
}else if($action == 'dev'){

  switch($language_wp){
    case  "es_ES":
      define("SITEURL",'http://ogmaprojects.com/sigma-comics/spanish');
    default:
      define("SITEURL",'http://ogmaprojects.com/sigma-comics');
  }
}else if($action == 'live'){
  
  switch($language_wp){
    case  "es_ES":
      define("SITEURL",'http://sigmacomics.com/spanish');
    default:
      define("SITEURL",'https://sigmacomics.com');
  }
  
}


