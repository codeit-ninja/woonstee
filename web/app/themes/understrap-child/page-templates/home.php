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

                    <!-- Render blocks -->
					<?php get_template_part('loop-templates/blocks/block', 'editor'); ?>

                    <!-- Render project slider -->
					<!-- <div class="container" id="block-green">
                        <?php get_template_part('loop-templates/slider/projects', 'slider'); ?>
                    </div> -->

                    <div class="mb-5">
                        <?php get_template_part('templates/instagram', 'posts'); ?>
                    </div>

				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
