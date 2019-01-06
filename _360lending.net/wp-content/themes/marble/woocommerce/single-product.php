<?php
/**
 * The Template for displaying all single products.
 *
 * @author 		TommusRhodus
 * @package 	WooCommerce/Templates
 * @version     9.9.9
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); 
the_post(); 

( is_active_sidebar('shop') ) ? $width = 'span9' :  $width = 'span12';

?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
	
	<?php do_action( 'ebor_single_product_title' ); ?>
	
	<?php do_action( 'ebor_wrapper' ); ?>
	
	<div class="row">
	
		<div class="<?php echo $width; ?>">
	
				<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
	
		</div>
		
		<?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action('woocommerce_sidebar');
		?>
	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer('shop'); ?>