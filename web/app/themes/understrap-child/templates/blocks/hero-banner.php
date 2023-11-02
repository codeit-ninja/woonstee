<?php
/**
 * Hero image block
 */
$index = $args['index'];
$block = $args['block'];
$classes = [];

if( $block['fullheight'] ) {
    $classes[] = 'vh-100';
}
?>
<div class="block block-hero-banner <?php echo join( ' ', $classes ); ?>" style="--codeit-banner-bg: <?php echo $block['background_color']; ?>">
    <div class="container h-100">
        <div class="row align-items-center h-100 g-5">
            <div class="col-lg-6 order-1 order-lg-0" data-aos="fade-right">
                <div class="d-flex flex-column align-items-baseline gap-4">
                    <div class="block-hero-banner-heading"><?php echo esc_html( $block['heading'] ); ?></div>
                    <div class="block-hero-banner-text"><?php echo esc_html( $block['text'] ); ?></div>
                    <?php if( $block['use_button'] ) : ?>
                        <?php get_template_part('templates/blocks/templates/button', null, $block['button_settings']['button']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 order-0 order-lg-1 mb-4 mb-lg-0" data-aos="fade-left">
                <?php get_template_part('global-templates/image', null, ['image_ID' => 844]); ?>
            </div>
        </div>
    </div>
</div>