<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
wp_enqueue_style( 'uris-feature-notice-css', URIS_PLUGIN_URL . 'css/uris-feature-notice.css', '', '1.0' );
?>
<div class="wb_plugin_feature notice  is-dismissible">
    <div class="wb_plugin_feature_banner default_pattern pattern_ ">
        <div class="wb-col-md-6 wb-col-sm-12 box">
            <div class="ribbon"><span>Check Pro</span></div>
            <img class="wp-photo-img-responsive" src="<?php echo URIS_PLUGIN_URL . 'img/wpg_xmas-min.jpg'; ?>" alt="img">
        </div>
        <div class="wb-col-md-6 wb-col-sm-12 wb_banner_featurs-list">
            <div class="gp_banner_head"><span><h2><?php _e( 'WP Photo Gallery Pro Features', URIS_TD ); ?> </h2></span></div>
            <ul>
                <li><?php _e( 'Multiple Column Layout', URIS_TD ); ?></li>
                <li><?php _e( 'Multiple Lightbox Effect', URIS_TD ); ?></li>
                <li><?php _e( '500 Plus Google Fonts', URIS_TD ); ?></li>
                <li><?php _e( 'Icon on Gallery Image', URIS_TD ); ?></li>
                <li><?php _e( 'Multiple Image Uploader', URIS_TD ); ?></li>
                <li><?php _e( 'Hide or Show Gallery Title and Description', URIS_TD ); ?></li>
                <li><?php _e( 'Multiple Color On Caption', URIS_TD ); ?></li>
                <li><?php _e( 'Drag and Drop  Image Control', URIS_TD ); ?></li>
                <li><?php _e( 'Widget Gallery Utility', URIS_TD ); ?></li>
               
            </ul>
            <div class="wp_btn-grup">
                <a class="wb_button-primary" href="https://wpfrank.com/demo/wp-photo-gallery-pro/"
                   target="_blank"><?php _e( 'Check Pro Demo', URIS_TD ); ?></a>
                <a class="wb_button-primary" href="https://wpfrank.com/account/signup/wp-photo-gallery-pro"
                   target="_blank"><?php _e( 'Buy Pro', URIS_TD ); ?> $15</a>
            </div>

        </div>
    </div>
</div>