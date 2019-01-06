<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_style( 'uris-feature-notice-css', URIS_PLUGIN_URL . 'css/uris-feature-notice.css', array(), '1.0', 'all' );
wp_enqueue_style('uris-bootstrap-min', URIS_PLUGIN_URL.'css/bootstrap-latest/bootstrap.css');
?>
    <div class="row col-md-12 wpfrank_banner">
        <div class="col-md-6 col-sm-12 wpfrank_banner_img">
            <a href="https://wpfrank.com/account/signup/ultimate-responsive-image-slider-pro" target="_blank"><img class="img-fluid" src="<?php echo URIS_PLUGIN_URL . "img/products/Ultimate-Responsive-Image-Slider-Pro.jpg"; ?>"></a>
        </div>
        <div class="col-md-6 col-sm-12 wpfrank_banner_features">
            <h3><span class="border-white border-bottom pb-1"><?php _e('Ultimate Responsive Image Slider Pro Features', URIS_TD ); ?></span></h3>
            <ul>
                <li><?php _e('5 Slider Layouts', URIS_TD ); ?></li>
                <li><?php _e('Double Lightbox Effects', URIS_TD ); ?></li>
                <li><?php _e('500 Plus Google Fonts', URIS_TD ); ?></li>
                <li><?php _e('Link Slide', URIS_TD ); ?></li>
                <li><?php _e('Multiple Image Uploader', URIS_TD ); ?></li>
                <li><?php _e('Hide or Show Gallery Title and Description', URIS_TD ); ?></li>
                <li><?php _e('Brand Slider Integrated', URIS_TD ); ?></li>
                <li><?php _e('Drag and Drop Slide Image Control', URIS_TD ); ?></li>
                <li><?php _e('Widget Slider Utility', URIS_TD ); ?></li>
            </ul>
            <div class="col-md-12 wpfrank_banner_actions">
                <a class="button-primary button-hero" href="https://wpfrank.com/demo/ultimate-responsive-image-slider-pro/" target="_blank"><?php _e('View Demo', URIS_TD ); ?></a>
                <a class="button-primary button-hero" href="https://wpfrank.com/account/signup/ultimate-responsive-image-slider-pro" target="_blank"><?php _e('Buy Now', URIS_TD ); ?> $21</a>
            </div>
            <div class="plugin_version">
                <span><b>7.2</b><?php _e('Version', URIS_TD ); ?></span>
            </div>
        </div>
    </div>
