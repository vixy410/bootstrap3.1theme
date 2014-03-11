<?php
/*
 * Template Name: Home Page
 */
?>

<?php get_header(); ?>

<!-- section -->
<div class="container">

<section role="main" class="col-md-9">
    <div class="panel panel-success">
  <div class="panel-heading">
  <h1 class="panel-title">
    <?php the_title(); ?>
  </h1>
   </div>
        
   <div class="panel-body">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
  
  <!-- article -->
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>
    <?php //comments_template( '', true ); // Remove if you don't want comments ?>
    <br class="clear">
    <?php edit_post_link(); ?>
  </article>
  <!-- /article -->
  
  <?php endwhile; ?>
  <?php else: ?>
  
  <!-- article -->
  <article>
    <h2>
      <?php _e( 'Sorry, nothing to display.', 'ck' ); ?>
    </h2>
  </article>
  <!-- /article -->
  
  <?php endif; ?>
   </div>
    </div>
</section>
<!-- /section -->


<div class="col-md-3">
<?php get_sidebar(); ?>
</div>
</div>


<div class="row">
    <section class="container">
        <?php get_footer(); ?>
    </section>
</div>

