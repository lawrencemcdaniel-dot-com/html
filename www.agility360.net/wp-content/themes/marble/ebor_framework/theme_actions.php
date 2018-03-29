<?php 

/*
 * Displays the opening page wrapper.
 */
add_action( 'ebor_open_wrapper', 'ebor_open_wrapper_markup', 10 );
function ebor_open_wrapper_markup(){
	echo '<div class="container inner">';
}

/*
 * Displays the closing page wrapper.
 */
add_action( 'ebor_close_wrapper', 'ebor_close_wrapper_markup', 10 );
function ebor_close_wrapper_markup(){
	echo '<div class="clear"></div></div>';
}

/*
 * Displays the opening dark page wrapper.
 */
function ebor_open_dark_wrapper_markup(){
	echo '<div class="dark-wrapper shop-wrapper"><div class="container inner">';
}

/*
 * Displays the closing dark page wrapper.
 */
function ebor_close_dark_wrapper_markup(){
	echo '<div class="clear"></div></div></div>';
}

/*
 * Displays the appropriate post format
 */
add_action( 'ebor_post_format', 'ebor_post_format_markup', 10 );
function ebor_post_format_markup(){
	$format = get_post_format();
	if( $format == 'audio' || $format == 'quote' || $format == 'chat' ) return;
	if(!( $format )) $format = 'standard';
	get_template_part( 'postformats/format', $format );
}

/*
 * Displays the post title and meta details with a few conditionals.
 */
add_action( 'ebor_post_title', 'ebor_post_title_markup', 10 );
function ebor_post_title_markup(){
	global $post;
	( get_post_type() == 'team' ) ? $team = '<span>'.get_post_meta( $post->ID, '_cmb_the_job_title', true ).'</span><div class="divide20"></div>' : $team = '';
	echo ( is_single() ) ? '<h2 class="post-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>' : '<h1 class="post-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h1>';
	echo $team;
	if( get_post_type() == 'post' ) get_template_part('loop/loop','meta');
}

/*
 * Displays the isotope filters for the portfolio
 */
add_action( 'ebor_portfolio_filters', 'ebor_portfolio_filters_markup', 10 );
function ebor_portfolio_filters_markup(){
	$output = '';
	$output = '<ul class="filter"><li><a class="active" href="#" data-filter="*">'.__('All','marble').'</a></li>';
	  
	$categories = get_categories('taxonomy=portfolio-category');
	foreach ($categories as $category){
		$output .= '<li><a href="#" data-filter=".' . $category->slug . '">' . $category->name . '</a></li>';
	}
	
	$output .= '</ul>';
	echo $output;
}

/*
 * Displays the meta information on single portfolio posts
 */
add_action( 'ebor_portfolio_meta', 'ebor_portfolio_meta_markup', 10 );
function ebor_portfolio_meta_markup(){
	global $post;
	echo '<ul class="nobullets item-details">';
	  if( get_post_meta( $post->ID, '_cmb_the_client_date', true ) && get_option('portfolio_date', '1') == 1 ){
	  		echo '<li><span>'.__('Date','marble').':</span> '.get_post_meta( $post->ID, '_cmb_the_client_date', true ).'</li>';
	  }
	  if( ebor_the_simple_terms() && get_option('portfolio_categories', '1') == 1 ){
	  		echo '<li><span>'.__('Categories','marble').':</span> '.ebor_the_simple_terms().'</li>';
	  }
	  if( get_post_meta( $post->ID, '_cmb_the_client', true ) && get_option('portfolio_client', '1') == 1 ){
	  		echo '<li><span>'.__('Client','marble').':</span> '.get_post_meta( $post->ID, '_cmb_the_client', true ).'</li>';
	  }
	  if( get_post_meta( $post->ID, '_cmb_the_client_url', true ) && get_option('portfolio_url', '1') == 1 ){
	  		echo '<li><span>'.__('URL','marble').':</span> <a href="'.esc_url(get_post_meta( $post->ID, '_cmb_the_client_url', true )).'" target="_blank">'.esc_url(get_post_meta( $post->ID, '_cmb_the_client_url', true )).'</a></li>';
	  }
	  $titles = get_post_meta( $post->ID, '_cmb_the_additional_title', true );
	  $details = get_post_meta( $post->ID, '_cmb_the_additional_detail', true );
	  if( $titles ){
	  	foreach( $titles as $index => $title ){
	  		echo '<li><span>'.$title.':</span> '.$details[$index].'</li>';
	  	}
	  }
	echo '</ul>'; 
}

/*
 * Displays the sharing buttons for posts
 */
add_action( 'ebor_social_sharing', 'ebor_social_sharing_markup', 10 );
function ebor_social_sharing_markup(){
	global $post;
	
	$url[] = '';
	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
	if( get_post_type() == 'portfolio' && get_option( 'portfolio_share','1' ) == 1 || get_post_type() == 'post' && get_option( 'post_share','1' ) == 1 || get_post_type() == 'product' && get_option( 'product_share','1' ) == 1 ) :
	
	if( get_post_type() == 'product' )
		echo '<div class="divide20"></div>';
	?>
	
	<div class="divide10"></div>
	<div class="share"> 
	<a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" target="_blank" onClick="return ebor_fb_like()" class="btn pull-left btn-facebook">Like</a> 
	<a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" onClick="return ebor_tweet()" class="btn pull-left btn-twitter">Tweet</a> 
	<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" onClick="return ebor_plus_one()" class="btn pull-left btn-googleplus">+1</a> 
	<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $url[0]; ?>" onClick="return ebor_pin()" target="_blank" class="btn pull-left btn-pinterest">Pin It</a> 
	<div class="clear"></div>
	</div>
	
	<script type="text/javascript">
		function ebor_fb_like() {
			window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
			return false;
		}
		function ebor_tweet() {
			window.open('https://twitter.com/share?url=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
			return false;
		}
		function ebor_plus_one() {
			window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
			return false;
		}
		function ebor_pin() {
			window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $url[0]; ?>&description=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
			return false;
		}
	</script>
	
	<?php
	endif;
}