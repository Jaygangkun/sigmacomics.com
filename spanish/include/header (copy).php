<?php 
if(!isset($_SESSION['lang']) && $_SESSION['lang'] == '' ) {
	header('Location: '.constant("SITEURL"));
	exit();
}

$sqlAll = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field-spanish' and `post_status`= 'publish' ";
if ($resultAll = $conn->query($sqlAll)) {
	$i = 0; 
	while($rowAll = $resultAll->fetch_assoc()){
		$content[$i] = $rowAll['post_content'];
		$i++;
	}
	//echo '<pre>';print_r($content);
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
							<div class="hdr-login"><a href="<?php echo constant("SITEURL")."/digital-dashboard";?> ">Hello.. User</a></div>
							<div class="hdr-login"><a href="<?php echo constant("SITEURL")."/logout.php";?> ">Logout</a></div>
						<?php }else{ ?> 
							<div class="hdr-login"><a href="<?php echo constant("SITEURL_SPANISH")."/login";?>">Login</a></div>
						<?php } ?>
						<?php 
						
						if( isset($_SERVER) ){
							$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$param = explode(constant("SITEURL_SPANISH"),$actual_link);
						?>

						<?php
						}
						?>
						<form method='post' action='<?php echo constant("SITEURL");?>/languageSubmit.php' id='form_lang' >
							<select name='lang' onchange='changeLang();' >
							<option value='en_US#@#<?php echo constant("SITEURL").$param[1];?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en_US'){ echo "selected"; } ?> >English</option>
							<option value='es_ES#@#<?php echo constant("SITEURL").'/spanish'.$param[1];?>' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'es_ES'){ echo "selected"; } ?> >Spanish</option>
							</select>
						</form>

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
						<ul class="navbar-nav mr-auto">
						<?php
							$sqlHeader = "SELECT p.post_title, p.post_name, p.menu_order, pm.meta_value FROM wp_posts AS p LEFT JOIN wp_term_relationships AS tr ON tr.object_id = p.ID LEFT JOIN wp_term_taxonomy AS tt ON tt.term_taxonomy_id = tr.term_taxonomy_id INNER JOIN wp_postmeta AS pm ON p.Id = pm.post_id WHERE p.post_type = 'nav_menu_item' AND tt.term_id = 10 AND pm.meta_key = '_menu_item_url' AND p.post_title  != '' order by  p.menu_order asc ;";

						if ($result = $conn->query($sqlHeader)) {
							while($row = $result->fetch_assoc()){
						?> 
						<li <?php echo ($row['meta_value'] == 'https://sigmacomics.com/order-issues/')?'class="menu-red"':''?> ><a href="<?php echo $row['meta_value']; ?>"><?php echo $row['post_title']; ?></a></li>
						<?php
							}
						}
						?>
						</ul>
					</div>
				</nav>
			</div>
		</div>

	</header>