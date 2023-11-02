<?php
/**
 * Offvancas template with form
 */
$id = $args['id'];
$employee = $args['employee'];
?>
<wc-offcanvas body="hidden" id="<?php echo esc_attr( $id ); ?>" variant="dark">
    <h4 class="mt-4"><?php echo $employee['name']; ?></h4>
    <span class="d-block text-muted"><?php echo $employee['role']; ?></span>
    <p class="mt-4"><?php echo esc_html( $employee['about_me'] ); ?></p>
</wc-offcanvas>