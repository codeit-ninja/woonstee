<?php
/**
 * Modal with WP editor content
 */
$id = $args['id'];
$html = $args['html'];
$variant = $args['variant'] ?: 'dark';
$size = $args['size'] ?: 'md';
?>
<wc-modal id="<?php echo esc_attr( $id ); ?>" variant="<?php echo esc_attr( $variant ); ?>">
    <div class="modal-container modal-<?php echo esc_attr( $size ); ?>">
        <div class="modal-body">
            <?php echo apply_filters( 'the_content', $html ); ?>
        </div>
    </div>
</wc-modal>