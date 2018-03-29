<?php  
	/* 
	Plugin Name: ProfTeamExtensions
	Plugin URI: http://www.profteamsolutions.com
	Version: 3.2
	Author: ProfTeam
	Description: A plugin that Provide Post Types.
	*/  


/*------------------------------------------------------
Identity, Add Portfolio Option to the Theme - Started
-------------------------------------------------------*/
add_action( 'plugins_loaded', 'identity_ext_setup' );


function identity_ext_setup(){
	add_action('init', 'identity_register_cpt_team' );
	add_action( 'init', 'identity_register_cpt_portfolio' );
	add_action( 'init', 'identity_register_cpt_testimonial' );
	add_action( 'init', 'identity_register_cpt_packages' );	
	add_action( 'init', 'identity_register_cpt_process' );	
	add_action( 'init', 'identity_register_cpt_present' );	
	add_action( 'init', 'identity_register_cpt_education' );
	add_action( 'init', 'create_portfolio_taxonomies');	
}



function create_portfolio_taxonomies() {
	
	$labels = array(
		'name'              => _x( 'Portfolio Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Portfolio Categories', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Portfolio Categories' ),
		'all_items'         => __( 'All Portfolio Categories' ),
		'parent_item'       => __( 'Parent Portfolio Categories' ),
		'parent_item_colon' => __( 'Parent Portfolio Categories:' ),
		'edit_item'         => __( 'Edit Portfolio Category' ),
		'update_item'       => __( 'Update Portfolio Category' ),
		'add_new_item'      => __( 'Add New Portfolio Category' ),
		'new_item_name'     => __( 'New Portfolio Category Name' ),
		'menu_name'         => __( 'Portfolio Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfoliocategories' ),
	);

	register_taxonomy( 'portfoliocategories', array( 'portfolio' ), $args );

}
	
	
function identity_register_cpt_portfolio() {

$labels = array(
	'name' => __( 'Portfolio', 'sentient' ),
	'singular_name' => __( 'portfolio', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New portfolio', 'sentient' ),
	'edit_item' => __( 'Edit portfolio', 'sentient' ),
	'new_item' => __( 'New portfolio', 'sentient' ),
	'view_item' => __( 'View portfolio', 'sentient' ),
	'search_items' => __( 'Search portfolios', 'sentient' ),
	'not_found' => __( 'No portfolios found', 'sentient' ),
	'not_found_in_trash' => __( 'No portfolios found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent portfolio:', 'sentient' ),
	'menu_name' => __( 'Portfolio', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' , 'comments'),

	'taxonomies' => array('portfoliocategories', 'post_tag'),	
	 
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'portfolio', $args );
}

/*------------------------------------------------------
Identity, Add Portfolio Option to the Theme - End
-------------------------------------------------------*/




/*------------------------------------------------------
Identity, Add Present Option to the Theme - Started
-------------------------------------------------------*/
function identity_register_cpt_present() {

$labels = array(
	'name' => __( 'Present', 'sentient' ),
	'singular_name' => __( 'present', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New present', 'sentient' ),
	'edit_item' => __( 'Edit present', 'sentient' ),
	'new_item' => __( 'New present', 'sentient' ),
	'view_item' => __( 'View present', 'sentient' ),
	'search_items' => __( 'Search Present', 'sentient' ),
	'not_found' => __( 'No present found', 'sentient' ),
	'not_found_in_trash' => __( 'No present found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent present:', 'sentient' ),
	'menu_name' => __( 'Present', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'revisions' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'present', $args );
}

/*------------------------------------------------------
Identity, Add Present Option to the Theme - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity, Add Education Option to the Theme - Started
-------------------------------------------------------*/
function identity_register_cpt_education() {

$labels = array(
	'name' => __( 'Education', 'sentient' ),
	'singular_name' => __( 'education', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New education', 'sentient' ),
	'edit_item' => __( 'Edit education', 'sentient' ),
	'new_item' => __( 'New education', 'sentient' ),
	'view_item' => __( 'View education', 'sentient' ),
	'search_items' => __( 'Search Education', 'sentient' ),
	'not_found' => __( 'No education found', 'sentient' ),
	'not_found_in_trash' => __( 'No education found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent education:', 'sentient' ),
	'menu_name' => __( 'Education', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'revisions' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'education', $args );
}

/*------------------------------------------------------
Identity, Add education Option to the Theme - End
-------------------------------------------------------*/


/*------------------------------------------------------
Identity, Add Testimonial Option to the Theme - Started
-------------------------------------------------------*/
function identity_register_cpt_testimonial() {

$labels = array(
	'name' => __( 'Testimonials', 'sentient' ),
	'singular_name' => __( 'testimonial', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New testimonial', 'sentient' ),
	'edit_item' => __( 'Edit testimonial', 'sentient' ),
	'new_item' => __( 'New testimonial', 'sentient' ),
	'view_item' => __( 'View testimonial', 'sentient' ),
	'search_items' => __( 'Search Testimonials', 'sentient' ),
	'not_found' => __( 'No testimonials found', 'sentient' ),
	'not_found_in_trash' => __( 'No testimonials found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent testimonial:', 'sentient' ),
	'menu_name' => __( 'Testimonials', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'testimonial', $args );
}

/*------------------------------------------------------
Identity, Add Testimonial Option to the Theme - End
-------------------------------------------------------*/


/*------------------------------------------------------
Identity, Add Packages Option to the Theme - - Started
-------------------------------------------------------*/
function identity_register_cpt_packages() {

$labels = array(
	'name' => __( 'Packages', 'sentient' ),
	'singular_name' => __( 'packages', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New Packages', 'sentient' ),
	'edit_item' => __( 'Edit Packages', 'sentient' ),
	'new_item' => __( 'New Packages', 'sentient' ),
	'view_item' => __( 'View Packages', 'sentient' ),
	'search_items' => __( 'Search Packages', 'sentient' ),
	'not_found' => __( 'No Packages found', 'sentient' ),
	'not_found_in_trash' => __( 'No Packages found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent Packages:', 'sentient' ),
	'menu_name' => __( 'Packages', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'revisions' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'packages', $args );
}

/*------------------------------------------------------
Identity, Add Packages Option to the Theme - End
-------------------------------------------------------*/


/*------------------------------------------------------
Identity, Add Process Option to the Theme - Started
-------------------------------------------------------*/
function identity_register_cpt_process() {

$labels = array(
	'name' => __( 'Process', 'sentient' ),
	'singular_name' => __( 'process', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New process', 'sentient' ),
	'edit_item' => __( 'Edit process', 'sentient' ),
	'new_item' => __( 'New process', 'sentient' ),
	'view_item' => __( 'View process', 'sentient' ),
	'search_items' => __( 'Search process', 'sentient' ),
	'not_found' => __( 'No process found', 'sentient' ),
	'not_found_in_trash' => __( 'No process found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent process:', 'sentient' ),
	'menu_name' => __( 'Process', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'revisions' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'process', $args );
}

/*------------------------------------------------------
Identity, Add Process Option to the Theme - End
-------------------------------------------------------*/




/*------------------------------------------------------
Identity, Add Team Members Option to the Theme - Started
-------------------------------------------------------*/

function identity_register_cpt_team() {

$labels = array(
	'name' => __( 'Team', 'sentient' ),
	'singular_name' => __( 'Team', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New Team Member', 'sentient' ),
	'edit_item' => __( 'Edit Team Member', 'sentient' ),
	'new_item' => __( 'New Team Member', 'sentient' ),
	'view_item' => __( 'View Team Member', 'sentient' ),
	'search_items' => __( 'Search Team Member', 'sentient' ),
	'not_found' => __( 'No Team Member found', 'sentient' ),
	'not_found_in_trash' => __( 'No Team Member found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent Team Member:', 'sentient' ),
	'menu_name' => __( 'Team', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),

	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'team', $args );
}

/*------------------------------------------------------
Identity, Add Team Members Option to the Theme - End
-------------------------------------------------------*/

if ( ! function_exists( 'optionsframework_mlu_init' ) ) :

function optionsframework_mlu_init () {
	register_post_type( 'optionsframework', array(
		'labels' => array(
			'name' => __( 'Theme Options Media', 'optionsframework' ),
		),
		'public' => true,
		'show_ui' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'supports' => array( 'title', 'editor' ), 
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => false,
		'public' => false
	) );
}

endif;



add_action( 'init', 'identity_add_page_cats' );	
function identity_add_page_cats()
{
    register_taxonomy_for_object_type( 'category', 'post' );
}



if(function_exists('identity_section_title')){
	add_shortcode('identity_section_title', 'identity_section_title');
}


if(function_exists('identity_white_title')){
	add_shortcode('identity_white_title', 'identity_white_title');
}

if(function_exists('identity_img_inside_mac')){
	add_shortcode('identity_img_inside_mac', 'identity_img_inside_mac');
}

if(function_exists('identity_homepage_icons_section')){
add_shortcode('identity_homepage_icons_section', 'identity_homepage_icons_section');
}

if(function_exists('identity_homepage_iconsstyle2_section')){
add_shortcode('identity_homepage_iconsstyle2_section', 'identity_homepage_iconsstyle2_section');
}

if(function_exists('identity_iconsstyle3_section')){
add_shortcode('identity_iconsstyle3_section', 'identity_iconsstyle3_section');
}

if(function_exists('identity_left_Slider_Section')){
add_shortcode('identity_left_Slider_Section', 'identity_left_Slider_Section');
}

if(function_exists('identity_animated_numbers')){
add_shortcode('identity_animated_numbers', 'identity_animated_numbers');
}

if(function_exists('identity_animated_numbers_style2')){
add_shortcode('identity_animated_numbers_style2', 'identity_animated_numbers_style2');
}

if(function_exists('identity_clients_Slider_Section')){
add_shortcode('identity_clients_Slider_Section', 'identity_clients_Slider_Section');
}

if(function_exists('identity_button')){
add_shortcode('identity_button', 'identity_button');
}

if(function_exists('identity_homepage_container')){
	add_shortcode('homepage_container', 'identity_homepage_container');
}

if(function_exists('identity_homepage_container_wide')){
add_shortcode('homepage_container_wide', 'identity_homepage_container_wide');
}

if(function_exists('identity_homepage_video_container')){
add_shortcode('identity_homepage_video_container', 'identity_homepage_video_container');
}

if(function_exists('identity_homepage_container_end')){
add_shortcode('homepage_container_end', 'identity_homepage_container_end');
}

if(function_exists('identity_process')){
add_shortcode('identity_process', 'identity_process');
}

if(function_exists('identity_team_members')){
add_shortcode('identity_team_members', 'identity_team_members');
}

if(function_exists('identity_portfolio')){
add_shortcode('identity_portfolio', 'identity_portfolio');
}

if(function_exists('identity_testimonial')){
add_shortcode('identity_testimonial', 'identity_testimonial');
}

if(function_exists('identity_map')){
add_shortcode('identity_map', 'identity_map');
}

if(function_exists('identity_blog')){
add_shortcode('identity_blog', 'identity_blog');
}

if(function_exists('identity_packages')){
add_shortcode('identity_packages', 'identity_packages');
}

if(function_exists('identity_contact_details')){
add_shortcode('identity_contact_details', 'identity_contact_details');
}


if(function_exists('identity_social_icon')){
add_shortcode('identity_social_icon', 'identity_social_icon');
}

if(function_exists('identity_alert_box')){
add_shortcode('identity_alert_box', 'identity_alert_box');
}

if(function_exists('identity_list_item')){
add_shortcode('identity_list_item', 'identity_list_item');
}

if(function_exists('identity_video')){
add_shortcode('identity_video', 'identity_video');
}

if(function_exists('identity_dropcaps')){
add_shortcode('identity_dropcaps', 'identity_dropcaps');
}

if(function_exists('identity_heading_one')){
add_shortcode('identity_heading_one', 'identity_heading_one');
}

if(function_exists('identity_heading_two')){
add_shortcode('identity_heading_two', 'identity_heading_two');
}

if(function_exists('identity_heading_three')){
add_shortcode('identity_heading_three', 'identity_heading_three');
}

if(function_exists('identity_heading_four')){
add_shortcode('identity_heading_four', 'identity_heading_four');
}

if(function_exists('identity_heading_five')){
add_shortcode('identity_heading_five', 'identity_heading_five');
}

if(function_exists('identity_heading_six')){
add_shortcode('identity_heading_six', 'identity_heading_six');
}

if(function_exists('identity_page_section')){
	add_shortcode('identity_page_section', 'identity_page_section');
}

if(function_exists('identity_resume')){
	add_shortcode('identity_resume', 'identity_resume');
}

if(function_exists('identity_about_me_image')){
	add_shortcode('identity_about_me_image', 'identity_about_me_image');
}

if(function_exists('identity_personal_details')){
	add_shortcode('identity_personal_details', 'identity_personal_details');
}

if(function_exists('identity_skills_bar')){
	add_shortcode('identity_skills_bar', 'identity_skills_bar');
}

if(function_exists('identity_download_button')){
	add_shortcode('identity_download_button', 'identity_download_button');
}


/*------------------------------------------------------
Identity Download Button - Shortcode	
-------------------------------------------------------*/
function identity_download_button($atts, $content = null) {
   extract(shortcode_atts(array('fontcolor' => '#000' , 'buttoncolor' => '#FFFFFF' , 'bordercolor' =>'#474d5d' , 'link' => '#' , 'buttontext' => 'Button'), $atts));
   if($fontcolor == '#FFFFFF' || $fontcolor == '#ffffff' || $fontcolor == '#fff'  || $fontcolor == '#FFF'){$hoverClass = 'identity-hover-button';}else{$hoverClass = '';}
   return '<a target="_blank" href='. esc_url($link) .' class="btn btn-primary btn-lg '. $hoverClass .'" style="color:'. $fontcolor .'; background-color: '. $buttoncolor .'; border: 2px solid '. $bordercolor .';"><i class="fa fa-download"></i> '. esc_attr($buttontext) .'</a>';
}



/*------------------------------------------------------
Identity Skills Bar - Shortcode
-------------------------------------------------------*/
function identity_skills_bar($atts, $content = null) {

	extract(shortcode_atts(array('skillname' => '', 'skillpercentage' => '', 'color' => ''), $atts));

	$return_string = '
					<ul class="skillBar">
						<li>
						<div class="skillBg">
							<span data-width="' . esc_attr($skillpercentage) . '"><strong>'. esc_attr($skillname). ' ' .  esc_attr($skillpercentage) . '%</strong></span>
						</div>
						</li>
					</ul>';

	return $return_string;

}



/*------------------------------------------------------
Identity Contact details - Shortcode
-------------------------------------------------------*/
function identity_personal_details( $atts, $content = null ) {
	extract(shortcode_atts(array('linkedin' => '' ,'facebook' => '' ,'twitter' => '' ,'birthdate' => '' , 'phone' => '' , 'email' => '' , 'website' => '' , 'address' => '' , 'color' => '', 'birthdatetitle' => '' ,'phonetitle' => '' ,'emailtitle' => '' ,'websitetitle' => '','linkedintitle' => '' ,'facebooktitle' => '' ,'twittertitle' => '' ,'addresstitle' => '' ), $atts));
	
	if($birthdate == ''){$birthdate = '';}else{$birthdate = '<li><i class="fa fa-li fa-calendar"></i><strong>' . esc_attr($birthdatetitle) . '</strong> : ' . esc_attr($birthdate) . '</li>';}
	if($phone == ''){$phone = '';}else{$phone = '<li><i class="fa fa-li fa-mobile"></i><strong>' . esc_attr($phonetitle) . '</strong> : ' . esc_attr($phone) . '</li>';}
	if($email == ''){$email = '';}else{$email = '<li><i class="fa fa-li fa-envelope-o"></i><strong>' . esc_attr($emailtitle) . '</strong> : ' . esc_attr($email) . '</li>';}
	if($website == ''){$website = '';}else{$website = '<li><i class="fa fa-li fa-globe"></i><strong>' . esc_attr($websitetitle) . '</strong> : ' . esc_url($website) . '</li>';}
	if($facebook == ''){$facebook = '';}else{$facebook = '<li><i class="fa fa-li fa-facebook"></i><strong>' . esc_attr($facebooktitle) . '</strong> : ' . esc_url($facebook) . '</li>';}
	if($twitter == ''){$twitter = '';}else{$twitter = '<li><i class="fa fa-li fa-twitter"></i><strong>' . esc_attr($twittertitle) . '</strong> : ' . esc_url($twitter) . '</li>';}
	if($address == ''){$address = '';}else{$address = '<li><i class="fa fa-li fa-home"></i><strong>' . esc_attr($addresstitle) . '</strong> : ' . esc_attr($address) . '</li>';}
	if($linkedin == ''){$linkedin = '';}else{$linkedin = '<li><i class="fa fa-li fa-linkedin"></i><strong>' . esc_attr($linkedintitle) . '</strong> : ' . esc_url($linkedin) . '</li>';}
	
	
	$return_string = '<div style="color:' . $color . ';">
						<ul class="fa-ul">
							' . $birthdate . '
							' . $phone . '
							' . $email . '
							' . $website . '
							' . $facebook . '
							' . $twitter . '
							' . $linkedin . '
							' . $address . '
						</ul></div>';
	
	return $return_string;	
}



/*------------------------------------------------------
Identity About Me Personal Image - Shortcode
-------------------------------------------------------*/
function identity_about_me_image($atts, $content = null) {

	extract(shortcode_atts(array('color' => '', 'color2' => '', 'bgcolor' => '', 'personalimg' => '', 'personalname' => '', 'designation' => ''), $atts));

	$getimageurlarray = wp_get_attachment_image_src( $personalimg , 'full');
	if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}

	$returnvalue = '
	  <div class="text-center item_bottom">
	   <img src="' . esc_url($getimageurl) . '" class="img-center img-responsive" alt="photo"/>
	   <div class="name-title" style="background-color: ' . $bgcolor . ';">
		<h2 style="color:' . $color . ';">' . esc_attr($personalname) . '</h2>
		<h5 style="color:' . $color2 . ';">' . esc_attr($designation) . '</h5>
	   </div>
	  </div>
		  ';

	return $returnvalue;

}



/*------------------------------------------------------
Identity Resume - Shortcode
-------------------------------------------------------*/
function identity_resume( $atts, $content = null ) {
	extract(shortcode_atts(array('noofpresent' => '' , 'noofeducation' => '' , 'presenttext' => '' , 'educationtext' => ''), $atts));
	
	global $prof_default;

	$return_string = '<ul class="timeline resume-timeline list-unstyled">
						<li class="title">' . esc_attr($presenttext) . '</li>';
	
	$loop = new WP_Query(array('post_type' => 'present', 'posts_per_page' => $noofpresent));
	
	$readmoretxt = __('Read more' , 'sentient');
	$counter = 1;
	$rightleft = '';
	$galleryids = '';
	$getText = '';
	$blogSliderClass = '';
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
	$blogSliderClass = '';
	
		if ($counter % 2 == 0) {
			$rightleft = 'note item_left';
		} else {
			$rightleft = 'note item_right';
		}
	
	if(of_get_option('select_present_education_link',$prof_default) == 'On'){$itemLink = esc_url(get_permalink());}else{$itemLink = '#';}
	
	$return_string .='
		<li class="' . $rightleft . '">
			<h4><a href="'. $itemLink .'">'. get_the_title() .'</a></h4>
			<h5>' . esc_attr(get_post_meta(get_the_ID(), 'Present Position', true)) . '</h5>
			<p class="desc">
				' . strip_shortcodes(wp_trim_words( get_the_content(), 35 )) . '
			</p>
			<span class="date">' . esc_attr(get_post_meta(get_the_ID(), 'Present Period', true)) . '</span>
			<span class="arrow fa fa-play"></span>
		</li>';
						
		$counter = $counter + 1;	
	
	endwhile;
	endif;
	
	if($noofeducation <> 0){
		$counter = 1;		
		$loop = new WP_Query(array('post_type' => 'education', 'posts_per_page' => $noofeducation));		
	
		$return_string .= '<li class="title">' . esc_attr($educationtext) . '</li>';
	
		if ( $loop ) :   
		while ( $loop->have_posts() ) : $loop->the_post();			
		
			if ($counter % 2 == 0) {
				$rightleft = 'note item_right';
			} else {
				$rightleft = 'note item_left';
			}
			
			$return_string .= '
				<li class="' . $rightleft . '">
					<h4><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></h4>
					<h5>' . esc_attr(get_post_meta(get_the_ID(), 'Education University', true)) . '</h5>
					<p class="desc">
						' . strip_shortcodes(wp_trim_words( get_the_content(), 35 )) . '
					</p>
					<span class="date">' . esc_attr(get_post_meta(get_the_ID(), 'Present Period', true)) . '</span>
					<span class="arrow fa fa-play"></span>
				</li>';
							
			$counter = $counter + 1;	
		
		endwhile;
		endif;		
		
	}
	

	
	$return_string .='	<li class="start fa fa-bookmark"></li>
						<li class="clear"></li>
					  </ul>';
	
	wp_reset_query();	

	return $return_string;	

}



/*------------------------------------------------------
Identity Homepage Row Start - Shortcode
-------------------------------------------------------*/
function identity_homepage_container($atts, $content = null) {
	
	extract(shortcode_atts(array('type' => '','repeat' => 'yes', 'background' => '', 'color' => '#ffffff' , 'bordertop' => 'no' , 'borderbottom' => 'no' , 'font' => '#666666' , 'paddingtop' => '40px' , 'paddingbottom' => '40px' , 'parallax' => ''), $atts));
	
	if($parallax == 'yes'){$parallaxClass='identity-parallax';}else{$parallaxClass='';}
	
	if($bordertop == 'yes'){$top = 'homepage-container-design-top';}else{$top = '';}
	
	if($borderbottom == 'yes'){$bottom = 'homepage-container-design-bottom';}else{$bottom = '';}
	
	if($repeat == 'yes'){$getrepeat = 'repeat'; $backcover = 'cover';}else{$getrepeat = 'no-repeat'; $backcover = 'cover';}
	
	$returnedvalue = '';
	
	if($type == 'yes'){
		$returnedvalue = '<div class="homepage-container-design ' . $top . ' ' . $bottom .'" style="background:'. $color .'; color:'. $font .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .';">
			<div class="homepage-container-design-inner">';
	}
	else
	{
		$getimageurlarray = wp_get_attachment_image_src( $background , 'full');
		if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
		$returnedvalue = '<div class="homepage-container-design ' . $parallaxClass . ' ' . $top . ' ' . $bottom .'" style="background-image:url('. $getimageurl .');color:'. $font .';background-repeat:'. $getrepeat .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .'; background-size:'. $backcover .'; background-position:top center;">
			<div class="homepage-container-design-inner">';
	}

		return $returnedvalue;

}




/*------------------------------------------------------
Identity Homepage Row Wide Start - Shortcode
-------------------------------------------------------*/
function identity_homepage_container_wide($atts, $content = null) {
	
	extract(shortcode_atts(array('type' => '','repeat' => 'yes', 'background' => '', 'color' => '#ffffff' , 'bordertop' => 'no' , 'borderbottom' => 'no' , 'font' => '#666666' , 'paddingtop' => '40px' , 'paddingbottom' => '40px'), $atts));
	
	if($bordertop == 'yes'){$top = 'homepage-container-design-top';}else{$top = '';}
	
	if($borderbottom == 'yes'){$bottom = 'homepage-container-design-bottom';}else{$bottom = '';}
	
	if($repeat == 'yes'){$getrepeat = 'repeat'; $backcover = 'auto';}else{$getrepeat = 'no-repeat'; $backcover = 'cover';}

	if($type == 'yes'){
		return '<div class="homepage-container-design homepage-container-design-wide '. $top . ' ' . $bottom .'" style="background:'. $color .'; color:'. $font .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .';">
			<div class="homepage-container-design-inner">';
	}
	else
	{
		$getimageurlarray = wp_get_attachment_image_src( $background , 'full');
		if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
		return '<div class="homepage-container-design homepage-container-design-wide '. $top . ' ' . $bottom .'" style="background-image:url('. $getimageurl .');color:'. $font .';background-repeat:'. $getrepeat .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .'; background-size:'. $backcover .';">
			<div class="homepage-container-design-inner">';
	}

}



/*------------------------------------------------------
Identity Section Title - Shortcode
-------------------------------------------------------*/
function identity_section_title($atts, $content = null){
	extract(shortcode_atts(array('icon' => '' , 'animationtype' => '' , 'normaltext' => '' , 'highlightedtext' => '' , 'iconbackgroundcolor' => '' , 'iconcolor' => '' , 'textcolor' => '' , 'highlightedcolor' => ''), $atts));
	
	return '<div class="section-title ' . $animationtype . ' text-center">
		<div style="background-color: ' . $iconbackgroundcolor . ';">
			<span class="fa fa-' . $icon . ' fa-2x" style="color: ' . $iconcolor . ';"></span>
		</div>
		<h1 style="color: ' . $textcolor . ';">' . esc_attr($normaltext) . ' <span style="background-color: ' . $highlightedcolor . ';">' . esc_attr($highlightedtext) . '</span></h1>
	</div>';
}


/*------------------------------------------------------
Identity White Title - Shortcode
-------------------------------------------------------*/
function identity_white_title($atts, $content = null){
	extract(shortcode_atts(array('titletext' => '' , 'animationtype' => ''), $atts));
	
	return '<div class="parallax-overlay identity-parallax-overlay ' . $animationtype . '">
				<h4>' . esc_attr($titletext) . '</h4>
			</div>';
}



	/*------------------------------------------------------
Identity Image Inside Mac - Shortcode
-------------------------------------------------------*/
function identity_img_inside_mac($atts, $content = null){
	extract(shortcode_atts(array('background' => '', 'link' => ''), $atts));
	$getText = '';
	$getimageurlarray = wp_get_attachment_image_src( $background , 'full');
	if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
	
	$getText .='<div class="slider-container item_bottom">
				<div class="swiper-about">
					<div class="swiper-wrapper" >';
	
	$splitImagesArray = explode(",", $background);
	$splitImagesArraySize = count($splitImagesArray);
	
	for ($x=0; $x < $splitImagesArraySize; $x++)
	{
		$getimageurlarray = wp_get_attachment_image_src( $splitImagesArray[$x] , 'full');
		
		$alt = get_post_meta($splitImagesArray[$x], '_wp_attachment_image_alt', true);
		
		$getText .= '<div xmlns="http://www.w3.org/1999/xhtml" class="swiper-slide swiper-slide-duplicate" >
							<img alt="' . esc_attr($alt) . '" class="img-responsive" src="' . esc_url($getimageurlarray[0]) . '">
						</div>';
	} 
	
	$getText .= '</div>
			<div class="pagination-about">
			</div>
		</div>
	</div>';
	
	return $getText;
}



/*------------------------------------------------------
Identity Icons Style 1 Section - Shortcode
-------------------------------------------------------*/
function identity_homepage_icons_section($atts, $content = null){
	extract(shortcode_atts(array('icon' => 'icon-mobile','animationtype' => '','circle' => '' ,'title' => 'Title Goes Here', 'text' => 'Content and Text goes here'), $atts));
	
	if($circle == 'circle'){$circleClass = 'icon-circular';} else {$circleClass = 'icon-box';}
	
	return '<div class="feature-content text-center ' . $animationtype . '">
		<div class="' . $circleClass . '">
			<i class="fa fa-' . $icon . ' fa-5x"></i>
		</div>
		<h4>' . esc_attr($title) . '</h4>
		 ' . esc_attr($text) .'
	</div>';
}




/*------------------------------------------------------
Identity Icons Style 2 Section - Shortcode
-------------------------------------------------------*/
function identity_homepage_iconsstyle2_section($atts, $content = null){
	extract(shortcode_atts(array('icon' => 'icon', 'color' => '', 'animationtype' => '' , 'iconborder' => 'yes', 'title' => 'Title Goes Here', 'text' => 'Content and Text goes here'), $atts));
	
	if($iconborder == 'yes'){$borderClass='services-box-icon';}else{$borderClass='services-icon';}
	
	return '<div class="services-box ' . $animationtype . '">
		<h4>' . esc_attr($title) . '</h4>
		<div class="' . $borderClass . '">
			<i style="color:' . $color . ';" class="fa fa-' . $icon . ' fa-3x"></i>
		</div>
		<div class="service-box-info">
			<p>
				 ' . esc_attr($text) .'
			</p>
		</div>
	</div>';
}





/*------------------------------------------------------
Identity Icons Style 3 Section - Shortcode
-------------------------------------------------------*/
function identity_iconsstyle3_section($atts, $content = null){
	extract(shortcode_atts(array('icon' => 'icon', 'title' => 'Title Goes Here', 'text' => 'Content and Text goes here'), $atts));
	
	return '<div class="feature-content text-center item_bottom">
			<div class="icon-circular">
			<i class="fa fa-' . $icon . ' fa-5x"></i>
			</div>
			<h4>' . esc_attr($title) . '</h4>
			' . esc_attr($text) .' 
			</div>';
}




/*------------------------------------------------------
Identity Left Slider Section - Shortcode
-------------------------------------------------------*/
function identity_left_Slider_Section($atts, $content = null){
	extract(shortcode_atts(array('background' => '', 'link' => ''), $atts));
	$getText = '';
	$getimageurlarray = wp_get_attachment_image_src( $background , 'full');
	if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
	
	$getText .='<div class="flexslider identity-slider-styletwo">			
				<ul class="slides">';
	
	$splitImagesArray = explode(",", $background);
	$splitImagesArraySize = count($splitImagesArray);
	
	for ($x=0; $x < $splitImagesArraySize; $x++)
	{
		$getimageurlarray = wp_get_attachment_image_src( $splitImagesArray[$x] , 'full');
		
		$alt = get_post_meta($splitImagesArray[$x], '_wp_attachment_image_alt', true);
		
		$getText .= '<li>
							<img class="img-center img-responsive" src="' . esc_url($getimageurlarray[0]) . '" alt="' . esc_attr($alt) . '">

					</li>';
	} 
	
	$getText .= '</ul>
		</div>';
	
	return $getText;
}




/*------------------------------------------------------
Identity Animated Numbers
-------------------------------------------------------*/
function identity_animated_numbers($atts, $content = null) {
	extract(shortcode_atts(array('icon' => 'icon', 'iconscolor' => '', 'number' => '1000', 'text' => 'Description goes here'), $atts));

	return '<div class="counters-item">
					<i class="fa fa-' . $icon . ' fa-2x" style="color:'. $iconscolor .';"></i>
					<strong style="color:'. $iconscolor .'" data-to="'. esc_attr($number) .'">'. esc_attr($number) .'</strong>
					<p>
						 ' . esc_attr($text) . '
					</p>
				</div>
	';
}




/*------------------------------------------------------
Identity Animated Numbers Style 2
-------------------------------------------------------*/
function identity_animated_numbers_style2($atts, $content = null) {
	extract(shortcode_atts(array('title' => 'title', 'number' => '1000', 'text' => 'Description goes here'), $atts));

	return '<div class="chart" data-percent="' . esc_attr($number) . '">
				<span class="percent">' . esc_attr($number) . '</span>
				<h4>' . esc_attr($title) . '</h4>
				<p>
					' . esc_attr($text) . '
				</p>
			</div>';
}




/*------------------------------------------------------
Identity Clients Slider Section - Shortcode
-------------------------------------------------------*/
function identity_clients_Slider_Section($atts, $content = null){
	extract(shortcode_atts(array('background' => ''), $atts));
	$getText = '';

	$splitImagesArray = explode(",", $background);
	$splitImagesArraySize = count($splitImagesArray);		
	
	$getText .=	'<div class="clients"><div class="row item_fade_in"><div class="carrousel-container">
		<div id="left_scroll">
			<a href=""></a>
		</div>
		<div id="carousel_inner">
			<ul class="clearfix" id="carousel_ul">';
			
			
	for ($x=0; $x < $splitImagesArraySize; $x++)
	{
		$getimageurlarray = wp_get_attachment_image_src( $splitImagesArray[$x] , 'full');
		
		$alt = get_post_meta($splitImagesArray[$x], '_wp_attachment_image_alt', true);
		
		$getText .= '<li><span><img src="' . esc_url($getimageurlarray[0]) . '" alt="' . esc_attr($alt) . '"></span></li>';

	} 		

	
	$getText .= '</ul>
		</div>
		<div id="right_scroll">
			<a href=""></a>
		</div>
		<input type="hidden" id="hidden_auto_slide_seconds" value=0/>
	</div></div></div>';

	
	return $getText;
}



/*------------------------------------------------------
Identity Button - Shortcode
-------------------------------------------------------*/
function identity_button($atts, $content = null) {
   extract(shortcode_atts(array('fontcolor' => '#000' , 'buttoncolor' => '#FFFFFF' , 'bordercolor' =>'#474d5d' , 'link' => '#' , 'buttontext' => 'Button'), $atts));
   if($fontcolor == '#FFFFFF' || $fontcolor == '#ffffff' || $fontcolor == '#fff'  || $fontcolor == '#FFF'){$hoverClass = 'identity-hover-button';}else{$hoverClass = '';}
   return '<a href='. esc_url($link) .' class="btn '. $hoverClass .'" style="color:'. $fontcolor .'; background-color: '. $buttoncolor .'; border: 2px solid '. $bordercolor .';">'. esc_attr($buttontext) .'</a>';

}



/*------------------------------------------------------
Identity Homepage Video Row Start - Shortcode
-------------------------------------------------------*/
function identity_homepage_video_container($atts, $content = null) {
	
	extract(shortcode_atts(array('video' => '', 'background' => '' , 'font' => '#666666' , 'paddingtop' => '40px' , 'paddingbottom' => '40px'), $atts));
					
	$returnedvalue = '';
	$getimageurlarray = wp_get_attachment_image_src( $background , 'full');
	$getvideourlarray = wp_get_attachment_image_src( $video , 'full');
	
	if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
	
	$returnedvalue = '<div class="homepage-container-design" style="color:'. $font .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .';">
		<div class="sentient-video-container"><video controls="false" width="100%" muted autoplay="autoplay" loop id="sentient-video-row">
			<source type="video/mp4" src="' . esc_url($video) . '"></source>
		</video></div>
		<div class="homepage-container-design-inner">';

	return $returnedvalue;

}




/*------------------------------------------------------
Identity Homepage Row End - ShortCode
-------------------------------------------------------*/
function identity_homepage_container_end($atts, $content = null) {
   return '</div></div>';
}




/*------------------------------------------------------
Identity Process - Shortcode
-------------------------------------------------------*/
function identity_process( $atts, $content = null ) {
	extract(shortcode_atts(array('noofprocesses' => ''), $atts));
	
	$loop = new WP_Query(array('post_type' => 'process', 'posts_per_page' => $noofprocesses));
	$return_string = '<ol class="process-flow list-unstyled">';
	
	$counter = 1;

	
	if ( $loop ) :   
	
		while ( $loop->have_posts() ) : $loop->the_post();
			if($counter == $noofprocesses){
				$nooflines = '';
			} else {
				$nooflines = '<div class="line">
							<div class="progress">
							</div>
						  </div>';
			}
			$return_string .= '<li class="active">
									<div class="process-node active">
										<i class="fa fa-' . get_post_meta(get_the_ID(), 'Icon', true) . '"></i>
									</div>
									<h4>' . get_the_title() . '</h4>
									<p>
										 ' . strip_shortcodes(wp_trim_words( get_the_content(), 20 )) . '
									</p>
									' . $nooflines . '
								</li>';		
			$counter = $counter + 1;
		endwhile;
		
	endif;
	wp_reset_query();	
	
	$return_string .= '</ol>';
	
   return $return_string;	

}




/*------------------------------------------------------
Identity Team Members - Four per Row - Shortcode
-------------------------------------------------------*/
function identity_team_members( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => '4' , 'read' => ''), $atts));
	
	global $prof_default;

	$return_string = '';
	$percentage = '';
	$linkValue = '';
	$UrlValue = '';
	
	$loop = new WP_Query(array('post_type' => 'team', 'posts_per_page' => $noofposts));

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
	if(get_post_meta(get_the_ID(), 'Team Social One Link', true) != ''){
		$gplus = get_post_meta(get_the_ID(), 'Team Social One', true);
		if(get_post_meta(get_the_ID(), 'Team Social One', true) == 'gplus'){$gplus = 'google-plus';}
		$socialStringOne = '<a href="' . esc_url(get_post_meta(get_the_ID(), 'Team Social One Link', true)) . '" class="' . get_post_meta(get_the_ID(), 'Team Social One', true) . '"><i class="fa fa-' . $gplus . '"></i></a>';
	} else {$socialStringOne ='';}
	
	if(get_post_meta(get_the_ID(), 'Team Social Two Link', true) != ''){
		$gplus = get_post_meta(get_the_ID(), 'Team Social Two', true);
		if(get_post_meta(get_the_ID(), 'Team Social Two', true) == 'gplus'){$gplus = 'google-plus';}
		$socialStringTwo = '<a href="' . esc_url(get_post_meta(get_the_ID(), 'Team Social Two Link', true)) . '" class="' . get_post_meta(get_the_ID(), 'Team Social Two', true) . '"><i class="fa fa-' . $gplus . '"></i></a>';
	} else {$socialStringTwo ='';}
	
	if(get_post_meta(get_the_ID(), 'Team Social Three Link', true) != ''){
		$gplus = get_post_meta(get_the_ID(), 'Team Social Three', true);
		if(get_post_meta(get_the_ID(), 'Team Social Three', true) == 'gplus'){$gplus = 'google-plus';}
		$socialStringThree = '<a href="' . esc_url(get_post_meta(get_the_ID(), 'Team Social Three Link', true)) . '" class="' . get_post_meta(get_the_ID(), 'Team Social Three', true) . '"><i class="fa fa-' . $gplus . '"></i></a>';
	} else {$socialStringThree ='';}
	
	
	if(get_post_meta(get_the_ID(), 'Team Skill Title One', true) != ''){
		$percentage = get_post_meta(get_the_ID(), 'Team Skill Percentage One', true);
		$skilltitleone_string = '<li>
									<div class="skillBg">
										<span data-width="' . esc_attr($percentage) . '" style="width: ' . esc_attr($percentage) . '%;"><strong>' . get_post_meta(get_the_ID(), 'Team Skill Title One', true) . ' ' . esc_attr($percentage) . '%</strong></span>
									</div>
								</li>';
								
	} else {$skilltitleone_string ='';}		
	
	if(get_post_meta(get_the_ID(), 'Team Skill Title Two', true) != ''){
		$percentage = get_post_meta(get_the_ID(), 'Team Skill Percentage Two', true);
		$skilltitletwo_string = '<li>
									<div class="skillBg">
										<span data-width="' . esc_attr($percentage) . '" style="width: ' . esc_attr($percentage) . '%;"><strong>' . get_post_meta(get_the_ID(), 'Team Skill Title Two', true) . ' ' . esc_attr($percentage) . '%</strong></span>
									</div>
								</li>';
	} else {$skilltitletwo_string ='';}	
	
	if(get_post_meta(get_the_ID(), 'Team Skill Title Three', true) != ''){
		$percentage = get_post_meta(get_the_ID(), 'Team Skill Percentage Three', true);
		$skilltitlethree_string = '<li>
									<div class="skillBg">
										<span data-width="' . esc_attr($percentage) . '" style="width: ' . esc_attr($percentage) . '%;"><strong>' . get_post_meta(get_the_ID(), 'Team Skill Title Three', true) . ' ' . esc_attr($percentage) . '%</strong></span>
									</div>
								</li>';
	} else {$skilltitlethree_string ='';}
	
	$get_team_position =  get_post_meta(get_the_ID(), 'Team Member Position', true);
	
	if($read == 'yes'){
		$UrlValue = __("Read More" , "sentient");
		$linkValue = '<a href="' . esc_url(get_permalink()) . '">' . esc_attr($UrlValue) . '</a>';
	} else {
		$linkValue = '';	
	}
	
	
	$return_string .= '<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="member_item">
							<div class="member_img">
								'. get_the_post_thumbnail( get_the_ID() , 'identity-team'  ) . '
							</div>
							<div class="member_descr center">
								<div class="member_name">
									'. get_the_title() .'
								</div>
								<div class="member_post">
									 ' . esc_attr($get_team_position) . '
								</div>
								<div class="member_social">
								'  . $socialStringOne . $socialStringTwo . $socialStringThree .  '
								</div>
								<div class="member_about">
									 ' . strip_shortcodes(wp_trim_words( get_the_content(), 20 )) . ' ' . $linkValue . '
								</div>
								<div class="skill-member">
									<ul class="skillBar">
										' . $skilltitleone_string . $skilltitletwo_string . $skilltitlethree_string . '
									</ul>
								</div>
							</div>
							</div>
							</div>';
			
	endwhile;
	endif;
	
	wp_reset_query();	

	return $return_string;	

}



/*------------------------------------------------------
Identity Portfolio - Four per Row - Shortcode
-------------------------------------------------------*/
function identity_portfolio( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => '4'), $atts));
	
	global $prof_default;
	$prevString = __("Previous Project","sentient");
	$nextString = __("Next Project","sentient");
	$closeString = __("Close Project","sentient");

	$return_string = '';
					$cat_string = '';
					$terms = get_terms("portfoliocategories");
					$count = count($terms);  
					$AllWord = __("ALL" , "sentient");
					
					if ( $count > 0 ){  
					  
						$cat_string .='<li>
									<a class="active" href="#" data-cat="*">' . esc_attr($AllWord) . '</a>
									</li>';
						foreach ( $terms as $term ) {  
							if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
								$termname = strtolower($term->name);  
								$termname = str_replace(' ', '-', $termname);  
								$cat_string .= '<li>
									<a href="#" data-cat="'.$termname.'">'.$term->name.'</a>
									</li>';  
							}
						}  
					}  
					
	$return_string .='<div id="portfolio-filter">
						<div class="row text-center">
							<div class="col-md-12">
								<ul class="portfolio-filter-list white">
									' . $cat_string . '
								</ul>
							</div>
						</div>		
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div id="portfolio-items" class="portfolio-items item_fade_in">
					';
	
	$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $noofposts));
	$cat_count = 1;
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
		$cat_count = 1;
		$terms = get_the_terms( get_the_ID() , 'portfoliocategories' );  
		$separator = ' / ';
		$output = '';
		$outputClass = '';
		if ( $terms && ! is_wp_error( $terms ) ) {   

			foreach ( $terms as $term )   
			{  
				$termname = strtolower($term->name);
				if($cat_count < 3){											
					$output .= $term->name . $separator;
				}
				$termname = strtolower($term->name);  
				$outputClass .= str_replace(' ', '-', $termname) . ' ';
				$cat_count = $cat_count + 1;
			} 
			
			$final_cat_string = trim($output, $separator);
			
		} else {   
		   $final_cat_string = '';
		   $outputClass = '';
		}			
	
	

		if ( get_post_format() == false) {									
			$porIcon = 'camera';
		}elseif ( has_post_format('video')) {
			$porIcon = 'film';
		}elseif ( has_post_format('gallery')) {
			$porIcon = 'image';
		}elseif ( has_post_format( 'audio' )) { 							
			$porIcon = 'music';
		}else { 
			$porIcon = 'camera';			
		} 		
	
	
	$return_string .= ' <article class="' . $outputClass . '">							
							<a class="" href="'. esc_url(get_permalink()) .'">
							'. get_the_post_thumbnail(get_the_ID() , array( 280, 190)) . '
							<div class="overlay">
								<div class="item-info">
									<i class="fa fa-' . $porIcon . '"></i>
									<h3>'. get_the_title() .'</h3>
									<span>' . $final_cat_string . '</span>
								</div>
							</div>
							</a>
						</article>';
			
	endwhile;
	endif;
	
	$return_string .='</div></div></div></div>';
	
	wp_reset_query();	

	return $return_string;	


}


	
/*------------------------------------------------------
Identity Testimonial - Shortcode
-------------------------------------------------------*/
function identity_testimonial( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => '3', 'animationtype' => '' , 'fontcolor' => '' , 'speed' => '' , 'length' => ''), $atts));



	$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => $noofposts));
	
	$return_string = '<div class="' . $animationtype . ' col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
					  <div class="swiper-testimonial" data-speed="' . esc_attr($speed) . '">
					  <div class="swiper-wrapper">';
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	if(strtoupper($length) == 'NO'){
		$testText = strip_shortcodes(wp_trim_words( get_the_content(), 77 ));
	} else {
		$testText = get_the_content();
	}	
	$return_string .= '<div class="swiper-slide white">
							<p class="quote" style="color: '. $fontcolor .';">
								 "' . $testText . '"
							</p>
							<p class="author" style="color: '. $fontcolor .';">
								 ' . get_the_title() . '
							</p>
							<p class="company" style="color: '. $fontcolor .';">
								 ' . esc_attr(get_post_meta(get_the_ID(), 'Person Position', true)) . ' <a style="color:' . $fontcolor . ';" href="' . esc_attr(get_post_meta(get_the_ID(), 'Company URL', true)) . '">' . esc_attr(get_post_meta(get_the_ID(), 'Testimonial Person Company Name', true)) . '</a>
							</p>
					   </div>';
	endwhile;
	endif;		
	
	$return_string .= '</div>
						<div class="pagination-testimonial">
						</div>
					   </div>
					   </div>';					
	
	wp_reset_query();	
	
	return $return_string;	


}




/*------------------------------------------------------
Identity Map - Shortcode
-------------------------------------------------------*/
function identity_map( $atts, $content = null ) {
	extract(shortcode_atts(array('loctitle' => '' , 'locdesc' => '' , 'latitude' => '-37.809674' , 'longitude' => '144.954718'), $atts));
	$Id = $latitude . $longitude;	
	$Id = str_replace('.', '', $Id);
	$Id = str_replace('-', '', $Id);
	$Id = 'map_' . $Id;
	
	$return_string = '<div id="'. $Id .'" class="map-canvas item_fade_in" data-lat="' . $latitude . '" data-lng="' . $longitude . '" data-base="' . get_template_directory_uri() . '" data-loctitle="' . $loctitle . '" data-locdesc="' . $locdesc . '">
					  </div>';
	
	return $return_string;	
}




/*------------------------------------------------------
Identity Blog - Shortcode
-------------------------------------------------------*/
function identity_blog( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => '' , 'link' => '' , 'title' => ''), $atts));
	
	global $prof_default;

	$return_string = '<ul class="timeline list-unstyled">
						<li class="title"><i class="fa fa-pencil"></i></li>';
	
	$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $noofposts));
	
	$readmoretxt = __('Read more' , 'sentient');
	$counter = 1;
	$rightleft = '';
	$galleryids = '';
	$getText = '';
	$blogSliderClass = '';
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
	$blogSliderClass = '';
	
		if ($counter % 2 == 0) {
			$rightleft = 'note item_left';
		} else {
			$rightleft = 'note item_right';
		}
	
	$return_string .='<li class="' . $rightleft . '">
						<h3>'. get_the_title() .'</h3>
						<span class="date"><i class="fa fa-clock-o"></i> ' . get_the_date() . '</span>';
						
			if ( get_post_format() == false && has_post_thumbnail()) {
				$return_string .='<a href="'. esc_url(get_permalink()) .'">' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '</a>';
			} elseif ( has_post_format( 'gallery' ) && get_post_meta(get_the_ID(), 'Post Gallery', true) != ''){
				$blogSliderClass = 'desc-slider';
				$getText .='<div class="flexslider"><ul class="slides">';
							
				$galleryids = explode(",", get_post_meta(get_the_ID(), 'Post Gallery', true));
				$idscount = count($galleryids);
				for ($x=0; $x < $idscount; $x++)
				{	
					$getimageurlarray = wp_get_attachment_image_src( $galleryids[$x] , 'full');
					
					$alt = get_post_meta($galleryids[$x], '_wp_attachment_image_alt', true);
					
					$getText .= '<li>   
										<a href="'. esc_url(get_permalink()) .'"><img class="img-center img-responsive" src="' . $getimageurlarray[0] . '" alt="' . $alt . '"/></a>
								</li>';
				} 
				
				$getText .= '</ul></div>';
	
				$return_string .= $getText;
			  
			} elseif ( has_post_format( 'video' ) && get_post_meta(get_the_ID(), 'Post Video URL', true) != ''){
			 $return_string .='<div class="media-container">
								<iframe src="'. esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)) .'" style="border:0px;"  height="260">
								</iframe></div>'; 
			 
			}  elseif(has_post_thumbnail())  {
			 $return_string .='<a href="'. esc_url(get_permalink()) .'">' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '</a>';    
			}
						
			 $return_string .='<p class="desc ' . $blogSliderClass . '">
							 ' . strip_shortcodes(wp_trim_words( get_the_content(), 35 )) . '
						</p>
						<div>
							<a class="btn btn-default pull-left" href="'. esc_url(get_permalink()) .'">' . esc_attr($readmoretxt) . '</a>
						</div>
						<span class="arrow fa fa-play"></span>
					 </li>';
						
		$counter = $counter + 1;	
	
	endwhile;
	endif;
	
	$return_string .='<li class="start"><a href="' . esc_url($link) . '">' . esc_attr($title) . '</a></li>
						<li class="clear"></li>
					  </ul>';
	
	wp_reset_query();	

	return $return_string;	

}




/*------------------------------------------------------
Identity Page Section - Shortcode
-------------------------------------------------------*/
function identity_page_section( $atts, $content = null ) {
	extract(shortcode_atts(array('id' => ''), $atts));

	return '<div id="' . $id . '"></div>';		

}




/*------------------------------------------------------
Identity Packages - Shortcode
-------------------------------------------------------*/
function identity_packages( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => ''), $atts));
	
	global $prof_default;
	
	if($noofposts > 4){$noofposts = 4;}
	$animation = '';
	$return_string = '<div class="container">
						<div class="row package-container">';
	
	$loop = new WP_Query(array('post_type' => 'packages', 'posts_per_page' => $noofposts));
	$counter = 1;
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
		$animation = get_post_meta(get_the_ID(), 'Package Animation', true);
		$currency = get_post_meta(get_the_ID(), 'Package Currency', true);
		$price = get_post_meta(get_the_ID(), 'Package Price', true);
		$period = get_post_meta(get_the_ID(), 'Package Period', true);
		$desc = get_post_meta(get_the_ID(), 'Package Mini Description', true);
		if(get_post_meta(get_the_ID(), 'Package Active', true) == 'yes'){$active = 'package-active';}else{$active = '';}
		
		if($animation == 'top') {$animation = 'item_top';} elseif($animation == 'left') {$animation = 'item_left';} elseif($animation == 'right') {$animation = 'item_right';} elseif($animation == 'bottom') {$animation = 'item_bottom';} else {$animation = '';}
		
		$return_string .='<div class="col-md-4 col-sm-4 ' . $animation . '">
							<div aria-controls="package' . $counter . '" class="package ' . $active . '">
								<h3>' . get_the_title() . '</h3>
								<div class="price">
									<span class="currency">' . $currency . '</span><span class="amt">' . $price . '</span><span class="mo">/' . $period . '</span>
									<p>
										 ' . $desc . '
									</p>
								</div>
							</div>
						</div>';
						
		$counter = $counter + 1;
	endwhile;
	endif;
	
	$return_string .='</div><div class="row packages item_bottom">';
	$counter = 1;
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
		if(get_post_meta(get_the_ID(), 'Package Active', true) == 'yes'){$active = 'package-show';}else{$active = 'package-hide';}
		
		$return_string .='<div id="package' . $counter . '" class="' . $active . '">
							' . do_shortcode(get_the_content()) . '
						</div>';
		$counter = $counter + 1;
	endwhile;
	endif;

	wp_reset_query();	

	$return_string .='</div></div>';
	return $return_string;	

}




/*------------------------------------------------------
Identity Contact Details - Shortcode
-------------------------------------------------------*/
function identity_contact_details( $atts, $content = null ) {
	extract(shortcode_atts(array('add1' => '' , 'add2' => '' , 'phone1' => '' , 'phone2' => '' , 'color' => ''), $atts));
			
	$return_string = '<div class="text-center" style="color:' . $color . ';">
						<i class="fa fa-map-marker fa-3x"></i>
						<p>
							 ' . esc_attr($add1) . ' <br>
							 ' . esc_attr($add2) . '
						</p>
						<p>
							 <a href="tel:'. $phone1 .'">' . esc_attr($phone1) . '</a> <br><a href="tel:'. $phone2 .'">' . esc_attr($phone2) . '</a>
						</p>
					</div>';
	
	return $return_string;	
}





/*------------------------------------------------------
Identity Social Icons - Shortcode
-------------------------------------------------------*/
function identity_social_icon( $atts, $content = null ) {
	extract(shortcode_atts(array('link' => '' , 'socialicon' => ''), $atts));
			
	$return_string = '<div class="social-icon">
							<a target="_blank" href="' . esc_url($link) . '"><i class="fa fa-' . $socialicon . ' fa-3x"></i></a>
						</div>';
	
	return $return_string;	
}




/*------------------------------------------------------
Identity Alert Box
-------------------------------------------------------*/
function identity_alert_box($atts, $content = null) {
	extract(shortcode_atts(array('type' => '' , 'text' => ''), $atts));

	return '<div class="alert-box alert-' . $type . ' alert">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<p>' . esc_attr($text) . '</p>
			</div>';
}




/*------------------------------------------------------
Identity List Item
-------------------------------------------------------*/
function identity_list_item($atts, $content = null) {
	extract(shortcode_atts(array('type' => '' , 'text' => '' , 'color' => ''), $atts));
	if($type == 'default'){$type = '';}else{$type = '<i class="fa-li fa fa-' . $type . '"></i>';}
	return '<ul class="fa-ul">
				<li style="color:' . $color . ';">
					'. $type .'' . esc_attr($text) . '
				</li>
			</ul>';
}




/*------------------------------------------------------
Identity Video
-------------------------------------------------------*/
function identity_video($atts, $content = null) {
	extract(shortcode_atts(array('url' => ''), $atts));

	return '<div class="media-container">
				<iframe src="' . esc_url($url) . '"  height="281"></iframe>
			</div>';
}




/*------------------------------------------------------
Identity Dropcaps
-------------------------------------------------------*/
function identity_dropcaps($atts, $content = null) {
	extract(shortcode_atts(array('type' => '' , 'character' => '' , 'text' => ''), $atts));

	return '<p><span class="' . $type . '">' . esc_attr($character) . '</span>' . esc_attr($text) . '</p>';
}



/*------------------------------------------------------
Identity H1
-------------------------------------------------------*/
function identity_heading_one($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading'), $atts));

	return '<h1>' . esc_attr($text) . '</h1>';
}



/*------------------------------------------------------
Identity H2
-------------------------------------------------------*/
function identity_heading_two($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H2 Heading'), $atts));

	return '<h2>' . esc_attr($text) . '</h2>';
}



/*------------------------------------------------------
Identity H3
-------------------------------------------------------*/
function identity_heading_three($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H3 Heading'), $atts));

	return '<h3>' . esc_attr($text) . '</h3>';
}



/*------------------------------------------------------
Identity H4
-------------------------------------------------------*/
function identity_heading_four($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H4 Heading'), $atts));

	return '<h4>' . esc_attr($text) . '</h4>';
}


/*------------------------------------------------------
Identity H5
-------------------------------------------------------*/
function identity_heading_five($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H5 Heading'), $atts));

	return '<h5>' . esc_attr($text) . '</h5>';
}




/*------------------------------------------------------
Identity H6
-------------------------------------------------------*/
function identity_heading_six($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H6 Heading'), $atts));

	return '<h6>' . esc_attr($text) . '</h6>';
}	

?>