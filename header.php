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
	<div class="menu-screen"></div>

<?php do_action( 'alcatraz_before' ); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'alcatraz' ); ?></a>

	<?php do_action( 'alcatraz_before_header' ); ?>

	<?php get_template_part( 'template-parts/globals/global', 'site-header' ); ?>

	<?php do_action( 'alcatraz_after_header' ); ?>

	<?php do_action( 'alcatraz_before_content' ); ?>

	<div id="content" class="site-content">

		<?php do_action( 'alcatraz_before_content_inside' ); ?>
