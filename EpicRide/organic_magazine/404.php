<?php get_header(); ?>

<div id="content" class="row">

	<div class="eight columns">

        <div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
                
            <h1><?php _e("Not Found, Error 404", 'organicthemes'); ?></h1>
            <p><?php _e("The page you are looking for no longer exists.", 'organicthemes'); ?></p>
            
        </div>
		
	</div>
			
	<div class="four columns">
		<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer(); ?>