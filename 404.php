<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
?>
<?php get_header(); ?>
			
			<!--BEGIN #primary-->
			<div id="primary" class="clearfix">
			
				<!--BEGIN #primary-blog .hfeed-->
				<div id="primary-blog" class="hfeed">			

	
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
				
				<!--END #primary-blog .hfeed-->
				</div>
				
				<?php get_sidebar(); ?>
			
			<!--END #primary-->
			</div>

<?php get_footer(); ?>