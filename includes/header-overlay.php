<?php
	
	$tz_enable_overlay = get_option('tz_enable_overlay');
	$tz_overlay_page = get_option('tz_overlay_page');
	
	if($tz_enable_overlay == 'true') :
	
	$the_query = NEW WP_Query('page_id='.$tz_overlay_page);
	
?>

<!-- BEGIN #overlay -->
<div id="overlay">
	
	<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
	<!--BEGIN .entry-content -->
	<div class="entry-content">
		<?php the_content(); ?>
	<!--END .entry-content -->
	</div>
	<?php endwhile; endif; ?>
	
	<div id="overlay-trigger"><a href="#"></a></div>

<!-- END #overlay -->
</div>

<?php endif; ?>