<?php
/**
 * Offvancas template with html content
 */
$id = $args['id'];
$html = $args['html'];
$variant = $args['variant'] ?: 'dark';
?>
<wc-offcanvas body="hidden" id="<?php echo esc_attr( $id ); ?>" variant="<?php echo esc_attr( $variant ); ?>">
    <?php echo apply_filters( 'the_content', $html ); ?>
</wc-offcanvas>