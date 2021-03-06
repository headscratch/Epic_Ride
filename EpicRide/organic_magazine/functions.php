<?php
require( get_template_directory() . '/includes/shortcodes.php' );
/*-----------------------------------------------------------------------------------------------------//	

	Set Default Thumbnail Size		       	     	 

-------------------------------------------------------------------------------------------------------*/


if ( function_exists( 'add_theme_support' ) ) { 
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 9999, 9999); // default Post Thumbnail dimensions


}
/*-----------------------------------------------------------------------------------------------------//	
	Initiate the localization of the theme		       	     	 
-------------------------------------------------------------------------------------------------------*/

load_theme_textdomain( 'organicthemes', TEMPLATEPATH.'/languages' );

/*-----------------------------------------------------------------------------------------------------//	
	Category ID to Name		       	     	 
-------------------------------------------------------------------------------------------------------*/

function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
    	if ($id == $category->cat_ID) { return $category->cat_name; break; }
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	404 Pagination Fix		       	     	 
-------------------------------------------------------------------------------------------------------*/

function my_post_queries( $query ) {
  // not an admin page and it is the main query
  if (!is_admin() && $query->is_main_query()){
    if(is_home() ){
      $query->set('posts_per_page', 1);
    }
  }
}
add_action( 'pre_get_posts', 'my_post_queries' );


/*-----------------------------------------------------------------------------------------------------//	
	Register Scripts		       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists('ot_enqueue_scripts') ) {
function ot_enqueue_scripts() {

	//Register Styles
	wp_register_style( 'organic-shortcodes', get_template_directory_uri() . '/css/organic-shortcodes.css', array( 'organic-style' ), '1.0' );
	wp_register_style( 'organic-style-mobile', get_template_directory_uri() . '/style-mobile.css', array( 'organic-style' ), '1.0' );
	wp_register_style( 'organic-shortcodes', get_template_directory_uri() . '/css/organic-shortcodes.css', array( 'organic-style' ), '1.0' );
	wp_register_style( 'organic-shortcodes-ie8', get_template_directory_uri() . '/css/organic-shortcodes-ie8.css', array( 'organic-shortcodes' ), '1.0' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'organic-shortcodes' ), '1.0' );
	wp_register_style( 'font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.css', array( 'font-awesome' ), '1.0' );
	wp_register_style( 'pretty-photo', get_template_directory_uri() . '/css/pretty-photo.css', '1.0' );
	
	// Enqueue Styles
	wp_enqueue_style( 'organic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'organic-style-mobile', get_template_directory_uri() . '/style-mobile.css', array( 'organic-style' ), '1.0' );
	wp_enqueue_style( 'organic-shortcodes', get_template_directory_uri() . '/css/organic-shortcodes.css', array( 'organic-style' ), '1.0' );
	wp_enqueue_style( 'organic-shortcodes-ie8', get_template_directory_uri() . '/css/organic-shortcodes-ie8.css', array( 'organic-shortcodes' ), '1.0' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'organic-shortcodes' ), '1.0' );
	wp_enqueue_style( 'font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.css', array( 'font-awesome' ), '1.0' );
	wp_enqueue_style( 'pretty-photo', get_template_directory_uri() . '/css/pretty-photo.css', '1.0' );

	// IE Conditional Styles
	global $wp_styles;
	$wp_styles->add_data('organic-shortcodes-ie8', 'conditional', 'lt IE 9');
	$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lt IE 8');
	
	// Enqueue jQuery First
	wp_enqueue_script('jquery');

	wp_register_script('custom', get_template_directory_uri() . '/js/jquery.custom.js');
	wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', true);
	wp_register_script('hover', get_template_directory_uri() . '/js/hoverIntent.js', 'jquery', '1.0', true);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', 'jquery', '1.6.2', true);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitVids.js', 'jquery', '', true);
	wp_register_script('retina', get_template_directory_uri() . '/js/retina.js');
	wp_register_script('modal', get_template_directory_uri() . '/js/jquery.modal.min.js', 'jquery', '', true);
	wp_register_script('lightbox', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery', '', true);

		//Enqueue Scripts
	wp_enqueue_script('custom');
	wp_enqueue_script('superfish');
	wp_enqueue_script('hover');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('retina');
	wp_enqueue_script('modal');
	wp_enqueue_script('lightbox');
	wp_enqueue_script('jquery-masonry');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-dialog');

	// Load Flexslider on front page and slideshow page template
	if( is_front_page() || is_page_template('template-slideshow.php') ) {
		wp_enqueue_script('flexslider');
	}

	// load single scripts only on single pages
    if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 



	}

	add_action('wp_enqueue_scripts', 'ot_enqueue_scripts');
}

/*-----------------------------------------------------------------------------------------------------//	
	Options Framework		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = 'false') {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( !empty($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}	
}

if ( !function_exists( 'optionsframework_add_page' ) && current_user_can('edit_theme_options') ) {
	function options_default() {
		add_theme_page(__("Theme Options", 'organicthemes'), __("Theme Options", 'organicthemes'), 'edit_theme_options', 'options-framework','optionsframework_page_notice');
	}
	add_action('admin_menu', 'options_default');
}

/**
 * Displays a notice on the theme options page if the Options Framework plugin is not installed
 */

if ( !function_exists( 'optionsframework_page_notice' ) ) {
	add_thickbox(); // Required for the plugin install dialog.

	function optionsframework_page_notice() { ?>
	
		<div class="wrap">
		<?php screen_icon( 'themes' ); ?>
		<h2><?php _e("Theme Options", 'organicthemes'); ?></h2>
        <p><b><?php _e("This theme requires the Options Framework plugin installed and activated to manage your theme options.", 'organicthemes'); ?> <a href="<?php echo admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=784&height=517'); ?>" class="thickbox onclick"><?php _e("Install Now", 'organicthemes'); ?></a></b></p>
		</div>
		<?php
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	WooCommerce Integration		       	     	 
-------------------------------------------------------------------------------------------------------*/

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
    add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>  
	<div id="content" class="row">
		<div class="eight columns">
				<div class="article">
    <?php
}

function mytheme_close_woocommerce_content_wrappers() {
	?>
    		</div> <!-- /article -->
    	</div> <!-- /columns -->
 
        <div class="four columns">
        	<?php get_sidebar( 'Right Sidebar' ); ?>
        </div>
        
 	</div> <!-- /row -->
    <?php
}

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

// WooCommerce thumbnail image sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'woo_install_theme', 1);
function woo_install_theme() {
 
update_option( 'woocommerce_thumbnail_image_width', '192' );
update_option( 'woocommerce_thumbnail_image_height', '192' );
update_option( 'woocommerce_single_image_width', '784' );
update_option( 'woocommerce_single_image_height', '784' );
update_option( 'woocommerce_catalog_image_width', '140' );
update_option( 'woocommerce_catalog_image_height', '140' );
}

// WooCommerce default product columns
function loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'loop_columns');

// WooCommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*-----------------------------------------------------------------------------------------------------//	
	Register Sidebars		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('register_sidebars') )
	register_sidebar(array('name'=>'Home Sidebar','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name'=>'Right Sidebar','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name'=>'Left Sidebar','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name'=>'Footer Left','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name'=>'Footer Mid Left','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name'=>'Footer Middle','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name'=>'Footer Mid Right','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name'=>'Footer Right','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));

/*-----------------------------------------------------------------------------------------------------//	
	Comments Function		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'organicthemes_comment' ) ) :
function organicthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'organicthemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'organicthemes' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s', 'organicthemes' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'organicthemes' ); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'organicthemes' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for organicthemes_comment()

/*-----------------------------------------------------------------------------------------------------//	
	Numbered Pagination		       	     	 
-------------------------------------------------------------------------------------------------------*/

function number_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 5, 'gap' => 5, 'anchor' => 1,
		'before' => '<div class="number-paginate">', 'after' => '</div>',
		'title' => '',
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;
		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}	

	$output = "";

	if ($pages > 1) {	
		$output .= "$before<span class='number-title'>$title</span>";
		$ellipsis = "<span class='number-gap'>...</span>";
		if ($page > 1 && !empty($previouspage)) {
			$output .= "<a href='" . get_pagenum_link($page - 1) . "' class='number-prev'>$previouspage</a>";
		}

		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				number_paginate_loop(1, $anchor), 
				$ellipsis, 
				number_paginate_loop($block_min, $pages, $page)
			);
		}

		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				number_paginate_loop(1, $anchor), 
				$ellipsis, 
				number_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				number_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}

		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				number_paginate_loop(1, $block_high, $page),
				$ellipsis,
				number_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}

		else {
			$output .= number_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<a href='" . get_pagenum_link($page + 1) . "' class='number-next'>$nextpage</a>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;

}

function number_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<span class='number-page number-current'>$i</span>" 
			: "<a href='" . get_pagenum_link($i) . "' class='number-page'>$i</a>";
	}

	return $output;

}

/*-----------------------------------------------------------------------------------------------------//	
	Featured Video Meta Box		       	     	 
-------------------------------------------------------------------------------------------------------*/

$prefix = 'custom_meta_';

$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Featured Video',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Paste Video Embed Code', 'organicthemes'),
            'desc' => __('Enter Vimeo, YouTube or other embed code to display a featured video.', 'organicthemes'),
            'id' => $prefix . 'video',
            'type' => 'textarea',
            'std' => ''
        ),
    )
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;
    
    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

/*-----------------------------------------------------------------------------------------------------//	
	Ajax Load More Posts		       	     	 
-------------------------------------------------------------------------------------------------------*/
/* John R -- Commented out function to remove the 'Load More Posts' function 
function pbd_alp_init() {

	$wp_query = new WP_Query(array('cat'=>of_get_option('category_home_one'),'posts_per_page'=>of_get_option('postnumber_home_one'), 'paged'=>$paged));

	// Add code to index pages.
	if( !is_singular() ) {	
		// Queue JS and CSS
		wp_enqueue_script('load-posts', get_template_directory_uri() . '/js/jquery.loadPosts.js', array('jquery'), '1.0', true);
		
		// What page are we on? And what is the pages limit?
		$max = $wp_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		//global $more; $more = 0;
		
		// Add some parameters for the JS.
		wp_localize_script(
			'load-posts',
			'pbd_alp',
			array(
				'startPage' => $paged,
				'maxPages' => $max,
				'nextLink' => next_posts($max, false)
			)
		);
	}
}
add_action('template_redirect', 'pbd_alp_init');
*/
/*-----------------------------------------------------------------------------------------------------//	
	Custom Excerpt Length		       	     	 
-------------------------------------------------------------------------------------------------------*/

function custom_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*-----------------------------------------------------------------------------------------------------//	
	Press Trends		       	     	 
-------------------------------------------------------------------------------------------------------*/

// Start of Presstrends Magic
if(of_get_option('enable_presstrends') == '1') {

/**
* PressTrends Theme API
*/
function presstrends_theme() {

	// PressTrends Account API Key
	$api_key = 'o5byp75idn9s80nvvahx361kb4m55t5wz9yj';
	$auth = 's3xgmsugkhveka6and2z9u4izgki4z8sa';

	// Start of Metrics
	global $wpdb;
	$data = get_transient( 'presstrends_theme_cache_data' );
	if ( !$data || $data == '' ) {
		$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
		$url      = $api_base . $auth . '/api/' . $api_key . '/';

		$count_posts    = wp_count_posts();
		$count_pages    = wp_count_posts( 'page' );
		$comments_count = wp_count_comments();

		// wp_get_theme was introduced in 3.4, for compatibility with older versions.
		if ( function_exists( 'wp_get_theme' ) ) {
			$theme_data    = wp_get_theme();
			$theme_name    = urlencode( $theme_data->Name );
			$theme_version = $theme_data->Version;
		} else {
			$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
			$theme_name = $theme_data['Name'];
			$theme_versino = $theme_data['Version'];
		}

		$plugin_name = '&';
		foreach ( get_plugins() as $plugin_info ) {
			$plugin_name .= $plugin_info['Name'] . '&';
		}
		$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
		$data                = array(
			'url'             => stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) ),
			'posts'           => $count_posts->publish,
			'pages'           => $count_pages->publish,
			'comments'        => $comments_count->total_comments,
			'approved'        => $comments_count->approved,
			'spam'            => $comments_count->spam,
			'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
			'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
			'theme_version'   => $theme_version,
			'theme_name'      => $theme_name,
			'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
			'plugins'         => count( get_option( 'active_plugins' ) ),
			'plugin'          => urlencode( $plugin_name ),
			'wpversion'       => get_bloginfo( 'version' ),
			'api_version'	  => '2.4',
		);

		foreach ( $data as $k => $v ) {
			$url .= $k . '/' . $v . '/';
		}
		wp_remote_get( $url );
		set_transient( 'presstrends_theme_cache_data', $data, 60 * 60 * 24 );
	}
}
// PressTrends WordPress Action
add_action('admin_init', 'presstrends_theme');		

} else { 
}

/*-----------------------------------------------------------------------------------------------------//	
	Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu		       	     	 
-------------------------------------------------------------------------------------------------------*/

function add_menuclass($ulclass) {
return preg_replace('/<ul>/', '<ul class="menu">', $ulclass, 1);
}
add_filter('wp_page_menu','add_menuclass');
add_filter('wp_nav_menu','add_menuclass');

/*-----------------------------------------------------------------------------------------------------//	
	WP 3.4+ Custom Header Support	       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support') )
$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/logo.png',
	'random-default'         => false,
	'width'                  => 980,
	'height'                 => 160,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '333333',
	'header-text'            => true,
	'uploads'                => true,
);
add_theme_support( 'custom-header', $defaults );

/*-----------------------------------------------------------------------------------------------------//	
	WP 3.4+ Custom Background Support	       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support') )
$defaults = array(
	'default-color'          => 'F9F9F9',
	'default-image'          => get_template_directory_uri() . '/images/background.png',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

/*-----------------------------------------------------------------------------------------------------//	
	Custom Menu Support	       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'ot_register_menu' ) ) {
    function ot_register_menu() {
	    register_nav_menu('header-menu', __('Header Menu'));
    }
    add_action('init', 'ot_register_menu');
}

// Display home page link in custom menu
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

/*-----------------------------------------------------------------------------------------------------//	
	Add default posts and comments RSS feed links to head		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support') )
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------------------------//	
	Featured Image (Post Thumbnail) Support		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support') )
add_theme_support('post-thumbnails');
add_image_size( 'slide', 784, 360, true ); // Slideshow Featured Image
add_image_size( 'post', 280, 185, true ); // Post Featured Imageadd_image_size( 'testpost', 280, 185, true ); // Post Featured Image
add_image_size( 'page', 1200, 520, true ); // Featured Page Banner