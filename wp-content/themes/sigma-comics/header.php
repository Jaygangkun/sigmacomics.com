<?php 
ob_start();
session_start();
$action = 'live'; // local, dev, live

$_SESSION['lang'] = get_locale();
$language_wp = $_SESSION['lang'];

if($action == 'local'){
 
	if($language_wp == 'es_ES'){
		define("SITEURL_WP",'http://localhost/sigma-comics/spanish');
	}else if($language_wp == 'fr_FR'){
		define("SITEURL_WP",'http://localhost/sigma-comics/french');
	}else if($language_wp == 'de_DE'){
		define("SITEURL_WP",'http://localhost/sigma-comics/german');
	}else if($language_wp == 'ja_JA'){
		define("SITEURL_WP",'http://localhost/sigma-comics/japanese');
	}else if($language_wp == 'it_IT'){
		define("SITEURL_WP",'http://localhost/sigma-comics/italian');
	}else{
		define("SITEURL_WP",'http://localhost/sigma-comics');
	}

}else if($action == 'dev'){	

	if($language_wp == 'es_ES'){
		define("SITEURL_WP",'http://ogmaprojects.com/sigma-comics/spanish');
	}else if($language_wp == 'fr_FR'){
		define("SITEURL_WP",'http://ogmaprojects.com/sigma-comics/french');
	}else if($language_wp == 'de_DE'){
		define("SITEURL_WP",'http://ogmaprojects.com/sigma-comics/german');
	}else if($language_wp == 'ja_JA'){
		define("SITEURL_WP",'http://ogmaprojects.com/sigma-comics/japanese');
	}else if($language_wp == 'it_IT'){
		define("SITEURL_WP",'http://ogmaprojects.com/sigma-comics/italian');
	}else{
		define("SITEURL_WP",'http://ogmaprojects.com/sigma-comics');
	}

}else if($action == 'live'){
  
	if($language_wp == 'es_ES'){
		define("SITEURL_WP",'http://sigmacomics.com/spanish');
	}else if($language_wp == 'fr_FR'){
		define("SITEURL_WP",'http://sigmacomics.com/french');
	}else if($language_wp == 'de_DE'){
		define("SITEURL_WP",'http://sigmacomics.com/german');
	}else if($language_wp == 'ja_JA'){
		define("SITEURL_WP",'http://sigmacomics.com/japanese');
	}else if($language_wp == 'it_IT'){
		define("SITEURL_WP",'http://sigmacomics.com/italian');
	}else{
		define("SITEURL_WP",'https://sigmacomics.com');
	}
  
}


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
<!-- Bootstrap -->
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
<!-- Owl Carousel -->
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.min.css" rel="stylesheet">
<!-- Responsive CSS -->
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" rel="stylesheet">
<!-- Font Link -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">

<?php wp_head(); ?>
</head>
<body>
<!-- Header Section Start -->
<header class="main-header">

<!-- Top Logo Header -->
<div class="top-logo-hdr">
	<div class="container">
		<div class="logo-hdr-row">
			<div class="hdr-search">
			<?php if ( is_active_sidebar( 'header-footer-social-link' ) ) : 
					dynamic_sidebar('header-footer-social-link');
			 endif; ?>
				<form method="post" action="https://www.aweber.com/scripts/addlead.pl">
				<div class="hdr-newsLetter">
				
					<input type="hidden" name="listname" value="awlist5764531" />
					<!--<input type="hidden" name="redirect" value="http://www.example.com/thankyou.htm" />-->
					<input type="hidden" name="meta_adtracking" value="custom form" />
					<input type="hidden" name="meta_message" value="1" /> 
					<input type="hidden" name="meta_required" value="name,email" /> 
					<input type="hidden" name="meta_forward_vars" value="1" /> 
					<input type="hidden" name="name"value="Sigma Comics">
					<input type="text" name="email" placeholder="Type your email address" required>
					<button type="submit">Submit</button>
				
				</div>
				</form>
			</div>
			
			<?php 
			if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'en_US' ){
				if ( is_active_sidebar( 'header-english' ) ) : 
					dynamic_sidebar('header-english');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'es_ES' ){
				if ( is_active_sidebar( 'header-spanish' ) ) : 
					dynamic_sidebar('header-spanish');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'fr_FR' ){
				if ( is_active_sidebar( 'header-french' ) ) : 
					dynamic_sidebar('header-french');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'de_DE' ){
				if ( is_active_sidebar( 'header-german' ) ) : 
					dynamic_sidebar('header-german');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'ja_JA' ){
				if ( is_active_sidebar( 'header-japanese' ) ) : 
					dynamic_sidebar('header-japanese');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'it_IT' ){
				if ( is_active_sidebar( 'header-italian' ) ) : 
					dynamic_sidebar('header-italian');
			 	endif;
			}else{
				if ( is_active_sidebar( 'header-english' ) ) : 
					dynamic_sidebar('header-english');
			 	endif;
			}
			
			?>
			
			<div class="hdr-login-btn">
						<?php if( isset($_SESSION['user'])){ ?>  
							<!--<div class="hdr-login"><a href="<?php echo constant("SITEURL")."/digital-dashboard";?> ">Hello.. User</a></div>-->
							<div class="hdr-login"><a href="<?php echo constant("SITEURL_WP")."/logout.php";?> ">Logout</a></div>
						<?php }else{ ?> 
							<div class="hdr-login"><a href="<?php echo constant("SITEURL_WP")."/login";?>">Login</a></div>
						<?php } ?>
						
						<?php pll_the_languages( array( 'dropdown' => 1,'force_home' => 1  ) ); ?>						
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span></span><span></span><span></span><span></span>
			</button>
		</div>
	</div>
</div>

<?php
if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'en_US' ){
	$menuClass = '';
}else{
	$menuClass = 'lang-adj';
}

?>
<!-- Menu Header -->
<div class="menu-header">
	<div class="container">
		<nav class="navbar navbar-light navbar-expand-lg">
				<?php
					wp_nav_menu( array(
						'theme_location'	 => 'top',
						'depth'				 => 3,
						'container'			 => 'div',
						'container_id'	 	 => 'navbarSupportedContent',
						'container_class'	 => 'navbar-collapse',
						'menu_class'		 => 'navbar-nav '.$menuClass )
					);
				?>
		</nav>
	</div>

	
</div>

</header>
<!-- Header Section End -->