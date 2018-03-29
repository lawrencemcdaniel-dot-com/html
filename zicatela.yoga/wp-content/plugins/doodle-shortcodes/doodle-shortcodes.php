<?php
/*
Plugin Name: Doodle Shortcodes
Plugin URI: http://doodle.15robots.com/
Description: Add shortcodes for Doodle (Hand-drawn Wordpress Theme).
Author: 15robots.com
Author URI: http://15robots.com/
Version: 1.1
Text Domain: doodle-shortcodes
Domain Path: /languages
License: Themeforest Split Licence
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

if ( ! class_exists( 'Doodle_Shortcodes' ) ) {
	class Doodle_Shortcodes
	{
		/**
		 * Tag identifier used by file includes and selector attributes.
		 * @var string
		 */
		protected $tag = 'doodle-shortcodes';

		/**
		 * User friendly name used to identify the plugin.
		 * @var string
		 */
		protected $name = 'Doodle Shortcodes';

		/**
		 * Current version of the plugin.
		 * @var string
		 */
		protected $version = '1.0';

		public function __construct()
		{
			add_action( 'init', array( &$this, 'addShortcodes' ));
			add_action( 'init', array( &$this, 'addShortcake' ));
		}

		public function addShortcodes() {

			/**
		     * Register DOODLE ICON shortcode.
		     */
		    add_shortcode( 'doodle_icon', function( $attr, $content = '' ) {

		        return wp_kses_post( $content );

		    } );

		    /**
		     * Register HEADING WITH ICON shortcode.
		     */
		    add_shortcode( 'doodle_heading_with_icon', function( $attr ) {

		        $attr = wp_parse_args( $attr, array(
		            'title' => '',
		            'subtitle' => '',
		            'icon' => '',
		        ) );

		        ob_start();

		        ?>

		        <div class="section-title">
		            <h1>
		            <?php echo esc_html( $attr['title'] ); ?>
		            <?php if ( ! empty( $attr['subtitle'] ) ) : ?>
		                <small><i class="icon-<?php echo esc_html( $attr['icon'] ); ?>"></i><?php echo esc_html( $attr['subtitle'] ); ?></small>
		            <?php endif; ?>
		            </h1>
		        </div>

		        <?php

		        return ob_get_clean();
		    } );

		    /**
		     * Register FEATURE shortcode.
		     */
		    add_shortcode( 'doodle_feature', function( $attr, $content = '' ) {

		        $attr = wp_parse_args( $attr, array(
		            'title' => '',
		            'icon' => '',
		        ) );

		        ob_start();

		        ?>

		        <div class="feature-item">
		            <?php if ( ! empty( $attr['icon'] ) ) : ?>
		                <p><span class="feature-icon-container"><i class="feature-icon icon-<?php echo esc_html( $attr['icon'] ); ?>"></i></span></p>
		            <?php endif; ?>
		            <?php if ( ! empty( $attr['title'] ) ) : ?>
		                <h4><?php echo esc_html( $attr['title'] ); ?></h4>
		            <?php endif; ?>
		            <?php echo wpautop( wp_kses_post( $content ) ); ?>
		        </div>

		        <?php

		        return ob_get_clean();
		    } );

		    /**
		     * Register BUTTON shortcode.
		     */
		    add_shortcode( 'doodle_button', function( $attr ) {

		        $attr = wp_parse_args( $attr, array(
		            'text' => '',
		            'url' => '',
		            'icon' => '',
		            'target' => '',
		        ) );

		        ob_start();

		        ?>

		            <a href="<?php echo esc_url( $attr['url'] ); ?>" target="<?php echo esc_html( $attr['target'] ); ?>" class="btn btn-large">
		            <?php if ( ! empty( $attr['icon'] ) ) : ?>
		                <i class="icon-<?php echo esc_html( $attr['icon'] ); ?>"></i>
		            <?php endif; ?>
		            <?php echo esc_html( $attr['text'] ); ?>
		            </a>

		        <?php

		        return ob_get_clean();
		    } );

		    /**
		     * Register COUNTDOWN shortcode.
		     */
		    add_shortcode( 'doodle_countdown', function( $attr ) {

		        $attr = wp_parse_args( $attr, array(
		            'date' => '',
		            'days' => '',
		            'hours' => '',
		            'minutes' => '',
		            'seconds' => '',
		        ) );

		        ob_start();

		        ?>

		            <div class="doodle-countdown" data-finaldate="<?php echo esc_attr( $attr['date'] ); ?>" data-days="<?php echo esc_attr( $attr['days'] ); ?>" data-hours="<?php echo esc_attr( $attr['hours'] ); ?>" data-minutes="<?php echo esc_attr( $attr['minutes'] ); ?>" data-seconds="<?php echo esc_attr( $attr['seconds'] ); ?>">
		                    <div class="col-sm-3 col-xs-12"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>0</span><?php echo esc_html( $attr['days'] ); ?></div></div></div></div></div>
		                    <div class="col-sm-3 hidden-xs"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>0</span><?php echo esc_html( $attr['hours'] ); ?></div></div></div></div></div>
		                    <div class="col-sm-3 hidden-xs"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>0</span><?php echo esc_html( $attr['minutes'] ); ?></div></div></div></div></div>
		                    <div class="col-sm-3 hidden-xs"><div class="countdown-item-wrapper"><div class="countdown-item"><div class="vertical-align-container"><div class="vertical-align-content"><span>0</span><?php echo esc_html( $attr['seconds'] ); ?></div></div></div></div></div>
		            </div>

		        <?php

		        return ob_get_clean();
		    } );

		    /**
		     * Register PORTFOLIO SLIDER shortcode.
		     */
		    add_shortcode( 'doodle_portfolio_slider', function( $attr ) {

		        $attr = wp_parse_args( $attr, array(
		            'portfolio_category' => '',
		            'portfolio_tag' => '',
		            'button_icon' => '',
		            'button_text' => '',
		            'number_of_items' => 5,
		            'order' => 'DESC',
		            'orderby' => 'date',
		            'thumbnail_format' => 'doodle-thumb',
		            'display_title' => 'false',
		        ) );

		        $showButton = false;
		        if ( ! empty( $attr['button_icon'] ) || ! empty( $attr['button_text'] ) ) {
		        	$showButton = true;
		        }

		        //taxonomy conditions
		        $tax_query = array();
		        if ( !empty($attr['portfolio_category']) ) {
		            $tax_query1 = array(
		                'taxonomy' => 'portfolio_category',
		                'field'    => 'slug',
		                'terms'    => sanitize_title_with_dashes($attr['portfolio_category']),
		            );
		            $tax_query[] = $tax_query1;
		        }
		        if ( !empty($attr['portfolio_tag']) ) {
		            $tax_query2 = array(
		                'taxonomy' => 'portfolio_tag',
		                'field'    => 'slug',
		                'terms'    => sanitize_title_with_dashes($attr['portfolio_tag']),
		            );
		            $tax_query[] = $tax_query2;
		        }

		        // List portfolio items
		        $args = array(
		            'post_type' => 'portfolio',
		            'post_status' => 'publish',
		            'tax_query' => $tax_query,
		            'posts_per_page' => $attr['number_of_items'],
		            'orderby' => $attr['orderby'],
		            'order' => $attr['order'],
		        );

		        ob_start();

		        ?>

		        <div class="row portfolio-slider <?php if($showButton): ?>with-button<?php endif; ?>">

		            <?php

		            $the_query = new WP_Query( $args );
		            if( $the_query->have_posts() && post_type_exists( 'portfolio' ) ) : 

		            	while( $the_query->have_posts() ) : $the_query->the_post();

		            	?>

			            <div class="col-xs-12 col-sm-6 col-md-3">
			                <div class="portfolio-slide">
			                    <div class="portfolio-thumb hand-drawn-border">
			                        <?php if( has_post_thumbnail() ) { ?>
			                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			                        <?php the_post_thumbnail( esc_attr($attr['thumbnail_format']), array('class'=>'img-responsive')); ?>
			                        </a>
			                        <?php } ?>
			                    </div>
			                    <?php if ( $attr['display_title'] == 'true' ): ?>
			                    	<h3 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			                    <?php endif; ?>
			                    <?php if ($showButton): ?>
			                    <p class="text-center btn-container"><span><a href="<?php the_permalink(); ?>" class="btn btn-medium"><i class="icon-<?php echo esc_html( $attr['button_icon'] ); ?>"></i> <?php echo esc_html( $attr['button_text'] ); ?></a></span></p>
			                    <?php endif; ?>
			                </div>
			            </div>

			            <?php

			            endwhile;

		            else:

		            ?>

		        		<p class="text-center"><em><?php _e('No portfolio items found','doodle-plugins'); ?></em></p>

		        	<?php

		            endif;

		            wp_reset_postdata();

		            ?>

		        </div>

		        <?php

		        return ob_get_clean();
		    } );

			/**
		     * Register PRODUCT SLIDER shortcode.
		     */
			if ( is_woocommerce_activated() ) {
		    add_shortcode( 'doodle_product_slider', function( $attr ) {

		        $attr = wp_parse_args( $attr, array(
		            'product_cat' => '',
		            'product_tag' => '',
		            'button_icon' => '',
		            'button_text' => '',
		            'number_of_items' => 5,
		            'order' => 'DESC',
		            'orderby' => 'date',
		            'thumbnail_format' => 'shop_catalog',
		            'featured' => 'false',
		            'display_title' => 'false',
		            'display_price' => 'false',
		            'display_rating' => 'false',
		            'display_sale_sticker' => 'false',
		        ) );

		        $showButton = false;
		        if ( ! empty( $attr['button_icon'] ) || ! empty( $attr['button_text'] ) ) {
		        	$showButton = true;
		        }

		        //taxonomy conditions
		        $tax_query = array();
		        if ( !empty($attr['product_cat']) ) {
		            $tax_query1 = array(
		                'taxonomy' => 'product_cat',
		                'field'    => 'slug',
		                'terms'    => sanitize_title_with_dashes($attr['product_cat']),
		            );
		            $tax_query[] = $tax_query1;
		        }
		        if ( !empty($attr['product_tag']) ) {
		            $tax_query2 = array(
		                'taxonomy' => 'product_tag',
		                'field'    => 'slug',
		                'terms'    => sanitize_title_with_dashes($attr['product_tag']),
		            );
		            $tax_query[] = $tax_query2;
		        }

		        // List products
		        $args = array(
		            'post_type' => 'product',
		            'post_status' => 'publish',
		            'tax_query' => $tax_query,
		            'posts_per_page' => $attr['number_of_items'],
		            'orderby' => $attr['orderby'],
		            'order' => $attr['order'],
		        );

		        //featured
		        if ( $attr['featured'] == "true" ) {
		        	$args['meta_key'] = "_featured";
		        	$args['meta_value'] = "yes";
		        }

		        ob_start();

		        ?>

		        <div class="row product-slider woocommerce <?php if($showButton): ?>with-button<?php endif; ?>">

		            <?php

		            $the_query = new WP_Query( $args );
		            if( $the_query->have_posts() && post_type_exists( 'product' ) ) : 

		            	while( $the_query->have_posts() ) : $the_query->the_post();global $product;

		            	?>

			            <div class="col-xs-12 col-sm-6 col-md-3">
			                <div class="product-slide">
				                <?php if ( $attr['display_sale_sticker'] == "true" && $product->is_on_sale() ) : ?>
									<?php echo '<span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span>'; ?>
								<?php endif; ?>
			                    <div class="product-thumb hand-drawn-border">
			                        <?php if( has_post_thumbnail() ) { ?>
			                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			                        <?php the_post_thumbnail( esc_attr($attr['thumbnail_format']), array('class'=>'img-responsive')); ?>
			                        </a>
			                        <?php } ?>
			                    </div>
								<?php if ( $attr['display_title'] == "true" ): ?>
			                    	<h3 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			                    <?php endif; ?>
								<?php if ( $attr['display_rating'] == "true" && get_option( 'woocommerce_enable_review_rating' ) !== 'no' && $rating_html = $product->get_rating_html() ) : ?>
									<?php echo $rating_html; ?>
								<?php endif; ?>
								<?php if ( $attr['display_price'] == "true" && $price_html = $product->get_price_html() ): ?>
				                    <?php echo '<div class="price">' . $price_html . '</div>'; ?>
								<?php endif; ?>
			                    <?php if ($showButton): ?>
			                    	<p class="text-center btn-container"><span><a href="<?php the_permalink(); ?>" class="btn btn-medium"><i class="icon-<?php echo esc_html( $attr['button_icon'] ); ?>"></i> <?php echo esc_html( $attr['button_text'] ); ?></a></span></p>
			                    <?php endif; ?>
			                </div>
			            </div>

			            <?php

			            endwhile;

		            else:

		            ?>

		        		<p class="text-center"><em><?php _e('No products found','doodle-plugins'); ?></em></p>

		        	<?php

		            endif;

		            wp_reset_postdata();

		            ?>

		        </div>

		        <?php

		        return ob_get_clean();
		    } );
			}

		    /**
		     * Register TESTIMONIAL shortcode.
		     */
		    add_shortcode( 'doodle_testimonial', function( $attr, $content = '' ) {

		        $attr = wp_parse_args( $attr, array(
		            'title' => '',
		            'text' => '',
		            'image' => 0,
		            'frame' => 'no-frame',
		        ) );

		        ob_start();

		        ?>

		        <div class="row testimonial">
		            <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-0">
		                <?php if ( ! empty( $attr['image'] ) ) : ?>
		                <div class="frame <?php echo $attr['frame']; ?>">
		                    <?php echo wp_get_attachment_image( $attr['image'], 'doodle-thumb-square', false, array('class'=>'img-responsive') ); ?>
		                </div>
		                <?php endif; ?>
		            </div>
		            <div class="col-sm-8 col-xs-12">
		                <?php if ( ! empty( $attr['title'] ) ) : ?>
		                    <h2><?php echo esc_html( $attr['title'] ); ?></h2>
		                <?php endif; ?>
		                <?php echo wpautop( wp_kses_post( $content ) ); ?>
		            </div>
		        </div>

		        <?php

		        return ob_get_clean();
		    } );

		}

		public function addShortcake() {

			/**
		     * Return if Shortcake is not installed
		     */
		    if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		        return;
		    }

		    /**
		     * Array of doodle icons
		     */
		    $doodle_icons = array(''=>'none','address-book'=>'address-book','amazon'=>'amazon','anchor'=>'anchor','android'=>'android','angellist'=>'angellist','apple'=>'apple','appstore'=>'appstore','archive'=>'archive','arrow-down'=>'arrow-down','arrow-left'=>'arrow-left','arrow-right'=>'arrow-right','arrow-up'=>'arrow-up','atom'=>'atom','award-star'=>'award-star','awards-cup'=>'awards-cup','balloon'=>'balloon','bar-chart'=>'bar-chart','battery-full'=>'battery-full','battery-low'=>'battery-low','beer'=>'beer','bicycle'=>'bicycle','blackberry'=>'blackberry','block'=>'block','blogger'=>'blogger','bomb'=>'bomb','bookmark'=>'bookmark','boombox'=>'boombox','boy'=>'boy','briefcase'=>'briefcase','browser'=>'browser','brush'=>'brush','bug'=>'bug','calculator'=>'calculator','calendar'=>'calendar','camera'=>'camera','chart-growth'=>'chart-growth','chart-pie'=>'chart-pie','chat'=>'chat','check'=>'check','checklist'=>'checklist','chicken'=>'chicken','chrome'=>'chrome','clockwise'=>'clockwise','closing-tag'=>'closing-tag','cloud'=>'cloud','coffee'=>'coffee','competition'=>'competition','counterclockwise'=>'counterclockwise','creativemarket'=>'creativemarket','credit-card'=>'credit-card','crown'=>'crown','css3'=>'css3','cupcake'=>'cupcake','diamond'=>'diamond','direction'=>'direction','directions'=>'directions','download'=>'download','dribble'=>'dribble','drink'=>'drink','dumbbell'=>'dumbbell','email'=>'email','etsy'=>'etsy','exchange'=>'exchange','export'=>'export','eye'=>'eye','facebook'=>'facebook','factory'=>'factory','female'=>'female','file'=>'file','file-download'=>'file-download','file-upload'=>'file-upload','fir-tree'=>'fir-tree','firefox'=>'firefox','flag'=>'flag','flickr'=>'flickr','flow-tree'=>'flow-tree','flower'=>'flower','folder'=>'folder','fonts'=>'fonts','football'=>'football','fork-spoon'=>'fork-spoon','foursquare'=>'foursquare','free'=>'free','fruit'=>'fruit','game-console'=>'game-console','gauge'=>'gauge','gear'=>'gear','gift'=>'gift','github'=>'github','globe'=>'globe','google-plus'=>'google-plus','googleplay'=>'googleplay','graduation'=>'graduation','head-exclamation-mark'=>'head-exclamation-mark','head-idea'=>'head-idea','head-question'=>'head-question','headphones'=>'headphones','heart'=>'heart','home'=>'home','horseshoe'=>'horseshoe','hotdog'=>'hotdog','html5'=>'html5','icecream'=>'icecream','ie'=>'ie','image'=>'image','info'=>'info','instagram'=>'instagram','itunes'=>'itunes','key'=>'key','keyboard'=>'keyboard','kickstarter'=>'kickstarter','lab'=>'lab','label'=>'label','leaf'=>'leaf','lifebuoy'=>'lifebuoy','lightbulb'=>'lightbulb','lightning'=>'lightning','link'=>'link','linkedin'=>'linkedin','linux'=>'linux','location'=>'location','lock'=>'lock','luggage'=>'luggage','magic-wand'=>'magic-wand','magnet'=>'magnet','mail'=>'mail','male'=>'male','man'=>'man','map-location'=>'map-location','microscope'=>'microscope','mobile'=>'mobile','money'=>'money','moon'=>'moon','mouse'=>'mouse','music-notes'=>'music-notes','new'=>'new','open'=>'open','opening-tag'=>'opening-tag','opera'=>'opera','palm-tree'=>'palm-tree','paperbox'=>'paperbox','paperclip'=>'paperclip','paperplane'=>'paperplane','paypal'=>'paypal','pencil'=>'pencil','phone'=>'phone','picasa'=>'picasa','picture'=>'picture','pin'=>'pin','pinterest'=>'pinterest','plane'=>'plane','play'=>'play','plus'=>'plus','podcasts'=>'podcasts','power'=>'power','print'=>'print','profile'=>'profile','promote'=>'promote','pulse'=>'pulse','question-mark'=>'question-mark','quotes'=>'quotes','radiation'=>'radiation','rain'=>'rain','record'=>'record','reddit'=>'reddit','ribbon'=>'ribbon','robot'=>'robot','rocket'=>'rocket','rss'=>'rss','ruler'=>'ruler','safari'=>'safari','sale'=>'sale','sale2'=>'sale2','scales'=>'scales','scissors'=>'scissors','screen'=>'screen','screwdriver'=>'screwdriver','search'=>'search','settings'=>'settings','share'=>'share','shipping'=>'shipping','shopping-bag'=>'shopping-bag','shoppingcart'=>'shoppingcart','siringe'=>'siringe','skype'=>'skype','sliders'=>'sliders','smiley-happy'=>'smiley-happy','sneaker'=>'sneaker','snow'=>'snow','soccer'=>'soccer','sound'=>'sound','soundcloud'=>'soundcloud','speech-bubbles'=>'speech-bubbles','spotify'=>'spotify','star'=>'star','steam'=>'steam','stumbleupon'=>'stumbleupon','sun'=>'sun','sync-cycle-repeat'=>'sync-cycle-repeat','tablet'=>'tablet','tea'=>'tea','temperature'=>'temperature','thumbs-down'=>'thumbs-down','thumbs-up'=>'thumbs-up','ticket'=>'ticket','time-alarm'=>'time-alarm','time-clock'=>'time-clock','time-hourglass'=>'time-hourglass','tools'=>'tools','traffic-cone'=>'traffic-cone','trash'=>'trash','tree'=>'tree','trumpet'=>'trumpet','tumblr'=>'tumblr','tv'=>'tv','twitter'=>'twitter','umbrella'=>'umbrella','unlocked'=>'unlocked','user'=>'user','user-profile'=>'user-profile','users'=>'users','valentine'=>'valentine','video'=>'video','vimeo'=>'vimeo','vine'=>'vine','whatsapp'=>'whatsapp','wifi'=>'wifi','wikipedia'=>'wikipedia','wind'=>'wind','windows'=>'windows','wine'=>'wine','woman'=>'woman','wrench'=>'wrench','yinyang'=>'yinyang','youtube'=>'youtube',);

		    /**
		     * Register a UI for the HEADING WITH ICON shortcode.
		     */
		    shortcode_ui_register_for_shortcode(
		        'doodle_heading_with_icon',
		        array(

		            // Display label. String. Required.
		            'label' => __('Heading with Icon', 'doodle-shortcodes'),

		            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
		            'listItemImage' => 'dashicons-art',

		            // Available shortcode attributes and default values. Required. Array.
		            // Attribute model expects 'attr', 'type' and 'label'
		            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
		            'attrs' => array(
		                array(
		                    'label' => __('Title', 'doodle-shortcodes'),
		                    'attr'  => 'title',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Subtitle', 'doodle-shortcodes'),
		                    'attr'  => 'subtitle',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Icon', 'doodle-shortcodes'),
		                    'attr' => 'icon',
		                    'type' => 'select',
		                    'options' => $doodle_icons
		                ),
		            ),
		        )
		    );

		    /**
		     * Register a UI for the FEATURE shortcode.
		     */
		    shortcode_ui_register_for_shortcode(
		        'doodle_feature',
		        array(

		            // Display label. String. Required.
		            'label' => __('Feature', 'doodle-shortcodes'),

		            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
		            'listItemImage' => 'dashicons-star-filled',

		            'inner_content' => array(
		                'label' => __('Description', 'doodle-shortcodes'),
		            ),

		            // Available shortcode attributes and default values. Required. Array.
		            // Attribute model expects 'attr', 'type' and 'label'
		            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
		            'attrs' => array(
		                array(
		                    'label' => __('Title', 'doodle-shortcodes'),
		                    'attr'  => 'title',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Icon', 'doodle-shortcodes'),
		                    'attr' => 'icon',
		                    'type' => 'select',
		                    'options' => $doodle_icons
		                ),
		            ),
		        )
		    );

		    /**
		     * Register a UI for the BUTTON shortcode.
		     */
		    shortcode_ui_register_for_shortcode(
		        'doodle_button',
		        array(

		            // Display label. String. Required.
		            'label' => __('Button', 'doodle-shortcodes'),

		            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
		            'listItemImage' => 'dashicons-admin-links',

		            // Available shortcode attributes and default values. Required. Array.
		            // Attribute model expects 'attr', 'type' and 'label'
		            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
		            'attrs' => array(
		                array(
		                    'label' => __('Text', 'doodle-shortcodes'),
		                    'attr'  => 'text',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('URL', 'doodle-shortcodes'),
		                    'attr'  => 'url',
		                    'type'  => 'url',
		                ),
		                array(
		                    'label' => __('Icon', 'doodle-shortcodes'),
		                    'attr' => 'icon',
		                    'type' => 'select',
		                    'options' => $doodle_icons
		                ),
		                array(
		                    'label' => __('Target', 'doodle-shortcodes'),
		                    'attr' => 'target',
		                    'type' => 'select',
		                    'options' => array('_self'=>'Open in same window', '_blank'=>'Open in new window')
		                ),
		            ),
		        )
		    );

		    /**
		     * Register a UI for the COUNTDOWN shortcode.
		     */
		    shortcode_ui_register_for_shortcode(
		        'doodle_countdown',
		        array(

		            // Display label. String. Required.
		            'label' => __('Countdown', 'doodle-shortcodes'),

		            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
		            'listItemImage' => 'dashicons-calendar',

		            // Available shortcode attributes and default values. Required. Array.
		            // Attribute model expects 'attr', 'type' and 'label'
		            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
		            'attrs' => array(
		                array(
		                    'label' => __('Date', 'doodle-shortcodes'),
		                    'attr'  => 'date',
		                    'type'  => 'date',
		                ),
		                array(
		                    'label' => __('Days Label', 'doodle-shortcodes'),
		                    'attr'  => 'days',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Hours Label', 'doodle-shortcodes'),
		                    'attr'  => 'hours',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Minutes Label', 'doodle-shortcodes'),
		                    'attr'  => 'minutes',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Seconds Label', 'doodle-shortcodes'),
		                    'attr'  => 'seconds',
		                    'type'  => 'text',
		                ),
		            ),
		        )
		    );

		    /**
		     * Register a UI for the PORTFOLIO SLIDER shortcode.
		     */
		    shortcode_ui_register_for_shortcode(
		        'doodle_portfolio_slider',
		        array(

		            // Display label. String. Required.
		            'label' => __('Portfolio Slider', 'doodle-shortcodes'),

		            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
		            'listItemImage' => 'dashicons-portfolio',

		            // Available shortcode attributes and default values. Required. Array.
		            // Attribute model expects 'attr', 'type' and 'label'
		            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
		            'attrs' => array(
		            	array(
		                    'label' => __('Number of items to show', 'doodle-shortcodes'),
		                    'attr'  => 'number_of_items',
		                    'type'  => 'number',
		                    'meta' => array(
								'placeholder' => '5',
							),
		                ),
		                array(
		                    'label' => __('Thumbnail format', 'doodle-shortcodes'),
		                    'attr' => 'thumbnail_format',
		                    'type' => 'select',
		                    'options' => array(
		                    	'doodle-thumb' => __('Landscape', 'doodle-shortcodes'),
		                    	'doodle-thumb-portrait' => __('Portrait', 'doodle-shortcodes'),
		                    	'doodle-thumb-square' => __('Square', 'doodle-shortcodes'),
		                    )
		                ),
		                array(
		                    'label' => __('Order', 'doodle-shortcodes'),
		                    'attr' => 'order',
		                    'type' => 'select',
		                    'options' => array(
		                    	'DESC' => __('Descending', 'doodle-shortcodes'),
		                    	'ASC' => __('Ascending', 'doodle-shortcodes'),
		                    )
		                ),
		                array(
		                    'label' => __('Order by', 'doodle-shortcodes'),
		                    'attr' => 'orderby',
		                    'type' => 'select',
		                    'options' => array(
		                    	'date' => __('Date', 'doodle-shortcodes'),
		                    	'title' => __('Title', 'doodle-shortcodes'),
		                    	'menu_order' => __('Menu Order', 'doodle-shortcodes'),
		                    	'ID' => __('ID', 'doodle-shortcodes'),
		                    	'rand' => __('Random', 'doodle-shortcodes'),
		                    )
		                ),
		                array(
		                    'label' => __('Portfolio category to show', 'doodle-shortcodes'),
		                    'attr'  => 'portfolio_category',
		                    'type'  => 'text',
		                    'meta' => array(
								'placeholder' => __('Enter the slug of the portfolio category', 'doodle-shortcodes'),
							),
		                ),
		                array(
		                    'label' => __('Portfolio tag to show', 'doodle-shortcodes'),
		                    'attr'  => 'portfolio_tag',
		                    'type'  => 'text',
		                    'meta' => array(
								'placeholder' => __('Enter the slug of the portfolio tag', 'doodle-shortcodes'),
							),
		                ),
		                array(
		                    'label' => __('Button text', 'doodle-shortcodes'),
		                    'attr'  => 'button_text',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Button icon', 'doodle-shortcodes'),
		                    'attr' => 'button_icon',
		                    'type' => 'select',
		                    'options' => $doodle_icons
		                ),
		                array(
		                    'label' => __('Display title', 'doodle-shortcodes'),
		                    'attr' => 'display_title',
		                    'type' => 'checkbox',
		                ),
		            ),
		        )
		    );

			/**
		     * Register a UI for the PRODUCT SLIDER shortcode.
		     */
			if ( is_woocommerce_activated() ) {
		    shortcode_ui_register_for_shortcode(
		        'doodle_product_slider',
		        array(

		            // Display label. String. Required.
		            'label' => __('Product Slider', 'doodle-shortcodes'),

		            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
		            'listItemImage' => 'dashicons-products',

		            // Available shortcode attributes and default values. Required. Array.
		            // Attribute model expects 'attr', 'type' and 'label'
		            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
		            'attrs' => array(
		            	array(
		                    'label' => __('Number of items to show', 'doodle-shortcodes'),
		                    'attr'  => 'number_of_items',
		                    'type'  => 'number',
		                    'meta' => array(
								'placeholder' => '5',
							),
		                ),
		                array(
		                    'label' => __('Thumbnail format', 'doodle-shortcodes'),
		                    'attr' => 'thumbnail_format',
		                    'type' => 'select',
		                    'options' => array(
		                    	'shop_catalog' => __('Catalog Image', 'doodle-shortcodes'),
		                    	'doodle-thumb' => __('Landscape', 'doodle-shortcodes'),
		                    	'doodle-thumb-portrait' => __('Portrait', 'doodle-shortcodes'),
		                    	'doodle-thumb-square' => __('Square', 'doodle-shortcodes'),
		                    )
		                ),
		                array(
		                    'label' => __('Order', 'doodle-shortcodes'),
		                    'attr' => 'order',
		                    'type' => 'select',
		                    'options' => array(
		                    	'DESC' => __('Descending', 'doodle-shortcodes'),
		                    	'ASC' => __('Ascending', 'doodle-shortcodes'),
		                    )
		                ),
		                array(
		                    'label' => __('Order by', 'doodle-shortcodes'),
		                    'attr' => 'orderby',
		                    'type' => 'select',
		                    'options' => array(
		                    	'date' => __('Date', 'doodle-shortcodes'),
		                    	'title' => __('Title', 'doodle-shortcodes'),
		                    	'menu_order' => __('Menu Order', 'doodle-shortcodes'),
		                    	'ID' => __('ID', 'doodle-shortcodes'),
		                    	'rand' => __('Random', 'doodle-shortcodes'),
		                    )
		                ),
		                array(
		                    'label' => __('Portfolio category to show', 'doodle-shortcodes'),
		                    'attr'  => 'product_cat',
		                    'type'  => 'text',
		                    'meta' => array(
								'placeholder' => __('Enter the slug of the portfolio category', 'doodle-shortcodes'),
							),
		                ),
		                array(
		                    'label' => __('Portfolio tag to show', 'doodle-shortcodes'),
		                    'attr'  => 'product_tag',
		                    'type'  => 'text',
		                    'meta' => array(
								'placeholder' => __('Enter the slug of the portfolio tag', 'doodle-shortcodes'),
							),
		                ),
		                array(
		                    'label' => __('Button text', 'doodle-shortcodes'),
		                    'attr'  => 'button_text',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Button icon', 'doodle-shortcodes'),
		                    'attr' => 'button_icon',
		                    'type' => 'select',
		                    'options' => $doodle_icons
		                ),
		                array(
		                    'label' => __('Show only featured products', 'doodle-shortcodes'),
		                    'attr' => 'featured',
		                    'type' => 'checkbox',
		                ),
		                array(
		                    'label' => __('Display title', 'doodle-shortcodes'),
		                    'attr' => 'display_title',
		                    'type' => 'checkbox',
		                ),
		                array(
		                    'label' => __('Display price', 'doodle-shortcodes'),
		                    'attr' => 'display_price',
		                    'type' => 'checkbox',
		                ),
		                array(
		                    'label' => __('Display rating', 'doodle-shortcodes'),
		                    'attr' => 'display_rating',
		                    'type' => 'checkbox',
		                ),
		                array(
		                    'label' => __('Display sale sticker', 'doodle-shortcodes'),
		                    'attr' => 'display_sale_sticker',
		                    'type' => 'checkbox',
		                ),
		            ),
		        )
		    );
			}

		    /**
		     * Register a UI for the TESTIMONIAL shortcode.
		     */
		    shortcode_ui_register_for_shortcode(
		        'doodle_testimonial',
		        array(

		            // Display label. String. Required.
		            'label' => __('Testimonial', 'doodle-shortcodes'),

		            // Icon/image for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
		            'listItemImage' => 'dashicons-testimonial',

		            'inner_content' => array(
		                'label' => __('Text', 'doodle-shortcodes'),
		            ),

		            // Available shortcode attributes and default values. Required. Array.
		            // Attribute model expects 'attr', 'type' and 'label'
		            // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
		            'attrs' => array(
		                array(
		                    'label' => __('Title', 'doodle-shortcodes'),
		                    'attr'  => 'title',
		                    'type'  => 'text',
		                ),
		                array(
		                    'label' => __('Image', 'doodle-shortcodes'),
		                    'attr' => 'image',
		                    'type' => 'attachment',
		                    'libraryType' => array( 'image' ),
		                ),
		                array(
		                    'label' => __('Frame', 'doodle-shortcodes'),
		                    'attr' => 'frame',
		                    'type' => 'select',
		                    'options' => array(
		                    		'' => __('None', 'doodle-shortcodes'),
		                    		'frame-1' => __('Frame 1', 'doodle-shortcodes'),
		                    		'frame-2' => __('Frame 2', 'doodle-shortcodes'),
		                    		'frame-3' => __('Frame 3', 'doodle-shortcodes'),
		                    		'frame-4' => __('Frame 4', 'doodle-shortcodes'),
		                    	),
		                ),
		            ),
		        )
		    );

		}

	}
	new Doodle_Shortcodes;
}
