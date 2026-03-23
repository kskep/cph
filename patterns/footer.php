<?php
/**
 * Title: Moxy Footer
 * Slug: cph/footer
 * Description: Footer for the Moxy front page.
 * Categories: footer, cph/moxy
 * Block Types: core/template-part/footer
 * Keywords: footer, nav, moxy
 * Viewport Width: 1440
 * Post Types: wp_template
 * Inserter: true
 */
?>
<!-- wp:group {"align":"full","className":"moxy-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull moxy-footer"><!-- wp:group {"align":"wide","className":"moxy-footer__inner","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide moxy-footer__inner"><!-- wp:columns {"verticalAlignment":"top","className":"moxy-footer__columns"} -->
<div class="wp-block-columns are-vertically-aligned-top moxy-footer__columns"><!-- wp:column {"verticalAlignment":"top","width":"36%","className":"moxy-footer__brand-column"} -->
<div class="wp-block-column is-vertically-aligned-top moxy-footer__brand-column" style="flex-basis:36%"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"moxy-footer__logo"} -->
<figure class="wp-block-image size-full moxy-footer__logo"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/Moxy_logo_Reversed.svg' ) ); ?>" alt="Moxy Hotels"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"moxy-footer__copy"} -->
<p class="moxy-footer__copy">Smart rooms, loud personality, and bars that know how to keep the night moving.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"url","href":"https://mobileapp.marriott.com/","className":"moxy-footer__devices"} -->
<figure class="wp-block-image size-full moxy-footer__devices"><a href="https://mobileapp.marriott.com/"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/devices.webp' ) ); ?>" alt="Compatible mobile and desktop screens as a montage"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"34%","className":"moxy-footer__links"} -->
<div class="wp-block-column is-vertically-aligned-top moxy-footer__links" style="flex-basis:34%"><!-- wp:heading {"level":4,"fontSize":"small"} -->
<h4 class="wp-block-heading has-small-font-size">Explore</h4>
<!-- /wp:heading -->

<!-- wp:navigation {"overlayMenu":"never","className":"moxy-footer__nav","layout":{"type":"flex","orientation":"vertical"}} -->
<!-- wp:navigation-link {"label":"News","url":"https://news.marriott.com/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Jobs","url":"https://jobs.marriott.com/marriott/jobs?page=1&brand=Moxy+Hotels","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Hotel Development","url":"https://hotel-development.marriott.com/brands/moxy-hotels/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"About Moxy Guestbook","url":"https://www.instagram.com/moxyhotels/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Terms of Use","url":"https://www.marriott.com/about/terms-of-use.mi","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Privacy Statement","url":"https://www.marriott.com/about/privacy.mi","kind":"custom"} /-->
<!-- /wp:navigation --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"30%","className":"moxy-footer__apps"} -->
<div class="wp-block-column is-vertically-aligned-top moxy-footer__apps" style="flex-basis:30%"><!-- wp:heading {"level":4,"fontSize":"small"} -->
<h4 class="wp-block-heading has-small-font-size">Stay Connected</h4>
<!-- /wp:heading -->

<!-- wp:social-links {"iconColor":"custom-white","iconColorValue":"#ffffff","className":"has-icon-color is-style-logos-only moxy-footer__socials"} -->
<ul class="wp-block-social-links has-icon-color is-style-logos-only moxy-footer__socials"><!-- wp:social-link {"url":"https://www.instagram.com/moxyhotels/","service":"instagram"} /-->
<!-- wp:social-link {"url":"https://www.facebook.com/moxyhotels","service":"facebook"} /-->
<!-- wp:social-link {"url":"https://www.youtube.com/","service":"youtube"} /--></ul>
<!-- /wp:social-links -->

<!-- wp:paragraph {"className":"moxy-footer__app-copy","fontSize":"xsmall"} -->
<p class="moxy-footer__app-copy has-xsmall-font-size">Download the Marriott Bonvoy app to unlock your room, manage trips, and collect points on the go.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"moxy-footer__badges","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group moxy-footer__badges"><!-- wp:image {"sizeSlug":"full","linkDestination":"url","href":"https://apps.apple.com/","className":"moxy-footer__badge"} -->
<figure class="wp-block-image size-full moxy-footer__badge"><a href="https://apps.apple.com/"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/appstore-apple.webp' ) ); ?>" alt="Download on the App Store"/></a></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"url","href":"https://play.google.com/","className":"moxy-footer__badge"} -->
<figure class="wp-block-image size-full moxy-footer__badge"><a href="https://play.google.com/"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/appstore-google.webp' ) ); ?>" alt="Get it on Google Play"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"moxy-footer__legal","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
<div class="wp-block-group moxy-footer__legal"><!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">Copyright 2026 Moxy Hotels. All rights reserved.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"moxy-footer__powered"} -->
<figure class="wp-block-image size-full moxy-footer__powered"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/powered_by_logo.svg' ) ); ?>" alt="Powered by Marriott"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->