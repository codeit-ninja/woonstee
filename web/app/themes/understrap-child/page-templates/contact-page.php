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

		<div class="row g-5">
            <div class="col-12">
                <?php 
                the_title(
                    '<header class="entry-header"><h1 class="entry-title">',
                    '</h1></header><!-- .entry-header -->'
                ); 
                ?>
            </div>
            <div class="col-md-6">
                <?php echo do_shortcode('[contact-form-7 id="22ed420" title="Contact formulier"]'); ?>
            </div>
            <div class="col-md-6">
                <div class="card card-xl text-bg-light border-light">
                    <?php get_template_part('global-templates/image', null, array( 'image_ID' => $showroom['image'] )); ?>
                    <div class="card-body">
                        <h2 class="card-title">Showroom</h2>
                        <p class="card-text"><?php echo $showroom['address']; ?></p>
                    </div>
                </div>
            </div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
