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
                <div class="block-hero-banner-horizontal-text"><?php echo $block['vertical_text']; ?></div>
                <div class="block-hero-banner-header flex-grow-1">
                    <div class="block-hero-banner-leading"><?php echo $block['heading']; ?></div>
                    <div class="block-hero-banner-text"><?php echo esc_html( $block['text'] ); ?></div>
                </div>
            </div>
            <div class="block-hero-banner-col block-hero-banner-image-container">
                <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
            </div>
        </div>
    </div>
</div>