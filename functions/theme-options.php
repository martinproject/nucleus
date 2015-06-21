<?php

add_action('init','tz_options');

if (!function_exists('tz_options')) {
function tz_options(){
	
// VARIABLES
if( function_exists( 'wp_get_theme' ) ) {
    if( is_child_theme() ) {
        $temp_obj = wp_get_theme();
        $theme_obj = wp_get_theme( $temp_obj->get('Template') );
    } else {
        $theme_obj = wp_get_theme();
    }
    $themeversion = $theme_obj->get('Version');
    $themename = $theme_obj->get('Name');
} else { 
    $theme_data = get_theme_data(STYLESHEETPATH . '/style.css');
    $themename = $theme_data['Name'];
    $themeversion = $theme_data['Version'];
}
$shortname = "tz";

// Populate option in array for use in theme
global $tz_options;
$tz_options = get_option('tz_options');

$GLOBALS['template_path'] = TZ_DIRECTORY;

//Access the WordPress Categories via an Array
$tz_categories = array();  
$tz_categories_obj = get_categories('hide_empty=0');
foreach ($tz_categories_obj as $tz_cat) {
    $tz_categories[$tz_cat->cat_ID] = $tz_cat->cat_name;}
$categories_tmp = array_unshift($tz_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$tz_pages = array();
$tz_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tz_pages_obj as $tz_page) {
    $tz_pages[$tz_page->ID] = $tz_page->post_name; }
$tz_pages_tmp = array_unshift($tz_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = TZ_FILEPATH . '/css/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('tz_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Set the Options Array
$options = array();




$options[] = array( "name" => __('General Settings','framework'),
                    "type" => "heading");
                    
$options[] = array( "name" => "",
					"message" => __('Control and configure the general setup of your theme. Upload your preferred logo, setup your feeds and insert your analytics tracking code.','framework'),
					"type" => "intro");
					
$options[] = array( "name" => __('Website Description','framework'),
					"desc" => __('Enter your site description. This will appear underneath your logo.','framework'),
					"id" => $shortname."_site_description",
					"std" => "",
					"type" => "textarea");
					
$options[] = array( "name" => __('Contact Telephone Number','framework'),
					"desc" => __('Enter your contact telephone number. This will appear beside your site navigation','framework'),
					"id" => $shortname."_header_phone",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Contact Email Address','framework'),
					"desc" => __('Enter your contact email address. This will appear beside your site navigation','framework'),
					"id" => $shortname."_header_email",
					"std" => "",
					"type" => "text");
					
 
                    
$options[] = array( "name" => __('Enable Plain Text Logo','framework'),
					"desc" => __('Check this to enable a plain text logo rather than an image.','framework'),
					"id" => $shortname."_plain_logo",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => __('Custom Logo','framework'),
					"desc" => __('Upload a logo for your theme, or specify the image address of your online logo. (http://example.com/logo.png)','framework'),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
				

$options[] = array( "name" => __('Custom Favicon','framework'),
					"desc" => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','framework'),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __('Contact Form Email Address','framework'),
					"desc" => __('Enter the email address where you\'d like to receive emails from the contact form, or leave blank to use admin email.','framework'),
					"id" => $shortname."_email",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('FeedBurner URL','framework'),
					"desc" => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere','framework'),
					"id" => $shortname."_feedburner",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __('Tracking Code','framework'),
					"desc" => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.','framework'),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");                                                    
										
					
					
$options[] = array( "name" => __('Styling Options','framework'),
					"type" => "heading");
					
					
$options[] = array( "name" => "",
					"message" => __('Configure the visual appearance of you theme by selecting a stylesheet if applicable, choosing your overall layout and inserting any custom CSS necessary.','framework'),
					"type" => "intro");
					
$options[] = array( "name" => __('Theme Stylesheet','framework'),
					"desc" => __('Select your themes alternative color scheme.','framework'),
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);
					
$options[] = array( "name" => __('Link Colour','framework'),
					"desc" => __('Select your themes link colour scheme.','framework'),
					"id" => $shortname."_link_colour",
					"std" => "#f26c4f",
					"type" => "color");
					
$options[] = array( "name" => __('Custom CSS','framework'),
                    "desc" => __('Quickly add some CSS to your theme by adding it to this block.','framework'),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");
					
					
$options[] = array( "name" => __('Overlay Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => "",
					"message" => __('Choose whether to enable/disable your site\'s overlay. Use this feature to show special content.','framework'),
					"type" => "intro");				
                    
$options[] = array( "name" => __('Enable Overlay','framework'),
					"desc" => __('Check this to enable the overlay.','framework'),
					"id" => $shortname."_enable_overlay",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => __('Overlay Content','framework'),
					"desc" => __('Choose the page you wish to use within your overlay.','framework'),
					"id" => $shortname."_overlay_page",
					"std" => "",
					"type" => "select-page");
					


					
$options[] = array( "name" => __('Homepage Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => "",
					"message" => __('The following settings allow you to customise the ajax slider on the default home page template.','framework'),
					"type" => "intro");
					
$options[] = array( "name" => __('Enable Auto Slide','framework'),
					"desc" => __('Check this to enable the slider to load a new slide automatically after a period of time.','framework'),
					"id" => $shortname."_slide_auto",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => __('Slide Duration','framework'),
					"desc" => __('Enter in the amount of milliseconds before the slider loads the next post. 5000 = 5 seconds.','framework'),
					"id" => $shortname."_slide_number",
					"std" => "",
					"type" => "text");





$options[] = array( "name" => __('Homepage Alt Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => "",
					"message" => __('Portfolio area settings.','framework'),
					"type" => "intro");

$options[] = array( "name" => __('Enable Portfolio Area','framework'),
					"desc" => __('Check this to enable the portfolio posts on the homepage.','framework'),
					"id" => $shortname."_portfolio_enable",
					"std" => "false",
					"type" => "checkbox");					

					
$options[] = array( "name" => __('Recent Work Title','framework'),
					"desc" => __('Enter in the title you wish to use in place of "Recent Work".','framework'),
					"id" => $shortname."_portfolio_title",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Portfolio Order','framework'),
					"desc" => __('Choose the order of your portfolio posts.','framework'),
					"id" => $shortname."_portfolio_order",
					"std" => "",
					"options" => array('date' => __('Date', 'framework'), 'rand' => __('Random', 'framework')),
					"type" => "select2");
					
$options[] = array( "name" => __('Portfolio Number','framework'),
					"desc" => __('Enter the amount of portfolio posts you would like to show.','framework'),
					"id" => $shortname."_portfolio_number",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "",
					"message" => __('Blog area settings.','framework'),
					"type" => "intro");
									
					
$options[] = array( "name" => __('Enable Blog Area','framework'),
					"desc" => __('Check this to enable the blog posts on the homepage.','framework'),
					"id" => $shortname."_blog_enable",
					"std" => "false",
					"type" => "checkbox");	
					
					
$options[] = array( "name" => __('From the Blog Title','framework'),
					"desc" => __('Enter in the title you wish to use in place of "From the Blog".','framework'),
					"id" => $shortname."_blog_title",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __('Blog Order','framework'),
					"desc" => __('Choose the order of your blog posts.','framework'),
					"id" => $shortname."_blogo_order",
					"std" => "",
					"options" => array('date' => __('Date', 'framework'), 'rand' => __('Random', 'framework')),
					"type" => "select2");
					
$options[] = array( "name" => __('Blog Number','framework'),
					"desc" => __('Enter the amount of blog posts you would like to show.','framework'),
					"id" => $shortname."_blog_number",
					"std" => "",
					"type" => "text");

					
					
$options[] = array( "name" => "",
					"message" => __('The following settings allow you to configure the image slider on the alternative home page template.','framework'),
					"type" => "intro");
									
				
$options[] = array( "name" => __('Enable Slider','framework'),
					"desc" => __('Check this to enable the image slider.','framework'),
					"id" => $shortname."_image_slider",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => __('Autoslide','framework'),
					"desc" => __('Enter in the amount of milliseconds before the next transition or leave blank to disable auto slide. 5000 = 5 seconds.','framework'),
					"id" => $shortname."_image_slider_number",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __('Image 1','framework'),
					"desc" => __('Upload an image to show in the slider.','framework'),
					"id" => $shortname."_image_1",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __('Image 1 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_1",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __('Image 2','framework'),
					"desc" => __('Upload an image to show in the slider.','framework'),
					"id" => $shortname."_image_2",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __('Image 2 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_2",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Image 3','framework'),
					"desc" => __('Upload an image to show in the slider.','framework'),
					"id" => $shortname."_image_3",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __('Image 3 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_3",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __('Image 4','framework'),
					"desc" => __('Upload an image to show in the slider.','framework'),
					"id" => $shortname."_image_4",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __('Image 4 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_4",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __('Image 5','framework'),
					"desc" => __('Upload an image to show in the slider.','framework'),
					"id" => $shortname."_image_5",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __('Image 5 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_5",
					"std" => "",
					"type" => "text");
					

$options[] = array( "name" => __('Portfolio Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => "",
					"message" => __('The following settings allow you to customise areas in your portfolio posts.','framework'),
					"type" => "intro");
					
$options[] = array( "name" => __('Enable Autoslide','framework'),
					"desc" => __('Enter in the amount of milliseconds before the slider goes onto the next transition. 5000 = 5 seconds, 0 will disable auto slide.','framework'),
					"id" => $shortname."_portfolio_slide_number",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __('Enable Related Posts','framework'),
					"desc" => __('Check this to enable the related posts area.','framework'),
					"id" => $shortname."_portfolio_enable_related",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => __('Related Title','framework'),
					"desc" => __('Enter the related posts title.','framework'),
					"id" => $shortname."_portfolio_related_title",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __('Related Posts Number','framework'),
					"desc" => __('Enter the amount of related posts to show.','framework'),
					"id" => $shortname."_portfolio_related_number",
					"std" => "4",
					"type" => "text");									
					
					
					
					
$options[] = array( "name" => __('Post Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => "",
					"message" => __('Here you can configure how you would like your posts to function.','framework'),
					"type" => "intro");
					
$options[] = array( "name" => __('Show Featured Image','framework'),
					"desc" => __('Check this to show the featured image at the beginning of the post.','framework'),
					"id" => $shortname."_post_img",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => __('Respond Caption','framework'),
					"desc" => __('Input a caption that will sit near the comment reply form.','framework'),
					"id" => $shortname."_respond_caption",
					"std" => "",
					"type" => "textarea");
					
					
					
					
				

update_option('tz_template',$options); 					  
update_option('tz_themename',$themename);   
update_option('tz_shortname',$shortname);

}
}
?>
