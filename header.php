<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
		<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title>
        <?php wp_title(''); ?>
        <?php if(wp_title('', false)) { echo ' :'; } ?>
        <?php bloginfo('name'); ?>
        </title>

		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<!-- meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<!-- icons -->
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<!-- css + javascript -->
		<?php wp_head(); ?>
		<script>
		!function(){
			// configure legacy, retina, touch requirements @ conditionizr.com
			conditionizr()
		}()
		</script>
		</head>
                <body <?php body_class(); ?> class="container">

<!-- wrapper -->
<div class="wrapper">

<!-- header -->
<header class="header clear" role="banner"> 
          <!--logo-->
          
          <?php get_template_part('header','logo'); ?>
          <!--/logo--> 
          
          <!--header menu-->
          <?php get_template_part('header','menu'); ?>
          <!--/header menu--> 
          <!--slider-->
          <div class="row" style="margin:auto">
          <?php get_template_part('header','slider'); ?>
          </div>
          <!--/slider-->
          
        </header>
<!-- /header -->