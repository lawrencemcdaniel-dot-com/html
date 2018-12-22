<?php

add_shortcode('map_wrapper','map_wrapper');
function map_wrapper( $attrs = null, $content = null,$shortcodename ="" ){
	return "<div class='map-wrapper'></div>";
}

/** fblike
  * Objective:
  *		1.Facebook Widget.
**/
add_shortcode('fblike','fblike');
function fblike( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'box_count','width'=>'','height'=>'','send'=>false,'show_faces'=>false,'action'=>'like','font'=> 'lucida+grande'
				,'colorscheme'=>'light'), $attrs));

	if ($layout == 'standard') { $width = '450'; $height = '35';  if ($show_faces == 'true') { $height = '80'; } }
	if ($layout == 'box_count') { $width = '55'; $height = '65'; }
	if ($layout == 'button_count') { $width = '90'; $height = '20'; }
	$layout = 'data-layout = "'.$layout.'" ';
	$width = 'data-width = "'.$width.'" ';
	$font = 'data-font = "'.str_replace("+", " ", $font).'" ';
	$colorscheme = 'data-colorscheme = "'.$colorscheme.'" ';
	$action = 'data-action = "'.$action.'" ';
	if ( $show_faces ) { $show_faces = 'data-show-faces = "true" '; } else { $show_faces = ''; }
	if ( $send ) { $send = 'data-send = "true" '; } else { $send = ''; }
	
    $out = '<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>';
	$out .= '<div class = "fb-like" data-href = "'.get_permalink().'" '.$layout.$width.$font.$colorscheme.$action.$show_faces.$send.'></div>';
return $out;
}


/** googleplusone
  * Objective:
  *		1.googleplusone Widget.
**/
add_shortcode('googleplusone','googleplusone');	
function googleplusone( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('size'=> '','lang'=> ''), $attrs));
	$size = empty($size) ? "size='small'" : "size='{$size}'";
	$lang = empty($lang) ? "{lang:en_GB}" : "{lang:'{$lang}'}";
	
	$out = '<script type="text/javascript" src="https://apis.google.com/js/plusone.js">'.$lang.'</script>';
	$out .= '<g:plusone '.$size.'></g:plusone>';
	return $out;
}

/** twitter
  * Objective:
  *		1.twitter Widget.
**/
add_shortcode('twitter','twitter');
function twitter( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'vertical','username'=>'','text'=>'','url'=>'','related'=> '','lang'=> ''), $attrs));
	
	$p_url= get_permalink();
	$p_title = get_the_title();
	
	$text = !empty($text) ? "data-text='{$text}'" :"data-text='{$p_title}'";
	$url = !empty($url) ? "data-url='{$url}'" :"data-url='{$p_url}'";
	$related = !empty($related) ? "data-related='{$related}'" :'';
	$lang = !empty($lang) ? "data-lang='{$lang}'" :'';
	$twitter_url = "http://twitter.com/share";
		$out = '<a href="{$twitter_url}" class="twitter-share-button" '.$url.' '.$lang.' '.$text.' '.$related.' data-count="'.$layout.'" data-via="'.$username.'">'.
	__('Tweet','dt_themes').'</a>';
		$out .= '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
	return $out;	
}

/** stumbleupon
  * Objective:
  *		1.Stumbleupon Widget.
**/
add_shortcode('stumbleupon','stumbleupon');
function stumbleupon( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'5','url'=>get_permalink()),$attrs));
	$url = "&r='{$url}'";
	$out = '<script src="//www.stumbleupon.com/hostedbadge.php?s='.$layout.$url.'"></script>';
return $out;	
}

/** linkedin
  * Objective:
  *		1.linkedin Widget.
**/
add_shortcode('linkedin','linkedin');
function linkedin( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'2','url'=>get_permalink()),$attrs));
	
    	if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($layout == '2') { $layout = 'right'; }
		if ($layout == '3') { $layout = 'top'; }
		$out = '<script type="text/javascript" src="//platform.linkedin.com/in.js"></script><script type="in/share" data-counter = "'.$layout.'" '.$url.'></script>';
return $out;	
}

/** delicious
  * Objective:
  *		1.Delicious Widget.
**/
add_shortcode('delicious','delicious');
function delicious( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('text'=>__("Delicious",'dt_themes')),$attrs));
	
	$delicious_url = "//delicious.com/save";
	
	$out = '<img src="//delicious.com/static/img/delicious.small.gif" height="10" width="10" alt="Delicious" />&nbsp;<a href="{$delicious_url}" onclick="window.open(&#39;http://www.delicious.com/save?v=5&noui&jump=close&url=&#39;+encodeURIComponent(location.href)+&#39;&title=&#39;+encodeURIComponent(document.title), &#39;delicious&#39;,&#39;toolbar=no,width=550,height=550&#39;); return false;">'.$text.'</a>';
return $out;	
}

/** pintrest
  * Objective:
  *		1.Pintrest Widget.
**/
add_shortcode('pintrest','pintrest');
function pintrest( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('text'=>get_the_excerpt(),'layout'=>'horizontal','image'=>'','url'=>get_permalink(),'prompt'=>false),$attrs));
	$out = '<div class = "mysite_sociable"><a href="//pinterest.com/pin/create/button/?url='.$url.'&media='.$image.'&description='.$text.'" class="pin-it-button" count-layout="'.$layout.'">'.__("Pin It",'dt_themes').'</a>';
	$out .= '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
	
	if($prompt):
		$out = '<a title="'.__('Pin It on Pinterest','dt_themes').'" class="pin-it-button" href="javascript:void(0)">'.__("Pin It",'dt_themes').'</a>';
		$out .= '<script type = "text/javascript">';
		$out .= 'jQuery(document).ready(function(){';
			$out .= 'jQuery(".pin-it-button").click(function(event) {';
			$out .= 'event.preventDefault();';
			$out .= 'jQuery.getScript("//assets.pinterest.com/js/pinmarklet.js?r=" + Math.random()*99999999);';
			$out .= '});';
		$out .= '});';
		$out .= '</script>';
		$out .= '<style type = "text/css">a.pin-it-button {position: absolute;background: url(//assets.pinterest.com/images/pinit6.png);font: 11px Arial, sans-serif;text-indent: -9999em;font-size: .01em;color: #CD1F1F;height: 20px;width: 43px;background-position: 0 -7px;}a.pin-it-button:hover {background-position: 0 -28px;}a.pin-it-button:active {background-position: 0 -49px;}</style>';
	
	endif;
	return $out;
}

/** digg
  * Objective:
  *		1.Digg Widget.
**/
add_shortcode('digg','digg');
function digg( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'DiggMedium','url'=>get_permalink(),'title'=>get_the_title(),'type'=>'','description'=>get_the_content(),'related'=>''),$attrs));
	
	if ($title != '') { $title = "&title='".$title."'"; }
	if ($type != '') { $type = "rev='".$type."'"; }
	if ($description != '') { $description = "<span style = 'display: none;'>".$description."</span>"; }
	if ($related != '') { $related = "&related=no"; }

	$out = '<a class="DiggThisButton '.$layout.'" href="//digg.com/submit?url='.$url.$title.$related.'"'.$type.'>'.$description.'</a>';
	$out .= '<script type = "text/javascript" src = "//widgets.digg.com/buttons.js"></script>';
	return $out;
}

add_shortcode('social','my_social'); 
function my_social($attrs, $content=null,$shortcodename="") {
	$dttheme_options = get_option(IAMD_THEME_SETTINGS);

	if( isset($dttheme_options['general']['show-sociables']) && isset($dttheme_options['social']) ):
		$out = "<ul class='dt-sc-social-icons'>";
			foreach($dttheme_options['social'] as $social):
				$link = $social['link'];
				$custom_image = isset($social['custom-image']) && !empty($social['custom-image']) ? "<img src='{$custom_image}' />": '';
				$icon = $social['icon'];
				$class = explode(".",$icon);
				$class = $class[0];
				$out .= "<li class='{$class}'><a href='{$link}' target='_blank'>";
				if(!empty($custom_image)):
					$out .=	$custom_image;
				else:
					$out .= "<img src='".IAMD_BASE_URL."images/sociable/hover/{$icon}' alt='{$icon}' />";
				endif;
				
				$out .= "<img src='".IAMD_BASE_URL."images/sociable/{$icon}' alt='{$icon}' />";
				$out .="	</a>";
				$out .= "</li>"; 
			endforeach;
		$out .= "</ul>";
	return $out;	
	endif;	
}


add_shortcode('dt_sc_post','dt_sc_post');
function dt_sc_post( $attrs, $content=null, $shortcodename ="" ){
	extract(shortcode_atts(array( 'id'=>'1', 'read_more_text'=>__('Read More','dt_themes'),'excerpt_length'=>10), $attrs));
	
	$p = get_post($id,'ARRAY_A');
if( !is_null($p) && 'post'==$p['post_type'] ) {
	$link = get_permalink($id);
	$title = $p['post_title'];
	$author_id = $p['post_author'];
	$class = get_post_class("blog-entry",$id);
	$class = implode(" ",$class);
	
	$tags = "";
	$terms = wp_get_post_tags($id);
	if( !empty($terms) ){
		$tags .= '<p class="tags"><span class="fa fa-tags"> </span>';
		foreach( $terms as $term ){
			$tags .= '<a href="'.get_term_link($term->slug, 'post_tag').'"> '.$term->name.'</a>,';
		}
		$tags = substr($tags,0,-1);
		$tags .= '</p>';
	}
	
	$post_meta = get_post_meta($id ,'_dt_post_settings',TRUE);
	$format = get_post_format($id);
	
	$out =  "<article class='{$class}'>";
	$out .= '	<div class="blog-entry-inner">';
	
	$out .= '		<div class="entry-meta">';
	$out .= "			<a href='{$link}' class='entry_format'></a>";
	$out .= '			<div class="date"><p>'. get_the_date('M',$id).' '.get_the_date('d',$id).' <span> '.get_the_date('Y',$id).'</span></p></div>';
	
	$commtext = "";
	if((wp_count_comments($id)->approved) == 0)	$commtext = '0';
	else $commtext = wp_count_comments($id)->approved;
	$out .= "			<a href='{$link}/#respond' class='comments'><span class='fa fa-comments'> </span> ".$commtext."</a>";
	$out .= '		</div>';
	
	$out .= '		<div class="entry-thumb">';
						#Image Format
						if( $format === "image" || empty($format) ):
							$out .= "<a href='{$link}'>";
							if( has_post_thumbnail( $id )) {
								$out .= get_the_post_thumbnail($id,'full');	
							}else{
								$out .= '<img src="//placehold.it/1060x636&text=Image"/>';
							}
							$out .= '</a>';
						
						#Gallery Format
						elseif( $format === "gallery" ):
							$out .= "<ul class='entry-gallery-post-slider'>";
								if( has_post_thumbnail() ):
									$id = get_post_thumbnail_id($post->ID);
									$img = wp_get_attachment_image_src($id,'full');
									$out .= "<li><img src='".$img[0]."' width='".$img[1]."' height='".$img[2]."' alt=''/></li>";
								endif;
								
								if( array_key_exists("items", $post_meta) ):
									$items_id_exists = array_key_exists('items_id',$post_meta) ? true : false;
									foreach ( $post_meta['items'] as $k => $item ) {
										if( $items_id_exists ) {
											$id = $post_meta['items_id'][$k];
											$img = wp_get_attachment_image_src($id,'full');
											$out .= "<li><img src='".$img[0]."' width='".$img[1]."' height='".$img[2]."' alt='' /></li>";
										} else {
											$out .= "<li><img src='{$item}' /></li>";
										}
									}
								endif;
							$out .= '</ul>';						
						#Video Format
						elseif( $format == "video" ):
							if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
								if( array_key_exists('oembed-url', $post_meta) ):
									$out .= "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
								elseif( array_key_exists('self-hosted-url', $post_meta) ):
									$out .= "<div class='dt-video-wrap'>".apply_filters( 'the_content', $post_meta['self-hosted-url'] ).'</div>';
								endif;
							endif;
						
						#Audio Format
						elseif( $format == "audio" ):
							if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
								if( array_key_exists('oembed-url', $post_meta) ):
									$out .= wp_oembed_get($post_meta['oembed-url']);
								elseif( array_key_exists('self-hosted-url', $post_meta) ):
									$out .= apply_filters( 'the_content', $post_meta['self-hosted-url'] );
								endif;
							endif;
						else:
							$out .= "<a href='{$link}'>";
								if( has_post_thumbnail( $id )) {
									$out .= get_the_post_thumbnail($id,'full');	
								}else{
									$out .= '<img src="//placehold.it/1060x636&text=Image"/>';
								}
							$out .= '</a>';
						endif;
	$out .= '		</div>';
	
	$out .= '		<div class="entry-details">';
	$out .= "			<div class='entry-title'><h4><a href='{$link}'>{$title}</a></h4></div>";
	
	$out .= '			<div class="entry-metadata">';
	$out .= "				<p class='author'><span class='fa fa-user'> </span><a href='".get_author_posts_url($author_id)."'>".get_the_author_meta('display_name',$author_id)."</a></p>";
	$out .=  				$tags;
	$out .= '			</div><!-- .entry-metadata -->';
	
	$out .= '			<div class="entry-body">';
						$excerpt = explode(' ', $p['post_content'], $excerpt_length);
						$excerpt = array_filter($excerpt);
						
						if (!empty($excerpt)) {
							if (count($excerpt) >= $excerpt_length) {
								array_pop($excerpt);
								$excerpt = implode(" ", $excerpt).'...';
							} else {
								$excerpt = implode(" ", $excerpt);
							}
							$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
							$excerpt = strip_tags($excerpt,'');
							$out .= '<p>'.$excerpt.'</p>';										
						}

	$out .= '			</div>';

	$out .= "	 		<a href='{$link}' class='dt-sc-button small read-more'> {$read_more_text} <span class='fa fa-angle-double-right'> </span></a>";	
	
	$out .= '		</div>';
	
	$out .= '	</div>';
	$out .= '</article>';
	return $out;
 }
}

#Recent Posts
add_shortcode('dt_sc_recent_post','dt_sc_recent_post');
function dt_sc_recent_post( $attrs, $content=null, $shortcodename ="" ){
	extract(shortcode_atts(array( 'count' => '2', 'column' => '2', 'read_more_text'=>__('Read More','dt_themes'),'excerpt_length'=>10, 'category' => ''), $attrs));
	
	global $post;
	$tpl_default_settings = get_post_meta( $post->ID, '_tpl_default_settings', TRUE );
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	$show_sidebar = ( $page_layout === "content-full-width" ) ? false : true;
	$image_size = "";
	
	$column = $column;
	$out = '';
	
	switch( $column ):
		case '1':
			$image_size = $show_sidebar ? "dt-blog-one-column-with-sidebar" : "dt-blog-one-column";
		break;
		case '2':
			$image_size = $show_sidebar ? "dt-blog" : "dt-blog-two-column";
		break;
		case '3':
			$image_size = "dt-blog";
		break;
		case '4':
			$image_size = "dt-blog";
		break;
	endswitch;
	
	$rposts = new WP_Query( array( 'posts_per_page' => $count, 'orderby' => 'date' ) );
	
	if( !empty( $category ) ) {
		
		$category = explode(",",$category);
		$rposts = new WP_Query( array( 'posts_per_page' => $count, 'orderby' => 'date', 'category__in' => $category ) );
	}
    
    if ( $rposts->have_posts() ) {
        while( $rposts->have_posts() ) {
            $rposts->the_post();
			
			$id=get_the_id();
			$author=get_the_author();
			$format = get_post_format($id);
			$link = get_permalink($id);
			$post_meta = get_post_meta($id ,'_dt_post_settings',TRUE);
			
			if($column == 1) {
				$class = '<div class="column dt-sc-one-column blog-fullwidth first">';
			}else if($column == 2){
				if(($rposts->current_post % 2) == 0) {
					$class = "<div class='column dt-sc-one-half first'>";
				}else{
					$class = "<div class='column dt-sc-one-half'>";
				}
			}else{
				
				if(($rposts->current_post % 3) == 0){
					$class = "<div class='column dt-sc-one-third first'>";
				}else{
					$class = "<div class='column dt-sc-one-third'>";
				}
			}
				
			
			$out .= $class;
			$out .=  "<article class='postid- {$id} author- {$author} format-{$format} blog-entry'>";
			$out .= '	<div class="blog-entry-inner">';
			
			$out .= '		<div class="entry-meta">';
			$out .= "			<a href='".get_permalink()."' class='entry_format'></a>";
			$out .= '			<div class="date"><p>'. get_the_date('M').' '.get_the_date('d').' <span> '.get_the_date('Y').'</span></p></div>';

			$out .= "			<a href='".get_comments_link()."' class='comments'><span class='fa fa-comments'> </span> ".get_comments_number( 'no responses', '1', '%' )."</a>";
			$out .= '		</div>';
			
			$out .= '		<div class="entry-thumb">';
							#Image Format
							if( $format === "image" || empty($format) ):
								$out .= "<a href='{$link}'>";
								if( has_post_thumbnail( $id )) {
									$out .= get_the_post_thumbnail($id,$image_size);	
								}else{
									$out .= '<img src="//placehold.it/1060x636&text=Image"/>';
								}
								$out .= '</a>';

							#Gallery Format	
							elseif( $format === "gallery" ):
								$out .= "<ul class='entry-gallery-post-slider'>";
									if( has_post_thumbnail() ):
										$id = get_post_thumbnail_id($post->ID);
										$img = wp_get_attachment_image_src($id,$image_size);
										$out .= "<li><img src='".$img[0]."' width='".$img[1]."' height='".$img[2]."' alt=''/></li>";
									endif;
									
									if( array_key_exists("items", $post_meta) ):
										$items_id_exists = array_key_exists('items_id',$post_meta) ? true : false;
										foreach ( $post_meta['items'] as $k => $item ) {
											if( $items_id_exists ) {
												$id = $post_meta['items_id'][$k];
												$img = wp_get_attachment_image_src($id,$image_size);
												
												$out .= "<li><img src='".$img[0]."' width='".$img[1]."' height='".$img[2]."' alt='' /></li>";
											} else {
												$out .= "<li><img src='{$item}' /></li>";
											}
										}
									endif;
								$out .= '</ul>';

							#Video Format
							elseif( $format == "video" ):
								if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
									if( array_key_exists('oembed-url', $post_meta) ):
										$out .= "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
									elseif( array_key_exists('self-hosted-url', $post_meta) ):
										$out .= "<div class='dt-video-wrap'>".apply_filters( 'the_content', $post_meta['self-hosted-url'] ).'</div>';
									endif;
								endif;
									
							#Audio Format
							elseif( $format == "audio" ):
								if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
									if( array_key_exists('oembed-url', $post_meta) ):
										$out .= wp_oembed_get($post_meta['oembed-url']);
									elseif( array_key_exists('self-hosted-url', $post_meta) ):
										$out .= apply_filters( 'the_content', $post_meta['self-hosted-url'] );
									endif;
								endif;
							else:
								$out .= "<a href='{$link}'>";
								if( has_post_thumbnail( $id )) {
									$out .= get_the_post_thumbnail($id,$image_size);	
								}else{
									$out .= '<img src="//placehold.it/1060x636&text=Image"/>';
								}
								$out .= '</a>';
							endif;
			$out .= '		</div>'; 
			
			$out .= '		<div class="entry-details">';
			$out .= '			<div class="entry-title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></div>';
			
			$out .= '			<div class="entry-metadata">';
			$out .= "				<p class='author'><span class='fa fa-user'> </span><a href='".get_the_author_link()."'>".get_the_author()."</a></p>";
		 
		 			if(has_tag()) :  
			$out .=   '<p class="tags"><span class="fa fa-tags"> </span>';
			$out .=   get_the_tag_list('',' , ','');
			$out .= '</p>'; 
			         endif;

			$out .= '			</div><!-- .entry-metadata -->';
			
			$out .= '			<div class="entry-body">';
								
			$out .= 			wp_trim_words(get_the_content(),$excerpt_length);					
		
			$out .= '			</div>';
		
			$out .= "	 		<a href='".get_permalink()."' class='dt-sc-button small read-more'> {$read_more_text} <span class='fa fa-angle-double-right'> </span></a>";	
			
			$out .= '		</div>';
			
			$out .= '	</div>';
			$out .= '</article>';
			$out .= '</div>';
			 
        }
    }
	
	return $out;
	wp_reset_query();
    
} 

#EVENTS LIST SHORTCODE...
if(!function_exists('dt_events_list')) {
	
	function dt_events_list( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'limit'  => '-1',
			'excerpt_length' => '15'
		), $atts));

		global $post; $out = ""; $i = 1;
		
		$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
		$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : 'content-full-width';

		$feature_image = 'events-threecolumn';
	
		if($page_layout != "content-full-width")
			$feature_image = $feature_image."-sidebar";
		
		$all_events = tribe_get_events(array( 'eventDisplay'=>'all', 'posts_per_page'=> $limit ));

		foreach($all_events as $post) {
		  setup_postdata($post);
		  
			$col_class = '';

			if($i == 1) $col_class = ' first'; else $col_class = '';
			if($i == 3) $i = 1; else $i = $i + 1;
		  
		    $out .= '<div class="dt-sc-one-third column'.$col_class.'">';
				$out .= '<div class="events-shortcode-list">';
					$out.= '<div class="event-thumb">';
						$out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
									if ( has_post_thumbnail() ) {
										$attr = array('title' => get_the_title());
										$out .= get_the_post_thumbnail($post->ID, $feature_image, $attr);
									} else {
										$out .= "<img src='//placehold.it/1060x600&text=Image' alt='There is no image for event ' width='1060' height='600'/>";
									}
							$out .= '</a>';
						$out .= '</div>';
					
					$out .= '<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
					$out .= '<div class="event-meta"><span class="fa fa-calendar"> </span> '.tribe_get_start_date($post->ID, true, 'M j, Y').'</div>';
					$out .= '<div class="event-excerpt">';
						$out .= dttheme_excerpt($excerpt_length);
					$out .= '</div>';
				$out .= '</div>';
		  $out .= '</div>';
		} 
		wp_reset_query();
		
		return $out;
	}
	add_shortcode('dt_events_list', 'dt_events_list');
}

?>