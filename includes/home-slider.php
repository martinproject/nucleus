<?php 

if(file_exists('../../../../wp-load.php')) :
	include '../../../../wp-load.php';
else:
	include '../../../../../wp-load.php';
endif; 

ob_start(); 
	
query_posts(array(
		'post_type' => 'slide',
		'posts_per_page' => 1,
		'p' => $_POST['id']
));
?>
			

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<!--BEGIN #primary .hfeed-->
	<div id="primary" class="hfeed" data-src="<?php echo get_template_directory_uri(); ?>/includes/home-slider.php">

		<!--BEGIN .hentry-->
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	
			<!--BEGIN .entry-content -->
			<div class="entry-content clearfix">
				<?php the_content(__('Read more...', 'framework')); ?>
			<!--END .entry-content -->
			</div> 
			
			<img class="hidden" src="<?php echo get_template_directory_uri(); ?>/images/blank.png" alt="" />
	
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
		
	</div>
		
	<?php if(!$hide) : ?>
	<div id="slide-arrow-wrap">
		<div id="slide-left"><span></span><a data-id="<?php echo $next; ?>" href="#"></a></div>
		<div id="slide-right"><span></span><a data-id="<?php echo $previous; ?>" href="#"></a></div>
	</div>
	<?php endif; ?>

<?php endwhile; endif; ?>

<?php ob_end_flush(); ?>