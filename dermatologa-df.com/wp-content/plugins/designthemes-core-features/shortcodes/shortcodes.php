<?php
class DTCoreShortcodesDefination {
	
	function __construct() {
		
		/* Accordion Shortcode */
		add_shortcode ( "dt_sc_accordion_group", array (
				$this,
				"dt_sc_accordion_group" 
		) );

		/* Button Shortcode */
		add_shortcode ( "dt_sc_button", array (
				$this,
				"dt_sc_button" 
		) );

		/* BlockQuotes Shortcode */
		add_shortcode ( "dt_sc_blockquote", array (
				$this,
				"dt_sc_blockquote" 
		) );

		/* Callout Box Shortcode */
		add_shortcode ( "dt_sc_callout_box", array (
				$this,
				"dt_sc_callout_box"
		));

		/* Columns Shortcode */

		add_shortcode ( "dt_sc_full_width", array ( 
				$this,
				"dt_sc_columns"
		) );
		
		add_shortcode ( "dt_sc_one_half", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_one_third", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_one_fourth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_one_fifth", array (
				$this,
				"dt_sc_columns" 
		) );
		
		add_shortcode ( "dt_sc_one_sixth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_two_sixth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_two_third", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_three_fourth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_two_fifth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_three_fifth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_four_fifth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_three_sixth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_four_sixth", array (
				$this,
				"dt_sc_columns" 
		) );
		add_shortcode ( "dt_sc_five_sixth", array (
				$this,
				"dt_sc_columns" 
		) );

		/* Title Shortcode */
		add_shortcode ( "dt_sc_h1", array ( 
			$this,
			"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h2", array ( 
			$this,
			 "dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h3", array ( 
			$this,
			"dt_sc_title"
		) );

		add_shortcode ( "dt_sc_h4", array ( 
			$this,
			"dt_sc_title"
		) );
		
		add_shortcode ( "dt_sc_h5", array ( 
			$this,
			"dt_sc_title"
		) );
		
		add_shortcode ( "dt_sc_h6", array ( 
			$this, 
			"dt_sc_title"
		) );
		/* Title Shortcode End */

		/* Contact Information */
		#Address
		add_shortcode ( "dt_sc_address", array (
				$this,
				"dt_sc_address"
		) );
		
		#Phone
		add_shortcode ( "dt_sc_phone", array (
				$this,
				"dt_sc_phone"
		) );

		#Mobile
		add_shortcode ( "dt_sc_mobile", array (
				$this,
				"dt_sc_mobile"
		) );
		
		#Fax
		add_shortcode ( "dt_sc_fax", array (
				$this,
				"dt_sc_fax"
		) );
		
		#Email
		add_shortcode ( "dt_sc_email", array (
				$this,
				"dt_sc_email"
		) );

		#Web
		add_shortcode ( "dt_sc_web", array (
				$this,
				"dt_sc_web"
		) );

		#Online Form
		add_shortcode ( "dt_sc_online_form", array (
				$this,
				"dt_sc_online_form"
		) );

		#Book Appointment
		add_shortcode ( "dt_sc_book_appointment", array (
				$this,
				"dt_sc_book_appointment"
		) );
		
		/* Contact Information End */
		
		/* Donutchart Start */
		add_shortcode ( "dt_sc_donutchart_small", array ( 
				$this,
				"dt_sc_donutchart"
		) );
		
		add_shortcode ( "dt_sc_donutchart_medium", array ( 
				$this,
				"dt_sc_donutchart"
		) );

		add_shortcode ( "dt_sc_donutchart_large", array ( 
				$this,
				"dt_sc_donutchart"
		) );
		
		/* Donutchart End */
		
		/* Dividers */
		
		/* Clear Shortcode */
		add_shortcode ( "dt_sc_clear", array ( 
				$this,
				"dt_sc_clear"
		) );
		
		/* HR With Border */
		add_shortcode( "dt_sc_hr_border", array (
				$this,
				"dt_sc_hr_border"
		) );

		add_shortcode ( "dt_sc_hr_top", array (
				$this,
				"dt_sc_hr_top"
		) );

		add_shortcode ( "dt_sc_hr", array (
				$this,
				"dt_sc_dividers" 
		) );
		
		add_shortcode ( "dt_sc_hr_medium", array (
				$this,
				"dt_sc_dividers" 
		) );
		
		add_shortcode ( "dt_sc_hr_large", array (
				$this,
				"dt_sc_dividers" 
		) );
		
		add_shortcode ( "dt_sc_hr_invisible", array (
				$this,
				"dt_sc_dividers" 
		) );

		add_shortcode ( "dt_sc_hr_invisible_small", array (
				$this,
				"dt_sc_dividers" 
		) );
		
		add_shortcode ( "dt_sc_hr_invisible_medium", array (
				$this,
				"dt_sc_dividers" 
		) );
		
		add_shortcode ( "dt_sc_hr_invisible_large", array (
				$this,
				"dt_sc_dividers" 
		) );
		/* Dividers End */
		
		/* Icon Boxes Shortcode */
		add_shortcode ( "dt_sc_icon_box", array (
				$this,
				"dt_sc_icon_box" 
		) );
		/* Icon Boxes Shortcode End*/

		/* Icon Boxes Shortcode */
		add_shortcode ( "dt_sc_icon_box_colored", array (
				$this,
				"dt_sc_icon_box_colored" 
		) );
		/* Icon Boxes Shortcode End*/
		
		/* Dropcap Shortcode */
		add_shortcode ( "dt_sc_dropcap", array (
				$this,
				"dt_sc_dropcap" 
		) );
		
		/* Code Shortcode */
		add_shortcode ( "dt_sc_code", array (
				$this,
				"dt_sc_code" 
		) );

		/* Ordered List Shortcode */
		add_shortcode ( "dt_sc_fancy_ol", array (
				$this,
				"dt_sc_fancy_ol" 
		) );
		
		/* Unordered List Shortcode */
		add_shortcode ( "dt_sc_fancy_ul", array (
				$this,
				"dt_sc_fancy_ul" 
		) );

		/* Manual List Shortcode */
		add_shortcode ( "dt_sc_manual_list", array (
				$this,
				"dt_sc_manual_list" 
		) );

		/* Manual List = Add Shortcode [box] Shortcode */
		add_shortcode ( "dt_sc_box", array (
				$this,
				"dt_sc_box" 
		) );


		/* Pricing Table */
		add_shortcode ( "dt_sc_pricing_table", array (
				$this,
				"dt_sc_pricing_table" 
		) );

		/* Pricing Table Item */
		add_shortcode ( "dt_sc_pricing_table_item", array (
				$this,
				"dt_sc_pricing_table_item" 
		) );

		/* Progress Bar Shortcode */
		add_shortcode ( "dt_sc_progressbar", array (
				$this,
				"dt_sc_progressbar" 
		) );

		/* Tabs */
		add_shortcode ( "dt_sc_tab", array (
				$this,
				"dt_sc_tab" 
		) );

		add_shortcode ( "dt_sc_tabs_horizontal", array (
				$this,
				"dt_sc_tabs_horizontal" 
		) );

		add_shortcode ( "dt_sc_tabs_vertical", array (
				$this,
				"dt_sc_tabs_vertical" 
		) );

		/* Team Shortcode */
		add_shortcode ( "dt_sc_team", array (
				$this,
				"dt_sc_team" 
		) );

		/* Testimonial Shortcode */
		add_shortcode ( "dt_sc_testimonial", array (
				$this,
				"dt_sc_testimonial" 
		) );
		
		/* Testimonial Carousel Shortcode */
		add_shortcode ( "dt_sc_testimonial_carousel", array (
				$this,
				"dt_sc_testimonial_carousel"
		) );

		/* Toggle Shortcode */
		add_shortcode ( "dt_sc_toggle", array (
				$this,
				"dt_sc_toggle" 
		) );

		/* Toogle Framed Shortcode */
		add_shortcode ( "dt_sc_toggle_framed", array (
				$this,
				"dt_sc_toggle_framed" 
		) );
		
		/* Titles Box Shortcode */
		add_shortcode ( "dt_sc_titled_box", array (
				$this,
				"dt_sc_titled_box" 
		) );
		
		/* Tooltip Shortcode */
		add_shortcode ( "dt_sc_tooltip", array (
				$this,
				"dt_sc_tooltip"
		) );
		
		/* PullQuotes Shortcode */
		add_shortcode ( "dt_sc_pullquote", array (
				$this,
				"dt_sc_pullquote" 
		) );

		/* Portfolio Shortcode */
		add_shortcode ( "dt_sc_three_columns_portfolio", array (
				$this,
				"dt_sc_portfolio" 
		) );

		add_shortcode ( "dt_sc_four_columns_portfolio", array (
				$this,
				"dt_sc_portfolio" 
		) );

		add_shortcode ( "dt_sc_infographic_bar", array (
				$this,
				"dt_sc_infographic_bar" 
		) );

		/* Page Builder Utils */
		add_shortcode ( "dt_sc_doshortcode", array ( $this, "dt_sc_doshortcode" ) );		
		
		/* Resizeable Column */
		add_shortcode ( "dt_sc_resizable", array ( $this, "dt_sc_resizable" ) );

		add_shortcode ( "dt_sc_resizable_inner", array ( $this, "dt_sc_resizable" ) );
		
		add_shortcode ( "dt_sc_widgets", array ( $this, "dt_sc_widgets" ) );
		/* Page Builder Utils */
	}
	
	/**
	 *
	 * @param string $content        	
	 * @return string
	 */
	function dtShortcodeHelper($content = null) {
		$content = do_shortcode ( shortcode_unautop ( $content ) );
		$content = preg_replace ( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		$content = preg_replace ( '#<br \/>#', '', $content );
		return trim ( $content );
	}
	
	/**
	 *
	 * @param string $dir        	
	 * @return multitype:
	 */
	function dtListImages($dir = null) {
		$images = array ();
		$icon_types = array (
				'jpg',
				'jpeg',
				'gif',
				'png' 
		);
		
		if (is_dir ( $dir )) {
			$handle = opendir ( $dir );
			while ( false !== ($dirname = readdir ( $handle )) ) {
				
				if ($dirname != "." && $dirname != "..") {
					$parts = explode ( '.', $dirname );
					$ext = strtolower ( $parts [count ( $parts ) - 1] );
					
					if (in_array ( $ext, $icon_types )) {
						$option = $parts [count ( $parts ) - 2];
						$images [$dirname] = str_replace ( ' ', '', $option );
					}
				}
			}
			closedir ( $handle );
		}
		
		return $images;
	}
	
	
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_accordion_group($attrs, $content = null) {
		$out = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$out = str_replace ( "<h5 class='dt-sc-toggle", "<h5 class='dt-sc-toggle-accordion ", $out );
		$out = "<div class='dt-sc-toggle-frame-set'>{$out}</div>";
		return $out;
	}


	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_button($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'size' => '',
				'link' => '#',
				'target' => '',
				'variation' => '',
				'bgcolor' => '',
				'textcolor' => '',
				'class' =>''
		), $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		$size = ($size == 'xlarge') ? ' xlarge' : $size;
		$size = ($size == 'large') ? ' large' : $size;
		$size = ($size == 'medium') ? ' medium' : $size;
		$size = ($size == 'small') ? ' small' : $size;
		
		$target = empty($target) ? 'target="_blank"' : "target='{$target}' ";
		
		$variation = (($variation) && (empty ( $bgcolor ))) ? ' ' . $variation : '';
		
		$styles = array ();
		if ($bgcolor)
			$styles [] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
		if ($textcolor)
			$styles [] = 'color:' . $textcolor . ';';
		$style = join ( '', array_unique ( $styles ) );
		$style = ! empty ( $style ) ? ' style="' . $style . '"' : '';
		
		$link = esc_url ( $link );
		
		$out = "<a href='{$link}' {$target} class='dt-sc-button {$class} {$size} {$variation}' {$style}>{$content}</a>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_blockquote($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => "type1",	
				'align' => '',
				'variation' => '',
				'textcolor' => '',
				'cite'=> ''		
		), $attrs ) );
		
		$class = array();
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
		if( $variation)
			$class[] = ' ' . $variation;
		
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = strip_tags($content);
		$content = ! empty ( $content ) ? "<q>{$content}</q>" : "";
		
		$cite = ! empty ( $cite ) ? ' <cite>&ndash; ' . $cite . '</cite>' : "";
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
		$class = join( '', array_unique( $class ) );

		$out = "<blockquote class='{$type} {$class}' {$style}><q>{$content}</q> {$cite}</blockquote>";
		return $out;
	}


	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_callout_box($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => "type1",
				'link' => '#',
				'button_text'=> __('Purchase Now','dt_themes'),
				'class' => '',
				'target' => ''
		), $attrs ) );

		$attribute = " class='dt-sc-callout-box {$type} {$class}' ";
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		$out = "<div {$attribute}>";
		$out .= ( !empty( $title ) ) ? "<h2>{$title}</h2>" : "";
		if( $type === "type1" ) {
			$out .= $content;
			
		}else{
			$out .= '<div class="column dt-sc-four-fifth first">';
			$out .= $content;
			$out .= '</div>';
			
			$out .= '<div class="column dt-sc-one-fifth">';
			$out .= ( !empty($link) ) ? "<a href='{$link}' class='dt-sc-button medium' target='{$target}'>{$button_text}</a>" : "";
			$out .= '</div>';			
		}
		$out .= "</div>";
		
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @param string $shortcodename        	
	 * @return string
	 */
	function dt_sc_columns($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'id' => '',
				'class' => '',
				'style' => '' ,
				'type' => ''
		), $attrs ) );
		
		$shortcodename = str_replace ( "_", "-", $shortcodename );
		$id = ($id != '') ? " id = '{$id}'" : '';
		$style = !empty( $style ) ? " style='{$style}' ": "";
		
		if( trim($type) == 'type2' ):
			$type = "no-space";
		elseif( trim($type) == 'type1'):
			$type = "space";
		else:
			$type = "";
		endif;	


		$first = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'first' )) ? 'first' : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$out = "<div {$id} class='column {$shortcodename} {$class} {$type} {$first}' {$style}>{$content}</div>";
		return $out;
	}

	function dt_sc_title( $attrs,$content = null , $shortcodename = "" ){
		extract ( shortcode_atts ( array ( 'class' => '' ), $attrs ) );

		$shortcodename = str_replace ( "dt_sc_", "", $shortcodename );
		$out = "<{$shortcodename} class='{$class}'>";
		$out .= DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$out .= "</{$shortcodename}>";
		return $out;	
	}

	/* Contact Information */
	
	/**
	 * Shortcode : Address
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	 function dt_sc_address($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'line1' => '',
				'line2' => '',
				'line3' => '',
				'line4' => ''
		), $attrs ) );
		
		
		$out = '<p class="dt-sc-contact-info address">';
		$out .= "<i class='fa fa-rocket'></i>";
		$out .= "<span>";
		$out .= ( !empty($line1) ) ? $line1 : "";
		$out .= ( !empty($line2) ) ? "<br>$line2" : "";
		$out .= ( !empty($line3) ) ? "<br>$line3" : "";
		$out .= ( !empty($line4) ) ? "<br>$line4" : "";
		$out .= "</span>";
		$out .= '</p>';
		
		return $out;
	 }

	/**
	 * Shortcode : Phone
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	 function dt_sc_phone($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'phone' => ''
		), $attrs ) );

		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i class='fa fa-phone'></i>";
		$out .= __('Phone : ','dt_themes');
		$out .= ( !empty($phone) ) ?"<span>{$phone}</span>": "";
		$out .= '</p>';
		
		return $out;
	 }
	 
	/**
	 * Shortcode : Mobile
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	 function dt_sc_mobile($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'mobile' => ''
		), $attrs ) );

		
		
		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i  class='fa fa-mobile-phone'></i>";
		$out .= __('Mobile : ','dt_themes');
		$out .= ( !empty($mobile) ) ?"<span>{$mobile}</span>": "";
		$out .= '</p>';
		
		return $out;
	 }

	/**
	 * Shortcode : Fax
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	 function dt_sc_fax($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'fax' => ''
		), $attrs ) );

		$attribute = "  ";

		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i class='fa fa-fax'></i>";
		$out .= __('Fax : ','dt_themes');
		$out .= ( !empty($fax) ) ? "<span>{$fax}</span>" : "";
		$out .= '</p>';
		
		return $out;
	 }

	/**
	 * Shortcode : Email id
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	 function dt_sc_email($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'emailid' => ''
		), $attrs ) );

		$attribute = "  ";

		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i class='fa fa-envelope-o'></i>";
		$out .= __('Email : ','dt_themes');
		$out .= ( !empty($emailid) ) ? "<a href='mailto:$emailid'>{$emailid}</a>" : "";
		$out .= '</p>';
		
		return $out;
	 }

	/**
	 * Shortcode : Website Url
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	 function dt_sc_web($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'url' => ''
		), $attrs ) );
		
		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i class='fa fa-globe' ></i>";
		$out .= __('Web : ','dt_themes');
		if( !empty( $url ) ) {
			$out .= "<a target='_blank' href='{$url}'>";
			$a = preg_replace('#^[^:/.]*[:/]+#i', '',urldecode( $url ));
			$out .=	preg_replace('!\bwww3?\..*?\b!', '', $a);
			$out .= "</a>";
		}
		$out .= '</p>';
		
		return $out;
	 }

	/**
	 * Shortcode : Website Online Form  Url
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	 function dt_sc_online_form($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'url' => ''
		), $attrs ) );

		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i class='fa fa-pencil'></i>";
		$out .= __('Online Form : ','dt_themes');
		if( !empty( $url ) ) {
			$out .= "<a href='{$url}'>".__("Fill out this form")."</a>";
		}
		$out .= '</p>';
		
		return $out;
	 }


	/* Book Appointment Section */
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_book_appointment($attrs, $content = null) {
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		return '<div class="dt-sc-appointment">'.$content.'</div>';
	}
	 
	 

	/* Contact Information End*/
	
	/* Dividers */
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_clear($attrs, $content = null) {
		return '<div class="dt-sc-clear"></div>';
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_hr_border($attrs, $content = null) {
		return '<div class="dt-sc-hr-border"></div>';
	}


	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @param string $shortcodename        	
	 * @return string
	 */
	function dt_sc_donutchart($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'title' => '',
				'bgcolor' => '',
				'fgcolor' => '',
				'percent' =>'30'
		), $attrs ) );
		
		$size = "100";
		$size = ( "dt_sc_donutchart_medium" === $shortcodename ) ? "200" : $size;
		$size = ( "dt_sc_donutchart_large" === $shortcodename ) ? "300" : $size;
		
		$shortcodename = str_replace ( "_", "-", $shortcodename );
		$out = "<div class='{$shortcodename}'>";
		$out .= "<div class='dt-sc-donutchart' data-size='{$size}' data-percent='{$percent}' data-bgcolor='{$bgcolor}' data-fgcolor='$fgcolor'></div>";
		$out .= ( empty($title) ) ? $out : "<h5 class='dt-sc-donutchart-title'>{$title}</h5>";
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @param string $shortcodename        	
	 * @return string
	 */
	function dt_sc_dividers($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'class' => '',
				'top' => '' 
		), $attrs ) );
		
		if ("dt_sc_hr" === $shortcodename || "dt_sc_hr_medium" === $shortcodename || "dt_sc_hr_large" === $shortcodename) {
			
			$shortcodename = str_replace ( "_", "-", $shortcodename );
			
			$out = "<div class='{$shortcodename} {$class}'>";
			
			if ((isset ( $attrs [0] ) && trim ( $attrs [0] == 'top' ))) {
				
				$out = "<div class='{$shortcodename} top {$class}'>";
				$out .= "<a href='#top' class='scrollTop'><span class='fa fa-angle-up'></span>" . __ ( "top", 'dt_themes' ) . "</a>";
			}
			
			$out .= "</div>";
		} else {
			$shortcodename = str_replace ( "_", "-", $shortcodename );
			$out = "<div class='{$shortcodename}  {$class}'></div>";
		}
		return $out;
	}

	function dt_sc_hr_top($attrs, $content = null, $shortcodename="" ){
		$out = do_shortcode("[dt_sc_hr top]");
		return $out;
	}
	/* Dividers End*/
	
	/* Icon Boxes Shortcode */
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @param string $shortcodename        	
	 * @return string
	 */
	function dt_sc_icon_box($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'fontawesome_icon' => '',
				'custom_icon' => '',
				'title' => '',
				'link' => '',
				'target' => ''
		), $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		$out =  "<div class='dt-sc-ico-content {$type}'>";
		if( !empty($fontawesome_icon) && empty($custom_icon) ){
			$out .= "<div class='icon'> <span class='fa fa-{$fontawesome_icon}'> </span> </div>";
		
		}elseif( !empty($custom_icon) ){
			$out .= "<div class='icon'> <span> <img src='{$custom_icon}' alt=''/></span> </div>";	
		}
		$out .= empty( $title ) ? $out : "<h5><a href='{$link}' target='{$target}'> {$title} </a></h5>";
		$out .= $content;
		$out .= "</div>";
		return $out;
	}
	/* Icon Boxes Shortcode End*/

	/* Icon Boxes Colored Shortcode */
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @param string $shortcodename        	
	 * @return string
	 */
	function dt_sc_icon_box_colored($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'fontawesome_icon' => '',
				'custom_icon' => '',
				'title' => '',
				'bgcolor' => ''
		), $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		$bgcolor = empty ( $bgcolor ) ? "" : " style='background:{$bgcolor};' ";
		
		$type = ( trim($type) === 'type1' ) ? "no-space" : "space";
		
		$out =  "<div class='dt-sc-colored-box {$type}' {$bgcolor}>";
		
		$icon = "";
		if( !empty($fontawesome_icon) ){
			$icon = "<span class='fa fa-{$fontawesome_icon}'> </span>";
		
		}elseif( !empty($custom_icon) ){
			$icon = "<img src='{$custom_icon}' alt=''/>";	
		}
		
		$out .= "<h5>{$icon}{$title}</h5>";
		$out .= $content;
		$out .= "</div>";
		return $out;
	}
	/* Icon Boxes Colored Shortcode End*/


	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @param string $shortcodename        	
	 * @return string
	 */
	function dt_sc_dropcap($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'variation' => '',
				'bgcolor' => '',
				'textcolor' => '' 
		), $attrs ) );
		
		$type = str_replace ( " ", "-", $type );
		$type = "dt-sc-dropcap-".strtolower ( $type );
		
		$bgcolor = ( $type == 'dt-sc-dropcap-default') ? "" : $bgcolor;
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . $variation : '';
		
		$styles = array();
		if($bgcolor) $styles[] = 'background-color:' . $bgcolor . ';';
		if($textcolor) $styles[] = 'color:' . $textcolor . ';border-color:' . $textcolor . ';';;
		$style = join('', array_unique( $styles ) );
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		$out = "<span class='dt-sc-dropcap $type {$variation}' {$style}>{$content}</span>";
		return $out;
	}
	
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_code($attrs, $content = null) {
		$array = array (
				'[' => '&#91;',
				']' => '&#93;',
				'/' => '&#47;',
				'<' => '&#60;',
				'>' => '&#62;',
				'<br />' => '&nbsp;' 
		);
		$content = strtr ( $content, $array );
		$out = "<pre>{$content}</pre>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return mixed
	 */
	function dt_sc_fancy_ol($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'style' => '',
				'variation' => '',
				'class' => '' 
		), $attrs ) );
		
		$style = ($style) ? trim ( $style ) : 'decimal';
		$class = ($class) ? trim ( $class ) : '';
		$variation = ($variation) ? ' ' . trim ( $variation ) : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace ( '<ol>', "<ol class='dt-sc-fancy-list {$variation} {$class} {$style}'>", $content );
		$content = str_replace ( '<li>', '<li><span>', $content );
		$content = str_replace ( '</li>', '</span></li>', $content );
		return $content;
	}
	
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return mixed
	 */
	function dt_sc_fancy_ul($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'style' => '',
				'variation' => '',
				'class' => '' 
		), $attrs ) );
		$style = ($style) ? trim ( $style ) : 'decimal';
		$class = ($class) ? trim ( $class ) : '';
		$variation = ($variation) ? ' ' . trim ( $variation ) : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace ( '<ul>', "<ul class='dt-sc-fancy-list {$variation} {$class} {$style}'>", $content );
		return $content;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return mixed
	 */
	function dt_sc_manual_list($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => 'type1'
		), $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		if( $type === "type1"){
			$content = str_replace ( '<ul>', "<ul class='dt-sc-numbered-list'>", $content );
		}else{
			$content = str_replace ( '<ul>', "<ul class='dt-sc-numbered-list-type2'>", $content );
		}
		return $content;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return mixed
	 */
	function dt_sc_box($attrs, $content = null) {
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		return "<span>$content</span>";
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_pricing_table($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => 'type1' 
		), $attrs ) );
		
		$type = ( trim($type) === 'type1' ) ? "no-space" : "space";
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		return "<div class='dt-sc-pricing-table {$type}'>" . $content . '</div>';
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_pricing_table_item($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'heading' => __ ( "Heading", 'dt_themes' ),
				'per' => 'month',
				'price' => '',
				"button_link" => "#",
				"button_text" => __ ( "Buy Now", 'dt_themes' ),
				"button_size" => "small" 
		), $attrs ) );
		
		$selected = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'selected' )) ? 'selected' : '';
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace ( '<ul>', '<ul class="dt-sc-tb-content">', $content );
		$content = str_replace ( '<ol>', '<ul class="dt-sc-tb-content">', $content );
		$content = str_replace ( '</ol>', '</ul>', $content );
		$price = ! empty ( $price ) ? "<div class='dt-sc-price'> $price <span> $per</span> </div>" : "";
		
		$out = "<div class='dt-sc-pr-tb-col $selected'>";
		$out .= '	<div class="dt-sc-tb-header">';
		$out .= '		<div class="dt-sc-tb-title">';
		$out .= "			<h5>$heading</h5>";
		$out .= '		</div>';
		$out .= $price;
		$out .= '	</div>';
		$out .= $content;
		$out .= '<div class="dt-sc-buy-now">';
		$out .= do_shortcode ( "[dt_sc_button size='$button_size' link='$button_link']" . $button_text . "[/dt_sc_button]" );
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_progressbar($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type' => 'standard',
				'color' => '',
				'value' => '55',
				'textcolor' => '' 
		), $attrs ) );
		
		
		if( $type === 'standard' ){
			$type = "dt-sc-standard";
		}elseif( $type === 'progress-striped' ){
			$type = "dt-sc-progress-striped";
		}elseif( $type === 'progress-striped-active' ){
			$type = "dt-sc-progress-striped active";
		}

		
		$color = ! empty ( $color ) ? "style='background-color:$color;'" : "";
		$textcolor = ! empty ( $textcolor ) ? " style='color:{$textcolor}'" : "";
		
		$value_in_percentage = "<span>$value%</span>";
		$value = "data-value='$value'";
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = $content . $value_in_percentage;
		
		$out = "<div class='dt-sc-progress $type'>";
		$out .= "<div class='dt-sc-bar' $color $value>";
		$out .= "<div class='dt-sc-bar-text' {$textcolor}>$content</div>";
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}
	
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_tab($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => '' 
		), $attrs ) );
		$out = '<li class="tab_head"><a href="#">' . $title . '</a></li><div class="tabs_content">' . DTCoreShortcodesDefination::dtShortcodeHelper ( $content ) . '</div>';
		return $out;
	}
	
	
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_tabs_horizontal($attrs, $content = null) {
		$out = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$E = $C = "";
		
		preg_match_all ( "'<li class=\"tab_head\">(.*?)</li>'si", $out, $match );
		foreach ( $match [0] as $val ) {
			$val = str_replace ( '<li class="tab_head">', '<li>', $val );
			$E .= $val;
		}
		preg_match_all ( "'<div class=\"tabs_content\">(.*?)</div>'si", $out, $match );
		foreach ( $match [0] as $val ) {
			$val = str_replace ( '<div class="tabs_content">', '<div class="dt-sc-tabs-frame-content">', $val );
			$C .= $val;
		}
		$out = '<div class="dt-sc-tabs-container">' . '<ul class="dt-sc-tabs-frame">' . $E . '</ul>' . $C . '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_tabs_vertical($attrs, $content = null) {
		$out = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$E = $C = "";
		
		preg_match_all ( "'<li class=\"tab_head\">(.*?)</li>'si", $out, $match );
		foreach ( $match [0] as $val ) {
			$val = str_replace ( '<li class="tab_head">', '<li>', $val );
			$val = str_replace ( '</a></li>', '<span></span></a></li>', $val );
			$E .= $val;
		}
		preg_match_all ( "'<div class=\"tabs_content\">(.*?)</div>'si", $out, $match );
		foreach ( $match [0] as $val ) {
			$val = str_replace ( '<div class="tabs_content">', '<div class="dt-sc-tabs-vertical-frame-content">', $val );
			$C .= $val;
		}
		$out = "<ul class='dt-sc-tabs-vertical-frame'>$E</ul>";
		$out = "<div class='dt-sc-tabs-vertical-container'>$out" . "$C</div>";
		return $out;
	}

	/**
	 *
	 * @param unknown $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_team($attrs, $content = null) {
		$dir_path = plugin_dir_path ( __FILE__ ) . "images/sociables/";
		$sociables_icons = DTCoreShortcodesDefination::dtListImages ( $dir_path );
		
		$sociables = array_values ( $sociables_icons );
		$attributes = array (
				'name' => '',
				'image' => 'http://placehold.it/300',
				'role' => '',
				'degree' => '',
				'email' => '',
				'alt' => __('Please specify image url','dt_themes'),
				'title' => __('Please specify image url','dt_themes')
		);
		
		foreach ( $sociables as $sociable ) {
			$attributes [$sociable] = '';
		}
		
		extract ( shortcode_atts ( $attributes, $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		$image = "<img src='{$image}' alt='{$alt}' title='{$title}' />";
		
		$name = empty ( $name ) ? "" : $name;
		$name = empty ( $degree ) ? $name : "{$name}, <span>{$degree}</span>";
		$name = empty ( $name ) ? "" : "<h4><i class='fa fa-user-md'> </i>{$name}</h4>";
		
		$role = empty ( $role ) ? "" : "<h6>{$role}</h6>";
		
		$email =  empty ( $email ) ? "" : "<p class='email'>".__('Email : ','dt_themes')."<a href='mailto:{$email}'>{$email}</a></p>";
		
		$s = "";
		$path = plugin_dir_url ( __FILE__ ) . "images/sociables/";
		foreach ( $sociables as $sociable ) {
			$img = array_search ( $sociable, $sociables_icons );
			$class = explode(".",$img);
			$class = $class[0];
			$s .= empty ( $$sociable ) ? "" : "<li class='{$class}'><a href='{$$sociable}' target='_blank'> <img src='{$path}hover/{$img}' alt='{$sociable}'/>  <img src='{$path}{$img}' alt='{$sociable}'/> </a></li>";
		}
		
		$s = ! empty ( $s ) ? "<div class='dt-sc-social-icons'><ul>$s</ul></div>" : "";
		
		
		$class = "dt-sc-team ";
		
		$out = "<div class='{$class}'>";
		$out .= "	<div class='image'>{$image}</div>";
		$out .= '	<div class="team-details">';
		$out .= $name.$content.$role.$email.$s;
		$out .= '	</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_testimonial($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'name' => '',
				'role' => '',
				'image' => 'http://placehold.it/300'
		), $attrs ) );
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = ! empty ( $content ) ? "<q>{$content}</q>" : "";
		$name = ! empty ( $name ) ? " {$name} " : "";
		$role = ! empty ( $role ) ? "<span> , {$role}</span>" : "";
		
		$content = (! empty ( $content ) ) ? '<blockquote>"'.$content.'"</blockquote>' : "";
		$content.= "<cite> - $name$role</cite>";
		
		$image = "<img src='{$image}' alt='{$role}' title='{$name}' />";
		$image = "<div class='author'>{$image}</div>";

		
		return "<div class='dt-sc-testimonial'>$image$content</div>";
	}
	
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_testimonial_carousel($attrs, $content = null) {
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = str_replace( '<ul>', "<ul class='dt-sc-testimonial-carousel'>", $content );
		
		
		$out = '<div class="dt-sc-testimonial-carousel-wrapper">';
		$out .= $content;
		$out .= '<div class="carousel-arrows">';
		$out .= '	<a href="" class="testimonial-prev"> <span class="fa fa-caret-left"> </span> </a>';
		$out .= '	<a href="" class="testimonial-next">  <span class="fa fa-caret-right"> </span> </a>';
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}
	
	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_toggle($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => '' 
		), $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		#$content = strip_tags($content);


		$out = "<h5 class='dt-sc-toggle'><a href='#'>{$title}</a></h5>";
		$out .= '<div class="dt-sc-toggle-content" style="display: none;">';
		$out .= '<div class="block">';
		$out .= $content;
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_toggle_framed($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => '' 
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		#$content = strip_tags($content);
		
		$out = '<div class="dt-sc-toggle-frame">';
		$out .= "	<h5 class='dt-sc-toggle'><a href='#'>{$title}</a></h5>";
		$out .= '	<div class="dt-sc-toggle-content" style="display: none;">';
		$out .= '		<div class="block">';
		$out .=  $content;
		$out .= '		</div>';
		$out .= '	</div>';
		$out .= '</div>';
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_titled_box($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => '',
				'icon' => '',
				'type'	=> '',
				'variation' => '',
				'bgcolor' => '',
				'textcolor' => '' 
		), $attrs ) );
		
		$type = (empty($type)) ? 'dt-sc-titled-box' :"dt-sc-$type";
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . $variation : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper( $content );
		#$content = strip_tags($content);
		
		$styles = array();
		if($bgcolor) $styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
		if($textcolor) $styles[] = 'color:' . $textcolor . ';';
		$style = join('', array_unique( $styles ) );
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;
		
		if($type == 'dt-sc-titled-box') :
			$icon = ( empty($icon) ) ? "" : "<span class='fa {$icon} '></span>";
			$title = "<h6 class='{$type}-title' {$style}> {$icon} {$title}</h6>";
			$out = "<div class='{$type} {$variation}'>";
			$out .= $title;
			$out .=	"<div class='{$type}-content'>{$content}</div>";
			$out .= "</div>";
		else :
			$out = "<div class='{$type}'>{$content}</div>";
		endif;
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_tooltip($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type'	=> 'default',
				'tooltip' => '',
				'position' => 'top',
				'href' => '',
				'target' => '',
				'bgcolor' => '',
				'textcolor' => '' 
		), $attrs ) );
		
		$class  = "class=' ";
		$class .=  ( $type == "boxed" ) ? "dt-sc-boxed-tooltip" : "";
		$class .= " dt-sc-tooltip-{$position}'";
		
		$href = " href='{$href}' ";
		$title = " title = '{$tooltip}' ";
		$target = empty($target) ? 'target="_blank"' : "target='{$target}' ";
		
		$styles = array();
		if($bgcolor) $styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
		if($textcolor) $styles[] = 'color:' . $textcolor . ';';
		$style = join('', array_unique( $styles ) );
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;
		$style = ( $type == "boxed" ) ? $style : "";
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper( $content );
		$out = "<a {$href} {$title} {$class} {$style} {$target}>{$content}</a>";
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_pullquote($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'type'	=> 'pullquote1',
				'align' => '',
				'icon' => '',
				'textcolor' => '',
				'cite' => ''
		), $attrs ) );
		
		$class = array();
		if( isset($type) )
			$class[] = " dt-sc-{$type}";
			
		if( trim( $icon ) == 'yes' )
			$class[] = ' quotes';

		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite .'</cite>' : '' ;
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
		$class = join( '', array_unique( $class ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$content = strip_tags($content);

		$out = "<span class='{$class}' {$style}> {$content} {$cite}</span>";
		
		return $out;
	}


	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_portfolio($attrs, $content = null, $shortcodename ="") {
		extract ( shortcode_atts ( array (
				'showposts'	=> '-1',
				'categories' => ''
		), $attrs ) );
		
		if(empty($categories)):
			$args = array(	'paged' => get_query_var( 'paged' ) ,'posts_per_page' =>$showposts  ,'post_type' => 'dt_portfolios');
		else:
			$categories = explode(",",$categories);
			$categories = array_filter($categories);
			
			$args = array(	'orderby' 	=> 'ID'
						,'order' 			=> 'ASC'
						,'paged' 			=> get_query_var( 'paged' )
						,'posts_per_page' 	=> $showposts
						,'tax_query'		=> array( array( 'taxonomy'=>'portfolio_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$categories  ) ) );	
		endif;
		
		$class = ( $shortcodename === "dt_sc_three_columns_portfolio") ? "three-columns-portfolio-carousel" : "four-columns-portfolio-carousel";
		$liclass = ( $shortcodename === "dt_sc_three_columns_portfolio") ? "dt-sc-one-third" : "dt-sc-one-fourth";
		
		$out = "";
		query_posts($args);
		if( have_posts() ):
			$out .= '	<!-- **Portfolio Carousel Wrapper** -->';
			$out .= '	<div class="portfolio-carousel-wrapper gallery">';
			$out .= '		<!-- **Portfolio Carousel** -->';
			$out .= "		<ul class='portfolio-carousel {$class}'>";
			
			while( have_posts() ):
				the_post();
				$the_id = get_the_ID();
				$title = get_the_title();
				$permalink = get_permalink( $the_id );
				
				$portfolio_item_meta = get_post_meta($the_id,'_portfolio_settings',TRUE);
				$portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();
				$items_id_exists = false;
				if(  array_key_exists('items_id',$portfolio_item_meta) ){
					$items_id_exists =  array_filter($portfolio_item_meta['items_id']);
					$items_id_exists = !empty( $items_id_exists ) ? true : false;
				}

				
				$out .= "		<li class='portfolio {$liclass}'>";
				$out .=	'			<div class="portfolio-thumb">';
									if( has_post_thumbnail() ):
										$id = get_post_thumbnail_id($the_id);
										$popup = wp_get_attachment_url( $id , 'full',true);
										$thumb = wp_get_attachment_image_src( $id , 'dt-portfolio-small');
										$image = $thumb[0];
										$out .= "<img src='{$image}' />";
									elseif( array_key_exists("items_name",$portfolio_item_meta) ):	
										$item =  $portfolio_item_meta['items_name'][0];
										$popup = $portfolio_item_meta['items'][0];
										if( "video" === $item ):
											$items = array_diff( $portfolio_item_meta['items_name'] , array("video") );
											if( !empty($items) ):
												if( $items_id_exists ):
													$id = $portfolio_item_meta['items_id'][key($items)];
													$img = wp_get_attachment_image_src($id,'dt-portfolio-small');
													$out .="<img src='".$img[0]."' width='".$img[1]."' height='".$img[2]."' alt='' />";
												else:
													$out .="<img src='".$portfolio_item_meta['items'][key($items)]."' width='1060' height='795' alt='' />";
												endif;
											else:
												$popup = "http://placehold.it/1060x713&text=Add%20Image%20%20Portfolio";
												$out .= "<img src='{$popup}'/>"; 
											endif;
										else:
											if( $items_id_exists ):
												$id = $portfolio_item_meta['items_id'][0];
												$img = wp_get_attachment_image_src($id,'dt-portfolio-small');
												$out .= "<img src='".$img[0]."' width='".$img[1]."' height='".$img[2]."' alt=''/>";
											else:
												$out .= "<img src='".$portfolio_item_meta['items'][0]."' width='1060' height='795' alt=''/>";
											endif;
										endif;
									else:
										$popup = "http://placehold.it/520x350&text=Add%20Image%20/%20Video%20%20to%20Portfolio";
										$out .= "<img src='{$popup}'/>"; 	
									endif;
										
				
				$out .= '				<div class="image-overlay">';
				$out .= "				<a href='{$popup}' data-gal='prettyPhoto[gallery]' class='zoom'> <span class='fa fa-arrows-alt'></span> </a>";
				$out .= "				<a href='{$permalink}' title='{$title}' class='link'> <span class='fa fa-external-link'> </span> </a>";				
				$out .= '				</div>';					
				$out .= '			</div>';
				
				$out .= '			<div class="portfolio-detail">';
									if(dttheme_is_plugin_active('roses-like-this/likethis.php')):
				$out .= '				<div class="views"><i class="fa fa-heart"> </i>'.generateLikeString($the_id, isset($_COOKIE["like_" . $the_id])).'</div>';
									endif;
				$out .= "			<h5><a href='{$permalink}' title='{$title}'>{$title}</a></h5>";					
									if( array_key_exists("sub-title",$portfolio_item_meta) ):
               	$out .="				<p>{$portfolio_item_meta['sub-title']}</p>";
									endif;				
				$out .= '			</div>';
				$out .= "		</li>";
			endwhile;
			
			$out .= "		</ul>";
            $out .= '      <div class="carousel-arrows">';
            $out .= '      	<a href="#" title="" class="portfolio-prev-arrow"> <span class="fa fa-caret-left"> </span> </a>';
			$out .= '			<a href="#" title="" class="portfolio-next-arrow"> <span class="fa fa-caret-right"> </span> </a>';
			$out .= '       </div>';
			$out .= '	</div>';
			
		else:
			$out .= "<p>".__("Please add few portfolio items before using this shortcode",'dt_themes')."</p>";		
		endif;
		wp_reset_query();
		
		return $out;
	}

	/**
	 *
	 * @param array $attrs        	
	 * @param string $content        	
	 * @return string
	 */
	function dt_sc_infographic_bar($attrs, $content = null, $shortcodename ="") {
		extract ( shortcode_atts ( array (
				'type' => 'standard',
				'icon' =>'',
				'icon_size'=>'150',
				'color' => '',
				'value' => '55'
		), $attrs ) );

		if( $type === 'standard' ){
			$type = "dt-sc-standard";
		}elseif( $type === 'progress-striped' ){
			$type = "dt-sc-progress-striped";
		}elseif( $type === 'progress-striped-active' ){
			$type = "dt-sc-progress-striped active";
		}
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		
		$out = '<div class="dt-sc-infographic-bar">';
		
		if( !empty($icon) ){
		$out .= "<i class='fa {$icon}' style='font-size:{$icon_size}px; color:{$color};'> </i>";
		}
		$out .= '	<div class="info">';
		
		$out .= "		<div class='dt-sc-progress $type'>";
		$out .= "		 <div data-value={$value} style='background-color:{$color};' class='dt-sc-bar'></div>";
		$out .= '		</div>';
		
		$out .= "		<div class='dt-sc-bar-percentage'> <span> {$value}%  </span> </div>";
		$out .= "		<div class='dt-sc-bar-text'>$content</div>";
		$out .= '	</div>';
		
		$out .= '</div>';
		
		return $out;
	}

	function dt_sc_doshortcode($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'width' => '100',
				'animation' => '',
				'animation_delay' => ''
		), $attrs ) );

		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );

		$danimation = !empty( $animation ) ? " data-animation='{$animation}' ": "";
		$ddelay = ( !empty( $animation ) && !empty( $animation_delay )) ? " data-delay='{$animation_delay}' " : "";
		$danimate = !empty( $animation ) ? "animate": "";

		$first = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'first' )) ? 'first' : '';

		$out = '<div class="column '.$danimate.' '.$first.'" style="width:'.$width.'%;" '.$danimation.' '.$ddelay.'>';
		$cont = do_shortcode($content);
		if(isset($cont))
			$out .= $cont;
		else
			$out .= $content;
		$out .= '</div>';
		return $out;
	}

	function dt_sc_resizable($attrs, $content = null) {		
		extract ( shortcode_atts ( array (
				'width' => '',
				'class' => '',
				'animation' => '',
				'animation_delay' => ''
		), $attrs ) );

		$danimation = !empty( $animation ) ? " data-animation='{$animation}' ": "";
		$ddelay = (!empty( $animation ) && !empty( $animation_delay )) ? " data-delay='{$animation_delay}' " : "";
		$danimate = !empty( $animation ) ? "animate": "";

		$style = (!empty( $width ) ) ? ' style="width:'.$width.'%;" ' : "";
	
		$first = (isset ( $attrs [0] ) && trim ( $attrs [0] == 'first' )) ? 'first' : '';
		$content = do_shortcode(DTCoreShortcodesDefination::dtShortcodeHelper ( $content ));
		$out = "<div class='column {$class} {$danimate} {$first}' {$danimation} {$ddelay} {$style}>{$content}</div>";
		return $out;
	}

	function dt_sc_widgets($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'widget_name' => '',
				'widget_wpname' => '',
				'widget_wpid' => ''
		), $attrs ) );
		
		if($widget_name != ''):	
			
			foreach($attrs as $key=>$value):
				$instance[$key] = $value;			
			endforeach;
			
			$instance = array_filter($instance);
			
			if(($widget_name == 'TribeEventsAdvancedListWidget' || $widget_name == 'TribeEventsMiniCalendarWidget') && isset($instance['selector'])) {
				$instance['filters'] = '{"tribe_events_cat":["'.$instance['selector'].'"]}';
			}
			
			if(substr($widget_name, 0, 2) == 'WC') $add_cls = 'woocommerce';
			else $add_cls = '';
			
			ob_start();
			the_widget($widget_name, $instance, 'before_widget=<aside id="'.$widget_wpid.'" class="widget '.$add_cls.' '.$widget_wpname.'">&after_widget=</aside>&before_title=<h3 class="widgettitle">&after_title=<span></span></h3>&widget_id='.$instance['widget_wpid']);
			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
							
		endif;

	}
}
new DTCoreShortcodesDefination ();
?>