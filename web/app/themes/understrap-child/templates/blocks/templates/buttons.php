<?php
/**
 * BLock editor buttons template
 */
$buttons = $args['buttons'];
$flex_direction = 'flex-column';
$flex_align = 'align-items-lg-' . $args['align'];

if( $args['inline'] ) {
    $flex_direction = 'flex-row';
}

if( ! isset( $buttons ) || ! $buttons ) {
    return;
}
?>

<div class="block-template block-template-buttons">
    <div class="d-flex gap-3 <?php echo $flex_direction; ?> <?php echo $flex_align; ?>">
        <?php
        foreach ( $buttons as $button ) :
            get_template_part( 'templates/blocks/templates/button', null, $button['button'] );
        endforeach;
        ?>
    </div>
</div>