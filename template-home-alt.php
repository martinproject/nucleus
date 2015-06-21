<?php
/*
Template Name: Home Alternative
*/
?>

<?php get_header(); ?>

	<!--BEGIN #primary .hfeed-->
	<div id="primary" class="hfeed clearfix" data-src="<?php echo get_template_directory_uri(); ?>/includes/home-slider.php">

		
		<?php get_template_part('includes/home-imageslider'); ?>
		
		<?php
		
		$tz_portfolio_enable = get_option('tz_portfolio_enable');
		$tz_portfolio_title = get_option('tz_portfolio_title');
		$tz_portfolio_order = get_option('tz_portfolio_order');
		$tz_portfolio_number = get_option('tz_portfolio_number');
		
		if($tz_portfolio_order == '')
			$tz_portfolio_order = 'date';
			
		if($tz_portfolio_number == '')
			$tz_portfolio_number = 4;
		
		if($tz_portfolio_enable == 'true') :
		
		?>
		
		<?php if($tz_portfolio_title != '') : ?>
		<h2 class="home-title"><?php echo stripslashes($tz_portfolio_title); ?></h2>
		<?php endif; ?>
		
		
		<?php
		
		$start = 0;
		$finish = 1;
		
		$query = new WP_Query(array(
		
							'post_type' => 'portfolio',
							'orderby' => $tz_portfolio_order,
							'posts_per_page' => $tz_portfolio_number
						)
				);
				
		$post_count = $query->post_count;
		
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
		
		$thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
		
		if($thumb == '')
			$thumb = FALSE;
		?>
		
		<?php if($start == 0 || tz_is_multiple($start, 4)) : ?>
		<ul class="grid clearfix">
			<li>
				<ul class="clearfix">
		<?php endif; ?>
		
					<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						
						
						<div class="post-thumb">
						
							<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
								<span class="post-thumb-overlay"></span>
								<?php if($thumb) : ?>
                                <img width="210" height="140" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
                                <?php else: ?>
                                <?php the_post_thumbnail('thumbnail-home'); ?>
                                <?php endif; ?>
							</a>
							
						</div>
						
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a></h3>
						

					</li>
		
		<?php if(tz_is_multiple($finish, 4) || $post_count == $finish) : ?>		
				</ul>
			</li>	
		</ul>
		<?php 
		endif; 		
		$start++;
		$finish++;
		endwhile; endif; 
		?>
		
		
		<?php endif; ?>


		<?php
		
		$tz_blog_enable = get_option('tz_blog_enable');
		$tz_blog_title = get_option('tz_blog_title');
		$tz_blog_order = get_option('tz_blog_order');
		$tz_blog_number = get_option('tz_blog_number');
		
		if($tz_blog_order == '')
			$tz_blog_order = 'date';
			
		if($tz_blog_number == '')
			$tz_blog_number = 4;
		
		if($tz_blog_enable == 'true') :
		
		?>
		
		<?php if($tz_blog_title != '') : ?>
		<h2 class="home-title"><?php echo stripslashes($tz_blog_title); ?></h2>
		<?php endif; ?>
		
		
		<?php
		
		$start = 0;
		$finish = 1;
		
		$query = new WP_Query(array(
							'orderby' => $tz_blog_order,
							'posts_per_page' => $tz_blog_number
						)
				);
				
		$post_count = $query->post_count;
		
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
		
		?>
		
		<?php if($start == 0 || tz_is_multiple($start, 4)) : ?>
		<ul class="grid clearfix">
			<li>
				<ul class="clearfix">
		<?php endif; ?>
		
					<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<?php
						if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>
						<div class="post-thumb">
						
							<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
								<span class="post-thumb-overlay"></span>
								<?php the_post_thumbnail('thumbnail-home'); ?>
							</a>
							
						</div>
						<?php endif; ?>
						
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a></h3>
						
						<!--BEGIN .entry-meta .entry-header-->
						<div class="entry-meta entry-header">
							
							<span class="published"><?php the_time( get_option('date_format') ); ?></span>
							<span class="meta-sep">&middot;</span>
							<span class="comment-count"><?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
							<?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?>
						<!--END .entry-meta entry-header -->
						</div>
						
						<!--BEGIN .entry-excerpt -->
						<div class="entry-excerpt">
							<?php the_excerpt(); ?>
						<!--END .entry-content -->
						</div>

					</li>

		
		<?php if(tz_is_multiple($finish, 4) || $post_count == $finish) : ?>		
				</ul>
			</li>	
		</ul>
		<?php 
		endif; 		
		$start++;
		$finish++;
		endwhile; endif; 
		?>
		
		
		<?php endif; ?>


							
	<!--END #primary .hfeed-->
	</div>

<?php get_footer(); ?>