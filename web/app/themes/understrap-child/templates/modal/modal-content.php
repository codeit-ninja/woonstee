<?php
/**
 * Modal with WP editor content
 */
$id = $args['id'];
$html = $args['html'];
$variant = $args['variant'] ?: 'dark';
?>
<wc-modal id="<?php echo esc_attr( $id ); ?>" variant="<?php echo esc_attr( $variant ); ?>">
    <div class="modal-container">
        <div class="modal-body">
            <?php echo apply_filters( 'the_content', $html ); ?>
        </div>
    </div>
</wc-modal>