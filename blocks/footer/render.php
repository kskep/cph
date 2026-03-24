<?php
$defaults = array(
    'menuOneRef'       => 0,
    'menuTwoRef'       => 0,
    'socialHeading'    => 'Stay Connected',
    'promoCopy'        => 'Explore the possibilities. What you need, when you need it.',
    'promoButtonLabel' => 'Learn More',
    'promoButtonUrl'   => 'https://mobileapp.marriott.com/',
    'legalCopy'        => 'Copyright © 2024 Marriott International, Inc. All Rights Reserved. Marriott Proprietary Information. Terms of Use · Privacy Center · Help · Tracking Preferences · Your Privacy Choices',
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
        'class' => 'moxy-footer alignfull',
    )
);

$footer_nav_markup = static function( $ref, $fallback_links ) {
    if ( $ref > 0 && get_post_type( $ref ) === 'wp_navigation' ) {
        return do_blocks(
            '<!-- wp:navigation {"ref":' . (int) $ref . ',"overlayMenu":"never","className":"moxy-footer__nav","layout":{"type":"flex","orientation":"vertical"}} /-->'
        );
    }

    $items = '';
    foreach ( $fallback_links as $link ) {
        $items .= '<!-- wp:navigation-link {"label":"' . esc_attr( $link['label'] ) . '","url":"' . esc_url_raw( $link['url'] ) . '","kind":"custom"} /-->';
    }

    return do_blocks(
        '<!-- wp:navigation {"overlayMenu":"never","className":"moxy-footer__nav","layout":{"type":"flex","orientation":"vertical"}} -->' .
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
        'url'   => 'https://hotel-development.marriott.com/brands/moxy-hotels/',
    ),
    array(
        'label' => 'Terms of Use',
        'url'   => 'https://www.marriott.com/about/terms-of-use.mi',
    ),
);

$fallback_two = array(
    array(
        'label' => 'Jobs',
        'url'   => 'https://jobs.marriott.com/marriott/jobs?page=1&brand=Moxy+Hotels',
    ),
    array(
        'label' => 'About Moxy Guestbook',
        'url'   => 'https://www.instagram.com/moxyhotels/',
    ),
    array(
        'label' => 'Privacy Statement',
        'url'   => 'https://www.marriott.com/about/privacy.mi',
    ),
);
?>
<footer <?php echo $wrapper_attributes; ?>>
    <div class="moxy-footer__inner alignwide">
        <div class="wp-block-columns are-vertically-aligned-top moxy-footer__columns">
            <div class="wp-block-column is-vertically-aligned-top moxy-footer__menu-column" style="flex-basis:18%">
                <?php echo $footer_nav_markup( $menu_one_ref, $fallback_one ); ?>
            </div>
            <div class="wp-block-column is-vertically-aligned-top moxy-footer__menu-column" style="flex-basis:18%">
                <?php echo $footer_nav_markup( $menu_two_ref, $fallback_two ); ?>
            </div>
            <div class="wp-block-column is-vertically-aligned-top moxy-footer__social-column" style="flex-basis:18%">
                <h4 class="moxy-footer__heading"><?php echo $social_heading; ?></h4>
                <?php
                echo do_blocks(
                    '<!-- wp:social-links {"iconColor":"custom-white","iconColorValue":"#ffffff","size":"has-small-icon-size","className":"has-icon-color is-style-logos-only moxy-footer__socials"} -->
                    <!-- wp:social-link {"url":"https://www.instagram.com/moxyhotels/","service":"instagram"} /-->
                    <!-- wp:social-link {"url":"https://www.facebook.com/moxyhotels","service":"facebook"} /-->
                    <!-- wp:social-link {"url":"https://www.youtube.com/","service":"youtube"} /-->
                    <!-- /wp:social-links -->'
                );
                ?>
            </div>
            <div class="wp-block-column is-vertically-aligned-top moxy-footer__promo-column" style="flex-basis:46%">
                <div class="moxy-footer__promo-box">
                    <div class="moxy-footer__welcome-cards">
                        <p class="moxy-footer__welcome-card">WELCOME</p>
                        <p class="moxy-footer__welcome-card">WELCOME</p>
                    </div>
                    <p class="moxy-footer__promo-copy"><?php echo $promo_copy; ?></p>
                    <div class="wp-block-button moxy-footer__promo-button">
                        <a class="wp-block-button__link wp-element-button" href="<?php echo $promo_button_url; ?>"><?php echo $promo_button_label; ?></a>
                    </div>
                    <div class="moxy-footer__badges">
                        <a class="moxy-footer__badge" href="https://apps.apple.com/"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/appstore-apple.webp' ) ); ?>" alt="Download on the App Store" /></a>
                        <a class="moxy-footer__badge" href="https://play.google.com/"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/appstore-google.webp' ) ); ?>" alt="Get it on Google Play" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo do_blocks( '<!-- wp:pattern {"slug":"cph/moxy-bonvoy"} /-->' ); ?>
    <div class="moxy-footer__legal-strip alignfull">
        <p class="moxy-footer__legal-copy"><?php echo $legal_copy; ?></p>
    </div>
</footer>
