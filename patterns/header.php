<?php
/**
 * Title: Moxy Header
 * Slug: cph/header
 * Description: Header for the Moxy front page.
 * Categories: header, cph/moxy
 * Keywords: header, nav, moxy
 * Viewport Width: 1440
 * Block Types: core/template-part/header
 * Post Types: wp_template
 * Inserter: true
 */
?>
<!-- wp:group {"align":"full","className":"moxy-header","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull moxy-header"><!-- wp:group {"align":"wide","className":"moxy-header__inner","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center","flexWrap":"wrap"}} -->
<div class="wp-block-group alignwide moxy-header__inner"><!-- wp:group {"className":"moxy-header__brand","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group moxy-header__brand"><!-- wp:image {"sizeSlug":"full","linkDestination":"home","className":"moxy-header__logo"} -->
<figure class="wp-block-image size-full moxy-header__logo"><a href="/"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/Moxy_logo_Reversed.svg' ) ); ?>" alt="Moxy Hotels"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"moxy-header__tagline","fontSize":"xsmall"} -->
<p class="moxy-header__tagline has-xsmall-font-size">Stylish and playful hotels for anything but ordinary stays.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlayMenu":"mobile","icon":"menu","className":"moxy-header__nav","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1.25rem"}}} -->
<!-- wp:navigation-link {"label":"Explore","url":"#how-we-play","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Now Playing","url":"#now-playing","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Rewards","url":"#bonvoy","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Stay","url":"#book-your-stay","kind":"custom"} /-->
<!-- /wp:navigation -->

<!-- wp:group {"className":"moxy-header__actions","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group moxy-header__actions"><!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-text-btn moxy-header__link"} -->
<div class="wp-block-button is-style-text-btn moxy-header__link"><a class="wp-block-button__link wp-element-button" href="#bonvoy">Sign In</a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"moxy-coral","textColor":"custom-white","className":"moxy-header__cta js-booking-open"} -->
<div class="wp-block-button moxy-header__cta js-booking-open"><a class="wp-block-button__link has-custom-white-color has-moxy-coral-background-color has-text-color has-background wp-element-button" href="#book-your-stay">Get A Room</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->