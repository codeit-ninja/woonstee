<?php
/**
 * Template Name: Home page
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

                    <blockquote class="fs-2 text-center">
                        <?php the_field('quote'); ?>
                    </blockquote>
					<?php get_template_part('loop-templates/home/content', 'blocks'); ?>

				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
