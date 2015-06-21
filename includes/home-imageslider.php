<?php 
		
		$tz_slider = get_option('tz_image_slider'); 
		$tz_autoslide = get_option('tz_image_slider_number');
		
		$image1 = get_option('tz_image_1');
		$image2 = get_option('tz_image_2');
		$image3 = get_option('tz_image_3');
		$image4 = get_option('tz_image_4');
		$image5 = get_option('tz_image_5');
		
		$link1 = get_option('tz_image_link_1');
		$link2 = get_option('tz_image_link_2');
		$link3 = get_option('tz_image_link_3');
		$link4 = get_option('tz_image_link_4');
		$link5 = get_option('tz_image_link_5');
		
		if($tz_autoslide == '')
			$tz_autoslide =  FALSE;
		
		if($tz_slider == 'true') : 
		
		?>
		
		<!--BEGIN #slider-->
		<div id="slider"<?php if($tz_autoslide) : ?> data-speed="<?php echo $tz_autoslide; ?>"<?php endif; ?>>
			
			<!--BEGIN .slides_container-->
			<div class="slides_container">
				
				<?php $image_count = 0; ?>
				
				<?php if($image1 != '') : ?>
				
				<?php if($link1 != '') :?>
				<a href="<?php echo $link1; ?>">
				<?php endif; ?>
				
				<img src="<?php echo $image1; ?>" alt="" width="900" height="350" />
				
				<?php if($link1 != '') :?>
				</a>
				<?php endif; ?>
				
				<?php $image_count++; endif;?>
				
				
				
				<?php if($image2 != '') : ?>
				
				<?php if($link2 != '') :?>
				<a href="<?php echo $link2; ?>">
				<?php endif; ?>
				
				<img src="<?php echo $image2; ?>" alt="" width="900" height="350" />
				
				<?php if($link2 != '') :?>
				</a>
				<?php endif; ?>
				
				<?php $image_count++; endif;?>
				
				
				
				<?php if($image3 != '') : ?>
				
				<?php if($link3 != '') :?>
				<a href="<?php echo $link3; ?>">
				<?php endif; ?>
				
				<img src="<?php echo $image3; ?>" alt="" width="900" height="350" />
				
				<?php if($link3 != '') :?>
				</a>
				<?php endif; ?>
				
				<?php $image_count++; endif;?>
				
				
				
				<?php if($image4 != '') : ?>
				
				<?php if($link4 != '') :?>
				<a href="<?php echo $link4; ?>">
				<?php endif; ?>
				
				<img src="<?php echo $image4; ?>" alt="" width="900" height="350" />
				
				<?php if($link4 != '') :?>
				</a>
				<?php endif; ?>
				
				<?php $image_count++; endif;?>
				
				
				<?php if($image5 != '') : ?>
				
				<?php if($link5 != '') :?>
				<a href="<?php echo $link5; ?>">
				<?php endif; ?>
				
				<img src="<?php echo $image5; ?>" alt="" width="900" height="350" />
				
				<?php if($link5 != '') :?>
				</a>
				<?php endif; ?>
				
				<?php $image_count++; endif;?>
			
			<!--END .slides_container-->
			</div>
			
			<?php if($image_count > 1) : ?>
			<div id="slide-arrow-wrap">
				<div id="slide-left"><a class="previous-slide" href="#"></a></div>
				<div id="slide-right"><a class="next-slide" href="#"></a></div>
			</div>
			<?php endif; ?>
						
		<!--BEGIN #slider-->
		</div>
		
		<?php endif; ?>
