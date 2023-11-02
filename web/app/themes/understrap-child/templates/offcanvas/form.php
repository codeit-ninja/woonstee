<?php
/**
 * Offvancas template with form
 */
$id = $args['id'];
$shortcode = $args['shortcode'];
?>
<wc-offcanvas body="hidden" id="<?php echo $id; ?>">
    <?php echo do_shortcode( $shortcode ); ?>
</wc-offcanvas>