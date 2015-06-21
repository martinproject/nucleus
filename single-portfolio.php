<?php get_header(); ?>
            
    <!--BEGIN #primary .hfeed-->
    <div id="primary" class="hfeed">
    	
    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <?php 
		$image1 = get_post_meta(get_the_ID(), 'tz_portfolio_image', TRUE); 
		$image2 = get_post_meta(get_the_ID(), 'tz_portfolio_image2', TRUE); 
		$image3 = get_post_meta(get_the_ID(), 'tz_portfolio_image3', TRUE); 
		$image4 = get_post_meta(get_the_ID(), 'tz_portfolio_image4', TRUE); 
		$image5 = get_post_meta(get_the_ID(), 'tz_portfolio_image5', TRUE);
		$image6 = get_post_meta(get_the_ID(), 'tz_portfolio_image6', TRUE);
		$image7 = get_post_meta(get_the_ID(), 'tz_portfolio_image7', TRUE);
		$image8 = get_post_meta(get_the_ID(), 'tz_portfolio_image8', TRUE);
		$image9 = get_post_meta(get_the_ID(), 'tz_portfolio_image9', TRUE);
		$image10 = get_post_meta(get_the_ID(), 'tz_portfolio_image10', TRUE);
		$height = get_post_meta(get_the_ID(), 'tz_portfolio_image_height', TRUE);
		$audio1 = get_post_meta(get_the_ID(), 'tz_audio_mp3', TRUE);
		$audio2 = get_post_meta(get_the_ID(), 'tz_audio_ogg', TRUE);
		$embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
		$switch = get_post_meta(get_the_ID(), 'tz_switch', TRUE);
		?>
        
        <!--BEGIN .navigation .single-page-navigation -->
		<div class="navigation single-page-navigation clearfix">
		
			<div class="nav-previous">
				<?php next_post_link('&larr; %link'. __('<strong> : Prev</strong>', 'framework')); ?>
			</div>
			<div class="nav-next">
				<?php previous_post_link(__('<strong>Next : </strong>', 'framework') .' %link &rarr;'); ?>
			</div>
		<!--END .navigation .single-page-navigation -->
		</div>   
		                 
        <!--BEGIN .hentry -->
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        	
        	<?php
        		
    		$tz_autoslide = get_option('tz_portfolio_slide_number');
    		
    		if($tz_autoslide == '')
				$tz_autoslide =  FALSE;
    		?>
        		
        	<!--BEGIN .slider -->
            <div id="slider" <?php if($tz_autoslide) : ?> data-speed="<?php echo $tz_autoslide; ?>"<?php endif; ?> data-loader="<?php echo  get_template_directory_uri(); ?>/images/<?php if(get_option('tz_alt_stylesheet') == 'dark.css'):?>dark<?php else: ?>light<?php endif; ?>/ajax-loader.gif">
            
            
            <?php if($switch == 'audio') : ?>
        	
            <?php tz_audio(get_the_ID()); ?>
        
            <div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>

            <div class="jp-audio-container">
                <div class="jp-audio">
                    <div class="jp-type-single">
                        <div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
                            <ul class="jp-controls">
                                <li><div class="seperator-first"></div></li>
                                <li><div class="seperator-second"></div></li>
                                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                            </ul>
                            <div class="jp-progress-container">
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-volume-bar-container">
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

       	 	<?php endif; ?>
        
        	<?php if($switch == 'slideshow' || $switch == '') : ?>
				
				<?php $image_count = 0; ?>
				
                <div class="slides_container clearfix">
                    
                    <?php if($image1 != '') : ?>
                    <div><img height="<?php echo $height; ?>" width="900" src="<?php echo $image1; ?>" alt="<?php the_title(); ?>" /></div>
                    
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image2 != '') : ?>
                    <div><img width="900" src="<?php echo $image2; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image3 != '') : ?>
                    <div><img width="900" src="<?php echo $image3; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image4 != '') : ?>
                    <div><img width="900" src="<?php echo $image4; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image5 != '') : ?>
                    <div><img width="900" src="<?php echo $image5; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image6 != '') : ?>
                    <div><img width="900" src="<?php echo $image6; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image7 != '') : ?>
                    <div><img width="900" src="<?php echo $image7; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image8 != '') : ?>
                    <div><img width="900" src="<?php echo $image8; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image9 != '') : ?>
                    <div><img width="900" src="<?php echo $image9; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                    
                    <?php if($image10 != '') : ?>
                    <div><img width="900" src="<?php echo $image10; ?>" alt="<?php the_title(); ?>" /></div>
                    <?php $image_count++; endif; ?>
                
                </div>
                
                <?php if($image_count > 1) : ?>
                <div id="slide-arrow-wrap">
					<div id="slide-left"><a class="previous-slide" href="#"></a></div>
					<div id="slide-right"><a class="next-slide" href="#"></a></div>
				</div>
				<?php endif; ?>

        	<?php endif; ?>
		
       		<?php if($switch == 'video') : ?>
        
			<?php if($embed == '') : ?>
                
            <?php tz_video(get_the_ID()); ?>
            
            <?php $heightSingle = get_post_meta(get_the_ID(), 'tz_video_height_single', TRUE); ?>
            
            <style type="text/css">
                .single .jp-video-play,
                .single div.jp-jplayer.jp-jplayer-video {
                    height: <?php echo $heightSingle; ?>px;
                }
            </style>
            
            <div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer jp-jplayer-video"></div>
            
            <div class="jp-video-container">
                <div class="jp-video">
                    <div class="jp-type-single">
                        <div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
                            <ul class="jp-controls">
                                <li><div class="seperator-first"></div></li>
                                <li><div class="seperator-second"></div></li>
                                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                            </ul>
                            <div class="jp-progress-container">
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-volume-bar-container">
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <?php else: ?>
            
            	<?php echo stripslashes(htmlspecialchars_decode($embed)); ?>
            
            <?php endif; ?>
            
        	<?php endif; ?>
        
        	<!--END .slider -->
            </div>
            
            <!--BEGIN #content-container -->
            <div id="content-container" class="clearfix">
            
	            <h2 class="entry-title"><?php the_title(); ?></h2>
	
	            <!--BEGIN .entry-content -->
	            <div class="entry-content">
	            
	                <?php the_content(); ?>
	                
	            <!--END .entry-content -->
            	</div>
            
            <!--END #content-container -->
            </div>
            
                                
        <!--END .hentry-->  
        </div>

        <?php endwhile; ?>
        
        <?php
        
        $tz_portfolio_enable_related = get_option('tz_portfolio_enable_related'); 
        
        if($tz_portfolio_enable_related == 'true') :
        
        ?>
        
        <!--BEGIN .recent-wrap -->
        <div class="recent-wrap">
        	
        	<?php 
        	
        	$tz_portfolio_related_title = get_option('tz_portfolio_related_title');
        	
        	if($tz_portfolio_related_title) :
        	?>
        	<h2 class="home-title"><?php echo stripslashes($tz_portfolio_related_title); ?></h2>
        	<?php endif; ?>
		
        	<ul id="items" class="image-grid">
        
		        <?php 
				
				$postId = get_the_ID();
				
		        $related = get_posts_related_by_taxonomy($postId, 'skill-type', get_the_ID());
				
				//Get the total amount of posts
				$post_count = $related->post_count;
				
		        if ($related->have_posts()) : while ($related->have_posts()) : $related->the_post(); 
				
		        ?>
                	
            	<li>
	                <!--BEGIN .hentry -->
	                <div <?php post_class(); ?>>
	                    
	                    <?php 
	                    
	                   	$lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE); 
						$thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
						
						$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
						
						if($lightbox == 'no')
							$lightbox = FALSE;
						
						if($thumb == '')
							$thumb = FALSE;
	
						 $large_image = $large_image[0];
	                    
	                    ?>
	                    <div class="post-thumb clearfix">
	                    	
	                        <?php if($lightbox) : ?>
	                            <a class="lightbox" title="<?php the_title(); ?>" href="<?php echo $large_image; ?>">
	                            	<span class="post-thumb-overlay"></span>
	                                <?php if($thumb) : ?>
	                                <img width="210" height="140" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
	                                <?php else: ?>
	                                <?php the_post_thumbnail('thumbnail-home'); ?>
	                                <?php endif; ?>
	                            </a>
	                        <?php else: ?>
	                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
	                            	<span class="post-thumb-overlay"></span>
	                            	<?php if($thumb) : ?>
	                                <img width="210" height="140" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
	                            	<?php else: ?>
	                            	<?php the_post_thumbnail('thumbnail-home'); ?>
	                            	<?php endif; ?>
	                            </a>
	                        <?php endif; ?>
	                        
	                    </div>
	                                    
	                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
	                
	                <!--END .hentry-->  
	                </div>
	            
	            </li>
	            
	            <?php endwhile; endif; wp_reset_query(); ?>
        
        	</ul>
                
        <!--END .recent-wrap -->
        </div>
        
        <?php endif; ?>


    <?php else : ?>

        <!--BEGIN #post-0-->
        <div id="post-0" <?php post_class(); ?>>
        
            <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
        
            <!--BEGIN .entry-content-->
            <div class="entry-content">
                <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
            <!--END .entry-content-->
            </div>
        
        <!--END #post-0-->
        </div>

    <?php endif; ?>
    <!--END #primary .hfeed-->
    </div>

<?php get_footer(); ?>