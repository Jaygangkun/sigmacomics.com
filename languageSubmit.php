<?php	
ob_start();
session_start();
require_once("inc/connections.php");					
	// Set Language variable
	if(isset($_REQUEST['lang']) && !empty($_REQUEST['lang'])){

		if(!empty($_REQUEST['lang'])){
			$param = explode('#@#',$_REQUEST['lang']);
			
			$lang = $param[0];
			$link = $param[1];
		}

		$_SESSION['lang'] = $lang;
		if(isset($_SESSION['lang']) && $_SESSION['lang'] == $lang){
			
			if ($_SESSION['lang'] != 'en_US'){
						//echo $link;exit();
					header('Location: '.$link);
					//header('Location: signup');
					exit();
			}else{
				header('Location: '.$link);
				exit();
			}		
		}else{
			header('Location: '.constant("SITEURL"));
			exit();
		}
}
?>