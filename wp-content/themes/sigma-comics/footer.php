<!-- Footer Section Start -->

		

		<?php 
			if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'en_US' ){
		?>
		<footer class="main-footer">
		<div class="container">
			<div class="ftr-row">

			<div class="ftr-logo-clmn">
			<?php
			if ( is_active_sidebar( 'footer-english' ) ) : 
					dynamic_sidebar('footer-english');
			endif;
			?>
			</div>

			<div class="ftr-menu-clmn">
				<h2>Quick Link</h2>
			
				<?php
					wp_nav_menu( array(
						'theme_location'	 => 'footer',
						'menu_class'		 => ''
					));
				?>
			</div>

			<div class="ftr-newsLetter-clmn">
				<h2>Get Updates!</h2>
				<form method="post" action="https://www.aweber.com/scripts/addlead.pl">
				<ul class="ftr-news-letter">
					
					<li><input type="hidden" name="listname" value="awlist5764531" /></li>
					<!--<input type="hidden" name="redirect" value="http://www.example.com/thankyou.htm" />-->
					<li><input type="hidden" name="meta_adtracking" value="custom form" /></li>
					<li><input type="hidden" name="meta_message" value="1" /></li> 
					<li><input type="hidden" name="meta_required" value="name,email" /></li> 
					<li><input type="hidden" name="meta_forward_vars" value="1" /> </li>
					<li><input type="hidden" name="name"value="Sigma Comics"></li>
					<li><input type="text" name="email" placeholder="Type your email address" required></li>
					<li><button type="submit">Submit</button></li>
				

				</ul>
				</form>
				<?php if ( is_active_sidebar( 'header-footer-social-link' ) ) : 
					dynamic_sidebar('header-footer-social-link');
			 endif; ?>
			</div>
			</div>
			</div>
		</footer>
		<?php
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'es_ES' ){
				if ( is_active_sidebar( 'footer-spanish' ) ) : 
					dynamic_sidebar('footer-spanish');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'fr_FR' ){
				if ( is_active_sidebar( 'footer-french' ) ) : 
					dynamic_sidebar('footer-french');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'de_DE' ){
				if ( is_active_sidebar( 'footer-german' ) ) : 
					dynamic_sidebar('footer-german');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'ja_JA' ){
				if ( is_active_sidebar( 'footer-japanese' ) ) : 
					dynamic_sidebar('footer-japanese');
			 	endif;
			}else if( isset($_SESSION['lang']) && $_SESSION['lang'] == 'it_IT' ){
				if ( is_active_sidebar( 'footer-italian' ) ) : 
					dynamic_sidebar('footer-italian');
			 	endif;
			}else{
			?>
				<footer class="main-footer">
				<div class="container">
					<div class="ftr-row">

						<div class="ftr-logo-clmn">
						<?php
						if ( is_active_sidebar( 'footer-english' ) ) : 
								dynamic_sidebar('footer-english');
						endif;
						?>
						</div>

						<div class="ftr-menu-clmn">
							<h2>Quick Link</h2>
						
							<?php
								wp_nav_menu( array(
									'theme_location'	 => 'footer',
									'menu_class'		 => ''
								));
							?>
						</div>

						<div class="ftr-newsLetter-clmn">
							<h2>Get Updates!</h2>
							<form method="post" action="https://www.aweber.com/scripts/addlead.pl">
							<ul class="ftr-news-letter">
								
								<li><input type="hidden" name="listname" value="awlist5764531" /></li>
								<!--<input type="hidden" name="redirect" value="http://www.example.com/thankyou.htm" />-->
								<li><input type="hidden" name="meta_adtracking" value="custom form" /></li>
								<li><input type="hidden" name="meta_message" value="1" /></li> 
								<li><input type="hidden" name="meta_required" value="name,email" /></li> 
								<li><input type="hidden" name="meta_forward_vars" value="1" /> </li>
								<li><input type="hidden" name="name"value="Sigma Comics"></li>
								<li><input type="text" name="email" placeholder="Type your email address" required></li>
								<li><button type="submit">Submit</button></li>
							

							</ul>
							</form>
							<?php if ( is_active_sidebar( 'header-footer-social-link' ) ) : 
								dynamic_sidebar('header-footer-social-link');
						endif; ?>
						</div>
			</div>
			</div>
		</footer>

		<?php
			}	
		?>

			
			
			
			
		
<!-- Footer Section End -->

<!-- Footer Copyright Section Start -->
<div class="footer-copy-right-sec">
	<div class="container">
	<?php
					wp_nav_menu( array(
						'theme_location'	 => 'footer-copyright',
						'menu_class'		 => 'ftr-copyRight-menu'
					));
	?>
		<!--<ul class="ftr-copyRight-menu">
			<li><a href="#">TERMS</a></li>
			<li><a href="#">CONTACT</a></li>
			<li><a href="#">PRIVACY POLICY</a></li>
			<li><a href="#">CARRY OUR COMICS</a></li>
		</ul>-->
		<?php if ( is_active_sidebar( 'footer-copyright-text' ) ) : 
					dynamic_sidebar('footer-copyright-text');
			 endif; ?>
	</div>
</div>
<!-- Footer Copyright Section End -->

<!-- JS Start here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<!-- Bootstrap JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<!-- Owl Carousel JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<!-- Portfolio JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/isotope.pkgd.min.js"></script>
<!-- Custome js -->
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
<?php wp_footer(); ?>
</body>
</html>