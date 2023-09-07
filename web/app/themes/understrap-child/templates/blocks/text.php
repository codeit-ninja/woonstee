<?php
/**
 * Text with image content block renderer
 */
$index = $args['index'];
$block = $args['block'];

$style = $block['background_color'] ? 'style="background-color: '. $block['background_color'] .';"' : '';
?>

<div class="container">
    <div class="block block-text" <?php echo $style; ?>>
        <div class="block-text-content">
            <?= $block['text']; ?>
        </div>
    </div>
</div>