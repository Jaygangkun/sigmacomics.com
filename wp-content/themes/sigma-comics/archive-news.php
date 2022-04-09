<?php
/**
 *
 * Template name: Homepage
 * The template for displaying homepage.
 *
 * @package maxstore
 */
get_header();
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args_news = array(
  'posts_per_page'   => 10,
  'category_name'    => '',
  'orderby'          => 'date',
  'order'            => 'DESC',
  'include'          => '',
  'exclude'          => '',
  'meta_key'         => '',
  'meta_value'       => '',
  'post_type'        => 'news',
  'post_mime_type'   => '',
  'post_parent'      => '',
  'author'     		 => '',
  'post_status'      => 'publish',
  'paged' 			=> $paged,
  'suppress_filters' => true
);
$args_news = new WP_Query( $args_news );

?>

<!-- Latest News Page Body Section Start -->
<section class="inner-page-body-sec news-page-body">
	<div class="container">
		<div class="hdn">
		<?php 
            
            $postid = get_the_ID(); 
            $post = get_post( $postid, ARRAY_A );

            echo do_shortcode( wpautop($post['post_content']));
            
        ?> 
		</div>
		
		<div class="inr-latest-news">
			<ul>
			<?php
						foreach($args_news->posts as $key=>$news)
						{
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($news->ID), 'single-post-thumbnail' );
			?>
				<li>
					<figure><a href="<?php echo get_the_permalink($news->ID); ?>"><img src="<?php echo $image[0];?>" alt=""></a></figure>
					<article>
						<h2><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo substr($news->post_title, 0,60); ?></a>
								</h2>
						<h3 class="inr-news-date"><?php echo get_the_date("F j, Y", $news->ID);?></h3>
						<p><?php echo get_the_excerpt($news->ID);?></p>
					</article>
				</li>
			<?php }  
				
				$total_pages = $args_news->max_num_pages;

				if ($total_pages > 1){
					
				$current_page = max(1, get_query_var('paged'));
				
				$ppp = get_query_var('posts_per_page');
				$end = $ppp * $paged;
				$start = $end - $ppp + 1;
			?>

					<div class="blog_pagination">
							<?php
							echo paginate_links(array(
								'base' => get_pagenum_link(1) . '%_%',
								'format' => 'page/%#%',
								'current' => $current_page,
								'total' => $total_pages,
								'prev_text'    => __('<'),
								'next_text'    => __('>'),
							)); ?>

							<span class="blog_pagination_right">
							<?php echo "Showing $start to $end of $total_pages ($start Pages)"; ?>
							</span>

					</div>
			<?php }?>

			</ul>
		</div>

	</div>
</section>
<!-- Latest News Page Body Section End -->

<?php get_footer(); ?>
