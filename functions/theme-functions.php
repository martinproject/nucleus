<?php

/* These are functions specific to the included option settings and this theme */


/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function tz_head_css() {

		$output = '';
		
		$custom_css = get_option('tz_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Link Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}

add_action('wp_head', 'tz_head_css');


/*-----------------------------------------------------------------------------------*/
/* Link Colour CSS
/*-----------------------------------------------------------------------------------*/

function tz_link_css() {

		$output = '';
		
		$colour = get_option('tz_link_colour');
		
		// Output styles
		if ($colour != '') {
			?>
			
			<style type="text/css">
				
				a:hover,
				#sidebar .tz_tweet_widget span a:hover,
				#sidebar a:hover,
				.entry-content a:hover,
				.entry-excerpt a:hover,
				.comment-body a:hover,
				.author-tag,
				#respond label span,
				.image-grid li .entry-title a:hover,
				.page-template-template-home-alt-php .type-portfolio .entry-title a:hover,
				.page-template-template-home-alt-php .entry-title a:hover,
				#primary-nav a:hover { color: <?php echo $colour; ?>; }
			
			</style>
			
			<?php
		}
	
}

add_action('wp_head', 'tz_link_css');


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function tz_favicon() {
	$shortname = get_option('tz_shortname');
	if (get_option($shortname . '_custom_favicon') != '') {
	echo '<link rel="shortcut icon" href="'. get_option('tz_custom_favicon') .'"/>'."\n";
	}
	else { ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
	<?php }
}

add_action('wp_head', 'tz_favicon');


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function tz_analytics(){
	$shortname =  get_option('tz_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','tz_analytics');


/*-----------------------------------------------------------------------------------*/
/*	Helpful function to see if a number is a multiple of another number
/*-----------------------------------------------------------------------------------*/

function tz_is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
}

/*-----------------------------------------------------------------------------------*/
/*	Get related posts by taxonomy
/*-----------------------------------------------------------------------------------*/

function get_posts_related_by_taxonomy($post_id, $taxonomy, $args=array()) {
  $query = new WP_Query();
  $terms = wp_get_object_terms($post_id, $taxonomy);
  if (count($terms)) {
    // Assumes only one term for per post in this taxonomy
    $post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
    $post = get_post($post_id);
    $our_terms = array();
    foreach($terms as $term) {
        $our_terms[] = $term->slug;
    }
    $args = wp_parse_args($args,array(
        'post_type' => $post->post_type, // The assumes the post types match
        //'post__in' => $post_ids,
        'post__not_in' => array($post_id),
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'terms' => $our_terms,
                'field' => 'slug',
                'operator' => 'IN'
            )
        ),
        'orderby' => 'rand',
        'posts_per_page' => get_option('tz_portfolio_related_number')
    ));
    $query = new WP_Query($args);
  }
  return $query;
}

/*-----------------------------------------------------------------------------------*/
/*	Audio JS
/*-----------------------------------------------------------------------------------*/

function tz_audio($postid) {
	
	$mp3 = get_post_meta($postid, 'tz_audio_mp3', TRUE);
	$ogg = get_post_meta($postid, 'tz_audio_ogg', TRUE);
	
	 ?>
		<script type="text/javascript">
		
			jQuery(document).ready(function(){
	
				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
								<?php if($mp3 != '') : ?>
								mp3: "<?php echo $mp3; ?>",
								<?php endif; ?>
								<?php if($ogg != '') : ?>
								oga: "<?php echo $ogg; ?>",
								<?php endif; ?>
								end: ""
							});
						},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
					});
					
				}
			});
		</script>
	<?php 
}


/*-----------------------------------------------------------------------------------*/
/*	Video JS
/*-----------------------------------------------------------------------------------*/

function tz_video($postid) {
	
	$m4v = get_post_meta($postid, 'tz_video_m4v', TRUE);
	$ogv = get_post_meta($postid, 'tz_video_ogv', TRUE);
	$poster = get_post_meta($postid, 'tz_video_poster', TRUE);
	
	 ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				
				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
								<?php if($m4v != '') : ?>
								m4v: "<?php echo $m4v; ?>",
								<?php endif; ?>
								<?php if($ogv != '') : ?>
								ogv: "<?php echo $ogv; ?>",
								<?php endif; ?>
								<?php if ($poster != '') : ?>
								poster: "<?php echo $poster; ?>"
								<?php endif; ?>
							});
						},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
					});
					
				}
			});
		</script>
	<?php 
}


/*-----------------------------------------------------------------------------------*/
/*	List categories for the portfolio
/*-----------------------------------------------------------------------------------*/

class Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	  $link = '<a href="#" data-value="term-'.$category->term_id.'" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all items filed under %s' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '><span class="border"></span>';
      // $link .= $cat_name . '</a>';
      $link .= $cat_name;
      if(!empty($category->description)) {
         $link .= ' <span>'.$category->description.'</span>';
      }
      $link .= '</a><span class="middot">&middot;</span>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class=" ';
          $class = 'segment-'.$category->term_id.' cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  $class . '"';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}



?>
