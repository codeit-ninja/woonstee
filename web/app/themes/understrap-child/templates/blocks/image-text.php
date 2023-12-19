<?php
/**
 * Text with image content block renderer
 */
$index = $args['index'];
$block = $args['block'];
?>

<div class="<?php echo $block['container']; ?>">

    <?php if( $block['image_side'] === 'left' ) : ?>
        <div class="block block-image-text-odd block-image-text row gy-5 gy-lg-0 align-items-<?php echo $block['vertical_align']; ?>" style="--bg-color: <?php echo esc_attr( $block['background_color'] ); ?>">
            <div class="col-12 col-lg-5">
                <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
            </div>
            <div class="col-12 col-lg-7 text-start px-5">
                <?php echo $block['text']; ?>
                <?php if( $block['use_button'] ) : ?>
                    <div class="mt-4">
                        <?php get_template_part('templates/blocks/templates/button', null, $block['button_template']['button']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="block block-image-text-even block-image-text row gy-5 align-items-center" style="--bg-color: <?php echo esc_attr( $block['background_color'] ); ?>">
            <div class="col-12 col-lg-7 text-start px-5">
                <?php echo $block['text']; ?>
                <?php if( $block['use_button'] ) : ?>
                    <div class="mt-4">
                        <?php get_template_part('templates/blocks/templates/button', null, $block['button_template']['button']); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-lg-5">
                <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
            </div>
        </div>
    <?php endif; ?>
</div>