<?php
/**
 * Alcatraz Header
 *
 * @package Alcatraz
 */
?>

<header id="site-header" class="site-header" role="banner">

		<?php do_action( 'alcatraz_before_header_inside' ); ?>

		<div class="header-inner">

			<?php do_action( 'alcatraz_header' ); ?>

		</div>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>

			<button class="mobile-menu-toggle" type="button">
				<span class="mobile-menu-toggle__bar bar-1"></span>
				<span class="mobile-menu-toggle__bar bar-2"></span>
				<span class="mobile-menu-toggle__bar bar-3"></span>
				<span class="screen-reader-text">Menu</span>
			</button>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php do_action( 'alcatraz_before_primary_nav' ); ?>

				<?php wp_nav_menu( array(
					'theme_location'  => 'primary',
					'menu_id'         => 'primary-menu',
					'menu_class'      => 'primary-menu menu',
					'container_class' => 'main-navigation__menu',
				) ); ?>

				<?php do_action( 'alcatraz_after_primary_nav' ); ?>
			</nav>

		<?php endif; ?>

		<?php do_action( 'alcatraz_after_header_inside' ); ?>

	</header>