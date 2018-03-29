<?php 
	add_action('wp_head','ebor_custom_colours', 100);
	function ebor_custom_colours(){
	
	$background_image = get_option('select_background','none');
	$footer_background_image = get_option('footer_select_background','none');
	$highlight = get_option('highlight_colour','#1abb9c');
	$highlight_hover = get_option('highlight_hover_colour','#17a78b');
	$footer_background = get_option('footer_colour','#222222');
	$header_background = get_option('header_colour','#f5f5f5');
	$wrapper_dark = get_option('wrapper_background_dark', '#f3f3f3');
	$text_colour = get_option('text_colour','#6c6c6c');
	$meta_colour = get_option('meta_colour','#a8a8a8');
	$headings_colour = get_option('heading_text_colour','#4e4e4e');
	$header_height = get_option('header_padding','110');
	$nav_margin = get_option('nav_margin','0');
	$highlightrgb = hex2rgb( get_option('overlay_background','#000000') );
	$header_padding = get_option( 'header_offset', '35' );
	$nav_colour = get_option('nav_colour','#4e4e4e');
	$gallery_height = get_option('gallery_height','600');
	$custom_header_background = get_option('custom_header_background');
	$custom_footer_background = get_option('custom_footer_background');
?>
	
<style type="text/css">
		
		#header.navbar {
		<?php if( $custom_header_background ) : ?>
			background-image: url(<?php echo $custom_header_background; ?>);
		<?php elseif(!( $background_image == 'none' )) : ?>
			background-image: url(<?php echo $background_image; ?>);
		<?php else : ?>
			background-image: none;
		<?php endif; ?>
			background-color: <?php echo $header_background; ?>;
		}
		
		.black-wrapper {
		<?php if( $custom_footer_background ) : ?>
			background-image: url(<?php echo $custom_footer_background; ?>);
		<?php elseif(!( $footer_background_image == 'none' )) : ?>
			background-image: url(<?php echo $footer_background_image; ?>);
		<?php else : ?>
			background-image: none;
		<?php endif; ?>
			background-color: <?php echo $footer_background; ?>;
		}

		body, .black-wrapper h1,
		.black-wrapper h2,
		.black-wrapper h3,
		.black-wrapper h4,
		.black-wrapper h5,
		.black-wrapper h6, 
		i.contact, 
		.widget .post-list li em, 
		.social li a i, 
		.item-details li a, 
		.sidebox a,
		.header-style.icons .pull-left a  {
			color: <?php echo $text_colour; ?>;
		}
		
		.details h4 span, .lead, .meta,
		.more-link, .meta a,
		.more-link, .tp-caption.lite, .sidebox .post-list .meta em {
			color: <?php echo $meta_colour; ?>;
		}

		.dark-wrapper {
			background: <?php echo $wrapper_dark; ?>;
		}
		
		.light-wrapper, .navcoverpage, .navfake {
			background: #<?php echo get_background_color(); ?>;
		}
		
		a,
		.header-style.icons .pull-left a:hover,
		.post-title a:hover,
		ul.bullet li:before,
		.meta a:hover,
		.more:hover,
		blockquote small,
		i.large, a.cart-contents:hover, 
		.dropdowncarttrigger:hover, 
		.dropdowncarttrigger.active, 
		.dropdowncartcontents .dropdowncartproduct a:hover,
		.black-wrapper a:hover,
		#header.navbar .nav > .active > a,
		#header.navbar .nav > .active > a:hover,
		#header.navbar .nav > .active > a:focus,
		#header.navbar .nav > li > a:hover  {
		    color: <?php echo $highlight; ?>
		}
		.btn,
		.btn-group > .btn,
		.parallax .btn,
		.load-more li a,
		.button, .woocommerce .widget_shopping_cart .total, .woocommerce-page .widget_shopping_cart .total,
		.btn, .btn-group > .btn, .parallax .btn, #submit, .woocommerce-info, .woocommerce-message, button, .button, .added_to_cart, input[type="submit"],
		#header.navbar .nav li.dropdown.open > .dropdown-toggle,
		#header.navbar .nav li.dropdown.active > .dropdown-toggle,
		#header.navbar .nav li.dropdown.open.active > .dropdown-toggle {
		    background: <?php echo $highlight; ?>;
		}
		.btn:hover,
		.btn:focus,
		.btn:active,
		.btn.active,
		.pagination ul > li > a:hover,
		.pagination ul > li > a:focus,
		.pagination ul > .active > a,
		.pagination ul > .active > span,
		.load-more li a:hover,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, .dropdowncartcontents p.total, .woocommerce span.onsale, .woocommerce-page span.onsale, .button:hover,
		.btn:hover, .btn:focus, .btn:active, .btn.active, #submit:hover, input[type="submit"]:hover, .button:hover {
		    background: <?php echo $highlight_hover; ?>;
		}
		.sb-navigation-left:hover,
		.sb-navigation-right:hover,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .added_to_cart:hover {
		    background: <?php echo $highlight_hover; ?> !important;
		}
		#header .dropdown-menu > li > a:hover,
		#header .dropdown-menu > li > a:focus,
		#header .dropdown-submenu:hover > a,
		#header .dropdown-submenu:focus > a,
		#header .dropdown-menu > .active > a,
		#header .dropdown-menu > .active > a:hover,
		#header .dropdown-menu > .active > a:focus,
		.tp-caption .color {
		    color: <?php echo $highlight; ?>;
		}
		.sb-navigation-left:hover,
		.sb-navigation-right:hover {
		    background: <?php echo $highlight; ?>;
		}
		.item-details li a:hover {
		    color: <?php echo $highlight; ?>
		}
		.sidebox a:hover {
		    color: <?php echo $highlight; ?>
		}
		.pagination ul > li > a,
		.pagination ul > li > span {
		    background: <?php echo $highlight; ?>;
		}
		#comments .info h2 a:hover {
		    color: <?php echo $highlight; ?>
		}
		#comments a.reply-link:hover {
		    color: <?php echo $highlight; ?>
		}
		.tab a.active,
		.tab a:hover {
		    color: <?php echo $highlight; ?>
		}
		#testimonials .author {
		    color: <?php echo $highlight; ?>;
		}
		#testimonials .tab a.active,
		#testimonials .tab a:hover {
		    background: <?php echo $highlight; ?>;
		}
		.nav-tabs > .active > a,
		.nav.nav-tabs > li > a:hover,
		.nav.nav-tabs > li > a:focus,
		.nav.nav-tabs > .active > a,
		.nav.nav-tabs > .active > a:hover,
		.nav.nav-tabs > .active > a:focus,
		.progress.plain .bar,
		.accordion-heading .accordion-toggle.active,
		.accordion-heading .accordion-toggle:hover {
		    background: <?php echo $highlight; ?>;
		}
		.progress-list li em ,
		.fix-portfolio .filter li a.active,
		.fix-portfolio .filter li a:hover,
		.pricing .plan h4 span {
		    color: <?php echo $highlight; ?>
		}

		#header.navbar .nav > li > a {
			color: <?php echo $nav_colour; ?>;
		}
		@media (min-width: 768px) and (max-width: 979px) { 
			#header .dropdown-menu > li > a:hover,
			#header .dropdown-menu > li > a:focus,
			#header .dropdown-submenu:hover > a,
			#header .dropdown-submenu:focus > a,
			#header .dropdown-menu > .active > a,
			#header .dropdown-menu > .active > a:hover,
			#header .dropdown-menu > .active > a:focus,
			#header .nav-collapse .nav > li > a:hover,
			#header .nav-collapse .nav > li > a:focus,
			#header .nav-collapse .dropdown-menu a:hover,
			#header .nav-collapse .dropdown-menu a:focus {
			    color: <?php echo $highlight; ?>;
			}
		}
		@media (max-width: 767px) { 
			#header .dropdown-menu > li > a:hover,
			#header .dropdown-menu > li > a:focus,
			#header .dropdown-submenu:hover > a,
			#header .dropdown-submenu:focus > a,
			#header .dropdown-menu > .active > a,
			#header .dropdown-menu > .active > a:hover,
			#header .dropdown-menu > .active > a:focus,
			#header .nav-collapse .nav > li > a:hover,
			#header .nav-collapse .nav > li > a:focus,
			#header .nav-collapse .dropdown-menu a:hover,
			#header .nav-collapse .dropdown-menu a:focus {
			    color: <?php echo $highlight; ?>;
			}
		}
		
		h1,
		h2,
		h3,
		h4,
		h5,
		h6, .post-title a {
			color: <?php echo $headings_colour; ?>;
		}
		
		.overlay a div {
			background: rgba(<?php echo $highlightrgb; ?>,0.8);
		}
		
		.offset {
			padding-top: <?php echo $header_height; ?>px;
		}
		
		#header .responsive-menu, #header.navbar-fixed-top .nav-collapse {
			margin-top: <?php echo $nav_margin; ?>px;
		}
		
		#header.navbar {
			padding: <?php echo $header_padding; ?>px 0;
		}
		
		.portfolio-wide-container {
		    width: 100% !important;
		    position: relative;
		    padding: 0;
		    max-height: <?php echo $gallery_height; ?>px !important;
		    overflow: hidden !important;
		    margin-bottom: 50px;
		}
	
	<?php 
		if( get_option('static_header', '0') == '1' )
			echo '#header.navbar { position: static; } div.offset { display: none; }';
			
		echo get_option('custom_css'); 
	?>
	
</style>
	
<?php }