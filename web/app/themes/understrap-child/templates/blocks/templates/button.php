<?php
/**
 * BLock editor buttons template
 */
$button = $args;
$variant = 'btn-' . $button['color'];
$stretch = '';

if ( $button['variant'] === 'outline' ) {
    $variant = 'btn-outline-' . $button['color'];
}

if ( $button['stretch']) {
    $stretch = 'w-100';
}

if ( $button['action'] === 'link' ) {
    printf(
        '<a role="button" href="%s" target="%s" class="btn %s">%s</a>',
        esc_url($button['link']['url']),
        esc_attr($button['link']['target']),
        esc_attr( join( " ", array($variant, $stretch) ) ),
        esc_attr($button['text'])
    );
}

if ( $button['action'] === 'offcanvas' ) {
    $tpl_args = array(
        'id' => wp_unique_id('offcanvas-'),
        'html' => $button['offcanvas']['content'],
        'variant' => $button['offcanvas']['variant'],
    );

    printf(
        '<button class="btn %s" data-offcanvas-open="#%s">%s</button>',
        esc_attr( join( " ", array( $variant, $stretch) ) ),
        $tpl_args['id'],
        esc_attr($button['text'])
    );

    add_action(
        'insert_before_body_end',
        fn() =>
        get_template_part( 'templates/offcanvas/offcanvas', 'html', $tpl_args )
    );
}

if ( $button['action'] === 'modal' ) {
    $tpl_args = array(
        'id' => wp_unique_id('modal-'),
        'html' => $button['modal']['content'],
        'variant' => $button['modal']['variant'],
    );

    printf(
        '<button class="btn %s" data-modal-open="#%s">%s</button>',
        esc_attr( join( " ", array( $variant, $stretch ) ) ),
        $tpl_args['id'],
        esc_attr($button['text'])
    );

    add_action(
        'insert_before_body_end',
        fn() =>
        get_template_part( 'templates/modal/modal', 'content', $tpl_args )
    );
}
?>