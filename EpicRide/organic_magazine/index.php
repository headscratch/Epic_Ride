<?php get_header(); ?>

<div id="content" class="row">

	<div class="eight columns">
	
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
			<?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
			
			<h1 class="headline"><?php the_title(); ?></h1>
		
	        <div class="postauthor">
	            	<p><?php _e("Posted", 'organicthemes'); ?> <?php _e("on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?> &middot; <?php _e("Tags:", 'organicthemes'); ?> <?php the_tags(''); ?> &middot; <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), __("% Comments", 'organicthemes')); ?></a> &nbsp; <?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?></p>


		<?php if(of_get_option('display_social_blog') == '1') { ?>
	            <div class="social">
	            	<div class="like_btn">
	            	  	<div class="fb-like" href="<?php echo urlencode(get_permalink($post->ID)); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
	            	</div>
	            	<div class="tweet_btn">
	            		<a href="http://twitter.com/share" class="twitter-share-button"
	            		data-url="<?php the_permalink(); ?>"
	            		data-via="<?php echo of_get_option('twitter_user'); ?>"
	            		data-text="<?php the_title(); ?>"
	            		data-related=""
	            		data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
	            	</div>
	            	
	            </div>
	            <?php } else { ?>
	            <?php } ?>
            				
							
		</div>

	</div>
	        
	        <?php if(of_get_option('display_feature_post') == '1') { ?>
		        <?php if ( $video ) : ?>
		        	<div class="featurevid"><?php echo $video; ?></div>
		        <?php else: ?>					<?php if (get_the_category()=='page-portfolio-three'{  ?>						Hello Test!					<?php} ?>
		            <div class="featureimg"><?php the_post_thumbnail('full'); ?></div>
		        <?php endif; ?> 
	        <?php } else { ?>
	        <?php } ?>
			
			<div class="article">
				<?php the_content(__("Read More", 'organicthemes')); ?>

				
				
			
					<?php wp_link_pages(); ?>            	
         			



				<?php trackback_rdf(); ?>
			</div>
			
		
		
		<div class="postcomments">
			<?php comments_template('',true); ?>
		</div>       
		


		<?php endwhile; else: ?>
		<p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
		<?php endif; ?>
		
		
	</div>
	
	<div class="four columns">
		<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer(); ?>