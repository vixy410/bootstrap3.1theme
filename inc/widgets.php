<?php
/**
 * Register our widgets and sidebars.
 *
 * @since admired 1.0
 */
function admired_widgets_init() {


	// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Empanelment', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
       'before_widget' => '<aside id="%1$s" class="widget panel panel-primary %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
	'after_title' => '</h3></div>',
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('News', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<a class="" href="http://localhost/meridian-test/?page_id=335"> View All</a></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3> ',
    ));
	
	 register_sidebar(array(
        'name' => __('Jcarousel', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-3',
        'before_widget' => '<aside id="%1$s" >',
		'after_widget' => "</aside>",
		'before_title' => '<h3>',
		'after_title' => '</h3>',
    ));
	 register_sidebar(array(
         'name' => __('Page Sidebar', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3> ',
    ));
}
}
add_action( 'widgets_init', 'admired_widgets_init' );

?>