<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package doodle
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<?php
$bodyClasses = array();
$loader = get_theme_mod('doodle_show_loader', 'never');
if ($loader == 'always') {
  $bodyClasses[] = 'loading';
}
elseif($loader == 'homepage' && is_front_page()) {
  $bodyClasses[] = 'loading';
}
else {
  $bodyClasses[] = 'no-loading';
}
$bodyClasses[] = get_theme_mod('doodle_color_scheme', 'brown');
if ( get_theme_mod('doodle_fixed_navbar') ) { $bodyClasses[] = 'fixed-header'; }
?>

<body <?php body_class( implode(' ', $bodyClasses) ); ?>>

<!-- LOADING
================================================== -->
<div class="loading-modal">
	<div class="loading-icon"><img src="<?php echo get_template_directory_uri(); ?>/img/gear.svg" alt=""></div>
</div><!-- ./LOADING -->

<!-- HEADER
================================================== -->
<section class="site-header inverse">

<nav class="navbar navbar-default" role="navigation" id="main-nav">
  <div class="container">
    <div class="row">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="site-name">
          <?php if( $logo = get_theme_mod('doodle_logo') ): ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
          <?php else: ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( get_theme_mod('doodle_display_tagline') ): ?>
                <h2 class="site-description">| <?php bloginfo( 'description' ); ?></h2>
            <?php endif; ?>
          <?php endif; ?>
      </div>

    </div>

            <!-- Primary Menu -->
            <?php
                wp_nav_menu( array(
                    'menu'              => 'primary',
                    'theme_location'    => 'primary',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
                    'menu_class'        => 'nav navbar-nav navbar-right',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker())
                );
            ?>

    </div><!-- /.row -->
  </div><!-- /.container -->
</nav>

</section><!-- ./HEADER -->

<?php
if ( is_page_template("page-templates/contact.php") ) {
  get_template_part( 'partials/jumbotron-contact' );
} else {
  get_template_part( 'partials/jumbotron' );
}
?>

<?php
if ( !is_front_page() || !get_theme_mod('doodle_hide_secondary_navbar_on_homepage') ) {
  get_template_part( 'partials/breadcrumbs' );
}
?>

<div id="content" class="site-content">
  <div class="container">
    <div class="row">
