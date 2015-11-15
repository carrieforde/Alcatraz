<?php
/**
 * Template for displaying our header.
 *
 * This template displays all of the <head> section and everything up until <div id="content">
 *
 * @package alcatraz
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'alcatraz_before' ); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'alcatraz' ); ?></a>

	<?php do_action( 'alcatraz_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner">

		<?php do_action( 'alcatraz_before_header_inside' ); ?>

		<div class="site-branding">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'alcatraz' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav>

		<?php do_action( 'alcatraz_after_header_inside' ); ?>

	</header>

	<?php do_action( 'alcatraz_after_header' ); ?>

	<?php do_action( 'alcatraz_before_content' ); ?>

	<div id="content" class="site-content">

		<?php do_action( 'alcatraz_before_content_inside' ); ?>
