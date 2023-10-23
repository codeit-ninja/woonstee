<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$images = get_field('images');
?>

<div class="wrapper" id="single-project">

    <div class="<?php echo esc_attr( $container ); ?>">
        <?php breadcrumbs(); ?>
    </div>

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<main class="site-main" id="main">

				<div class="row">
                    <div class="col-6">
                        <div class="sticky-top" style="top: 150px;">
                            <?php
                            while ( have_posts() ) {
                                the_post();
                                get_template_part( 'loop-templates/content', 'single-project' );
                            }
                            ?>
                            <div class="post-share-links mt-5">
                                <div class="post-share-links-social">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-pinterest-p"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row g-1" data-masonry='{"percentPosition": true }'>
                            <?php foreach( $images as $image ) : ?>
                                <div class="col-12 col-md-6">
                                    <?php get_template_part('global-templates/image', null, array( 'image_ID' => $image['ID'] )); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

			</main>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
