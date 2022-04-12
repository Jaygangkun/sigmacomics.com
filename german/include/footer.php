<?php

//print_r($_SESSION);
	if (isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id'] != '' ){

	$sql = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' and `language` = 'de_DE' ";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_assoc();
		$total_quantity = (isset($row['total_quantity']))?$row['total_quantity']:'0';
	}

}else{
	$total_quantity = 0;
}
?>
	<!-- Footer Section Start -->
	<footer class="">
	<?php if($_SERVER['REQUEST_URI'] !=  constant("BASEURL").'/retailer-landing' && $_SERVER['REQUEST_URI'] != constant("BASEURL").'/cart-retail' && $_SERVER['REQUEST_URI'] != constant("BASEURL").'/checkout-retail'){ ?> 
	
		<div class="cartrightprt">
				<a href="<?php echo constant("SITEURL_GERMAN")?>/cart">
					<p><?php echo $total_quantity;?></p>
					<i class="fa fa-shopping-cart"></i>
				</a>

		</div>

	<?php } ?>
	</footer>
	<!-- Footer Section End -->

	<!-- Footer Copyright Section Start -->
	<div class="footer-copy-right-sec">
		<div class="container">
		<?php echo $contentMenu[6];?>
		</div>
	</div>
	<!-- Footer Copyright Section End -->