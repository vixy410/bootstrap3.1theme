<?php get_header(); ?>
	
<div class="row ">
    <div class="container">
	<!-- section -->
        <section role="main" class="col-md-9">
            <div class="panel panel-success">
	
            <h1 class="panel-title"><?php _e( 'Archives', 'ck' ); ?></h1>
	
		<?php get_template_part('loop'); ?>

            
		<?php get_template_part('pagination'); ?>
            
            </div>
	
	</section>
	<!-- /section -->
        
 <section class="col-md-3 well">
    <?php get_sidebar(); ?> 
 </section>
	
    </div>
</div>

<?php get_footer(); ?>