<?php
/**
 * BLock editor buttons template
 */
$buttons = $args['buttons'];
$flex_direction = 'flex-column';
$flex_align = 'justify-content-' . $args['align'];

if( $args['inline'] ) {
    $flex_direction = 'flex-row';
}
?>

<div class="block-template block-template-buttons">
    <div class="d-flex gap-3 <?php echo $flex_direction; ?> <?php echo $flex_align; ?> align-items-start">
        <?php
        foreach ($buttons as $button) :
            $variant = 'btn-' . $button['color'];
            $stretch = '';

            if( $button['variant'] === 'outline' ) {
                $variant = 'btn-outline-' . $button['color'];
            }

            if( $button['stretch']) {
                $stretch = 'w-100';
            }

            printf(
                '<a role="button" href="%s" class="btn %s">%s</a>',
                esc_url($button['link']),
                esc_attr(join(" ", array( $variant, $stretch ))),
                esc_attr($button['text'])
            );
        endforeach;
        ?>
    </div>
</div>