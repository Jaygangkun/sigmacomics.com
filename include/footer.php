<?php

//print_r($_SESSION);
	if (isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id'] != '' ){

	$sql = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' and `language` = 'en_US' ";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_assoc();
		$total_quantity = (isset($row['total_quantity']))?$row['total_quantity']:'0';
	}

}else{
	$total_quantity = 0;
}
?>
	<!-- Footer Section Start -->
	<footer class="main-footer">
	<?php if($_SERVER['REQUEST_URI'] !=  constant("BASEURL").'/retailer-landing' && $_SERVER['REQUEST_URI'] != constant("BASEURL").'/cart-retail' && $_SERVER['REQUEST_URI'] != constant("BASEURL").'/checkout-retail'){ ?> 
	
		<div class="cartrightprt">
				<a href="<?php echo constant("SITEURL")?>/cart">
					<p><?php echo $total_quantity;?></p>
					<i class="fa fa-shopping-cart"></i>
				</a>

		</div>

	<?php } ?>
	
		<div class="container">
			<div class="ftr-row">
				<div class="ftr-logo-clmn">
					<figure><img src="images/sigma-comics-small.jpg" alt=""></figure>
					<p>Humans have superheroes. Animals don’t. While humans may be destroying our planet, they aren't on
						the verge of extinction.</p>
				</div>

				
				<div class="ftr-menu-clmn">
					<h2>Quick Link</h2>
					<ul>
					<?php
							$sqlHeader = "SELECT p.post_title, p.post_name, p.menu_order, pm.meta_value FROM wp_posts AS p LEFT JOIN wp_term_relationships AS tr ON tr.object_id = p.ID LEFT JOIN wp_term_taxonomy AS tt ON tt.term_taxonomy_id = tr.term_taxonomy_id INNER JOIN wp_postmeta AS pm ON p.Id = pm.post_id WHERE p.post_type = 'nav_menu_item' AND tt.term_id = 13 AND pm.meta_key = '_menu_item_url' AND p.post_title  != '' order by  p.menu_order asc ;";

						if ($result = $conn->query($sqlHeader)) {
							while($row = $result->fetch_assoc()){
						?> 
						<li><a href="<?php echo $row['meta_value']; ?>"><?php echo $row['post_title']; ?></a></li>
					<?php
						}
					}
					?>
					</ul>
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
					<ul class="social-media-icon">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
						<li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
						
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Section End -->

	<!-- Footer Copyright Section Start -->
	<div class="footer-copy-right-sec">
		<div class="container">
			<ul class="ftr-copyRight-menu">

					<?php
							$sqlHeader = "SELECT p.post_title, p.post_name, p.menu_order, pm.meta_value FROM wp_posts AS p LEFT JOIN wp_term_relationships AS tr ON tr.object_id = p.ID LEFT JOIN wp_term_taxonomy AS tt ON tt.term_taxonomy_id = tr.term_taxonomy_id INNER JOIN wp_postmeta AS pm ON p.Id = pm.post_id WHERE p.post_type = 'nav_menu_item' AND tt.term_id = 14 AND pm.meta_key = '_menu_item_url' AND p.post_title  != '' order by  p.menu_order asc ;";

						if ($result = $conn->query($sqlHeader)) {
							while($row = $result->fetch_assoc()){
						?> 
						<li><a href="<?php echo $row['meta_value']; ?>"><?php echo $row['post_title']; ?></a></li>
					<?php
						}
					}
					?>

				<!--<li><a href="https://sigmacomics.com/carry-our-comics/">CARRY OUR COMICS</a></li>
				<li><a href="https://sigmacomics.com/advertise/">ADVERTISE</a></li>
				<li><a href="https://sigmacomics.com/terms-and-conditions/">TERMS</a></li>
				<li><a href="https://sigmacomics.com/privacy-policy/">PRIVACY POLICY</a></li>
				<li><a href="https://sigmacomics.com/contact/">CONTACTS</a></li>-->
			</ul>
			<p class="ftr-copyRight">Copyright &copy; <?php echo date('Y');?> sigma comics. LLC. All rights reserved.</p>
		</div>
	</div>
	<!-- Footer Copyright Section End -->