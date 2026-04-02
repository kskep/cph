<?php
/**
 * Title: Room Comparison
 * Slug: cph/room-comparison
 * Description: A layout for comparing multiple rooms side-by-side. Useful for guests choosing between similar room types.
 * Categories: cph/pages
 * Keywords: rooms, comparison, compare, side-by-side
 * Viewport Width: 1440
 * Inserter: true
 */
?>

<!-- wp:group {"tagName":"main","className":"cph-room-comparison-page"} -->
<main class="wp-block-group cph-room-comparison-page">

    <!-- wp:group {"className":"cph-container","layout":{"type":"constrained"}} -->
    <div class="wp-block-group cph-container">

        <!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
        <h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Compare Our Rooms</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Compare room features, amenities, and details to find your perfect match.</p>
        <!-- /wp:paragraph -->

        <!-- wp:spacer {"height":"40px"} -->
        <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:columns -->
        <div class="wp-block-columns">

            <!-- wp:column -->
            <div class="wp-block-column">

                <!-- wp:cph/room-card {
                    "layout": "vertical",
                    "showDetails": true,
                    "showAmenitiesPreview": true,
                    "amenitiesPreviewCount": 4,
                    "shortDescription": "Our comfortable standard room with all essential amenities for a relaxing stay.",
                    "occupancy": 2,
                    "bedType": "Queen Bed",
                    "roomSize": "320 sq ft / 30 m²",
                    "viewType": "City View",
                    "floorLevel": "2nd-5th Floor"
                } /-->

            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column">

                <!-- wp:cph/room-card {
                    "layout": "vertical",
                    "showDetails": true,
                    "showAmenitiesPreview": true,
                    "amenitiesPreviewCount": 4,
                    "shortDescription": "Spacious deluxe room with premium amenities and beautiful views.",
                    "occupancy": 2,
                    "bedType": "King Bed",
                    "roomSize": "450 sq ft / 42 m²",
                    "viewType": "Ocean View",
                    "floorLevel": "6th-10th Floor"
                } /-->

            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column">

                <!-- wp:cph/room-card {
                    "layout": "vertical",
                    "showDetails": true,
                    "showAmenitiesPreview": true,
                    "amenitiesPreviewCount": 4,
                    "shortDescription": "Our most luxurious suite with separate living area and panoramic views.",
                    "occupancy": 4,
                    "bedType": "King + Sofa Bed",
                    "roomSize": "750 sq ft / 70 m²",
                    "viewType": "Panoramic Ocean",
                    "floorLevel": "Penthouse"
                } /-->

            </div>
            <!-- /wp:column -->

        </div>
        <!-- /wp:columns -->

        <!-- wp:spacer {"height":"60px"} -->
        <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:group {"className":"cph-comparison-table-section","layout":{"type":"constrained"}} -->
        <div class="wp-block-group cph-comparison-table-section">

            <!-- wp:heading {"textAlign":"center","fontSize":"large"} -->
            <h3 class="wp-block-heading has-text-align-center has-large-font-size">Detailed Comparison</h3>
            <!-- /wp:heading -->

            <!-- wp:table {"className":"cph-comparison-table"} -->
            <figure class="wp-block-table cph-comparison-table">
                <table>
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Standard Room</th>
                            <th>Deluxe Room</th>
                            <th>Suite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Room Size</td>
                            <td>320 sq ft</td>
                            <td>450 sq ft</td>
                            <td>750 sq ft</td>
                        </tr>
                        <tr>
                            <td>Max Occupancy</td>
                            <td>2 Guests</td>
                            <td>2 Guests</td>
                            <td>4 Guests</td>
                        </tr>
                        <tr>
                            <td>Bed Type</td>
                            <td>Queen</td>
                            <td>King</td>
                            <td>King + Sofa</td>
                        </tr>
                        <tr>
                            <td>View</td>
                            <td>City</td>
                            <td>Ocean</td>
                            <td>Panoramic</td>
                        </tr>
                        <tr>
                            <td>Free WiFi</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Smart TV</td>
                            <td>✓</td>
                            <td>✓ (55")</td>
                            <td>✓ (65")</td>
                        </tr>
                        <tr>
                            <td>Minibar</td>
                            <td>Basic</td>
                            <td>Premium</td>
                            <td>Complimentary</td>
                        </tr>
                        <tr>
                            <td>Balcony</td>
                            <td>—</td>
                            <td>✓</td>
                            <td>✓ (Large)</td>
                        </tr>
                        <tr>
                            <td>Living Area</td>
                            <td>—</td>
                            <td>—</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Priority Checkout</td>
                            <td>—</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                    </tbody>
                </table>
            </figure>
            <!-- /wp:table -->

        </div>
        <!-- /wp:group -->

        <!-- wp:spacer {"height":"60px"} -->
        <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:group {"style":{"background":{"color":"#F9C740"}},"className":"cph-comparison-cta","layout":{"type":"constrained"}} -->
        <div class="wp-block-group cph-comparison-cta has-background" style="background-color:#F9C740">

            <!-- wp:spacer {"height":"40px"} -->
            <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center"><strong>Still deciding?</strong> Our team can help you choose the perfect room.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">

                <!-- wp:button -->
                <div class="wp-block-button">
                    <a class="wp-block-button__link wp-element-button" href="/contact">Get Help Choosing</a>
                </div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline"} -->
                <div class="wp-block-button is-style-outline">
                    <a class="wp-block-button__link wp-element-button" href="tel:+1234567890">Call Us</a>
                </div>
                <!-- /wp:button -->

            </div>
            <!-- /wp:buttons -->

            <!-- wp:spacer {"height":"40px"} -->
            <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

        </div>
        <!-- /wp:group -->

        <!-- wp:spacer {"height":"40px"} -->
        <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">

            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline">
                <a class="wp-block-button__link wp-element-button" href="/rooms">← View All Rooms</a>
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
