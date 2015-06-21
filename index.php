<?php get_header(); ?>
<?php /* Get author data */
	if(get_query_var('author_name')) :
	$curauth = get_userdatabylogin(get_query_var('author_name'));
	else :
	$curauth = get_userdata(get_query_var('author'));
	endif;
?>
			<!--BEGIN #primary-->
			<div id="primary" class="clearfix">
				
				
				<?php if(!is_search()) $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                <?php /* If this is a category archive */ if (is_category()) { ?>
                    <h1 class="page-title"><?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?></h1>
                <?php /* If this is a search */ } elseif (is_search()) { ?>
                    <h1 class="page-title"><?php _e('Search Results:', 'framework'); ?> "<?php echo $_GET['s']; ?>"</h1>
                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                    <h1 class="page-title"><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?></h1>
                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                    <h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?></h1>
                 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                    <h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?></h1>
                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                    <h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?></h1>
                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                    <h1 class="page-title"><?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?></h1>
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                    <h1 class="page-title"><?php _e('Blog Archives', 'framework') ?></h1>
                <?php } ?>


				<!--BEGIN #primary-blog .hfeed-->
				<div id="primary-blog" class="hfeed">			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .hentry -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
						
						<?php /* if the post has a WP 2.9+ Thumbnail */
						if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
						<div class="post-thumb">
							<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-blog'); /* post thumbnail settings configured in functions.php */ ?></a>
						</div>
						<?php } ?>
	
						<!--BEGIN .content-container -->
			            <div class="content-container clearfix">
			            
				            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				            <!--BEGIN .entry-content -->
				            <div class="entry-content">
				            
				                <?php the_content(''); ?>
				                
				            <!--END .entry-content -->
			            	</div>
			            
			            <!--END .content-container -->
			            </div>
	
						
						<!--BEGIN .entry-meta .entry-footer-->
						<div class="entry-meta entry-footer">
						
							<span class="published"><?php the_time( get_option('date_format') ); ?></span>
							<span class="meta-sep">&middot;</span>
							<span class="comment-count"><?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
							<span class="read-more-link"><a href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'framework'); ?></a> &rarr;</span>

						<!--END .entry-meta .entry-footer-->
						</div>
	                
					<!--END .hentry-->  
					</div>
	
					<?php endwhile; ?>
	
				<!--BEGIN .navigation .page-navigation -->
				<div class="navigation page-navigation clearfix">
					<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
					<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
				<!--END .navigation .page-navigation -->
				</div>
	
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