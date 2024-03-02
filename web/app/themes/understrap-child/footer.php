<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-12 text-center text-md-start">
                <span class="d-block py-3">
                Website by <a href="https://codeit.ninja" target="_blank">codeit.ninja</a>
                </span>
            </div>

		</div><!-- .row -->

	</div><!-- .container(-fluid) -->

</div><!-- #wrapper-footer -->

<!-- offvancas elements -->
<?php do_action( 'insert_before_body_end' ); ?>

</div><!-- #page -->

<div class="whatsapp">
    <span>Stel uw vragen via WhatsApp</span>
    <a href="https://wa.me/31625483423" target="_blank" title="Stel uw vragen via WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<?php
the_field('footer_scripts', 'option');
wp_footer();
?>

</body>

</html>

