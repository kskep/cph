<?php
/**
 * Title: Moxy Hero
 * Slug: cph/moxy-hero
 * Description: Hero carousel with booking teaser and modal.
 * Categories: cph/moxy, cph/hero
 * Keywords: hero, booking, moxy
 * Viewport Width: 1440
 * Inserter: true
 */
?>
<!-- wp:group {"align":"full","anchor":"book-your-stay","className":"moxy-hero-section","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull moxy-hero-section" id="book-your-stay"><!-- wp:group {"align":"full","className":"moxy-hero-slider js-moxy-slider","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull moxy-hero-slider js-moxy-slider"><!-- wp:group {"align":"full","className":"moxy-hero-slides","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull moxy-hero-slides"><!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/ox-cocktails-bar-moxy-1-37112-classic-hor-resized.jpg' ) ); ?>","dimRatio":30,"overlayColor":"moxy-ink","isUserOverlayColor":true,"minHeight":780,"minHeightUnit":"px","align":"full","className":"moxy-hero-slide is-active","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|x-large","left":"min(6vw, 4rem)","right":"min(6vw, 4rem)"}}}} -->
<div class="wp-block-cover alignfull moxy-hero-slide is-active" style="padding-top:var(--wp--preset--spacing--xx-large);padding-right:min(6vw, 4rem);padding-bottom:var(--wp--preset--spacing--x-large);padding-left:min(6vw, 4rem);min-height:780px"><span aria-hidden="true" class="wp-block-cover__background has-moxy-ink-background-color has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background" alt="Couple having cocktails at hotel bar" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/ox-cocktails-bar-moxy-1-37112-classic-hor-resized.jpg' ) ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"bottom","align":"wide","className":"moxy-hero-slide__inner"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-bottom moxy-hero-slide__inner"><!-- wp:column {"verticalAlignment":"bottom","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:60%"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"moxy-hero__brand"} -->
<figure class="wp-block-image size-full moxy-hero__brand"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/Moxy_logo_Color.svg' ) ); ?>" alt="Moxy Hotels"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"textColor":"custom-white","className":"moxy-hero__eyebrow","fontSize":"small"} -->
<p class="moxy-hero__eyebrow has-custom-white-color has-text-color has-small-font-size">#ATTHEMOXY</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"textColor":"custom-white","className":"moxy-hero__headline","fontSize":"display"} -->
<h1 class="wp-block-heading moxy-hero__headline has-custom-white-color has-text-color has-display-font-size">PLAY ON</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"custom-white","className":"moxy-hero__body","fontSize":"medium"} -->
<p class="moxy-hero__body has-custom-white-color has-text-color has-medium-font-size">Check in at the bar, crash in a smart room, and head back downstairs when the lobby turns into the night’s best hangout.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"moxy-coral","textColor":"custom-white","className":"js-booking-open"} -->
<div class="wp-block-button js-booking-open"><a class="wp-block-button__link has-custom-white-color has-moxy-coral-background-color has-text-color has-background wp-element-button" href="#book-your-stay">Get A Room</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-text-btn"} -->
<div class="wp-block-button is-style-text-btn"><a class="wp-block-button__link wp-element-button" href="#how-we-play">How We Play</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:40%"><!-- wp:group {"className":"moxy-booking-teaser js-booking-open","layout":{"type":"constrained"}} -->
<div class="wp-block-group moxy-booking-teaser js-booking-open"><!-- wp:heading {"level":3,"className":"moxy-booking-teaser__title"} -->
<h3 class="wp-block-heading moxy-booking-teaser__title">Book Your Stay</h3>
<!-- /wp:heading -->

<!-- wp:columns {"className":"moxy-booking-teaser__fields"} -->
<div class="wp-block-columns moxy-booking-teaser__fields"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">Destination</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"moxy-booking-teaser__value"} -->
<p class="moxy-booking-teaser__value">Where to?</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">Stay Dates</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"moxy-booking-teaser__value"} -->
<p class="moxy-booking-teaser__value">Tue, Mar 10 - Wed, Mar 11</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:button {"backgroundColor":"moxy-butter","textColor":"moxy-ink","className":"moxy-booking-teaser__button"} -->
<div class="wp-block-button moxy-booking-teaser__button"><a class="wp-block-button__link has-moxy-ink-color has-moxy-butter-background-color has-text-color has-background wp-element-button" href="#book-your-stay">Hotel Search</a></div>
<!-- /wp:button --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/ox-lifestyle-dog-at-check-in-15980-wide-hor-scaled.jpg' ) ); ?>","dimRatio":40,"overlayColor":"moxy-charcoal","isUserOverlayColor":true,"minHeight":780,"minHeightUnit":"px","align":"full","className":"moxy-hero-slide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|x-large","left":"min(6vw, 4rem)","right":"min(6vw, 4rem)"}}}} -->
<div class="wp-block-cover alignfull moxy-hero-slide" style="padding-top:var(--wp--preset--spacing--xx-large);padding-right:min(6vw, 4rem);padding-bottom:var(--wp--preset--spacing--x-large);padding-left:min(6vw, 4rem);min-height:780px"><span aria-hidden="true" class="wp-block-cover__background has-moxy-charcoal-background-color has-background-dim-40 has-background-dim"></span><img class="wp-block-cover__image-background" alt="Dog at the Moxy check-in desk" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/ox-lifestyle-dog-at-check-in-15980-wide-hor-scaled.jpg' ) ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","className":"moxy-hero-alt-copy","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide moxy-hero-alt-copy"><!-- wp:paragraph {"textColor":"custom-white","fontSize":"small"} -->
<p class="has-custom-white-color has-text-color has-small-font-size">READY FOR ANYTHING</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"textColor":"custom-white","fontSize":"display"} -->
<h2 class="wp-block-heading has-custom-white-color has-text-color has-display-font-size">Stay For The Chaos, Sleep For The Reset</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"custom-white","fontSize":"medium"} -->
<p class="has-custom-white-color has-text-color has-medium-font-size">Loud colors, clever corners, and a welcome that starts with a drink instead of a queue.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/ox-lifestyle-bar-moxy-36071.jpg' ) ); ?>","dimRatio":45,"overlayColor":"moxy-ink","isUserOverlayColor":true,"minHeight":780,"minHeightUnit":"px","align":"full","className":"moxy-hero-slide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|x-large","left":"min(6vw, 4rem)","right":"min(6vw, 4rem)"}}}} -->
<div class="wp-block-cover alignfull moxy-hero-slide" style="padding-top:var(--wp--preset--spacing--xx-large);padding-right:min(6vw, 4rem);padding-bottom:var(--wp--preset--spacing--x-large);padding-left:min(6vw, 4rem);min-height:780px"><span aria-hidden="true" class="wp-block-cover__background has-moxy-ink-background-color has-background-dim-45 has-background-dim"></span><img class="wp-block-cover__image-background" alt="Lobby bar at Moxy" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/moxy/ox-lifestyle-bar-moxy-36071.jpg' ) ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","className":"moxy-hero-alt-copy","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide moxy-hero-alt-copy"><!-- wp:paragraph {"textColor":"custom-white","fontSize":"small"} -->
<p class="has-custom-white-color has-text-color has-small-font-size">NOT YOUR AVERAGE LOBBY</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"textColor":"custom-white","fontSize":"display"} -->
<h2 class="wp-block-heading has-custom-white-color has-text-color has-display-font-size">The Lobby Is The Main Event</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"custom-white","fontSize":"medium"} -->
<p class="has-custom-white-color has-text-color has-medium-font-size">Coffee in the morning, cocktails after dark, and the kind of lounge you end up posting before you reach your room.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"moxy-hero-controls","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide moxy-hero-controls"><!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"moxy-slider-button js-moxy-prev"} -->
<div class="wp-block-button moxy-slider-button js-moxy-prev"><a class="wp-block-button__link wp-element-button" href="#book-your-stay">Prev</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"moxy-slider-button js-moxy-next"} -->
<div class="wp-block-button moxy-slider-button js-moxy-next"><a class="wp-block-button__link wp-element-button" href="#book-your-stay">Next</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"className":"moxy-slider-status js-moxy-status","fontSize":"xsmall"} -->
<p class="moxy-slider-status js-moxy-status has-xsmall-font-size">1 / 3</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"moxy-booking-modal js-booking-modal","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull moxy-booking-modal js-booking-modal"><!-- wp:group {"align":"wide","className":"moxy-booking-modal__dialog","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide moxy-booking-modal__dialog"><!-- wp:group {"className":"moxy-booking-modal__header","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group moxy-booking-modal__header"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Book a Hotel</h2>
<!-- /wp:heading -->

<!-- wp:button {"className":"is-style-text-btn js-booking-close"} -->
<div class="wp-block-button is-style-text-btn js-booking-close"><a class="wp-block-button__link wp-element-button" href="#book-your-stay">Close</a></div>
<!-- /wp:button --></div>
<!-- /wp:group -->

<!-- wp:columns {"className":"moxy-booking-modal__grid"} -->
<div class="wp-block-columns moxy-booking-modal__grid"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">Destination</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"moxy-booking-field"} -->
<div class="wp-block-group moxy-booking-field"><!-- wp:paragraph -->
<p>Select Destination</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">Dates</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"moxy-booking-field"} -->
<div class="wp-block-group moxy-booking-field"><!-- wp:paragraph -->
<p>Tue, Mar 10 - Wed, Mar 11</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"className":"moxy-booking-modal__grid"} -->
<div class="wp-block-columns moxy-booking-modal__grid"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">Rooms &amp; Guests</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"moxy-booking-field"} -->
<div class="wp-block-group moxy-booking-field"><!-- wp:paragraph -->
<p>1 Room, 1 Adult, 0 Children</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">Special Rates</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"moxy-booking-field"} -->
<div class="wp-block-group moxy-booking-field"><!-- wp:paragraph -->
<p>None</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-text-btn"} -->
<div class="wp-block-button is-style-text-btn"><a class="wp-block-button__link wp-element-button" href="#bonvoy">Use Points</a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"moxy-coral","textColor":"custom-white"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-custom-white-color has-moxy-coral-background-color has-text-color has-background wp-element-button" href="#book-your-stay">Submit</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->