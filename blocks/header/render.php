<?php
$defaults = array(
    'logoUrl'       => '',
    'logoAlt'       => 'Citi Plus Hotels',
    'navigationRef' => 0,
    'languageLabel' => 'English',
    'emailLabel'    => 'info@citiplushotels.gr',
    'emailUrl'      => 'mailto:info@citiplushotels.gr',
    'ctaLabel'      => 'Get a Room',
    'ctaUrl'        => '#book-your-stay',
);

$attrs = wp_parse_args( $attributes, $defaults );

$logo_url       = esc_url( $attrs['logoUrl'] );
$logo_alt       = esc_attr( $attrs['logoAlt'] );
$navigation_ref = absint( $attrs['navigationRef'] );
$language_label = esc_html( $attrs['languageLabel'] );
$email_label    = esc_html( $attrs['emailLabel'] );
$email_url      = esc_url( $attrs['emailUrl'] );
$cta_label      = esc_html( $attrs['ctaLabel'] );
$cta_url        = esc_url( $attrs['ctaUrl'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-header js-cph-header alignfull',
    )
);

$has_navigation_ref = $navigation_ref > 0 && get_post_type( $navigation_ref ) === 'wp_navigation';
if ( $has_navigation_ref ) {
    $navigation_markup = do_blocks(
        '<!-- wp:navigation {"ref":' . (int) $navigation_ref . ',"overlayMenu":"mobile","icon":"menu","className":"cph-header__nav","layout":{"type":"flex","justifyContent":"center"}} /-->'
    );
} else {
    $navigation_markup = do_blocks(
        '<!-- wp:navigation {"overlayMenu":"mobile","icon":"menu","className":"cph-header__nav","layout":{"type":"flex","justifyContent":"center"}} -->
        <!-- wp:navigation-link {"label":"Places to Stay","url":"#book-your-stay","kind":"custom"} /-->
        <!-- wp:navigation-link {"label":"Explore CPH","url":"#how-we-play","kind":"custom"} /-->
        <!-- wp:navigation-link {"label":"Offers","url":"#bonvoy","kind":"custom"} /-->
        <!-- /wp:navigation -->'
    );
}
?>
<header <?php echo $wrapper_attributes; ?>>
    <div class="cph-header__utility">
        <div class="cph-header__utility-inner alignwide">
            <p class="cph-header__utility-item cph-header__utility-item--language"><?php echo $language_label; ?></p>
            <p class="cph-header__utility-item cph-header__utility-item--email"><a href="<?php echo $email_url; ?>"><?php echo $email_label; ?></a></p>
        </div>
    </div>
    <div class="cph-header__inner alignwide">
        <div class="cph-header__brand">
            <?php if ( $logo_url ) : ?>
                <a class="cph-header__logo-mark cph-header__logo-mark--image" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Home">
                    <img src="<?php echo $logo_url; ?>" alt="<?php echo $logo_alt; ?>" />
                </a>
            <?php else : ?>
                <a class="cph-header__logo-mark" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="CPH Hotels home">
                    <svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M20 10L25 40L30 10H35L40 40L45 10H50L42.5 45H37.5L32.5 15L27.5 45H22.5L15 10H20Z" fill="currentColor"></path>
                        <text x="55" y="35" font-family="Montserrat, Arial, sans-serif" font-weight="800" font-size="24" fill="currentColor">CPH</text>
                        <text x="55" y="45" font-family="Montserrat, Arial, sans-serif" font-weight="400" font-size="8" fill="currentColor" letter-spacing="2">HOTELS</text>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <?php echo $navigation_markup; ?>
        <div class="cph-header__actions">
            <div class="wp-block-button cph-header__cta js-booking-open">
                <a class="wp-block-button__link wp-element-button" href="<?php echo $cta_url; ?>"><?php echo $cta_label; ?></a>
            </div>
        </div>
    </div>
</header>
