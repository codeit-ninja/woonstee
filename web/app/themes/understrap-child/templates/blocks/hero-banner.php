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
    <div class="container">
        <div class="block-hero-banner-grid">
            <div class="d-flex block-hero-banner-col">
                <div class="block-hero-banner-horizontal-text">DEWOONSTEETIEL.NL - INTERIEUR ADVIES</div>
                <div class="block-hero-banner-header flex-grow-1">
                    <div class="block-hero-banner-leading"><?php echo $block['heading']; ?></div>
                    <div class="block-hero-banner-text"><?php echo esc_html( $block['text'] ); ?></div>
                </div>
            </div>
            <div class="block-hero-banner-col block-hero-banner-image-container">
                <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
            </div>
        </div>
        <!-- <div class="grid align-items-center g-5">
            <div class="g-col-8 g-col-lg-5">
                <div class="d-flex">
                    <div class="block-hero-banner-horizontal-text">DEWOONSTEETIEL.NL - INTERIEUR ADVIES</div>
                    <div class="block-hero-banner-header flex-grow-1">
                        <div class="block-hero-banner-leading"><?php echo $block['heading']; ?></div>
                        <div class="block-hero-banner-text"><?php echo esc_html( $block['text'] ); ?></div>
                    </div>
                </div>
                <!-- <div class="d-flex flex-column align-items-baseline gap-4 block-hero-banner-content">
                    <div class="block-hero-banner-heading"><?php echo esc_html( $block['heading'] ); ?></div>
                    <div class="block-hero-banner-text"><?php echo esc_html( $block['text'] ); ?></div>
                    <?php if( $block['use_button'] ) : ?>
                        <?php get_template_part('templates/blocks/templates/button', null, $block['button_settings']['button']); ?>
                    <?php endif; ?>
                </div> -->
            </div>
            <div class="g-col-4 g-col-lg-7 mb-4 mb-lg-0 overflow-hidden block-hero-banner-image-container">
                <!-- <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
            </div>
        </div> -->
    </div>
</div>