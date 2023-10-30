<?php
/**
 * Offvancas template with form
 */
$id = $args['id'];
$shortcode = $args['shortcode'];
?>
<wc-offcanvas body="hidden" id="<?php echo $id; ?>">
    <wc-offcanvas-header>
        <button class="offcanvas-btn-close">
            <i class="fa-thin fa-arrow-left-long"></i>
            <span><?php _e('Ga terug', 'understrap') ?></span>
        </button>
    </wc-offcanvas-header>
    <?php echo do_shortcode( $shortcode ); ?>
</wc-offcanvas>