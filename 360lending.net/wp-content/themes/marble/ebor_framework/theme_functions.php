<?php

/////////////////////////////////////////////
////////CUSTOM FUNCTIONS////////////////////
///////////////////////////////////////////

/**
 * Set revslider into theme mode
 */
if(function_exists( 'set_revslider_as_theme' )){
	function ebor_set_revslider_as_theme(){
		set_revslider_as_theme();
	}
	add_action( 'init', 'ebor_set_revslider_as_theme' );
}

/* Select field */
function ebor_portfolio_field_select($field_id, $block_id, $options, $selected) {
	$output = '<select id="'. $block_id .'_'.$field_id.'" name="aq_blocks['.$block_id.']['.$field_id.']">';
	$output .= '<option value="all" '.selected( $selected, 'all', false ).'>Show All</option>';
	foreach($options as $option) {
		$output .= '<option value="'.$option->term_id.'" '.selected( $selected, $option->term_id, false ).'>'.htmlspecialchars($option->name).'</option>';
	}
	$output .= '</select>';
	return $output;
}

function ebor_load_favicons() { ?>
	<?php if ( get_option('144_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_option('144_favicon'); ?>"><?php endif; ?>
	<?php if ( get_option('114_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_option('114_favicon'); ?>"><?php endif; ?>
	<?php if ( get_option('72_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_option('72_favicon'); ?>"><?php endif; ?>
	<?php if ( get_option('mobile_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" href="<?php echo get_option('mobile_favicon'); ?>"><?php endif; ?>
	<?php if ( get_option('custom_favicon') !='' ) : ?><link rel="shortcut icon" href="<?php echo get_option('custom_favicon'); ?>"><?php endif; ?>
<?php }
add_action('wp_head', 'ebor_load_favicons');


// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'tcb_add_post_thumbnail_column', 5);

// Add the column
function tcb_add_post_thumbnail_column($cols){
  $cols['tcb_post_thumb'] = __('Featured Image','marble');
  return $cols;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function tcb_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'tcb_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'admin-list-thumb' );
      else
        echo 'Not supported in theme';
      break;
  }
}

/**
 * Portfolio Unlimited
 *
 * Uses pre_get_posts to provide unlimited portfolio posts when viewing the /portfolio/ archive
 *
 * @since 1.0.0
 */
 
function ebor_portfolio_unlimited( $query ) {

    if ( is_post_type_archive('portfolio') && !( is_admin() ) && $query->is_main_query() || is_post_type_archive('product') && get_option('shop_layout','shopstandard') == 'shopshowcase' && !( is_admin() ) && $query->is_main_query() ) {
        $query->set( 'posts_per_page', get_option('portfolio_posts_per_page','20') );
    }
    
    if ( is_tax('portfolio-category') && !( is_admin() ) && $query->is_main_query() || is_post_type_archive('portfolio') && get_option('portfolio_layout','classic') == 'classiclightbox' && $query->is_main_query() || is_post_type_archive('portfolio') && get_option('portfolio_layout','classic') == 'showcaselightbox' && $query->is_main_query() ) {
        $query->set( 'posts_per_page', '-1' );
    }
    
    return;
}
add_action( 'pre_get_posts', 'ebor_portfolio_unlimited' );

/**
 * Custom menu walker.
 *
 * Adds icons to the menu for the side naviation type.
 *
 * @since 1.0.0
 * @return menu object
 */
class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {

	
	function start_lvl(&$output, $depth = 0, $args = array()) {

		$indent = str_repeat( "\t", $depth );
		$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";
		
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		if($depth == 0){
			$classes[] = ($args->has_children) ? 'dropdown' : '';
		} elseif( $depth == 1) {
			$classes[] = ($args->has_children) ? 'dropdown-submenu' : '';
		}
		if( get_option('navigation_highlight','1') == '1' ){
			$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		} else {
			$classes[] = 'menu-item-' . $item->ID;
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		if($depth == 0){
			$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle js-activated"' : '';
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? '</a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		
		if ( !$element )
			return;
		
		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) ) 
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
				unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
		
	}
	
}

function ebor_wpml_cleaner($items,$args) {
      
    if($args->theme_location == 'primary'){
          
        if (function_exists('icl_get_languages')) {
            $items = str_replace('sub-menu', 'dropdown-menu', $items);
            $items = str_replace('onclick="return false"', 'class="dropdown-toggle js-activated"', $items);
            $items = str_replace('menu-item-language', 'menu-item-language dropdown', $items);
        }
  
        return $items;
    }
    else
        return $items;
}
add_filter( 'wp_nav_menu_items', 'ebor_wpml_cleaner', 20,2 );


/**
 * HEX to RGB Converter
 *
 * Converts a HEX input to an RGB array.
 * @param $hex - the inputted HEX code, can be full or shorthand, #ffffff or #fff
 * @since 1.0.0
 * @return string
 */
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
function ebor_the_simple_terms() {
global $post;
	if( get_the_terms($post->ID,'portfolio-category') !='' ) {
		$terms = get_the_terms($post->ID,'portfolio-category','',', ','');
		$terms = array_map('_simple_cb', $terms);
		return implode(' / ', $terms);
	}
}

/**
 * Term name return
 *
 * Returns the Pretty Name of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
function _simple_cb($t) {  return $t->name; }

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a space seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
function ebor_the_isotope_terms() {
global $post;
	if( get_the_terms($post->ID,'portfolio-category') ) {
		$terms = get_the_terms($post->ID,'portfolio-category','','','');
		$terms = array_map('_isotope_cb', $terms);
		return implode(' ', $terms);
	}
}

/**
 * Term Slug Return
 *
 * Returns the slug of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
function _isotope_cb($t) {  return $t->slug; }


/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
function ebor_the_simple_terms_links() {
global $post;
	if( get_the_terms($post->ID,'portfolio-category') !='' ) {
		$terms = get_the_terms($post->ID,'portfolio-category','',', ','');
		$terms = array_map('_simple_link', $terms);
		return implode(' ', $terms);
	}
}

/**
 * Term name return
 *
 * Returns the Pretty Name of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
function _simple_link($t) {  return '<a href="'.get_term_link( $t, 'portfolio-category' ).'">'.$t->name.'</a>'; }


//PAGIANTION, COURTESY OF KREISI
function kriesi_pagination($pages = '', $range = 2){
	$showitems = ($range * 2)+1;
	
	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
	}
	
	$output = '';
	
	if(1 != $pages){
		$output .= "<div class='pagination'><ul>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link(1)."'>".__('First','marble')."</a></li>";
		
		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
				$output .= ($paged == $i)? "<li class='active'><a href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
			}
		}
	
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link($pages)."'>".__('Last','marble')."</a></li>";
		$output.= "</ul></div>";
	}
	
	return $output;
}

function ebor_load_more($pages = '', $range = 2){
	$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		$displays = get_option('ebor_cpt_display_options');
		if( $displays['portfolio_slug'] ){ $slug = $displays['portfolio_slug']; } else { $slug = 'portfolio'; }
		
		if(1 != $pages){
			echo "<div class='load-more'><ul>";
			
			for ($i=1; $i <= $pages; $i++){
					echo ($paged == $i)? "":"<li><a href='".home_url('/'.$slug.'/page/'.$i)."'>".__('Load More','marble')." <i class='icon-arrows-cw'></i></a></li>";
			}
	
			echo "</ul></div>";
		}
}

function ebor_blog_load_more($pages = '', $range = 2, $cat = false){
	$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		( get_option('show_on_front') == 'page') ? $permalink = get_permalink( get_option( 'page_for_posts' ) ) : $permalink = trailingslashit( home_url() );
		
		if( $cat )
			$permalink = trailingslashit(get_term_link( $cat->term_id, $cat->taxonomy ));
		
		if(1 != $pages){
			echo "<div class='load-more'><ul>";
			
			for ($i=1; $i <= $pages; $i++){
					echo ($paged == $i)? "":"<li><a href='".$permalink.'page/'.$i."'>".__('Load More','marble')." <i class='icon-arrows-cw'></i></a></li>";
			}
	
			echo "</ul></div>";
		}
}

function ebor_load_more_shop($pages = '', $range = 2){
	$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		
		if(1 != $pages){
			echo "<div class='load-more'><ul>";
			
			for ($i=1; $i <= $pages; $i++){
					echo ($paged == $i)? "":"<li><a href='".$shop_page_url.'page/'.$i."'>".__('Load More','marble')." <i class='icon-arrows-cw'></i></a></li>";
			}
	
			echo "</ul></div>";
		}
}

function custom_comment($comment, $args, $depth) { 
$GLOBALS['comment'] = $comment; 
?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
  <div class="user"><?php echo get_avatar( $comment->comment_author_email, 70 ); ?></div>
  <div class="message">
    <div class="arrow-box">
      <div class="info">
        <?php printf('<h2>%s</h2>', get_comment_author_link()); ?>
        <div class="meta">
        	<div class="date"><?php echo get_comment_date(); ?></div>
        	<span class="sep">/</span>
        	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
      </div>
      <?php echo wpautop( get_comment_text() ); ?>
      <?php if ($comment->comment_approved == '0') : ?>
      <p><em><?php _e('Your comment is awaiting moderation.', 'marble') ?></em></p>
      <?php endif; ?>
    </div>
  </div>
</li>

<?php }