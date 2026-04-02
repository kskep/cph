<?php
$defaults = array(
    'menuOneRef'       => 0,
    'menuTwoRef'       => 0,
    'socialHeading'    => 'Stay Connected',
    'promoCopy'        => 'Explore the possibilities. What you need, when you need it.',
    'promoButtonLabel' => 'Learn More',
    'promoButtonUrl'   => 'https://mobileapp.marriott.com/',
    'legalCopy'        => 'Copyright © 2026 CityPlusHotels, Rhodes, Greece',
);

$attrs = wp_parse_args( $attributes, $defaults );

$promo_copy         = esc_html( $attrs['promoCopy'] );
$promo_button_label = esc_html( $attrs['promoButtonLabel'] );
$promo_button_url   = esc_url( $attrs['promoButtonUrl'] );
$legal_copy         = esc_html( $attrs['legalCopy'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-footer alignfull',
    )
);
?>
<footer <?php echo $wrapper_attributes; ?>>
    <div class="cph-footer__legal-strip alignfull">
        <p class="cph-footer__legal-copy"><?php echo $legal_copy; ?></p>
    </div>
</footer>
