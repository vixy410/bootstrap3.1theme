<?php get_header(); ?>
<div class="row">

<div class="container">
	
	<!-- section -->
        <section role="main" class="col-md-9">
	
		<h1><?php _e( 'Categories for', 'ck' ); the_category(); ?></h1>
	
		<?php get_template_part('loop'); ?>
		
		<?php get_template_part('pagination'); ?>
	
	</section>
	<!-- /section -->
 <section class="col-md-3">
    <?php get_sidebar(); ?> 
 </section>
</div>
</div>



<?php get_footer(); ?>