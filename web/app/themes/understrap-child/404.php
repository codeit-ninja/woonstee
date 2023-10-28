<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="error-404-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>">
        <?php breadcrumbs(); ?>
    </div>
    
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main mt-5" id="main">

					<section class="error-404 not-found row">

						<header class="page-header col-sm-6">

							<h1 class="page-title mb-3">Pagina niet gevonden</h1>
                            <p>De pagina die je probeert te bereiken bestaan niet (meer).</p>
                            <a href="/" role="button" class="btn btn-link px-0">Ga terug naar de homepage</a>
						</header><!-- .page-header -->

						<div class="page-content col-sm-6">
                            
                            <?php get_template_part('global-templates/image', null, ['image_ID' => 581]); ?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
