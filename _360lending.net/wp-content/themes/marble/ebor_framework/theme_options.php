<?php 

add_action('customize_register', 'ebor_theme_customize');
function ebor_theme_customize($wp_customize) {

class Example_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="3" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}

class CBP_Customizer_Number_Control extends WP_Customize_Control {

	public $type = 'number';
	
	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
		</label>
	<?php
	}
	
}

$social_options = array(
    'pinterest'=> 'Pinterest',
    'rss'=> 'RSS',
    'facebook'=> 'Facebook',
    'twitter'=> 'Twitter',
    'flickr'=> 'Flickr',
    'dribbble'=> 'Dribbble',
    'behance'=> 'Behance',
    'linkedin'=> 'LinkedIn',
    'vimeo'=> 'Vimeo',
    'youtube'=> 'Youtube',
    'skype'=> 'Skype',
    'tumblr'=> 'Tumblr',
    'delicious'=> 'Delicious',
    '500px'=> '500px',
    'grooveshark'=> 'Grooveshark',
    'forrst'=> 'Forrst',
    'digg'=> 'Digg',
    'blogger'=> 'Blogger',
    'klout'=> 'Klout',
    'dropbox'=> 'Dropbox',
    'github'=> 'Github',
    'songkick'=> 'Singkick',
    'posterous'=> 'Posterous',
    'appnet'=> 'Appnet',
    'gplus'=> 'Google Plus',
    'stumbleupon'=> 'Stumbleupon',
    'lastfm'=> 'LastFM',
    'spotify'=> 'Spotify',
    'instagram'=> 'Instagram',
    'evernote'=> 'Evernote',
    'paypal'=> 'Paypal',
    'picasa'=> 'Picasa',
    'soundcloud'=> 'Soundcloud',
);

//navigation location
$wp_customize->add_setting('navigation_highlight', array(
    'default'        => '1',
    'type' => 'option'
));

//navigation location
$wp_customize->add_control( 'navigation_highlight', array(
    'label'   => __('GLOBAL - Show Navigation Highlighting?', 'marble'),
    'section' => 'custom_logo_section',
    'type'    => 'select',
    'priority'       => 1,
    'choices'    => array(
        '1' => 'On',
        '0' => 'Off',
    ),
));

//navigation location
$wp_customize->add_setting('nav_base_link', array(
    'default'        => '0',
    'type' => 'option'
));

//navigation location
$wp_customize->add_control( 'nav_base_link', array(
    'label'   => __('Allow base menu items to be clickable?', 'marble'),
    'section' => 'custom_logo_section',
    'type'    => 'select',
    'priority'       => 1,
    'choices'    => array(
        '1' => 'On',
        '0' => 'Off',
    ),
));

///////////////////////////////////////
//     BLOG SECTION                 //
/////////////////////////////////////
	
	//CREATE CUSTOM STYLING SUBSECTION
	$wp_customize->add_section( 'blog_settings', array(
		'title'          => 'Blog Settings',
		'priority'       => 35,
	) );
	
	//blog layout
	$wp_customize->add_setting('blog_layout', array(
	    'default' => 'blogsidebar',
	    'type' => 'option'
	));
	
	//blog layout
	$wp_customize->add_control( 'blog_layout', array(
	    'label'   => __('Choose layout for Blog.', 'marble'),
	    'section' => 'blog_settings',
	    'type'    => 'select',
	    'priority' => 4,
	    'choices' => array(
	        'blogsidebar' => 'Sidebar',
	        'blognosidebar' => 'No Sidebar',
	        'blogshowcase' => 'Full Width Grid'
	    ),
	));
	
	//comments TITLE
	$wp_customize->add_setting( 'comments_title', array(
	    'default'        => 'Would you like to share your thoughts?',
	    'type' => 'option'
	) );
	
	//commentstitle
	$wp_customize->add_control( 'comments_title', array(
	    'label' => __('Comments Title', 'marble'),
	    'type' => 'text',
	    'section' => 'blog_settings',
	    'priority'       => 5,
	) );
	
	//comments subTITLE
	$wp_customize->add_setting( 'comments_subtitle', array(
	    'default'        => 'Your email address will not be published. Required fields are marked *',
	    'type' => 'option'
	) );
	
	//comments subtitle
	$wp_customize->add_control( 'comments_subtitle', array(
	    'label' => __('Comments Sub-title', 'marble'),
	    'type' => 'text',
	    'section' => 'blog_settings',
	    'priority'       => 5,
	) );
	
	//blog continue
	$wp_customize->add_setting( 'blog_continue', array(
	    'default'        => 'Continue Reading &rarr;',
	    'type' => 'option'
	) );
	
	//blog continue
	$wp_customize->add_control( 'blog_continue', array(
	    'label' => __('Blog "Continue Reading" Text', 'marble'),
	    'type' => 'text',
	    'section' => 'blog_settings',
	    'priority'       => 6,
	) );
	
	//blog continue
	$wp_customize->add_setting( 'author_details_title', array(
	    'default'        => 'About the author',
	    'type' => 'option'
	) );
	
	//blog continue
	$wp_customize->add_control( 'author_details_title', array(
	    'label' => __('SIGNLE - Author Details Title', 'marble'),
	    'type' => 'text',
	    'section' => 'blog_settings',
	    'priority'       => 6,
	) );
	
	//index date
	$wp_customize->add_setting( 'index_date', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//index date
	$wp_customize->add_control( 'index_date', array(
	    'label' => __('META - INDEX - Show date?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 7,
	) );
	
	//index categories
	$wp_customize->add_setting( 'index_categories', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//index categories
	$wp_customize->add_control( 'index_categories', array(
	    'label' => __('META - INDEX - Show Categories?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 8,
	) );
	
	//index comments
	$wp_customize->add_setting( 'index_comments', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//index comments
	$wp_customize->add_control( 'index_comments', array(
	    'label' => __('META - INDEX - Show comments?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 9,
	) );

	//single date
	$wp_customize->add_setting( 'single_date', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//single date
	$wp_customize->add_control( 'single_date', array(
	    'label' => __('META - SINGLE - Show date?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 11,
	) );
	
	//single categories
	$wp_customize->add_setting( 'single_categories', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//single categories
	$wp_customize->add_control( 'single_categories', array(
	    'label' => __('META - SINGLE - Show Categories?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 12,
	) );
	
	//single comments
	$wp_customize->add_setting( 'single_comments', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//single comments
	$wp_customize->add_control( 'single_comments', array(
	    'label' => __('META - SINGLE - Show comments?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 13,
	) );
	
	//blog social
	$wp_customize->add_setting( 'blog_social', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//blog social
	$wp_customize->add_control( 'blog_social', array(
	    'label' => __('META - SINGLE - Show Social Sharing Buttons?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 13,
	) );
	
	//blog author
	$wp_customize->add_setting( 'blog_author', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//blog author
	$wp_customize->add_control( 'blog_author', array(
	    'label' => __('META - SINGLE - Show post author details?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'blog_settings',
	    'priority'       => 13,
	) );
	
	
///////////////////////////////////////
//     PORTFOLIO SECTION            //
/////////////////////////////////////
	
	//CREATE CUSTOM STYLING SUBSECTION
	$wp_customize->add_section( 'portfolio_settings', array(
		'title'          => 'Portfolio Settings',
		'priority'       => 36,
	) ); 
	
	//blog layout
	$wp_customize->add_setting('portfolio_layout', array(
	    'default' => 'classic',
	    'type' => 'option'
	));
	
	//blog layout
	$wp_customize->add_control( 'portfolio_layout', array(
	    'label'   => __('Choose layout for Portfolio Archives.', 'marble'),
	    'section' => 'portfolio_settings',
	    'type'    => 'select',
	    'priority' => 2,
	    'choices'    => array(
	        'classic' => 'Portfolio w/Filters',
	        'classiclightbox' => 'Portfolio w/Filters + Lightbox',
	        'showcase' => 'Full-Width Grid',
	        'showcaselightbox' => 'Full-Width Grid + Lightbox',
	    ),
	));
	
	//disable ajax
	$wp_customize->add_setting( 'disable_ajax', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//disable ajax
	$wp_customize->add_control( 'disable_ajax', array(
	    'label' => 'ARCHIVES - Disable AJAX Post Loading?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	    'priority' => 4
	) );
	
	//disable ajax
	$wp_customize->add_setting( 'show_filters', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//disable ajax
	$wp_customize->add_control( 'show_filters', array(
	    'label' => 'ARCHIVES - Show Filters in Full Width Grid?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	    'priority' => 4
	) );
	
	//disable ajax
	$wp_customize->add_setting( 'portfolio_related', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//disable ajax
	$wp_customize->add_control( 'portfolio_related', array(
	    'label' => 'SINGLE - Show related posts? (Non-AJAX Only)',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	    'priority' => 4
	) );
	
	//disable ajax
	$wp_customize->add_setting( 'preview_name', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//disable ajax
	$wp_customize->add_control( 'preview_name', array(
	    'label' => 'GLOBAL - Show Client Name in Portfolio Preview?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	    'priority' => 4
	) );
	
	//portfolio posts
	$wp_customize->add_setting( 'portfolio_posts_per_page', array(
	    'default'        => "20",
	    'type' => 'option'
	) );
	
	//portfolio posts
	$wp_customize->add_control( 'portfolio_posts_per_page', array(
	    'label'   => __('GLOBAL - Posts Per Page for Portfolio', 'marble'),
	    'type' => 'text',
	    'section' => 'portfolio_settings',
	    'priority' => 3
	) );
	
	$wp_customize->add_setting( 'ajax_back_text', array(
	    'default' => "Back",
	    'type' => 'option'
	) );
	
	$wp_customize->add_control( 'ajax_back_text', array(
	    'label'   => __('Back Text for AJAX Portfolio (Animated)', 'marble'),
	    'type' => 'text',
	    'section' => 'portfolio_settings',
	    'priority' => 1
	) );
	
	$wp_customize->add_setting( 'ajax_next_text', array(
	    'default' => "Next",
	    'type' => 'option'
	) );
	
	$wp_customize->add_control( 'ajax_next_text', array(
	    'label'   => __('Next Text for AJAX Portfolio (Animated)', 'marble'),
	    'type' => 'text',
	    'section' => 'portfolio_settings',
	    'priority' => 1
	) );
	
	$wp_customize->add_setting( 'ajax_prev_text', array(
	    'default' => "Prev",
	    'type' => 'option'
	) );
	
	$wp_customize->add_control( 'ajax_prev_text', array(
	    'label'   => __('Prev Text for AJAX Portfolio (Animated)', 'marble'),
	    'type' => 'text',
	    'section' => 'portfolio_settings',
	    'priority' => 1
	) );
	
	//index categories
	$wp_customize->add_setting( 'portfolio_index_categories', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//index categories
	$wp_customize->add_control( 'portfolio_index_categories', array(
	    'label' => __('META - INDEX - Show categories?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	) );
	
	//portfolio date
	$wp_customize->add_setting( 'portfolio_date', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//portfolio date
	$wp_customize->add_control( 'portfolio_date', array(
	    'label' => 'META - SINGLE - Show project date?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	) );
	
	//portfolio categories
	$wp_customize->add_setting( 'portfolio_categories', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//portfolio categories
	$wp_customize->add_control( 'portfolio_categories', array(
	    'label' => 'META - SINGLE - Show project categories?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	) );
	
	//portfolio client
	$wp_customize->add_setting( 'portfolio_client', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//portfolio client
	$wp_customize->add_control( 'portfolio_client', array(
	    'label' => 'META - SINGLE - Show project client?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	) );
	
	//portfolio url
	$wp_customize->add_setting( 'portfolio_url', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//portfolio url
	$wp_customize->add_control( 'portfolio_url', array(
	    'label' => 'META - SINGLE - Show project URL?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	) );
	
	//portfolio url
	$wp_customize->add_setting( 'portfolio_share', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//portfolio url
	$wp_customize->add_control( 'portfolio_share', array(
	    'label' => 'META - SINGLE - Show Social Share Buttons',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	) );
	
	//portfolio comments
	$wp_customize->add_setting( 'portfolio_comments', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//portfolio comments
	$wp_customize->add_control( 'portfolio_comments', array(
	    'label' => 'GLOBAL - SINGLE - Show Comments on Portfolio?',
	    'type' => 'checkbox',
	    'section' => 'portfolio_settings',
	) );
	
	
///////////////////////////////////////
//     TEAM SECTION                 //
/////////////////////////////////////
	
	//CREATE TEAM SUBSECTION
	$wp_customize->add_section( 'team_settings', array(
		'title'          => 'Team Settings',
		'priority'       => 37,
	) ); 

	//team link to single
	$wp_customize->add_setting( 'team_link', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	//link team to single
	$wp_customize->add_control( 'team_link', array(
	    'label' => 'GLOBAL - Link Team Member to Single Post?',
	    'type' => 'checkbox',
	    'section' => 'team_settings',
	) );	

	//CREATE SHOP SECTION
	$wp_customize->add_section( 'shop_settings', array(
		'title'          => 'Shop Settings',
		'priority'       => 37,
	) ); 
	
	//shop layout
	$wp_customize->add_setting('shop_layout', array(
	    'default' => 'shopstandard',
	    'type' => 'option'
	));
	
	//shop layout
	$wp_customize->add_control( 'shop_layout', array(
	    'label'   => __('Choose layout for the Shop.', 'marble'),
	    'section' => 'shop_settings',
	    'type'    => 'select',
	    'priority' => 3,
	    'choices'    => array(
	        'shopstandard' => 'Standard',
	        'shopshowcase' => 'Full-Width Grid',
	    ),
	));
	
	//shop dropdown
	$wp_customize->add_setting( 'shop_dropdown', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//shop dropdown
	$wp_customize->add_control( 'shop_dropdown', array(
	    'label' => __('Show Shopping Cart Dropdown in Header?', 'marble'),
	    'type' => 'checkbox',
	    'section' => 'shop_settings',
	    'priority'       => 8,
	) );
	
	//portfolio url
	$wp_customize->add_setting( 'product_share', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	//portfolio url
	$wp_customize->add_control( 'product_share', array(
	    'label' => 'META - SINGLE - Show Social Share Buttons',
	    'type' => 'checkbox',
	    'section' => 'shop_settings',
	) );
	

///////////////////////////////////////
//     COLOURS SECTION              //
/////////////////////////////////////

//highlight colour
$wp_customize->add_setting('overlay_background', array(
    'default'           => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//highlight colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'overlay_background', array(
    'label'    => __('GLOBAL - Overlay Background', 'marble'),
    'section'  => 'colors',
)));

//highlight colour
$wp_customize->add_setting('highlight_colour', array(
    'default'           => '#1abb9c',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//highlight colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'highlight_colour', array(
    'label'    => __('GLOBAL - Highlight Colour', 'marble'),
    'section'  => 'colors',
)));

//highlight hover colour
$wp_customize->add_setting('highlight_hover_colour', array(
    'default'           => '#17a78b',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//highlight hover colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'highlight_hover_colour', array(
    'label'    => __('GLOBAL - Highlight Hover Colour', 'marble'),
    'section'  => 'colors',
)));

//wrapper colour
$wp_customize->add_setting('wrapper_background_dark', array(
    'default'           => '#f3f3f3',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//wrapper colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wrapper_background_dark', array(
    'label'    => __('GLOBAL - Page Wrapper Background (Dark)', 'marble'),
    'section'  => 'colors',
)));

//text colour
$wp_customize->add_setting('text_colour', array(
    'default'           => '#6c6c6c',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//text colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_colour', array(
    'label'    => __('GLOBAL - Text Colour', 'marble'),
    'section'  => 'colors',
)));

//heading text colour
$wp_customize->add_setting('heading_text_colour', array(
    'default'           => '#4e4e4e',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//hedaing text colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'heading_text_colour', array(
    'label'    => __('GLOBAL - Headings Text Colour', 'marble'),
    'section'  => 'colors',
)));

//meta colour
$wp_customize->add_setting('meta_colour', array(
    'default'           => '#a8a8a8',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//meta colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'meta_colour', array(
    'label'    => __('GLOBAL - Meta Text Colour', 'marble'),
    'section'  => 'colors',
)));

//header colour
$wp_customize->add_setting('header_colour', array(
    'default'           => '#f5f5f5',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//header colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_colour', array(
    'label'    => __('GLOBAL - Header Background Colour', 'marble'),
    'section'  => 'colors',
)));

//footer colour
$wp_customize->add_setting('footer_colour', array(
    'default'           => '#222222',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//footer colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_colour', array(
    'label'    => __('GLOBAL - Footer Background Colour', 'marble'),
    'section'  => 'colors',
)));

//nav colour
$wp_customize->add_setting('nav_colour', array(
    'default'           => '#4e4e4e',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

//nav colour
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_colour', array(
    'label'    => __('GLOBAL - Base Navigation Colour', 'marble'),
    'section'  => 'colors',
)));


///////////////////////////////////////
//     CUSTOM LOGO SECTION          //
/////////////////////////////////////
	
	//CREATE CUSTOM LOGO SUBSECTION
	$wp_customize->add_section( 'custom_logo_section', array(
		'title'          => 'Header Settings',
		'priority'       => 30,
	) );
	
	//Header Style
	$wp_customize->add_setting('header_layout', array(
	    'default' => 'default',
	    'type' => 'option'
	));
	
	//Header Style
	$wp_customize->add_control( 'header_layout', array(
	    'label'   => __('Choose layout for Header', 'marble'),
	    'section' => 'custom_logo_section',
	    'type'    => 'select',
	    'priority' => 2,
	    'choices'    => array(
	        'default' => 'Left/Right With Resize',
	        'center' => 'Centered',
	        'icons' => 'Social Icons',
	        'baricons' => 'Social Icon in Bar'
	    ),
	));
	
	$wp_customize->add_setting( 'static_header', array(
	    'default' => 0,
	    'type' => 'option'
	) );
	
	$wp_customize->add_control( 'static_header', array(
	    'label' => 'GLOBAL - Disable Fixed Menu? (Allow to scroll off screen)',
	    'type' => 'checkbox',
	    'section' => 'custom_logo_section',
	) );
	
	$wp_customize->add_setting( 'resize_header', array(
	    'default' => 1,
	    'type' => 'option'
	) );
	
	$wp_customize->add_control( 'resize_header', array(
	    'label' => 'GLOBAL - Resize Header on Scroll?',
	    'type' => 'checkbox',
	    'section' => 'custom_logo_section',
	) );
	
	//logo min height
	$wp_customize->add_setting( 'logo_min_height', array(
	    'default'        => '18',
	    'type' => 'option'
	) );
	
	//logo min height
	$wp_customize->add_control( new CBP_Customizer_Number_Control( $wp_customize, 'logo_min_height', array(
	    'label' => __('Minimum Logo Height (On Scroll)', 'marble'),
	    'type' => 'number',
	    'section' => 'custom_logo_section',
	    'priority'       => 3,
	) ) );
	
	//header height
	$wp_customize->add_setting( 'header_padding', array(
	    'default'        => '110',
	    'type' => 'option'
	) );
	
	//header height
	$wp_customize->add_control( new CBP_Customizer_Number_Control( $wp_customize, 'header_padding', array(
	    'label' => __('Header Height - Adjust if header is covering content', 'marble'),
	    'type' => 'number',
	    'section' => 'custom_logo_section',
	    'priority'       => 3,
	) ) );
	
	//header height
	$wp_customize->add_setting( 'header_offset', array(
	    'default'        => '35',
	    'type' => 'option'
	) );
	
	//header height
	$wp_customize->add_control( new CBP_Customizer_Number_Control( $wp_customize, 'header_offset', array(
	    'label' => __('Header Padding - Adjust space above and below logo', 'marble'),
	    'type' => 'number',
	    'section' => 'custom_logo_section',
	    'priority'       => 3,
	) ) );
	
	//nav margin
	$wp_customize->add_setting( 'nav_margin', array(
	    'default'        => '0',
	    'type' => 'option'
	) );
	
	//nav margin
	$wp_customize->add_control( new CBP_Customizer_Number_Control( $wp_customize, 'nav_margin', array(
	    'label' => __('Navigation Top Margin - Adjust to Center Navigation', 'marble'),
	    'type' => 'number',
	    'section' => 'custom_logo_section',
	    'priority'       => 4,
	) ) );
	
	//scroll offset
	$wp_customize->add_setting( 'scroll_offset', array(
	    'default'        => '50',
	    'type' => 'option'
	) );
	
	//scroll_offset
	$wp_customize->add_control( new CBP_Customizer_Number_Control( $wp_customize, 'scroll_offset', array(
	    'label' => __('Scroll Offset - SINGLE PAGE VERSION ONLY - Controls the offset of the header when scrolling.', 'marble'),
	    'type' => 'number',
	    'section' => 'custom_logo_section',
	    'priority'       => 4,
	) ) );

	//CUSTOM LOGO SETTINGS
    $wp_customize->add_setting('custom_logo', array(
        'default'  => get_template_directory_uri() . '/style/images/logo.png',
        'type' => 'option'

    ));
	
	//CUSTOM LOGO
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo', array(
        'label'    => __('Custom Logo Upload', 'marble'),
        'section'  => 'custom_logo_section',
        'priority'       => 1
    )));
    
    //CUSTOM RETINA LOGO SETTINGS
    $wp_customize->add_setting('custom_logo_retina', array(
        'default'  => get_template_directory_uri() . '/style/images/logo@2x.png',
        'type' => 'option'

    ));
	
	//CUSTOM RETINA LOGO
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo_retina', array(
        'label'    => __('Retina Logo - Needs @2x on the file e.g logo@2x.png', 'marble'),
        'section'  => 'custom_logo_section',
        'priority'       => 1
    )));
    
    //CUSTOM LOGO SETTINGS
    $wp_customize->add_setting('custom_header_background', array(
        'default'  => '',
        'type' => 'option'

    ));
	
	//CUSTOM LOGO
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_header_background', array(
        'label'    => __('Custom Header Background Image Upload', 'marble'),
        'section'  => 'custom_logo_section',
        'priority'       => 1
    )));
    
    //logo alt text
    $wp_customize->add_setting( 'custom_logo_alt_text', array(
        'default'        => 'Alt Text',
        'type' => 'option'
    ) );
    
    //logo alt text
    $wp_customize->add_control( 'custom_logo_alt_text', array(
        'label' => __('Custom Logo Alt Text', 'marble'),
        'type' => 'text',
        'section' => 'custom_logo_section',
    ) );
    
    //header backgorund
    $wp_customize->add_setting('select_background', array(
        'default' => 'none',
        'type' => 'option'
    ));
    
    //header background
    $wp_customize->add_control( 'select_background', array(
        'label'   => __('Header Background', 'marble'),
        'section' => 'custom_logo_section',
        'type'    => 'select',
        'priority' => 2,
        'choices'    => array(
        	'none' => 'None, Use a Colour',
            get_template_directory_uri() . '/style/images/bg/header-bg1.jpg' => 'One',
            get_template_directory_uri() . '/style/images/bg/header-bg2.jpg' => 'Two',
            get_template_directory_uri() . '/style/images/bg/header-bg3.jpg' => 'Three',
            get_template_directory_uri() . '/style/images/bg/header-bg4.jpg' => 'Four',
            get_template_directory_uri() . '/style/images/bg/header-bg5.jpg' => 'Five',
            get_template_directory_uri() . '/style/images/bg/header-bg6.jpg' => 'Six',
            get_template_directory_uri() . '/style/images/bg/header-bg7.jpg' => 'Seven',
            get_template_directory_uri() . '/style/images/bg/header-bg8.jpg' => 'Eight',
            get_template_directory_uri() . '/style/images/bg/header-bg9.jpg' => 'Nine',
            get_template_directory_uri() . '/style/images/bg/header-bg10.jpg' => 'Ten',
            get_template_directory_uri() . '/style/images/bg/header-bg11.jpg' => 'Eleven',
            get_template_directory_uri() . '/style/images/bg/header-bg12.jpg' => 'Twelve',
            get_template_directory_uri() . '/style/images/bg/header-bg13.jpg' => 'Thirteen',
            get_template_directory_uri() . '/style/images/bg/header-bg14.jpg' => 'Fourteen',
            get_template_directory_uri() . '/style/images/bg/header-bg15.jpg' => 'Fifteen',
        ),
    ));
    
    //Header phone
    $wp_customize->add_setting( 'header_phone', array(
        'default'        => '+00 (123) 456 78 90',
        'type' => 'option'
    ) );
    
    //Header Phone
    $wp_customize->add_control( 'header_phone', array(
        'label' => __('Header Phone Number, Only used in "Icons" Header Type', 'marble'),
        'type' => 'text',
        'section' => 'custom_logo_section',
        'priority' => 998
    ) );
    
    //Header email
    $wp_customize->add_setting( 'header_email', array(
        'default'        => 'hello@email.com',
        'type' => 'option'
    ) );
    
    //Header email
    $wp_customize->add_control( 'header_email', array(
        'label' => __('Header Email, Only used in "Icons" Header Type', 'marble'),
        'type' => 'text',
        'section' => 'custom_logo_section',
        'priority' => 999
    ) );
    

///////////////////////////////////////
//     CUSTOM FAVICON SECTION       //
/////////////////////////////////////
	

	//CUSTOM FAVICON SETTINGS
    $wp_customize->add_setting('custom_favicon', array(
        'default'           => '',
        'type' => 'option'

    ));
	
	//CUSTOM FAVICON
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_favicon', array(
        'label'    => __('Custom Favicon Upload', 'marble'),
        'section'  => 'title_tagline',
        'settings' => 'custom_favicon',
        'priority'       => 21,
    )));
    
    //CUSTOM FAVICON SETTINGS
        $wp_customize->add_setting('mobile_favicon', array(
            'default'           => '',
            'type' => 'option'
    
        ));
    	
    	//CUSTOM FAVICON
        $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'mobile_favicon', array(
            'label'    => __('Non-Retina Mobile Favicon Upload', 'marble'),
            'section'  => 'title_tagline',
            'settings' => 'mobile_favicon',
            'priority'       => 22,
        )));
        
    //CUSTOM FAVICON SETTINGS
        $wp_customize->add_setting('72_favicon', array(
            'default'           => '',
            'type' => 'option'
    
        ));
    	
    	//CUSTOM FAVICON
        $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '72_favicon', array(
            'label'    => __('1st & 2nd Generation iPad Favicon (72x72px)', 'marble'),
            'section'  => 'title_tagline',
            'settings' => '72_favicon',
            'priority'       => 23,
        )));
   
   //CUSTOM FAVICON SETTINGS
       $wp_customize->add_setting('114_favicon', array(
           'default'           => '',
           'type' => 'option'
       ));
   	
   	//CUSTOM FAVICON
       $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '114_favicon', array(
           'label'    => __('Retina iPhone Favicon (114x114px)', 'marble'),
           'section'  => 'title_tagline',
           'settings' => '114_favicon',
           'priority'       => 24,
       )));

//CUSTOM FAVICON SETTINGS
    $wp_customize->add_setting('144_favicon', array(
        'default'           => '',
        'type' => 'option'
    ));
	
	//CUSTOM FAVICON
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '144_favicon', array(
        'label'    => __('Retina iPad Favicon (144x144px)', 'marble'),
        'section'  => 'title_tagline',
        'settings' => '144_favicon',
        'priority'       => 25,
    )));
   
   ///////////////////////////////////////
   //     CUSTOM CSS SECTION           //
   /////////////////////////////////////
   	
   	//CREATE CUSTOM CSS SUBSECTION
   	$wp_customize->add_section( 'custom_css_section', array(
   		'title'          => 'Custom CSS',
   		'priority'       => 200,
   	) ); 
      
      $wp_customize->add_setting( 'custom_css', array(
          'default'        => '',
          'type'           => 'option',
      ) );
       
      $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'custom_css', array(
          'label'   => __('Custom CSS', 'marble'),
          'section' => 'custom_css_section',
          'settings'   => 'custom_css',
      ) ) );
      
      
      ///////////////////////////////////////
      //     FOOTER SETTINGS             //
      /////////////////////////////////////
      	
      	//CREATE CUSTOM CSS SUBSECTION
      	$wp_customize->add_section( 'footer_section', array(
      		'title'          => 'Footer Settings',
      		'priority'       => 40,
      	) );
      	
      	//CUSTOM LOGO SETTINGS
  	    $wp_customize->add_setting('custom_footer_background', array(
  	        'default'  => '',
  	        'type' => 'option'
  	
  	    ));
  		
  		//CUSTOM LOGO
  	    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_footer_background', array(
  	        'label'    => __('Custom Footer Background Image Upload', 'marble'),
  	        'section'  => 'footer_section',
  	        'priority'       => 5
  	    )));
      	
      	//Footer background
      	$wp_customize->add_setting('footer_select_background', array(
      	    get_template_directory_uri() . '/style/images/bg/footer-bg1.jpg',
      	    'type' => 'option'
      	));
      	
      	//Footer bacgrkound
      	$wp_customize->add_control( 'footer_select_background', array(
      	    'label'   => __('Footer Background', 'marble'),
      	    'section' => 'footer_section',
      	    'type'    => 'select',
      	    'priority' => 5,
      	    'choices'    => array(
      	    	'none' => 'None, Use a Colour',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg1.jpg' => 'One',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg2.jpg' => 'Two',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg3.jpg' => 'Three',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg4.jpg' => 'Four',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg5.jpg' => 'Five',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg6.jpg' => 'Six',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg7.jpg' => 'Seven',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg8.jpg' => 'Eight',
      	        get_template_directory_uri() . '/style/images/bg/footer-bg9.jpg' => 'Nine',
      	    ),
      	));
      	
      	//Footer Columns
      	$wp_customize->add_setting('footer_columns', array(
      	    'default'        => 'three',
      	    'type' => 'option'
      	));
      	
      	//Footer Columns
      	$wp_customize->add_control( 'footer_columns', array(
      	    'label'   => __('How many columns in the Footer?', 'marble'),
      	    'section' => 'footer_section',
      	    'type'    => 'select',
      	    'priority' => 5,
      	    'choices'    => array(
      	        'one' => 'One',
      	        'two' => 'Two',
      	        'three' => 'Three',
      	        'four' => 'Four',
      	    ),
      	));
      	
      	//footer social
      	$wp_customize->add_setting( 'footer_social', array(
      	    'default' => 1,
      	    'type' => 'option'
      	) );
      	
      	//subfooter
      	$wp_customize->add_control( 'footer_social', array(
      	    'label' => 'Show footer social section?',
      	    'type' => 'checkbox',
      	    'section' => 'footer_section',
      	    'priority' => 10,
      	) );
      	
      	$i = 1;
      	while( $i < 11 ){
      		//footer social 1
      		$wp_customize->add_setting("footer_social_$i", array(
      		    'default'        => 'pinterest',
      		    'type' => 'option'
      		));
      		
      		//footer social 1
      		$wp_customize->add_control( "footer_social_$i", array(
      		    'label'   => __("Footer Social Icon $i", 'marble'),
      		    'section' => 'footer_section',
      		    'type'    => 'select',
      		    'priority' => 10 + $i + $i,
      		    'choices'    => $social_options
      		));
      		
      		//footer social 1 link
      		$wp_customize->add_setting( "footer_social_link_$i", array(
      		    'default'        => '',
      		    'type' => 'option'
      		) );
      		
      		//footer social 1 link
      		$wp_customize->add_control( "footer_social_link_$i", array(
      		    'label' => __("Footer Social Link $i", 'marble'),
      		    'type' => 'text',
      		    'section' => 'footer_section',
      		    'priority' => 11 + $i + $i,
      		) );
      		$i++;
      	}
      	
      	//copyright text
      	$wp_customize->add_setting( 'copyright', array(
      	    'default'        => 'Configure in "Appearance" => "Customise new" => "Footer"',
      	    'type' => 'option'
      	) );
      	
      	//copyright text
      	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'copyright', array(
      	    'label'   => __('SubFooter Copyright Text', 'marble'),
      	    'section' => 'footer_section',
      	    'settings'   => 'copyright',
      	    'priority' => 1,
      	) ) );

      	///////////////////////////////////////
		//     GOOGLE API SECTION           //
		/////////////////////////////////////

		//CREATE CUSTOM CSS SUBSECTION
		$wp_customize->add_section( 'gmap_api_section', array(
		    'title'          => 'Google API Settings',
		    'priority'       => 200,
		) ); 
		      
		$wp_customize->add_setting( 'ebor_gmap_api', array(
		  'default'        => '',
		  'type'           => 'option',
		) );

		$wp_customize->add_control( 'ebor_gmap_api', array(
		    'label' => __('Google API Key', 'loom'),
		    'type' => 'text',
		    'section' => 'gmap_api_section',
		    'priority' => 4,
		) );

   
}

?>