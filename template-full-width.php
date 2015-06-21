<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>
			
			<!--BEGIN #primary-->
			<div id="primary" class="clearfix">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
	            	
	            	<h2 class="page-title"><?php the_title(); ?></h2>
		
		            <!--BEGIN .entry-content -->
		            <div class="entry-content">
		            
		                <?php the_content(); ?>
		                <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		                
		            <!--END .entry-content -->
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
		
			<!--END #primary-->
			</div>

<?php get_footer(); ?>