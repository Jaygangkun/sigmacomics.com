<?php
/**
 *
 * Template name: Homepage
 * The template for displaying homepage.
 *
 * @package maxstore
 */
get_header();
global $post;

//echo get_locale();

//if( ( get_locale() == 'es_ES' && $_GET['i'] == 'es' ) || get_locale() == 'en_US' ){
	if( get_locale() == 'en_US' ){

	$args_banner = array(
		'posts_per_page'   => 30,
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => 'id',
		'order'            => 'ASC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'banner',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'     		   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);
	$args_banner = new WP_Query( $args_banner );
	
	$args_news = array(
		'posts_per_page'   => 3,
		'category_name'    => '',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => '',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'     	   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true
	  );
	  $args_news = new WP_Query( $args_news );

?>


<!-- Banner Section Start -->
<?php 
echo get_field( "banners", get_the_ID()); 
?>
<!-- Banner Section End -->

<!-- Portfolio Section Start -->
<section class="news-portfolio-sec">
	<div class="container">
		<h2 class="sec-hdn">The Latest News</h2>

		<div class="filters filter-button-group">
		  <!--<ul>
		  	<li class="fltr-hdn">Filter:</li>
		    <li class="active" data-filter="*">All</li>
		    <li data-filter=".2020">2020</li>
		  </ul>-->
		</div>

		<div class="content grid">

		<?php
			foreach($args_news->posts as $key=>$news)
			{
				$image = wp_get_attachment_image_src( get_post_thumbnail_id($news->ID), 'single-post-thumbnail' );
	   ?>
			<div class="single-content webdesign 2020 grid-item">
				<div class="news-itm">
					<div class="news-date"><?php echo get_the_date("F j, Y", $news->ID);?></div>
					<figure><a href="<?php echo get_the_permalink($news->ID); ?>"><img src="<?php echo $image[0];?>"></a></figure>
					<article><p><?php echo substr(get_the_excerpt($news->ID),0,45);?></p></article>
				</div>
			</div>
		<?php } ?>

		</div>

	</div>
</section>
<!-- Portfolio Section End -->

<!-- Sigma Characters Section Start -->

<?php 
echo get_field( "sigma_comics_characters", get_the_ID()); 
?>
<!-- Sigma Characters Section End -->



<!-- About Section Start -->
<?php 
echo get_field( "about_sigma_comics", get_the_ID()); 
?>
<!-- About Section End -->

<!-- Support Sigma Section Start -->
<?php 
echo get_field( "support_sigma", get_the_ID()); 
?>
<!-- Support Sigma Section End -->

<?php }else if(get_locale() == 'es_ES'){ 
	wp_redirect( constant("SITEURL_WP").'/calico-3' );
	exit;
}else if(get_locale() == 'fr_FR'){ 
	wp_redirect( constant("SITEURL_WP").'/calico-2' );
	exit;
}else if(get_locale() == 'de_DE'){ 
	wp_redirect( constant("SITEURL_WP").'/calico-4' );
	exit;
}else if(get_locale() == 'ja_JA'){ 
	wp_redirect( constant("SITEURL_WP").'/calico-5' );
	exit;
}else if(get_locale() == 'it_IT'){ 
	wp_redirect( constant("SITEURL_WP").'/calico-6' );
	exit;
} ?>

<?php get_footer(); ?>
