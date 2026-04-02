<?php
/**
 * Title: Single Room
 * Slug: cph/single-room
 * Description: A complete layout for individual room pages. Includes gallery, features, description, and booking CTA.
 * Categories: cph/pages
 * Keywords: room, single, detail, gallery
 * Viewport Width: 1440
 * Inserter: true
 */
?>

<!-- wp:group {"tagName":"main","className":"cph-single-room-page"} -->
<main class="wp-block-group cph-single-room-page">

    <!-- wp:group {"className":"cph-breadcrumb-section","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-breadcrumb-section">
        
        <!-- wp:paragraph {"fontSize":"small"} -->
        <p class="has-small-font-size">
            <a href="/">Home</a> / <a href="/rooms">Rooms</a> / Room Name
        </p>
        <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"20px"} -->
    <div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"className":"cph-container","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-container">

        <!-- wp:post-title {"level":1,"fontSize":"x-large"} /-->

    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"30px"} -->
    <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:cph/room-gallery {
        "layout": "featured-thumbs",
        "columns": 3,
        "featuredFirst": true,
        "enableLightbox": true,
        "showCaptions": false
    } /-->

    <!-- wp:spacer {"height":"60px"} -->
    <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"className":"cph-container","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-container">

        <!-- wp:columns -->
        <div class="wp-block-columns">

            <!-- wp:column {"width":"65%"} -->
            <div class="wp-block-column" style="flex-basis:65%">

                <!-- wp:cph/room-features {
                    "occupancy": 2,
                    "bedType": "King Bed",
                    "displayStyle": "list",
                    "groupByCategory": true,
                    "showIcons": true
                } /-->

                <!-- wp:spacer {"height":"40px"} -->
                <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:group {"className":"cph-room-long-description","layout":{"type":"constrained"}} -->
                <div class="wp-block-group cph-room-long-description">

                    <!-- wp:heading {"fontSize":"large"} -->
                    <h2 class="wp-block-heading has-large-font-size">About This Room</h2>
                    <!-- /wp:heading -->

                    <!-- wp:post-content /-->

                </div>
                <!-- /wp:group -->

                <!-- wp:spacer {"height":"40px"} -->
                <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:group {"className":"cph-room-policies","layout":{"type":"constrained"}} -->
                <div class="wp-block-group cph-room-policies">

                    <!-- wp:heading {"fontSize":"medium"} -->
                    <h3 class="wp-block-heading has-medium-font-size">Room Policies</h3>
                    <!-- /wp:heading -->

                    <!-- wp:list -->
                    <ul>
                        <li>Check-in: 3:00 PM / Check-out: 11:00 AM</li>
                        <li>Smoking is not permitted in any room</li>
                        <li>Pets are not allowed (service animals welcome)</li>
                        <li>Maximum occupancy strictly enforced</li>
                    </ul>
                    <!-- /wp:list -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"35%"} -->
            <div class="wp-block-column" style="flex-basis:35%">

                <!-- wp:cph/room-booking {
                    "buttonText": "Check Availability",
                    "buttonStyle": "primary",
                    "additionalText": "Best price guaranteed • Free cancellation • Instant confirmation",
                    "showAdditionalText": true,
                    "showHotelSwitcher": false,
                    "title": "Book This Room",
                    "subtitle": "Reserve directly with our preferred partners for the best rates",
                    "layout": "vertical",
                    "stickyOnScroll": true
                } /-->

                <!-- wp:spacer {"height":"30px"} -->
                <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:group {"style":{"background":{"color":"#f2f4f5"}},"className":"cph-room-contact","layout":{"type":"constrained"}} -->
                <div class="wp-block-group cph-room-contact has-background" style="background-color:#f2f4f5">

                    <!-- wp:spacer {"height":"20px"} -->
                    <div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
                    <!-- /wp:spacer -->

                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center"><strong>Questions?</strong></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">Our reservations team is available 24/7 to help with your booking.</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">

                        <!-- wp:button {"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline">
                            <a class="wp-block-button__link wp-element-button" href="/contact">Contact Us</a>
                        </div>
                        <!-- /wp:button -->

                    </div>
                    <!-- /wp:buttons -->

                    <!-- wp:spacer {"height":"20px"} -->
                    <div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
                    <!-- /wp:spacer -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:column -->

        </div>
        <!-- /wp:columns -->

    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"80px"} -->
    <div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"style":{"background":{"color":"#f2f4f5"}},"className":"cph-similar-rooms","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-similar-rooms has-background" style="background-color:#f2f4f5">

        <!-- wp:spacer {"height":"60px"} -->
        <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:group {"className":"cph-container","layout":{"type":"constrained"}} -->
        <div class="wp-block-group cph-container">

            <!-- wp:heading {"textAlign":"center","fontSize":"large"} -->
            <h2 class="wp-block-heading has-text-align-center has-large-font-size">You May Also Like</h2>
            <!-- /wp:heading -->

            <!-- wp:spacer {"height":"40px"} -->
            <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:cph/rooms-query {
                "hotelLocation": "",
                "postsPerPage": 3,
                "columns": 3,
                "orderBy": "rand",
                "order": "desc",
                "showEmptyState": false
            } /-->

        </div>
        <!-- /wp:group -->

        <!-- wp:spacer {"height":"60px"} -->
        <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"60px"} -->
    <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"className":"cph-container","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-container">

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">

            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline">
                <a class="wp-block-button__link wp-element-button" href="/rooms">← Back to All Rooms</a>
            </div>
            <!-- /wp:button -->

        </div>
        <!-- /wp:buttons -->

    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"60px"} -->
    <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

</main>
<!-- /wp:group -->
