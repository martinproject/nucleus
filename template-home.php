<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

			<?php 
			query_posts(array(
					'post_type' => 'slide',
					'posts_per_page' => 1
			));
			?>
			
			<div id="loading"></div>
			
			<div id="primary-wrap">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed clearfix" data-src="<?php echo get_template_directory_uri(); ?>/includes/home-slider.php">
	
					<!--BEGIN .hentry-->
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	
						<!--BEGIN .entry-content -->
						<div class="entry-content clearfix">
							<?php the_content(__('Read more...', 'framework')); ?>
						<!--END .entry-content -->
						</div> 
	
					<!--END .hentry-->
					</div>
					
					<?php
					
					$previous = get_previous_post();
					
					if($previous)
						$previous = $previous->ID;
						
					$next = get_next_post();
					
					if($next)
						$next = $next->ID;
					
					$hide = FALSE;
					
					if(!$next && !$previous)
						$hide = TRUE;
						
					if(!$next) {
					
						$query = NEW WP_Query(array(
								'post_type' => 'slide',
								'posts_per_page' => 1,
								'order' => 'ASC'
						));
						
						if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
						
						$next = get_the_ID();
						
						endwhile; endif;
					}
					
					if(!$previous) {
					
						$query = NEW WP_Query(array(
								'post_type' => 'slide',
								'posts_per_page' => 1
						));
						
						if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
						
						$previous = get_the_ID();
						
						endwhile; endif;
					}
					
					?>
				
				<!--END #primary .hfeed-->
				</div>
				
				<?php if(!$hide) : ?>
				<div id="slide-arrow-wrap">
					<div id="slide-left"><a data-id="<?php echo $next; ?>" href="#"></a></div>
					<div id="slide-right"><a data-id="<?php echo $previous; ?>" href="#"></a></div>
				</div>
				<?php endif; ?>

				<?php endwhile; endif; ?>
			
			</div>

<?php get_footer(); ?>