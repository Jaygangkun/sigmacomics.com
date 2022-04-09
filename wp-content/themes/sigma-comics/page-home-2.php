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
		  <ul>
		  	<li class="fltr-hdn">Filter:</li>
		    <li class="active" data-filter="*">All</li>
		    <li data-filter=".2020">2020</li>
		    <!--<li data-filter=".webdev">2017</li>
		    <li data-filter=".brand">2018</li>-->
		  </ul>
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

			<!--<div class="single-content webdesign webdev grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic1.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>

			<div class="single-content brand webdesign grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic2.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>

			<div class="single-content brand grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic3.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>

			<div class="single-content webdesign grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic4.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>

			<div class="single-content webdesign grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic2.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>

			<div class="single-content webdesign brand grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic1.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>

			<div class="single-content webdesign grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic4.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>

			<div class="single-content webdesign webdev grid-item">
				<div class="news-itm">
					<div class="news-date">25 December 2017</div>
					<figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/news-pic3.jpg"></a></figure>
					<article><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p></article>
				</div>
			</div>-->


		</div>

		<!--<div class="news-pagination">
			<img src="<?php //echo get_template_directory_uri(); ?>/images/pagination.jpg" alt="">
		</div>-->

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

<?php get_footer(); ?>
