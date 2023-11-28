<?php
/**
 * Offvancas template rendering the main menu
 */
?>
<wc-offcanvas body="hidden" id="offcanvas-navbar" variant="primary">
    <?php
    wp_nav_menu(
        array(
            'theme_location'  => 'primary',
            'menu_class'      => 'nav flex-column align-items-center',
            'fallback_cb'     => '',
            'menu_id'         => 'main-menu',
            'depth'           => 2,
            'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
        )
    );
    ?>

    <div class="nav-social">
        <h4>Volg ons ook op</h4>
        <?php echo do_shortcode('[social-links]'); ?>
    </div>
</wc-offcanvas>