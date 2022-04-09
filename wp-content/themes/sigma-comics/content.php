<section class="inner-page-body-sec news-single-page">
	<div class="container">
		<div class="hdn">
			<h1 class="inr-page-title"><?php the_title();?></h1>
		</div>

		<section class="inr-bnr-sec">
			<figure><?php the_post_thumbnail('', array('class' => 'img-responsive')); ?></figure>
		</section>

		<div class="single-news-bdy-content">
			<?php the_content();?>
		</div>
		
	</div>
</section>