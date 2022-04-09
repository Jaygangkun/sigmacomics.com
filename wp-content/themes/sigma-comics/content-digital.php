<?php
require_once("wp-url.php");

$shopify_product_id = get_field('shopify_product_id'); 

$orderArr = $wpdb->get_results("SELECT * FROM `orders` where `user_id`= '".$_SESSION['user']['id']."' AND FIND_IN_SET ($shopify_product_id, `shopify_product_ids`) "); 

if(!empty($orderArr)){
    the_content();
}else{
    $orderArr = $wpdb->get_results("SELECT * FROM `orders` where `user_id`= '".$_SESSION['user']['id']."' AND FIND_IN_SET ('DS', `types`) "); 
    //print_r($orderArr);
    if(!empty($orderArr)){
        the_content();
    }else{
        
    }
}

?>
		