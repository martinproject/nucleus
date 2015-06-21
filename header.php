<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>
<!-- A ThemeZilla design (http://www.themezilla.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<?php 
	
	$colour = get_option('tz_alt_stylesheet');
	
	if(!$colour)
	 	$colour = 'light.css';
	
	?>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $colour; ?>" type="text/css" media="screen" />
	
	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('tz_feedburner')) { echo get_option('tz_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<?php get_template_part('includes/header-overlay'); ?>

	<!-- BEGIN #container -->
	<div id="container">
	
		<!-- BEGIN #header -->
		<div id="header" class="clearfix">
			
			<!-- BEGIN #logo -->
			<div id="logo">
				<?php /*
				If "plain text logo" is set in theme options then use text
				if a logo url has been set in theme options then use that
				if none of the above then use the default logo.png */
				if (get_option('tz_plain_logo') == 'true') :
			    ?>
			    
				<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
				
				<?php elseif (get_option('tz_logo')) : ?>

				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('tz_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
				
				<?php else: ?>
				
				<?php 
				
				if($colour == 'dark.css')
					$dir = 'dark';
					
				if($colour == 'light.css' || !$colour)
					$dir = 'light';
					
				if($colour == 'clean.css')
					$dir = 'clean';
						
				?>
				
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $dir; ?>/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				
				<?php endif; ?>
				
				<?php 
				
				$tz_site_description = get_option('tz_site_description'); 
				
				if($tz_site_description != '') :
				
				?>

				<p id="tagline"><?php echo stripslashes(htmlspecialchars_decode(nl2br($tz_site_description))); ?></p>
				
				<?php endif; ?>
				
			<!-- END #logo -->
			</div>
			
			<!-- BEGIN #primary-nav -->
			<div id="primary-nav">
			
				<?php 
				
				if ( has_nav_menu( 'primary-menu-one' ) ) 
					wp_nav_menu( array( 'container_class' => 'menu-primary-container', 'theme_location' => 'primary-menu-one' ) ); 
	
				if ( has_nav_menu( 'primary-menu-two' ) ) 
					wp_nav_menu( array( 'container_class' => 'menu-primary-2-container', 'theme_location' => 'primary-menu-two' ) ); 
					
				$tz_phone = get_option('tz_header_phone');
				$tz_email = get_option('tz_header_email');
				
				if($tz_phone != '' || $tz_email != '') :
				
				?>
				
				<!-- BEGIN #header-contact -->
				<div id="header-contact">
				
					<ul>
				
						<?php if($tz_phone != '') : ?>
						<li><?php _e('T', 'framework'); ?>: <?php echo stripslashes(htmlspecialchars_decode($tz_phone)); ?></li>
						<?php endif;?>
						
						<?php if($tz_email != '') : ?>
						<li><?php _e('E', 'framework'); ?>: <?php echo stripslashes(htmlspecialchars_decode($tz_email)); ?></li>
						<?php endif;?>
					
					</ul>
	
				<!-- END #header-contact -->
				</div>
				
				<?php endif; ?>
				
			<!-- END #primary-nav -->
			</div>
			
			<?php 
			
			$auto = get_option('tz_slide_auto');
			
			if(is_page_template('template-home.php') && $auto == 'true') :

			$time = get_option('tz_slide_number');
			
			if($time == '')
				$time = 5000;
			
			?>
			
			<!-- BEGIN #progress-bar -->
			<div id="progress-bar" data-time="<?php echo $time; ?>" class="clearfix">
			
				<div class="progress-bar-track">
					<div class="progress-bar-side"></div>
					<div class="progress-bar-bg">
					</div>
				</div>
				
				<div class="pause"><a href="#"><?php _e('Pause', 'framework'); ?></a></div>
			
			<!-- END #progress-bar -->
			</div>
			
			<?php endif; ?>

			
		<!--END #header-->
		</div>
		
		<!--BEGIN #content -->
		<div id="content" class="clearfix">
		