<?php 
/*if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'es_ES' ) {
	header('Location: '.constant("SITEURL_FRENCH").$_SERVER['PHP_SELF']);
	exit();
}*/

/*$sqlAll = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field-spanish' and `post_status`= 'publish' ";*/

/*$sqlAll = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 69 ORDER BY `ID` ASC ";*/

$sqlAll = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 69 ORDER BY `ID` ASC ";

if ($resultAll = $conn->query($sqlAll)) {
	$i = 0; 
	while($rowAll = $resultAll->fetch_assoc()){
		$content[$i] = $rowAll['post_content'];
		$i++;
	}
	//echo '<pre>';print_r($content);
}

$sqlMenu = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'menu-links' and `post_status`= 'publish' ";

if ($resultMenuAll = $conn->query($sqlMenu)) {
	$i = 0; 
	while($rowMenuAll = $resultMenuAll->fetch_assoc()){
		$contentMenu[$i] = $rowMenuAll['post_content'];
		$i++;
	}
	//echo '<pre>';print_r($contentMenu);exit();
}


?>
<header class="main-header">
		<!-- Top Logo Header -->
		<div class="top-logo-hdr">
			<div class="container">
				<div class="logo-hdr-row">
					<div class="hdr-search">
						<ul class="social-media-icon">
							<li class="hdr-get-update">Get Updates!</li>
							<li><a href="https://fb.me/sigmacomicsgroup"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/sigma_comics"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://www.instagram.com/sigma_comics"><i class="fa fa-instagram"></i></a></li>
							<li><a href="https://www.pinterest.com/sigmacomics"><i class="fa fa-pinterest-p"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UCwcqy5ELbZ1k8jnjy7cwtIQ/"><i class="fa fa-youtube-play"></i></a></li>
				
						</ul>
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
					
					<div class="hdr-logo">
						<?php echo (isset($content[35]))?$content[35]:'' ;?>
					</div>

					<div class="hdr-login-btn">
						<?php if( isset($_SESSION['user'])){ ?>  
							<!--<div class="hdr-login"><a href="<?php echo constant("SITEURL")."/digital-dashboard";?> ">Hello.. User</a></div>-->
							<div class="hdr-login"><a href="<?php echo constant("SITEURL_FRENCH")."/logout.php";?> ">Logout</a></div>
						<?php }else{ ?> 
							<div class="hdr-login"><a href="<?php echo constant("SITEURL_FRENCH")."/login";?>">Login</a></div>
						<?php } ?>
						<?php 
						
						if( isset($_SERVER) ){
							$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$param = explode(constant("SITEURL_FRENCH"),$actual_link);
						?>

						<?php
						}
						?>

						<select name='lang' onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
							<option value='<?php echo constant("SITEURL");?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en_US'){ echo "selected"; } ?> >English</option>
							<option value='<?php echo constant("SITEURL").'/spanish/calico-3';?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'es_ES'){ echo "selected"; } ?> >Spanish</option>
							<option value='<?php echo constant("SITEURL").'/french/calico-2';?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'fr_FR'){ echo "selected"; } ?> >French</option>
							<option value='<?php echo constant("SITEURL").'/german/calico-4';?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'de_DE'){ echo "selected"; } ?> >German</option>
							<option value='<?php echo constant("SITEURL").'/japanese/calico-5';?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ja_JA'){ echo "selected"; } ?> >Japanese</option>
							<option value='<?php echo constant("SITEURL").'/italian/calico-6';?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'it_IT'){ echo "selected"; } ?> >Italian</option>
						</select>

						<script>
						function changeLang(){
							document.getElementById('form_lang').submit();
						}
						</script>
						
					</div>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span></span><span></span><span></span><span></span>
					</button>
					
				</div>
			</div>
		</div>

		<!-- Menu Header -->
		<div class="menu-header">
			<div class="container">
				<nav class="navbar navbar-light navbar-expand-lg">
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<?php echo $contentMenu[3];?>
					</div>
				</nav>
			</div>
		</div>

	</header>