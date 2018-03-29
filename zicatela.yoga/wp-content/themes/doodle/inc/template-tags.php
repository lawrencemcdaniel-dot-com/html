<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package doodle
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'doodle' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'doodle' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'doodle' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'doodle_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function doodle_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'doodle' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous pull-left">%link</div>', '<i class="icon-arrow-left"></i>' );
				next_post_link( '<div class="nav-next pull-right">%link</div>', '<i class="icon-arrow-right"></i>' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'doodle_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function doodle_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = $time_string;

	$byline = sprintf(
		_x( 'by %s', 'post author', 'doodle' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<div class="posted-on">' . $posted_on . '</div><div class="byline"> ' . $byline . '</div>';

}
endif;

if ( ! function_exists( 'doodle_entry_byline' ) ) :
/**
 * Prints HTML with byline.
 */
function doodle_entry_byline() {
	$byline = sprintf(
		_x( 'by %s', 'post author', 'doodle' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo $byline;
}
endif;

if ( ! function_exists( 'doodle_entry_cats_and_tags' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function doodle_entry_cats_and_tags() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( '<span class="cat-separator"></span>' );
		if ( $categories_list && doodle_categorized_blog() ) {
			echo '<div class="cat-links"><label>' . __( 'Categories:', 'doodle' ) . '</label> ' . $categories_list . '</div>';
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', '<span class="tag-separator"></span>', '' );
		if ( $tags_list ) {
			echo '<div class="tags-links"><label>' . __( 'Tags:', 'doodle' ) . '</label> ' . $tags_list . '</div>';
		}
	}
}
endif;

if ( ! function_exists( 'doodle_entry_comments' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function doodle_entry_comments() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'doodle' ), __( '1 Comment', 'doodle' ), __( '% Comments', 'doodle' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'doodle' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'doodle' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'doodle' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'doodle' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'doodle' ), get_the_date( _x( 'Y', 'yearly archives date format', 'doodle' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'doodle' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'doodle' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'doodle' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'doodle' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'doodle' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'doodle' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'doodle' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'doodle' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'doodle' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function doodle_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'doodle_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'doodle_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so doodle_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so doodle_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in doodle_categorized_blog.
 */
function doodle_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'doodle_categories' );
}
add_action( 'edit_category', 'doodle_category_transient_flusher' );
add_action( 'save_post',     'doodle_category_transient_flusher' );

/**
 * Numeric Pagination
 */
function doodle_numeric_paging_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav class="numeric-pagination posts-navigation"><ul class="pagination pagination-lg">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link("&laquo;") );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li><span>&hellip;</span></li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li><span>&hellip;</span></li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link("&raquo;") );

	echo '</ul></nav>' . "\n";

}

function doodle_excerpt_max_length($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}

function doodle_get_youtube_id($vurl){
    $image_url = parse_url($vurl);
    // Test if the link is for youtube
    if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
        $array = explode("&", $image_url['query']);
        return substr($array[0], 2);
    // Test if the link is for the shortened youtube share link
    } else if($image_url['host'] == 'www.youtu.be' || $image_url['host'] == 'youtu.be'){
        return ltrim($image_url['path'],'/');
    // Test if the link is for vimeo
    } else {
    	return false;
    }
}

/**
 * Post Thumbnail
 */
function doodle_post_thumbnail($thumb_size="doodle-thumb") {

	/* POST FORMAT */
	$format = get_post_format();
	switch ($format) {
		case 'gallery':
			if ( $gallery = get_post_meta( get_the_ID(), '_doodle_header_background_slider_files', 1 ) ) {
				$gallery = array_keys($gallery);
			}
			elseif ( get_post_gallery() ) {
	            $gallery = get_post_gallery( get_the_ID(), false );
	            if ( !isset($gallery['ids']) ) {
	            	$media = get_attached_media( 'image' );
	            	$gallery = array_keys( $media);
	            } else {
		            $gallery = explode(',',$gallery['ids']);
	            }
	        }
	        if( is_array($gallery) ) {
				echo '<div class="gallery-thumb clickable '. $thumb_size .'">';
			    foreach( $gallery AS $id ) {
			       	echo '<div class="gallery-thumb-slide">';
			       	echo '<a href="'.get_permalink().'" title="'.esc_attr( get_the_title() ).'">';
			       	echo wp_get_attachment_image($id, $thumb_size);
			       	echo '</a>';
			       	echo '</div>';
		    	}
		    	echo '</div>';
	        }
			break;

		case 'video':
			if ( $video_url = get_post_meta( get_the_ID(), '_doodle_header_background_video', true ) ) {
				$video_url = esc_url( $video_url );
				$video_thumb = 'http://img.youtube.com/vi/'.doodle_get_youtube_id($video_url).'/0.jpg';
				echo '<a href="'.get_permalink().'" title="'.esc_attr( get_the_title() ).'">';
				echo '<div class="hand-drawn-border clickable thumb-wrapper"><div class="doodle-video-thumb" style="background-image:url('.$video_thumb.')"><div class="thumb-overlay"></div></div></div>';
				echo '</a>';
			}
			elseif ( has_post_thumbnail() ) {
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'doodle-thumb', true);
				$video_thumb = $thumb_url[0];
				echo '<a href="'.get_permalink().'" title="'.esc_attr( get_the_title() ).'">';
				echo '<div class="hand-drawn-border clickable thumb-wrapper"><div class="doodle-video-thumb" style="background-image:url('.$video_thumb.')"><div class="thumb-overlay"></div></div></div>';
				echo '</a>';
			}
			else {
				echo '<a href="'.get_permalink().'" title="'.esc_attr( get_the_title() ).'">';
				echo '<div class="hand-drawn-border clickable thumb-wrapper"><div class="doodle-video-thumb"></div></div>';
				echo '</a>';
			}
			break;
		
		default:
			if( has_post_thumbnail() ) {
				echo '<a href="'.get_permalink().'" title="'.esc_attr( get_the_title() ).'">';
				the_post_thumbnail($thumb_size, array('class'=>'hand-drawn-border clickable'));
				echo '</a>';
			}
			break;
	}

}
