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

$menu_one_ref       = absint( $attrs['menuOneRef'] );
$menu_two_ref       = absint( $attrs['menuTwoRef'] );
$social_heading     = esc_html( $attrs['socialHeading'] );
$promo_copy         = esc_html( $attrs['promoCopy'] );
$promo_button_label = esc_html( $attrs['promoButtonLabel'] );
$promo_button_url   = esc_url( $attrs['promoButtonUrl'] );
$legal_copy         = esc_html( $attrs['legalCopy'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-footer alignfull',
    )
);

$footer_nav_markup = static function( $ref, $fallback_links ) {
    if ( $ref > 0 && get_post_type( $ref ) === 'wp_navigation' ) {
        return do_blocks(
            '<!-- wp:navigation {"ref":' . (int) $ref . ',"overlayMenu":"never","className":"cph-footer__nav","layout":{"type":"flex","orientation":"vertical"}} /-->'
        );
    }

    $items = '';
    foreach ( $fallback_links as $link ) {
        $items .= '<!-- wp:navigation-link {"label":"' . esc_attr( $link['label'] ) . '","url":"' . esc_url_raw( $link['url'] ) . '","kind":"custom"} /-->';
    }

    return do_blocks(
        '<!-- wp:navigation {"overlayMenu":"never","className":"cph-footer__nav","layout":{"type":"flex","orientation":"vertical"}} -->' .
        $items .
        '<!-- /wp:navigation -->'
    );
};

$fallback_one = array(
    array(
        'label' => 'News',
        'url'   => 'https://news.marriott.com/',
    ),
    array(
        'label' => 'Hotel Development',
        'url'   => 'https://hotel-development.marriott.com/brands/cph-hotels/',
    ),
    array(
        'label' => 'Terms of Use',
        'url'   => 'https://www.marriott.com/about/terms-of-use.mi',
    ),
);

$fallback_two = array(
    array(
        'label' => 'Jobs',
        'url'   => 'https://jobs.marriott.com/marriott/jobs?page=1&brand=CPH+Hotels',
    ),
    array(
        'label' => 'About CPH Guestbook',
        'url'   => 'https://www.instagram.com/citiplushotels/',
    ),
    array(
        'label' => 'Privacy Statement',
        'url'   => 'https://www.marriott.com/about/privacy.mi',
    ),
);
?>
<footer <?php echo $wrapper_attributes; ?>>
    <div class="cph-footer__inner alignwide">
        <div class="wp-block-columns are-vertically-aligned-top cph-footer__columns">
            <div class="wp-block-column is-vertically-aligned-top cph-footer__menu-column" style="flex-basis:18%">
                <?php echo $footer_nav_markup( $menu_one_ref, $fallback_one ); ?>
            </div>
            <div class="wp-block-column is-vertically-aligned-top cph-footer__menu-column" style="flex-basis:18%">
                <?php echo $footer_nav_markup( $menu_two_ref, $fallback_two ); ?>
            </div>
            <div class="wp-block-column is-vertically-aligned-top cph-footer__social-column" style="flex-basis:18%">
                <h4 class="cph-footer__heading"><?php echo $social_heading; ?></h4>
                <?php
                echo do_blocks(
                    '<!-- wp:social-links {"iconColor":"custom-off-black","iconColorValue":"#161717","size":"has-small-icon-size","className":"has-icon-color is-style-logos-only cph-footer__socials"} -->
                    <!-- wp:social-link {"url":"https://www.instagram.com/citiplushotels/","service":"instagram"} /-->
                    <!-- wp:social-link {"url":"https://www.facebook.com/citiplushotels","service":"facebook"} /-->
                    <!-- wp:social-link {"url":"https://www.youtube.com/","service":"youtube"} /-->
                    <!-- /wp:social-links -->'
                );
                ?>
            </div>
            
        </div>
    </div>
   
    <div class="cph-footer__legal-strip alignfull">
        <p class="cph-footer__legal-copy"><?php echo $legal_copy; ?></p>
    </div>
</footer>
