<?php
/**
 * Title: Room Archive
 * Slug: cph/room-archive
 * Description: A full page layout for displaying a grid of rooms filtered by hotel location. Includes hero section, room grid, and booking CTA.
 * Categories: cph/pages
 * Keywords: rooms, archive, grid, hotel
 * Viewport Width: 1440
 * Inserter: true
 */
?>

<!-- wp:group {"tagName":"main","className":"cph-room-archive-page"} -->
<main class="wp-block-group cph-room-archive-page">
    
    <!-- wp:cph/hero {
        "heroImageUrl": "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1920&h=1080&fit=crop",
        "heroImageAlt": "Luxury hotel rooms",
        "taglineLineOne": "Our Rooms",
        "taglineLineTwo": "Comfort & Style",
        "brandLabel": "CPH Hotels"
    } /-->

    <!-- wp:spacer {"height":"60px"} -->
    <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"className":"cph-container","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-container">
        
        <!-- wp:heading {"textAlign":"center","fontSize":"large"} -->
        <h2 class="wp-block-heading has-text-align-center has-large-font-size">Choose Your Perfect Room</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Discover our collection of thoughtfully designed rooms and suites. Each space is crafted for comfort and style.</p>
        <!-- /wp:paragraph -->

        <!-- wp:spacer {"height":"40px"} -->
        <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:cph/rooms-query {
            "hotelLocation": "",
            "postsPerPage": 12,
            "columns": 3,
            "orderBy": "menu_order",
            "order": "asc",
            "showEmptyState": true,
            "emptyStateTitle": "No rooms available",
            "emptyStateMessage": "Please check back later for room availability."
        } /-->

    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"80px"} -->
    <div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"style":{"background":{"color":"#F9C740"}},"className":"cph-room-archive-cta","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-room-archive-cta has-background" style="background-color:#F9C740">
        
        <!-- wp:spacer {"height":"60px"} -->
        <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:group {"className":"cph-container","layout":{"type":"constrained"}} -->
        <div class="wp-block-group cph-container">
            
            <!-- wp:columns -->
            <div class="wp-block-columns">
                
                <!-- wp:column {"width":"60%"} -->
                <div class="wp-block-column" style="flex-basis:60%">
                    
                    <!-- wp:heading {"fontSize":"large"} -->
                    <h2 class="wp-block-heading has-large-font-size">Need Help Choosing?</h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p>Our reservations team is here to help you find the perfect room for your stay. Contact us for personalized recommendations.</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons">
                        
                        <!-- wp:button -->
                        <div class="wp-block-button">
                            <a class="wp-block-button__link wp-element-button" href="/contact">Contact Us</a>
                        </div>
                        <!-- /wp:button -->

                        <!-- wp:button {"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline">
                            <a class="wp-block-button__link wp-element-button" href="tel:+1234567890">Call Now</a>
                        </div>
                        <!-- /wp:button -->

                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column {"width":"40%"} -->
                <div class="wp-block-column" style="flex-basis:40%">
                    
                    <!-- wp:group {"className":"cph-contact-info"} -->
                    <div class="wp-block-group cph-contact-info">
                        
                        <!-- wp:paragraph -->
                        <p><strong>Reservations</strong><br>+1 (234) 567-890<br>reservations@cphhotels.com</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph -->
                        <p><strong>Hours</strong><br>24 hours a day, 7 days a week</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

        <!-- wp:spacer {"height":"60px"} -->
        <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

    </div>
    <!-- /wp:group -->

</main>
<!-- /wp:group -->
