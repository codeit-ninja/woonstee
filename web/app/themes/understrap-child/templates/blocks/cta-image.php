<?php
/**
 * Call to action block template
 */
$index = $args['index'];
$block = $args['block'];

$background_color = isset( $block['background_color'] ) ? $block['background_color'] : 'transparent';
$text_color = isset( $block['text_color'] ) ? $block['text_color'] : '#000000';
$order = array( 'text' => 1, 'image' => 2 );

if( $block['image_position'] === 'left' ) {
    $order = array( 'text' => 2, 'image' => 1 );
}
?>

<div class="container">
    <div class="block block-cta-image" style="background-color: <?php echo $background_color; ?>;color: <?php echo $text_color; ?>;">
        <div class="row align-items-center">
            <div class="col-md-7 order-<?php echo $order['text']; ?>">
                <div class="block-cta-image-body p-5">
                    <?php printf('%s', $block['text']); ?>  
                    <?php if( isset( $block['buttons_template'] ) && $block['buttons_template'] ) : ?>
                        <div class="mt-4">
                            <?php get_template_part('templates/blocks/templates/buttons', null, $block['buttons_template']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-5 order-<?php echo $order['image']; ?> align-self-stretch">
                <?php get_template_part('global-templates/bg', 'image', ['image_ID' => $block['image'], 'min_height' => $block['image_min_height']]); ?>
            </div>
        </div>
    </div>
</div>