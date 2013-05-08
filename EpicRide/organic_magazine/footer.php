<div class="clear"></div>

</div> <!-- close container -->

<div class="footerwidgets">

	<div class="row">
        
            <div class="two columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left') ) : ?> 
                <?php endif; ?>
            </div>
            
            <div class="two columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Mid Left') ) : ?>
                <?php endif; ?>
            </div>
            
            <div class="two columns">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Middle') ) : ?>
                <?php endif; ?>
            </div>
            
            <div class="two columns">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Mid Right') ) : ?>
                <?php endif; ?>
            </div>
            
            <div class="four columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right') ) : ?>
                <?php endif; ?>
            </div>

	</div>

</div>

<div class="footer">

	<div class="row">
		<div class="twelve columns">
    
    	<div class="footerleft">       
            <p><?php _e("Copyright", 'organicthemes'); ?> &copy; <?php echo date(__("Y", 'organicthemes')); ?> &middot; <?php _e("All Rights Reserved", 'organicthemes'); ?> &middot; <?php bloginfo('name'); ?></p>

<p>Built and managed by <a href="http://www.laurenlibke.com" target="_blank">Lauren Libke</a></p>

        </div>
        
           
		
		</div>
	</div>
	
</div> <!-- close container -->

<?php wp_footer(); ?>

</body>
</html>