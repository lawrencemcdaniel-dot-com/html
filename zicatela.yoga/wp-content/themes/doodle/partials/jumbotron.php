<?php
/* SITEWIDE SETTINGS */
$header_type = get_theme_mod('doodle_header_type', 'background_image');
$header_image = get_header_image();
$use_overlay = false;
$overlay_code = '<div class="jumbotron-overlay"></div>';
$is_boxed = false;
$show_next_and_prev = false;
$print_image = false;
$video_url = "";
$header_content = "";

/* WOOCOMMERCE */
$is_shop = false;
if ( is_woocommerce_activated() ) {
  if ( is_shop() ) {
    $is_shop = true;
    $page_id = get_option( 'woocommerce_shop_page_id' );
    if( has_post_thumbnail( $page_id ) ) {
        $header_image = wp_get_attachment_url( get_post_thumbnail_id($page_id) );
    }
  }
  elseif ( is_product_category() ) {
    global $wp_query;
    $cat = $wp_query->get_queried_object();
    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
    $wc_cat_image = wp_get_attachment_url( $thumbnail_id );
    if ($wc_cat_image) {
      $header_image = $wc_cat_image;
    }
  }
}

/* PAGE CUSTOM SETTINGS */
if ( is_page() || is_single() || $is_shop ) {
    if (!$is_shop) { $page_id = get_the_ID(); }
    $page_header_type = get_post_meta( $page_id, '_doodle_header_type', true );
    if ( !empty($page_header_type) ) { $header_type = $page_header_type; }
    $header_overlay = get_post_meta( $page_id, '_doodle_header_overlay', true );
    if ($header_overlay == "semitransparent_overlay" || $header_overlay == "striped_overlay") {
      $use_overlay = true;
      if ($header_overlay == "striped_overlay") {
        $overlay_code = '<div class="jumbotron-overlay striped"></div>';
      }
    }
    if ($page_header_type == "boxed_slider_show_next_and_prev") {
      $header_type = "boxed_slider";
      $show_next_and_prev = true;
      $is_boxed = true;
    }
    if ($page_header_type == "boxed_slider" || $page_header_type == "boxed_video") {
      $is_boxed = true;
    }
    if ($page_header_type == "background_video" || $page_header_type == "boxed_video") {
      $video_url = esc_url( get_post_meta( $page_id, '_doodle_header_background_video', true ) );
    }
    $header_content = get_post_meta( $page_id, '_doodle_header_content', true );
    $header_text_box = get_post_meta( $page_id, '_doodle_header_text_box', true );
    if ( $header_text_box ) {
      $header_text_box = wptexturize($header_text_box);
      $header_text_box = convert_chars($header_text_box);
      $header_text_box = wpautop($header_text_box);
      $header_text_box = shortcode_unautop($header_text_box);
      $header_text_box = do_shortcode($header_text_box);
    }
}

/* FEATURED IMAGE */
if ( is_singular() && has_post_thumbnail() ) {
    $header_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
}
if ( $header_type == 'background_video' && !has_post_thumbnail() ) {
    $header_image = 'http://img.youtube.com/vi/'.doodle_get_youtube_id($video_url).'/0.jpg';
}
if ( $header_type == 'background_image' || $header_type == 'background_video' ) {
    $print_image = true;
}

?>

<?php if($header_type!='none'): ?>
<!-- JUMBOTRON
================================================== -->
<section id="doodle-jumbotron" class="site-section background-accent fullwidth-section <?php if($is_boxed) {?>boxed<?php } ?> <?php if($show_next_and_prev) {?>show-next-and-prev-bg<?php } ?>" <?php if($print_image){ ?> style="background-image: url(<?php echo $header_image; ?>);" <?php } ?>>

    <?php if ($header_type == 'background_slider'): ?>
    <!-- intro slider -->
    <div id="fullwidth-slider-wrapper">
        <div id="fullwidth-slider">
        <?php
        $files = get_post_meta( $page_id, '_doodle_header_background_slider_files', 1 );
        $file_num = 0;
        foreach ( (array) $files as $attachment_id => $attachment_url ) {
          $additional_class = "";
          if ($file_num == 0) { $additional_class = "active"; }
                echo '<div class="fullwidth-slide '. $additional_class .'">';
                echo wp_get_attachment_image( $attachment_id, 'full', 0, array( 'class' => 'img-responsive' ) );
                echo '</div>';
                ++$file_num;
            }
        ?>
        </div>

        <?php if($header_type == "background_slider" && $use_overlay ): ?>
            <?php echo $overlay_code; ?>
        <?php endif; ?>

        <?php if(count($files)>1): ?>
        <!-- self-drawing buttons -->
        <div class="container fullwidth-arrows-container">
          <button class="animated-svg animated-arrow inverse" id="animated-arrow-left" data-src="<?php echo get_template_directory_uri(); ?>/img/arrows/inverse/arrow-left.svg" data-src-id="svg-arrow-left"></button>
          <button class="animated-svg animated-arrow inverse" id="animated-arrow-right" data-src="<?php echo get_template_directory_uri(); ?>/img/arrows/inverse/arrow-right.svg" data-src-id="svg-arrow-right"></button>
        </div>
        <!-- ./self-drawing buttons -->
        <?php endif; ?>
    </div>
    <!-- ./intro slider -->

    <?php elseif($header_type == 'boxed_slider'): ?>
    <!-- intro slider -->
    <div id="boxed-slider-wrapper" class="center-slides <?php if($show_next_and_prev) {?>show-next-and-prev<?php } ?>">
        <div id="boxed-slider">
        <?php
        $files = get_post_meta( $page_id, '_doodle_header_background_slider_files', 1 );
        $file_num = 0;
        foreach ( (array) $files as $attachment_id => $attachment_url ) {
          $additional_class = "";
          if ($file_num == 0) { $additional_class = "active"; }
                echo '<div class="boxed-slide '. $additional_class .'">';
                echo wp_get_attachment_image( $attachment_id, 'full', 0, array( 'class' => 'img-responsive' ) );
                echo '</div>';
                ++$file_num;
            }
        ?>
        </div>

        <?php if($header_type == "background_slider" && $use_overlay ): ?>
            <?php echo $overlay_code; ?>
        <?php endif; ?>

        <!-- self-drawing buttons -->
        <div class="container fullwidth-arrows-container">
          <button class="animated-svg animated-arrow inverse" id="animated-arrow-left" data-src="<?php echo get_template_directory_uri(); ?>/img/arrows/inverse/arrow-left.svg" data-src-id="svg-arrow-left"></button>
          <button class="animated-svg animated-arrow inverse" id="animated-arrow-right" data-src="<?php echo get_template_directory_uri(); ?>/img/arrows/inverse/arrow-right.svg" data-src-id="svg-arrow-right"></button>
        </div>
        <!-- ./self-drawing buttons -->
    </div>
    <!-- ./intro slider -->

    <?php elseif($header_type == 'background_video'): ?>
        <div class="ytplayer-bg" data-property="{videoURL:'<?php echo $video_url; ?>',containment:'#doodle-jumbotron',mute:true,autoPlay:true,loop:false,opacity:1,showYTLogo:true, realfullscreen:true,optimizeDisplay:true, stopMovieOnBlur: false}"></div>

    <?php elseif($header_type == 'boxed_video'): ?>
        <div class="boxed-video">
          <?php
          echo wp_oembed_get($video_url, array('width'=>945, 'height'=>532));
          ?>
        </div>
    <?php endif; ?>

    <?php if( ($header_type == "background_image" || $header_type == 'background_video') && $use_overlay ): ?>
        <?php echo $overlay_code; ?>
    <?php endif; ?>

    <?php if($header_content == "boxed_text" ): ?>
    <div class="container">
      <div class="row">
        <div class="col-md-offset-6 col-md-5 col-lg-offset-7 col-lg-4">
          <div class="fullwidth-intro-text">
            <div class="vertical-align-container">
            <div class="vertical-align-content">
              <?php echo $header_text_box; ?>
            </div>
            </div>
            <!-- ./self-drawing borders -->
              <div class="animated-border-wrapper">
                <div class="animated-svg animated-border" id="animated-border-top" data-src="<?php echo get_template_directory_uri(); ?>/img/borders/inverse/border-top.svg" data-src-id="svg-border-top"></div>
                <div class="animated-svg animated-border" id="animated-border-left" data-src="<?php echo get_template_directory_uri(); ?>/img/borders/inverse/border-left.svg" data-src-id="svg-border-left"></div>
                <div class="animated-svg animated-border" id="animated-border-bottom" data-src="<?php echo get_template_directory_uri(); ?>/img/borders/inverse/border-bottom.svg" data-src-id="svg-border-bottom"></div>
                <div class="animated-svg animated-border" id="animated-border-right" data-src="<?php echo get_template_directory_uri(); ?>/img/borders/inverse/border-right.svg" data-src-id="svg-border-right"></div>
              </div>
              <!-- ./self-drawing borders -->
            </div>
        </div>
      </div>
    </div>
    <?php elseif($header_content == "unboxed_text" ): ?>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="intro-unboxed">
            <?php echo $header_text_box; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

</section><!-- /.JUMBOTRON -->
<?php endif; ?>