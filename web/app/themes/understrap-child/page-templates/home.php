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

	<div id="content">

		<div class="row">

			<div class="col-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

                    <!-- <div class="container">
                        <blockquote class="fs-2 text-center">
                            <?php the_field('quote'); ?>
                        </blockquote>
                    </div> -->

                    <!-- Render blocks -->
					<?php get_template_part('loop-templates/blocks/block', 'editor'); ?>

                    <!-- Render project slider -->
					<div class="container" id="block-green">
                        <?php get_template_part('loop-templates/slider/projects', 'slider'); ?>
                    </div>

				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
