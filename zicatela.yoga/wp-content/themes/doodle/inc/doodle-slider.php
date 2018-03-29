<?php
/**
 * Override gallery shortcode to replace 1-column galleries with a slider
 *
 * @package doodle
 */

function doodle_post_gallery( $value, $attr ) {
		// Bail if somebody else has done something
		if ( ! empty( $value ) )
			return $value;

		// If [gallery columns="1"]
		if ( ! empty( $attr['columns'] ) && 1 == $attr['columns'] )
			return doodle_gallery_shortcode($attr);

		return $value;
}
add_filter( 'post_gallery', 'doodle_post_gallery', 10, 2 );


function doodle_gallery_shortcode($attr) {
	global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post ? $post->ID : 0,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "";

    $slider_width = 0;

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
//      $img = wp_get_attachment_image_src($id, 'medium');
//      $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
        $img = wp_get_attachment_image_src($id, $size);
        if ($img[1] > $slider_width) {$slider_width = $img[1];}

        $output .= "<div class=\"standard-slide\">\n";
        if ( substr( $attachment->post_content, 0, 4 ) === "http" ) {
            $link = esc_url( $attachment->post_content );
        }
        else {
            $link = false;
        }
        if ($link) {
            $output .= "<a href='$link'>";
        }
        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
        if ($attachment->post_excerpt) {
            $output .= "<div class='caption'>$attachment->post_excerpt</div>";
        }
        if ($link) {
            $output .= "</a>";
        }
        $output .= "</div>\n";
    }

    $output = "<div class=\"standard-slider\" style=\"max-width:{$slider_width}px\">\n". $output ."</div>\n";

    return $output;
}
