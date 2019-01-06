<?php
	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action('woocommerce_before_main_content');
	
	if ( apply_filters( 'woocommerce_show_page_title', true ) ) : 
?>

	<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

<?php 
	endif;
	
	do_action( 'woocommerce_archive_description' );
	
	if ( have_posts() ) :
	
			/**
			 * woocommerce_before_shop_loop hook
			 *
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
			
			do_action( 'ebor_wrapper' );
			
			woocommerce_product_loop_start();
			
			woocommerce_product_subcategories();
			
			
			while ( have_posts() ) : the_post();
			
				woocommerce_get_template_part( 'content', 'product' );

			endwhile; // end of the loop.
			woocommerce_product_loop_end();
			
			elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :
			
				woocommerce_get_template( 'loop/no-products-found.php' );

	endif;
	
	/**
	 * woocommerce_sidebar hook
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action('woocommerce_sidebar');

	/**
	 * woocommerce_after_main_content hook
	 *
	 */
	do_action('woocommerce_after_main_content');
	
	if( kriesi_pagination() ) : 
?>

	    <div class="dark-wrapper">
	      <?php 
	      	do_action('ebor_open_wrapper');
	      	echo function_exists('kriesi_pagination') ? kriesi_pagination() : posts_nav_link();
	      	do_action('ebor_close_wrapper'); 
	      ?>
	    </div>
	    
<?php 
	endif;