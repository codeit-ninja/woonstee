<?php
/**
 * Sidebar setup for footer full
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-footer-full" role="complementary">

		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'footerfull' ); ?>

			</div>

            <!-- <div class="row" id="footer-guarantees">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="d-flex align-items-center gap-2 py-3 inline-list">
                        <i class="fa-regular fa-circle-check"></i>
                        <span>Tenminste 2 jaar garantie</span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="d-flex align-items-center gap-2 py-3 inline-list">
                        <i class="fa-regular fa-circle-check"></i>
                        <span>Internationale leveringen</span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="d-flex align-items-center gap-2 py-3 inline-list">
                        <i class="fa-regular fa-circle-check"></i>
                        <span>Aflevering en montage aan huis</span>
                    </div>
                </div>
            </div> -->

		</div>

	</div><!-- #wrapper-footer-full -->

	<?php
endif;
