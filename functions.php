<?php


/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\

	Theme Support
\*------------------------------------*/

function theme_setup(){
	
	require_once( get_template_directory() . '/inc/nav-menu-walker.php' );
	require_once( get_template_directory() . '/inc/widgets.php' );
	
	}
	
add_action( 'after_setup_theme', 'theme_setup' );

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

   
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('ck', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function ck_nav()
{
		/*	$defaults = array(
			'theme_location'  => '',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);*/
	$defaults = array( 
				'theme_location'	=>	'header-menu',
				'menu_class'		=>	'nav navbar-nav',
				'container_class' 	=>  'navbar navbar-inverse',
				'depth'				=>	3,
				'fallback_cb'		=>	false,
				'walker'			=>	new The_Bootstrap_Nav_Walker
				);

   wp_nav_menu( $defaults );
}

// Load HTML5 Blank scripts (header.php)
function ck_header_scripts()
{
    if (!is_admin()) {
    
    	wp_deregister_script('jquery'); // Deregister WordPress jQuery
    	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array(), '1.10.1'); // Google CDN jQuery
    	wp_enqueue_script('jquery'); // Enqueue it!
        
        wp_register_script('scurityastra', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array(), '3.1.1'); // Google CDN jQuery
    	wp_enqueue_script('scurityastra'); // Enqueue it!
        
    	
    	wp_register_script('conditionizr', 'http://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!
        
        wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
        
        wp_register_script('ckscripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('ckscripts'); // Enqueue it!
    }
}
add_action('init', 'ck_header_scripts'); // Add Custom Scripts to wp_head

// Load HTML5 Blank conditional scripts
function ck_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}
add_action('wp_print_scripts', 'ck_conditional_scripts'); // Add Conditional Page Scripts


// Load HTML5 Blank styles
function ck_styles()
{

    wp_register_style('ck', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('ck'); // Enqueue it!
	
	// wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all');
   // wp_enqueue_style('bootstrap'); // Enqueue it!
    
     wp_register_style('securityastra',  'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', array(), '3.1.1', 'all');
    wp_enqueue_style('securityastra'); // Enqueue it!
    
	wp_register_style('custom', get_template_directory_uri() . '/css/custom.css', array(), '1.0', 'all');
    wp_enqueue_style('custom'); // Enqueue it!
	
   /* wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!
		*/
    
	
}
add_action('wp_enqueue_scripts', 'ck_styles'); // Add Theme Stylesheet

// Register HTML5 Blank Navigation
function register_ck_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'ck'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'ck'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'ck') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}
add_action('init', 'register_ck_menu'); // Add HTML5 Blank Menu

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation


// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute


// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)



// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function ck_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
add_action('init', 'ck_pagination'); // Add our HTML5 Pagination

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'ck') . '</a>';
}
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts


// Remove Admin bar
function remove_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar


// Remove 'text/css' from our enqueued stylesheet
function ck_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
add_filter('style_loader_tag', 'ck_style_remove'); // Remove 'text/css' from enqueued stylesheet


// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images


// Custom Gravatar in Settings > Discussion
function ckgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}
add_filter('avatar_defaults', 'ckgravatar'); // Custom Gravatar in Settings > Discussion

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments

// Custom Comments Callback
function ckcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
<!-- heads up: starting < for the html tag (li or div) in the next line: -->

<<?php echo $tag ?>
<?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?>
id="comment-
<?php comment_ID() ?>
">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
  <?php endif; ?>
  <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?> </div>
  <?php if ($comment->comment_approved == '0') : ?>
  <em class="comment-awaiting-moderation">
  <?php _e('Your comment is awaiting moderation.') ?>
  </em> <br />
  <?php endif; ?>
  <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
    <?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
    </a>
    <?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
  </div>
  <?php comment_text() ?>
  <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </div>
  <?php if ( 'div' != $args['style'] ) : ?>
</div>
<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions






// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_ck()
{
    register_taxonomy_for_object_type('category', 'ck'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'ck');
    register_post_type('ck', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Custom Post', 'ck'), // Rename these to suit
            'singular_name' => __('Custom Post', 'ck'),
            'add_new' => __('Add New', 'ck'),
            'add_new_item' => __('Add New Custom Post', 'ck'),
            'edit' => __('Edit', 'ck'),
            'edit_item' => __('Edit  Custom Post', 'ck'),
            'new_item' => __('New  Custom Post', 'ck'),
            'view' => __('View Custom Post', 'ck'),
            'view_item' => __('View  Custom Post', 'ck'),
            'search_items' => __('Search  Custom Post', 'ck'),
            'not_found' => __('No Custom Posts found', 'ck'),
            'not_found_in_trash' => __('No Custom Posts found in Trash', 'ck')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}
add_action('init', 'create_post_type_ck'); // Add our HTML5 Blank Custom Post Type

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.


// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.


?>
