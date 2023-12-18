<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<nav id="main-nav" class="navbar navbar-expand-md" aria-labelledby="main-nav-label">

	<h2 id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</h2>


	<div class="<?php echo esc_attr( $container ); ?>">

		<!-- Your site branding in the menu -->
		<?php get_template_part( 'global-templates/navbar-branding' ); ?>

        <div class="quik-contact-links ms-auto me-5">
            <div class="d-flex align-items-center gap-3">
                <i class="fa-thin fa-phone"></i>
                <a href="tel:+31 0344 621 608">Contact opnemen</a>
            </div>
        </div>

        <button class="wc-hamburger" type="button" data-offcanvas-open="#offcanvas-navbar">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <?php
        add_action(
            'insert_before_body_end',
            fn() => get_template_part( 'templates/offcanvas/offcanvas', 'nav' ),
            20
        );
        ?>

	</div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->
