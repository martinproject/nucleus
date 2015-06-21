<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
			
			<!--BEGIN #primary-->
			<div id="primary" class="clearfix">
			
				<!--BEGIN #primary-blog .hfeed-->
				<div id="primary-blog" class="hfeed">			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .hentry -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
		            	
		            	<h2 class="page-title"><?php the_title(); ?></h2>
			
			            <!--BEGIN .entry-content -->
			            <div class="entry-content">
			            
			                <?php the_content(''); ?>
			                
			                <!--BEGIN .archive-lists -->
							<div class="archive-lists">
								
								<h4><?php _e('Last 30 Posts', 'framework') ?></h4>
								
								<ul>
								<?php $archive_30 = get_posts('numberposts=30');
								foreach($archive_30 as $post) : ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
								<?php endforeach; ?>
								</ul>
								
								<h4><?php _e('Archives by Month:', 'framework') ?></h4>
								
								<ul>
									<?php wp_get_archives('type=monthly'); ?>
								</ul>
					
								<h4><?php _e('Archives by Subject:', 'framework') ?></h4>
								
								<ul>
							 		<?php wp_list_categories( 'title_li=' ); ?>
								</ul>
							
							<!--END .archive-lists -->
							</div>

			                
			            <!--END .entry-content -->
		            	</div>
			            	
			            	
					<!--END .hentry-->  
					</div>
	
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