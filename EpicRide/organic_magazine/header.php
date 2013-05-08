<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<link href='http://fonts.googleapis.com/css?family=Open+Sans|Raleway:300,500|Kreon:700' rel='stylesheet' type='text/css'>

<meta charset="<?php bloginfo('charset'); ?>">

<?php if(of_get_option('enable_responsive') == '1') { ?>
<!-- Mobile View -->
<meta name="viewport" content="width=device-width">
<?php } else { ?>
<?php } ?>

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-mobile.css">
<?php get_template_part( 'style', 'options' ); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>

<!-- Social -->
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Merriweather:400,700,300,900' rel='stylesheet' type='text/css'>

<script type="text/javascript"> 
	var $j = jQuery.noConflict();
	$j(document).ready(function() { 
	    $j('.menu').superfish({
	    	delay: 200,
	    	animation: {opacity:'show', height:'show'},
	    	speed: 'fast',
	    	autoArrows: true,
	    	dropShadows: false
	    }); 
	}); 
</script>

<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(window).load(function() { 
		// Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
		$j('.flexslider').fitVids().flexslider({
			slideshowSpeed: <?php echo of_get_option('transition_interval'); ?>,
			animationDuration	: 400,
			animation: 'fade',
			video: true,
			useCSS: false,
			touch: false,
			animationLoop: true,
			smoothHeight: true
		});
	});
</script>


<!-- Make Social Buttons Load in Ajax -->
<script type="text/javascript">
	jQuery(document).ajaxComplete(function($) {
		gapi.plusone.go();
		twttr.widgets.load();
		try {
			FB.XFBML.parse();
		}catch(ex){}
	});
</script>

</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=246727095428680";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class="container">
	
	<div class="row">
	
	    <div id="header">
	    
	    	<?php if(of_get_option('display_site_title') == '1') { ?>
		    	<div id="masthead">
		    		<?php if (is_home() || is_front_page() ) { ?>
		    	    	<h1 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
		    	    	<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		    	    <?php } else { ?>
		    	    	<h4 class="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h4>
		    	    	<h5 class="site-description"><?php bloginfo( 'description' ); ?></h5>
		    	    <?php } ?>
		    	</div>
	    	<?php } else { ?>
	    	<?php } ?>
	    	
	    	<?php if (is_home() || is_front_page() ) { ?>
	    		<h1 id="custom-header"><a href="<?php echo get_option('home'); ?>/" title="Home"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" /><?php bloginfo( 'name' ); ?></a></h1>
	    	<?php } else { ?>
	    		<p id="custom-header"><a href="<?php echo get_option('home'); ?>/" title="Home"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" /><?php bloginfo( 'name' ); ?></a></p>
	    	<?php } ?>
	    	
	    </div>
    
    </div>
    
    <div class="row">
    
	    <div id="navigation">
		
	        <?php if ( function_exists('ot_register_menu') ) { // Check for 3.0+ menus
	        	wp_nav_menu( array( 
	        		'theme_location' => 'header-menu', 
	        		'title_li' => '',
	        		'depth' => 4, 
	        		'container_class' => 'menu' 
	        		)
	        	);
		
	        } else { ?>
							
	        	<ul class="menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul>
	        <?php } ?>
	        
	        <?php if(of_get_option('display_search') == '1') { ?>
		        <div class="searchnav">
		            <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
		            <input type="text" class="inputbox" value="<?php _e("Search", 'organicthemes'); ?>" onfocus="if (this.value == '<?php _e("Search", 'organicthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Search", 'organicthemes'); ?>';}" name="s" id="s" />
		            </form>
		        </div>
	        <?php } else { ?>
	        <?php } ?>
	    </div>
    
    </div>