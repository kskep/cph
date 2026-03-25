<?php
/**
 * Title: CPH Header
 * Slug: cph/header
 * Description: Header for the CPH front page.
 * Categories: header, cph/cph
 * Keywords: header, nav, CPH
 * Viewport Width: 1440
 * Block Types: core/template-part/header
 * Post Types: wp_template
 * Inserter: true
 */
?>
<!-- wp:group {"align":"full","className":"cph-header","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull cph-header"><!-- wp:group {"className":"cph-header__brand","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group cph-header__brand"><!-- wp:html -->
<a class="cph-header__logo-mark" href="/" aria-label="CPH Hotels home">
<svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
<path d="M20 10L25 40L30 10H35L40 40L45 10H50L42.5 45H37.5L32.5 15L27.5 45H22.5L15 10H20Z" fill="currentColor"></path>
<text x="55" y="35" font-family="Montserrat, Arial, sans-serif" font-weight="800" font-size="24" fill="currentColor">CPH</text>
<text x="55" y="45" font-family="Montserrat, Arial, sans-serif" font-weight="400" font-size="8" fill="currentColor" letter-spacing="2">HOTELS</text>
</svg>
</a>
<!-- /wp:html --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"cph-header__right","layout":{"type":"default"}} -->
<div class="wp-block-group cph-header__right"><!-- wp:group {"className":"cph-header__utility","layout":{"type":"flex","justifyContent":"right","verticalAlignment":"center","flexWrap":"nowrap"}} -->
<div class="wp-block-group cph-header__utility"><!-- wp:paragraph {"className":"cph-header__utility-item cph-header__utility-item--language","fontSize":"xsmall"} -->
<p class="cph-header__utility-item cph-header__utility-item--language has-xsmall-font-size">English</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"cph-header__main","layout":{"type":"flex","justifyContent":"right","verticalAlignment":"center","flexWrap":"nowrap"}} -->
<div class="wp-block-group cph-header__main"><!-- wp:navigation {"overlayMenu":"mobile","icon":"menu","className":"cph-header__nav","layout":{"type":"flex","justifyContent":"right"},"style":{"spacing":{"blockGap":"1.25rem"}}} -->
<!-- wp:navigation-link {"label":"Places to Stay","url":"#book-your-stay","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Explore CPH","url":"#how-we-play","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Offers","url":"#bonvoy","kind":"custom"} /-->
<!-- /wp:navigation -->

<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"cph-coral","textColor":"custom-off-black","className":"cph-header__cta js-booking-open"} -->
<div class="wp-block-button cph-header__cta js-booking-open"><a class="wp-block-button__link has-custom-off-black-color has-cph-coral-background-color has-text-color has-background wp-element-button" href="#book-your-stay">Get a Room</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
