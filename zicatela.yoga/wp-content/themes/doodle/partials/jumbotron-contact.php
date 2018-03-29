<?php
$header_location = get_post_meta( get_the_ID(), '_doodle_contact_header_location', true );
$header_infowindow = get_post_meta( get_the_ID(), '_doodle_contact_header_infowindow', true );
$header_map_color = get_post_meta( get_the_ID(), '_doodle_contact_header_map_color', true );
if (!$header_map_color) { $header_map_color = 'black-and-white'; }
if ( $header_infowindow ) {
  $header_infowindow = wptexturize($header_infowindow);
  $header_infowindow = convert_chars($header_infowindow);
  $header_infowindow = wpautop($header_infowindow);
  $header_infowindow = shortcode_unautop($header_infowindow);
  $header_infowindow = do_shortcode($header_infowindow);
}
if ( !is_array($header_location) ) {
	$header_location = array('latitude'=>0,'longitude'=>0);
}
?>

<script type="text/javascript">
var templateDir = "<?php echo esc_url( get_template_directory_uri() ); ?>";
</script>

<!-- JUMBOTRON
================================================== -->
<section id="doodle-jumbotron" class="site-section background-accent fullwidth-section">

    <div id="map_canvas" class="<?php echo esc_attr($header_map_color); ?>" data-lat="<?php echo $header_location['latitude']; ?>" data-lng="<?php echo $header_location['longitude']; ?>"></div>
    <div id="map_canvas_infowindow" class="sr-only"><?php echo $header_infowindow; ?></div>

</section><!-- /.JUMBOTRON -->
