<?php
/**
 * Offvancas template with form
 */
$id = $args['id'];
$shortcode = $args['shortcode'];
?>
<div class="offcanvas offcanvas-form offcanvas-end text-bg-dark" data-bs-backdrop="static" tabindex="-1" id="<?php echo $id; ?>" aria-labelledby="<?php echo $id; ?>">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php echo $atts['title'] ?: 'Formulier'; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php echo do_shortcode( $shortcode ); ?>
    </div>
</div>