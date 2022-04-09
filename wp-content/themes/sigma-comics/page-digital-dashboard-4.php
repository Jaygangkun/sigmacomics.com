<?php
get_header();
//require_once("wp-url.php");

if(!isset($_SESSION['user']) && $_SESSION['user']== ''){
	header( 'Location:'. constant("SITEURL").'/german/digital-dashboard-login-4');
	exit();
}


global $wp;
$url = explode('/',home_url( $wp->request ));
$slug = end($url);

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args_cat = array(
  'posts_per_page'   => 100,
  'category_name'    => 'german',
  'orderby'          => 'date',
  'order'            => 'ASC',
  'include'          => '',
  'exclude'          => '',
  'meta_key'         => '',
  'meta_value'       => '',
  'post_type'        => 'digital-issue',
  'post_mime_type'   => '',
  'post_parent'      => '',
  'author'     		 => '',
  'post_status'      => 'publish',
  'paged' 			=> $paged,
  'suppress_filters' => true
);
$args_cat = new WP_Query( $args_cat );
?>

<section class="inner-page-body-sec news-page-body">
	<div class="container">
  <div class="hdn">
  <?php 
    
    $postid = get_the_ID(); 
    $post = get_post( $postid, ARRAY_A );

    echo do_shortcode($post['post_content']);
    
?>  
  
			<!--<p class="boldTxt"><?php //echo $slug;?></p>-->
  </div>

  <div class="inr-latest-news">
			<ul class="txtMiddle">
<?php
if( !empty($args_cat) ){
  
  $orderArr = $wpdb->get_results("SELECT * FROM `orders` where `user_id`= '".$_SESSION['user']['id']."' and `language` = 'de_DE' "); 
  //print_r($orderArr);
  if( !empty($orderArr) ){

    foreach($orderArr as $order){
      $shopify_product_ids[] = $order->shopify_product_ids;
      $types[]               = $order->types;
    }
  
    $types_string = implode(',',$types);
    $types_arr = explode(',',$types_string);
  
    $shopify_product_ids_string = implode(',',$shopify_product_ids);
    $shopify_product_ids_arr = explode(',',$shopify_product_ids_string);
  
    if( isset($types) && !empty($types) && ( in_array('DS', $types_arr ) || in_array('PRDS', $types_arr )  || in_array('PCDS', $types_arr ) ) ){
      foreach($args_cat->posts as $key=>$data)
      {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($data->ID), 'single-post-thumbnail' );
    ?>
    <li>
              <figure><img src="<?php echo $image[0];?>" alt="" class="img-fit"></figure>
  
    <article><h2><a href="<?php echo get_the_permalink($data->ID); ?>"><?php echo $data->post_title;?></a></h2>
    
    <a href="<?php echo get_the_permalink($data->ID); ?>" class="readbuy-btn">LESEN</a>
    <p><?php echo get_the_excerpt($data->ID); ?></p>
    </article>
    </li>
    <?php
      } 
    } else if( isset($types) && !empty($types) && in_array('IDI', $types_arr ) ){
      foreach($args_cat->posts as $key=>$data)
      {
		$value = get_field( "shopify_product_id", $data->ID );
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($data->ID), 'single-post-thumbnail' );
        if( isset($shopify_product_ids_arr) && !empty($shopify_product_ids_arr) && in_array($value, $shopify_product_ids_arr) ){
        
    ?>
    <li>
              <figure><img src="<?php echo $image[0];?>" alt="" class="img-fit"></figure>
  
    <article><h2><a href="<?php echo get_the_permalink($data->ID); ?>"><?php echo $data->post_title;?></a></h2> 
    
    <a href="<?php echo get_the_permalink($data->ID); ?>" class="readbuy-btn">LESEN</a>
    <p><?php echo get_the_excerpt($data->ID); ?></p>
    </article>
    </li>
    <?php }else{ ?>
		
		<li> 
              <figure><img src="<?php echo $image[0];?>" alt="" class="img-fit"></figure>
  
      <article><h2>
      <a href="<?php echo constant("SITEURL");?>/german/individual-digital-issue-select-add-to-cart.php?product=<?php echo $value;?>">
      <?php echo $data->post_title;?></a> </h2> 
      <a href="<?php echo constant("SITEURL");?>/german/individual-digital-issue-select-add-to-cart.php?product=<?php echo $value;?>" class="digibuy-btn">KAUFEN</a>
			<p><?php echo get_the_excerpt($data->ID); ?></p>
			</article>
    	</li>

	<?php } ?>
    <?php
      } 
    }
  }else{
?>
<!--<li>
	<figure><img src="<?php echo constant("SITEURL");?>/german/images/digital-subscription-icon.jpg" alt="" class="img-fit"></figure>
    <article><h2><a href="<?php echo constant("SITEURL");?>/german/digital-subscription-add-to-cart">DIGITAL SUBSCRIPTION</a></h2><a href="<?php echo constant("SITEURL");?>/german/digital-subscription-add-to-cart" class="digibuy-btn">LESEN</a>
    <p>HECTOR RECEIVES A DISTURBING VIDEOS AND PREPARES FOR REVENGE. FOLLOW HECTOR GILAS HE PREPARES FOR THE MASTER BOXING TOURNAMENT IN BOSTON.</p>
    </article>
</li>-->
<li>
<?php if ( is_active_sidebar( 'digital-subscription-box-german' ) ) : 
					dynamic_sidebar('digital-subscription-box-german');
			 endif; ?>
</li>
<?php
	foreach($args_cat->posts as $key=>$data)
      {
        $value = get_field( "shopify_product_id", $data->ID );
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($data->ID), 'single-post-thumbnail' );
    ?>
    <li>
              <figure><img src="<?php echo $image[0];?>" alt="" class="img-fit"></figure>
  
    <article>
   
    <h2><a href="<?php echo constant("SITEURL");?>/german/individual-digital-issue-select-add-to-cart.php?product=<?php echo $value;?>"><?php echo $data->post_title;?></a></h2>
  
  <a href="<?php echo constant("SITEURL");?>/german/individual-digital-issue-select-add-to-cart.php?product=<?php echo $value;?>" class="digibuy-btn">KAUFEN</a>
    <p><?php echo get_the_excerpt($data->ID); ?></p>
    </article>
    </li>
    <?php
      }
  }
}else{
?>
<li><article><h2>No digital issues found</li></h2></article>
<?php
} 
?>
    </ul>
  </div>

  </div>
</section>

<?php get_footer(); ?>