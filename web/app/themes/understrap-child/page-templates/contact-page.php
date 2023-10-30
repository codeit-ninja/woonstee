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

<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>">
        <?php breadcrumbs(); ?>
    </div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row g-3 align-items-stretch">
            <div class="col-12">
            </div>
            <div class="col-md-6">
                <div class="form p-5">
                    <?php echo do_shortcode('[contact-form-7 id="22ed420" title="Contact formulier"]'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5">
                    <?php the_content(); ?>
                </div>
            </div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
