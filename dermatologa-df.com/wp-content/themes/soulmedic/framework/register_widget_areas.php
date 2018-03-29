<?php 
	#Display Everywhere
	register_sidebar(array(
		'name' 			=>	'Display Everywhere',
		'id'			=>	'display-everywhere-sidebar',
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle"><span>',
		'after_title' 	=> 	'</span></h3>'));

	#Custom Sidebars
	$widgets = dttheme_option('widgetarea','custom');
	$widgets = is_array($widgets) ? array_unique($widgets) : array();
    $widgets = array_filter($widgets);
    foreach ($widgets as $key => $value) {
    	$id = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
		'name' 			=>	$value,
		'id'			=>	$id,
		'description'   =>  __("A unique sidebar that is created in Admin panel","dt_themes"),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));
    }

    #Post's Author Archive Sidebar 
    	$author_archive_layout = dttheme_option('specialty','author-archives-layout');
    	$author_archive_layout = !empty($author_archive_layout) ? $author_archive_layout : "content-full-width";
		if( $author_archive_layout != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	__("Author's Archive Sidebar",'dt_themes'),
				'id'			=>	'author-archive-sidebar',
				'description'   =>  __("Author's archive sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}


    #Post's Category Archive Sidebar 
    	$cat_archive_layout = dttheme_option('specialty','category-archives-layout');
    	$cat_archive_layout = !empty($cat_archive_layout) ? $cat_archive_layout : "content-full-width";
		if( $cat_archive_layout != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	__("Post's Category Archive Sidebar",'dt_themes'),
				'id'			=>	'post-category-archive-sidebar',
				'description'   =>  __("Category's archive sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}


    #Post's Tag Archive Sidebar
    	$tag_archive_layout = dttheme_option('specialty','tag-archives-layout');
    	$tag_archive_layout = !empty($tag_archive_layout) ? $tag_archive_layout : "content-full-width";
		if( $tag_archive_layout != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	__("Tag's Archive Sidebar",'dt_themes'),
				'id'			=>	'post-tags-archive-sidebar',
				'description'   =>  __("Tag's archive sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}


    #Search Page Layout
    	$search_layout = dttheme_option('specialty','search-layout');
    	$search_layout = !empty($search_layout) ? $search_layout : "content-full-width";
		if( $search_layout != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	__("Search Sidebar",'dt_themes'),
				'id'			=>	'search-sidebar',
				'description'   =>  __("Search page sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}


    #404 Page Layout
    	$layout_404 = dttheme_option('specialty','404-layout');
    	$layout_404 = !empty($layout_404) ? $layout_404 : "content-full-width";
		if( $layout_404 != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	__('Not Found ( 404 ) Sidebar','dt_themes'),
				'id'			=>	'not-found-404-sidebar',
				'description'   =>  __("404 page sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}

if( class_exists('TribeEvents')	):
	#Events Everywhere
	register_sidebar(array(
		'name' 			=>	'Events Everywhere',
		'id'			=>	'events-everywhere-sidebar',
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle"><span>',
		'after_title' 	=> 	'</span></h3>'));
endif;

if( class_exists('woocommerce')	):

	#Shop Everywhere Sidebar
		register_sidebar(array(
			'name' 			=>	'Shop Everywhere',
			'id'			=>	'shop-everywhere-sidebar',
			'description'   =>  __("Shop page unique sidebar that appears on the left (or) right.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	
	#Product Detail page Sidebar
		$product_layout =  dttheme_option('woo',"product-layout");
		$product_layout = !empty($product_layout) ? $product_layout : "content-full-width";
		if( $product_layout != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	'Product Detail Page Sidebar',
				'id'			=>	'product-detail-sidebar',
				'description'   =>  __("Product detail page sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}

	#Product Category Archive Sidebar
		$product_category_archive_layout =  dttheme_option('woo',"product-category-layout");
		$product_category_archive_layout = !empty($product_category_archive_layout) ? $product_category_archive_layout : "content-full-width";
		if( $product_category_archive_layout != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	'Product Category Archive Sidebar',
				'id'			=>	'product-category-archive-sidebar',
				'description'   =>  __("Product category archive page sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}

	#Product Tag Archive Sidebar
		$product_tag_archive_layout =  dttheme_option('woo',"product-tag-layout");
		$product_tag_archive_layout = !empty($product_tag_archive_layout) ? $product_tag_archive_layout : "content-full-width";
		if( $product_tag_archive_layout != "content-full-width" ){
			register_sidebar(array(
				'name' 			=>	'Product Tag Archive Sidebar',
				'id'			=>	'product-tag-archive-sidebar',
				'description'   =>  __("Product tag archive page sidebar that appears on the left (or) right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
endif;

	#Footer Columnns		
	$footer_columns =  dttheme_option('general','footer-columns');
	dttheme_footer_widgetarea($footer_columns);?>