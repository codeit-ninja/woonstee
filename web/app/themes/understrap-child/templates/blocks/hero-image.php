<?php
/**
 * Hero image block
 */
$index = $args['index'];
$block = $args['block'];

$image = wp_get_attachment_image( $block['image'], 'full', false, array('class' => 'img-fluid mx-auto') );
$text = $block['text'];
$fullwidth = $block['fullwidth'] ? 'container-fluid p-0' : 'container';
$fullheigth = ! $block['fixed_height'] && $block['fullheigth'] ? 'vh-100' : '';

$heigth = '';

if( $block['fixed_height'] ) {
    $heigth = 'style="height: '. $block['height_in_px'] .'px;"';
}
?>

<div class="block block-hero-image block-wrapper overflow-hidden <?php echo $fullwidth; ?> <?php echo $fullheigth; ?>" <?php echo $heigth; ?>>
    <?php echo $image; ?>

    <?php if( $block['use_text'] && $text ) : ?>
        <div class="block-hero-image-text" style="justify-content: <?php echo $block['vertical_alignment']; ?>">
            <div class="container" style="align-items: <?php echo $block['horizontal_alignment']; ?>">
                <?php echo $text; ?>
                <?php if( $block['use_button'] ) : ?>
                    <a href="" role="button" class="<?php echo $block['button_classes']; ?> mt-5">
                        <?php echo $block['button_text']; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>