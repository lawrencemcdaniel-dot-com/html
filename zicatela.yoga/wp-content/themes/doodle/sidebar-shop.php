<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package doodle
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<?php
$shop_sidebar = get_theme_mod('doodle_wc_sidebar', 'left');
switch ($shop_sidebar) {
	case 'right':
      $container_class = "col-md-3 col-lg-3 col-lg-offset-1";
      break;
    case 'none':
      $container_class = "col-md-12";
      break;
    default:
      $container_class = "col-md-3 col-md-pull-9 col-lg-offset-1";
      break;
}
?>

<div class="<?php echo $container_class; ?>">
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #secondary -->
</div>
