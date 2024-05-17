<?php
/**
 * Text with image content block renderer
 */
$index = $args['index'];
$block = $args['block'];

$style = $block['background_color'] ? 'style="background-color: ' . $block['background_color'] . ';"' : '';
?>

<div class="container">
    <div class="block block-text" <?php echo $style; ?>>
        <div class="block-text-content" style="<?php echo $block['content_max_width'] ? 'margin: 0 auto;max-width: ' . $block['content_max_width'] . 'px' : ''; ?>">
            <?= $block['text']; ?>
            <?php if( $block['use_button'] ) : ?>
                <div class="mt-5 <?php echo $block['center_button'] ? 'text-center' : 'text-start'; ?>">
                    <?php get_template_part('templates/blocks/templates/button', null, $block['button_template']['button']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>