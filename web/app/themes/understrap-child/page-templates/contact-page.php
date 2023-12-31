<?php
/**
 * Template Name: Contact page
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$showroom = get_field('showroom');
?>

<div class="wrapper flex-grow-1 d-flex flex-column" id="page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>">
        <?php breadcrumbs(); ?>
    </div>

	<div class="<?php echo esc_attr( $container ); ?> mt-auto" id="content" tabindex="-1">

		<div class="row g-3 align-items-stretch">
            <div class="col-md-7 col-lg-6 order-md-0 order-1">
                <div class="form p-5">
                    <?php echo do_shortcode('[contact-form-7 id="22ed420" title="Contact formulier"]'); ?>
                </div>
            </div>
            <div class="col-md-5 col-lg-6 order-md-1 order-0">
                <div class="p-5">
                    <?php the_content(); ?>
                </div>
            </div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
