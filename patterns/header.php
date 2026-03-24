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
<!-- wp:group {"align":"full","className":"moxy-header","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull moxy-header"><!-- wp:group {"align":"full","className":"moxy-header__utility","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull moxy-header__utility"><!-- wp:group {"align":"wide","className":"moxy-header__utility-inner","layout":{"type":"flex","justifyContent":"right","verticalAlignment":"center","flexWrap":"nowrap"}} -->
<div class="wp-block-group alignwide moxy-header__utility-inner"><!-- wp:paragraph {"className":"moxy-header__utility-item moxy-header__utility-item--language","fontSize":"xsmall"} -->
<p class="moxy-header__utility-item moxy-header__utility-item--language has-xsmall-font-size">SELECT LANGUAGE</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"moxy-header__utility-item moxy-header__utility-item--account","fontSize":"xsmall"} -->
<p class="moxy-header__utility-item moxy-header__utility-item--account has-xsmall-font-size">SIGN IN OR JOIN</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"moxy-header__utility-divider","fontSize":"xsmall"} -->
<p class="moxy-header__utility-divider has-xsmall-font-size">|</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"moxy-header__utility-brand","fontSize":"xsmall"} -->
<p class="moxy-header__utility-brand has-xsmall-font-size">MARRIOTT BONVOY</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"moxy-header__inner","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center","flexWrap":"wrap"}} -->
<div class="wp-block-group alignwide moxy-header__inner"><!-- wp:group {"className":"moxy-header__brand","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group moxy-header__brand"><!-- wp:html -->
<a class="moxy-header__logo-mark" href="/" aria-label="Moxy Hotels home">
<svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
<path d="M20 10L25 40L30 10H35L40 40L45 10H50L42.5 45H37.5L32.5 15L27.5 45H22.5L15 10H20Z" fill="currentColor"></path>
<text x="55" y="35" font-family="Montserrat, Arial, sans-serif" font-weight="800" font-size="24" fill="currentColor">moxy</text>
<text x="55" y="45" font-family="Montserrat, Arial, sans-serif" font-weight="400" font-size="8" fill="currentColor" letter-spacing="2">HOTELS</text>
</svg>
</a>
<!-- /wp:html --></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlayMenu":"mobile","icon":"menu","className":"moxy-header__nav","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1.25rem"}}} -->
<!-- wp:navigation-link {"label":"Places to Stay","url":"#book-your-stay","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Explore Moxy","url":"#how-we-play","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Offers","url":"#bonvoy","kind":"custom"} /-->
<!-- /wp:navigation -->

<!-- wp:group {"className":"moxy-header__actions","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group moxy-header__actions"><!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"moxy-coral","textColor":"custom-white","className":"moxy-header__cta js-booking-open"} -->
<div class="wp-block-button moxy-header__cta js-booking-open"><a class="wp-block-button__link has-custom-white-color has-moxy-coral-background-color has-text-color has-background wp-element-button" href="#book-your-stay">Get a Room</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->