<?php get_header(); ?>

<?php if(of_get_option('display_slideshow') == '1') { ?>

	<?php if ( ! $paged || $paged < 2 ) { ?>
	
	<div class="row">
		
		<div id="slideshow">
	    	<div class="flexslider">
		        <ul class="slides">
		            <?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_slider'),'posts_per_page'=>of_get_option('postnumber_slider'))); ?>
		            <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		            <?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
		            <?php global $more; $more = 0; ?>
		            
		            <li>
		            	<div class="eight columns">
			                <?php if ( $video ) : ?>
			                    <div class="featurevid"><?php echo $video; ?></div>
			                <?php else: ?>
			                    <a class="featureimg" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'slide' ); ?></a>
			                <?php endif; ?>
		                </div>
		                <div class="four columns">
							<div class="article">
		                    <h1 class="headline smaller"><a href="<?php the_permalink(); ?>" rel="bookmark">
		                    	<?php if (strlen($post->post_title) > 48) {
		                    		echo substr(the_title($before = '', $after = '', FALSE), 0, 48) . '...'; } else {
		                    		the_title();
		                    	} ?>
		                    </a></h1>
		                    <h6 class="text-date"><?php the_time(__("l, F j, Y", 'organicthemes')); ?></h6>
		                    <?php the_excerpt(); ?>
		                    <p><a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark"><?php _e("read more >>", 'organicthemes'); ?></a></p>
		                    </div>
		                </div>
		            </li>
		            
		            <?php endwhile; ?>
		            <?php else : // do not delete ?>
					<?php endif; // do not delete ?>
		        </ul>
	        </div>
	    </div>
		    
	</div>
	
	<?php } else { ?>
	<?php } ?>

<?php } else { ?>
<?php } ?>

</div> <!-- close container -->

<div class="container">

<div class="row">
	
	<div class="eight columns">
		<div id="homepage">
	    	
	    	<?php if(of_get_option('display_home_one') == '1') { ?>
	        
	        <div class="post first">
	            
	            <?php global $paged; ?>
				<?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_home_one'),'posts_per_page'=>of_get_option('postnumber_home_one'),'paged'=>$paged)); ?>
	            <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
	            <?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
	            <?php global $more; $more = 0; ?>
	            
	            	<div class="holder single">
	            	
	            		
	            		<div class="article">
	            			<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2> 
							<div class="postauthor">
								<p><?php _e("Posted", 'organicthemes'); ?> <?php _e("on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?> &middot; <?php _e("Tags:", 'organicthemes'); ?> <?php the_tags(''); ?> &middot; <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), __("% Comments", 'organicthemes')); ?></a> &nbsp; <?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?></p>   


	<?php if(of_get_option('display_social_home') == '1') { ?>
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



		                    <?php if ( $video ) : ?>
								<div class="featurevid"><?php echo $video; ?></div>
		                    <?php else: ?>
		                        <a class="featureimg" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'testpost' ); ?></a>
		                    <?php endif; ?>          
	                        <?php the_content('read more >>'); ?>


					
							
						
	                    </div>
	                    
	                </div>
	                
	                
	            <?php endwhile; ?>
	            <?php else : // do not delete ?>
	            <?php endif; // do not delete ?>
	            
	             <div class="pagination">
	            	<?php if (function_exists("number_paginate")) { number_paginate(); } ?>
	            </div>
				
			</div>
	        
	        <?php } else { ?>
	    	<?php } ?>
	        
	        <?php if(of_get_option('display_home_two') == '1') { ?>
	        
	        <h3 class="title"><?php echo cat_id_to_name(of_get_option('category_home_two')); ?></h3>
	
	    	<div class="post second">
	
				<?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_home_two'),'posts_per_page'=>of_get_option('postnumber_home_two'),'paged'=>$paged)); ?>
				<?php $post_class = 'first'; ?>
	            <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
	            <?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
	            <?php global $more; $more = 0; ?>
	            <?php $first_or_second = ('first'==$first_or_second) ? 'second' : 'first'; ?>
	
					<div class="holder double <?php echo $first_or_second; ?>">
					
						<div class="article">
						
		                    <?php if ( $video ) : ?>
								<div class="featurevid"><?php echo $video; ?></div>
		                    <?php else: ?>
		                        <a class="featureimg" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'testpost' ); ?></a>
		                    <?php endif; ?>
	                    	
	                        <h2 class="headline smaller"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	                        <h6 class="text-date"><?php the_time(__("l, F j, Y", 'organicthemes')); ?></h6>          
	                        <?php the_excerpt(); ?>
	                        
	                    </div>
	                    
	                </div>
				
				<?php endwhile; ?>
	            
	            <div class="pagination">
	            	<?php if (function_exists("number_paginate")) { number_paginate(); } ?>
	            </div>
	            
	            <?php else : // do not delete ?>
				<?php endif; // do not delete ?>
	
	        </div>
	        	
	        <?php } else { ?>
	    	<?php } ?>
	
		</div> <!-- close homepage --> 
	</div> <!-- close eight columns --> 

	<div class="four columns">
		<?php get_sidebar('home'); ?>
	</div>
	
</div>

<?php get_footer(); ?>