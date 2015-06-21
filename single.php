<?php get_header(); ?>
			
			<!--BEGIN #primary-->
			<div id="primary" class="clearfix">
			
				<!--BEGIN #primary-blog .hfeed-->
				<div id="primary-blog" class="hfeed">			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .hentry -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
						
						<?php /* if show post image is checked */
						if (get_option('tz_post_img') == "true") { ?>
						<?php /* if the post has a WP 2.9+ Thumbnail */
						if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<div class="post-thumb">
							<?php the_post_thumbnail('thumbnail-blog'); /* post thumbnail settings configured in functions.php */ ?>
						</div>
						<?php } } ?>
	
						<!--BEGIN #content-container -->
			            <div id="content-container" class="clearfix">
			            	
			            	<div id="title-wrap">
			            	
			            		<h2 class="entry-title"><?php the_title(); ?></h2>
				            
					            <!--BEGIN .entry-meta .entry-footer-->
								<div class="entry-meta entry-footer">
								
									<span class="published"><?php the_time( get_option('date_format') ); ?></span>
									<span class="meta-sep">&middot;</span>
									<span class="comment-count"><?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
			
								<!--END .entry-meta .entry-footer-->
								</div>
			            	
			            	</div>
				            
				
				            <!--BEGIN .entry-content -->
				            <div class="entry-content">
				            
				                <?php the_content(''); ?>
				                
				            <!--END .entry-content -->
			            	</div>
			            
			            <!--END #content-container -->
			            </div>
			            
					<!--END .hentry-->  
					</div>
					
					<?php comments_template('', true); ?>
	
					<?php endwhile; ?>
	
				<?php else : ?>
	
					<!--BEGIN #post-0-->
					<div id="post-0" <?php post_class(); ?>>
					
						<h2 class="page-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
					
						<!--BEGIN .entry-content-->
						<div class="entry-content">
							<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
						<!--END .entry-content-->
						</div>
					
					<!--END #post-0-->
					</div>
	
				<?php endif; ?>
				
				<!--END #primary-blog .hfeed-->
				</div>
				
				<?php get_sidebar(); ?>
			
			<!--END #primary-->
			</div>

<?php get_footer(); ?>