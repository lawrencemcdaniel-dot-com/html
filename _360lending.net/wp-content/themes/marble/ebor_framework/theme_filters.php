<?php

/////////////////////////////////////////////
////////CUSTOM FILTERS  ////////////////////
///////////////////////////////////////////

add_filter('previous_post_link', 'prev_post_link_attributes');
function prev_post_link_attributes($output) {
    $class = 'class="btn pull-right rm0 nav-prev-item"';
    return str_replace('<a href=', '<a '.$class.' href=', $output);
}

add_filter('next_post_link', 'next_post_link_attributes');
function next_post_link_attributes($output) {
    $class = 'class="btn pull-right rm5 nav-next-item"';
    return str_replace('<a href=', '<a '.$class.' href=', $output);
}

add_filter( 'the_content' , 'mh_youtube_wmode' , 15 );
function mh_youtube_wmode( $content ) {
	$mh_youtube_regex = "/\<iframe .*\.com.*><\/iframe>/";
	preg_match_all( $mh_youtube_regex , $content, $mh_matches );
	if ( $mh_matches ) {;
    	for ( $mh_count = 0; $mh_count < count( $mh_matches[0] ); $mh_count++ ){
            $mh_old = $mh_matches[0][$mh_count];
            $mh_new = str_replace( "?feature=oembed" , '?wmode=transparent' , $mh_old );
            $mh_new = preg_replace( '/\><\/iframe>$/' , ' wmode="Opaque"></iframe></figure>' , $mh_new );
            $mh_new = str_replace( "<iframe" , "<figure class='media-wrapper player'><iframe" , $mh_new );
            $content = str_replace( $mh_old, $mh_new , $content );
        }
    }
	return $content;
}

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


add_filter('widget_text', 'do_shortcode');

/**
 * Custom gallery shortcode
 *
 * Filters the standard WordPress gallery to create a gallery using revolution slider.
 *
 * @since 1.0.0
 * @return Revolution Slider Gallery
 */
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'li',
        'icontag'    => 'dt',
        'captiontag' => 'div',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $output = '<div class="owl-carousel portfolio-slider custom-controls">';

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
        
        $output .= '<div class="item">'. wp_get_attachment_image( $id, 'full' );

        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='caption sfb white-bg small'>
                " . wpautop($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        
        $output .= '</div>';
    }

    $output .= "</div>\n";

    return $output;
}

/**
 * Add tinymce to the category description boxes
 *
 *
 * @since 1.0.3
 */
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );
        
// add extra css to display quicktags correctly
add_action( 'admin_print_styles', 'taxonomy_tinycme_admin_head' );
function taxonomy_tinycme_admin_head() { ?>
        <style type="text/css">
                .quicktags-toolbar input{width: 55px !important;}
        </style> <?php
}

/*
 * Start replacing the description textarea on the edit detail page of a taxonomy (custom or 'category').
 * */

$show_description_column = TRUE;

add_filter('edit_tag_form_fields', 'taxonomy_tinycme_add_wp_editor_term');
add_filter('edit_category_form_fields', 'taxonomy_tinycme_add_wp_editor_term');
function taxonomy_tinycme_add_wp_editor_term($tag) { ?>
        <tr class="form-field">
                <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
                <td>
                        <?php  
                                $settings = array(
                                        'wpautop' => true, 
                                        'media_buttons' => true, 
                                        'quicktags' => true, 
                                        'textarea_rows' => '15', 
                                        'textarea_name' => 'description' 
                                );        
                                wp_editor(html_entity_decode($tag->description ), 'description2', $settings); ?>        
                </td>        
        </tr> <?php
}

/*
 * Remove the default textarea from the edit detail page.
 * */
add_action('admin_head', 'taxonomy_tinycme_hide_description'); 
function taxonomy_tinycme_hide_description() {
        global $pagenow;
        //only hide on detail not yet on overview page.
        if( ($pagenow == 'edit-tags.php' && isset($_GET['action']) )) :         
        ?>
                <script type="text/javascript">
                        jQuery(function($) {
                                $('#description, textarea#tag-description').closest('.form-field').hide(); 
                         }); 
                 </script>
         <?php 
        endif; 
}

// lets hide the cat description from the category admin page if $show_description_column = FALSE
function manage_my_taxonomy_columns($columns)
{
        global $show_description_column;
         // only edit the columns on the current taxonomy, this should be a setting.
        if ( $show_description_column)
                 return $columns;

        // unset the description columns
        if ( $posts = $columns['description'] ){ unset($columns['description']); }
         
        return $columns;
}
add_filter('manage_edit-post_tag_columns','manage_my_taxonomy_columns');
add_filter('manage_edit-category_columns','manage_my_taxonomy_columns');