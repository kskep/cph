<?php
/**
 * Room Features Block Render Template
 * 
 * @package cph
 */

$defaults = array(
    'occupancy'         => 2,
    'bedType'           => 'King Bed',
    'roomSize'          => '',
    'viewType'          => '',
    'floorLevel'        => '',
    'amenities'         => array(
        array( 'icon' => 'wifi', 'label' => 'Free WiFi', 'category' => 'technology' ),
        array( 'icon' => 'ac', 'label' => 'Air Conditioning', 'category' => 'comfort' ),
        array( 'icon' => 'tv', 'label' => 'Smart TV', 'category' => 'technology' ),
        array( 'icon' => 'minibar', 'label' => 'Minibar', 'category' => 'dining' ),
        array( 'icon' => 'safe', 'label' => 'In-Room Safe', 'category' => 'security' ),
        array( 'icon' => 'coffee', 'label' => 'Coffee Maker', 'category' => 'dining' ),
    ),
    'shortDescription'  => '',
    'longDescription'   => '',
    'displayStyle'      => 'list',
    'groupByCategory'   => false,
    'showIcons'         => true,
    'highlightFeatures' => array(),
);

$attrs = wp_parse_args( $attributes, $defaults );

// Get current room post data if in context
$room_post = get_post();
$is_room = $room_post && $room_post->post_type === 'cph_room';

// On single room pages, prefer room meta over placeholder block defaults.
if ( $is_room ) {
    $meta_occupancy = get_post_meta( $room_post->ID, 'occupancy', true );
    if ( '' !== $meta_occupancy && null !== $meta_occupancy ) {
        $attrs['occupancy'] = $meta_occupancy;
    }

    $meta_bed_type = get_post_meta( $room_post->ID, 'bed_type', true );
    if ( '' !== $meta_bed_type ) {
        $attrs['bedType'] = $meta_bed_type;
    }

    if ( empty( $attrs['roomSize'] ) ) {
        $attrs['roomSize'] = get_post_meta( $room_post->ID, 'room_size', true ) ?: '';
    }
    if ( empty( $attrs['viewType'] ) ) {
        $attrs['viewType'] = get_post_meta( $room_post->ID, 'view_type', true ) ?: '';
    }
    if ( empty( $attrs['floorLevel'] ) ) {
        $attrs['floorLevel'] = get_post_meta( $room_post->ID, 'floor_level', true ) ?: '';
    }
    if ( empty( $attrs['shortDescription'] ) ) {
        $attrs['shortDescription'] = get_the_excerpt( $room_post );
    }
    if ( empty( $attrs['longDescription'] ) ) {
        $attrs['longDescription'] = get_the_content( null, false, $room_post );
    }
    
    $term_amenities = cph_get_room_amenities_data( $room_post->ID );
    if ( ! empty( $term_amenities ) ) {
        $attrs['amenities'] = $term_amenities;
    }
}

// Prepare data
$occupancy   = absint( $attrs['occupancy'] );
$bed_type    = esc_html( $attrs['bedType'] );
$room_size   = esc_html( $attrs['roomSize'] );
$view_type   = esc_html( $attrs['viewType'] );
$floor_level = esc_html( $attrs['floorLevel'] );
$short_desc  = ! empty( $attrs['shortDescription'] ) ? wp_kses_post( $attrs['shortDescription'] ) : '';
$long_desc   = ! empty( $attrs['longDescription'] ) ? wp_kses_post( $attrs['longDescription'] ) : '';

$amenities = is_array( $attrs['amenities'] ) ? $attrs['amenities'] : array();

// Group amenities by category if enabled
if ( $attrs['groupByCategory'] && ! empty( $amenities ) ) {
    $grouped_amenities = array();
    foreach ( $amenities as $amenity ) {
        $category = ! empty( $amenity['category'] ) ? $amenity['category'] : 'general';
        if ( ! isset( $grouped_amenities[$category] ) ) {
            $grouped_amenities[$category] = array();
        }
        $grouped_amenities[$category][] = $amenity;
    }
} else {
    $grouped_amenities = array( 'all' => $amenities );
}

// Category labels
$category_labels = array(
    'all'           => __( 'Amenities', 'cph' ),
    'general'       => __( 'General', 'cph' ),
    'technology'    => __( 'Technology', 'cph' ),
    'comfort'       => __( 'Comfort', 'cph' ),
    'dining'        => __( 'Dining', 'cph' ),
    'security'      => __( 'Security', 'cph' ),
    'bathroom'      => __( 'Bathroom', 'cph' ),
    'accessibility' => __( 'Accessibility', 'cph' ),
);

$display_class = 'cph-room-features--' . esc_attr( $attrs['displayStyle'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-room-features ' . $display_class,
    )
);
?>
<div <?php echo $wrapper_attributes; ?>>
    
    <?php if ( $short_desc ) : ?>
        <div class="cph-room-features__short-description">
            <p><?php echo $short_desc; ?></p>
        </div>
    <?php endif; ?>
    
    <!-- Room Specifications -->
    <div class="cph-room-features__specs">
        <h3 class="cph-room-features__heading"><?php esc_html_e( 'Room Details', 'cph' ); ?></h3>
        <ul class="cph-room-features__specs-list">
            <?php if ( $occupancy ) : ?>
                <li class="cph-room-features__spec-item">
                    <?php if ( $attrs['showIcons'] ) : ?>
                        <span class="cph-room-features__spec-icon icon-users" aria-hidden="true"></span>
                    <?php endif; ?>
                    <span class="cph-room-features__spec-label"><?php esc_html_e( 'Occupancy', 'cph' ); ?></span>
                    <span class="cph-room-features__spec-value"><?php echo $occupancy; ?> <?php echo _n( 'Guest', 'Guests', $occupancy, 'cph' ); ?></span>
                </li>
            <?php endif; ?>
            
            <?php if ( $bed_type ) : ?>
                <li class="cph-room-features__spec-item">
                    <?php if ( $attrs['showIcons'] ) : ?>
                        <span class="cph-room-features__spec-icon icon-bed" aria-hidden="true"></span>
                    <?php endif; ?>
                    <span class="cph-room-features__spec-label"><?php esc_html_e( 'Beds', 'cph' ); ?></span>
                    <span class="cph-room-features__spec-value"><?php echo $bed_type; ?></span>
                </li>
            <?php endif; ?>
            
            <?php if ( $room_size ) : ?>
                <li class="cph-room-features__spec-item">
                    <?php if ( $attrs['showIcons'] ) : ?>
                        <span class="cph-room-features__spec-icon icon-resize" aria-hidden="true"></span>
                    <?php endif; ?>
                    <span class="cph-room-features__spec-label"><?php esc_html_e( 'Size', 'cph' ); ?></span>
                    <span class="cph-room-features__spec-value"><?php echo $room_size; ?></span>
                </li>
            <?php endif; ?>
            
            <?php if ( $view_type ) : ?>
                <li class="cph-room-features__spec-item">
                    <?php if ( $attrs['showIcons'] ) : ?>
                        <span class="cph-room-features__spec-icon icon-eye" aria-hidden="true"></span>
                    <?php endif; ?>
                    <span class="cph-room-features__spec-label"><?php esc_html_e( 'View', 'cph' ); ?></span>
                    <span class="cph-room-features__spec-value"><?php echo $view_type; ?></span>
                </li>
            <?php endif; ?>
            
            <?php if ( $floor_level ) : ?>
                <li class="cph-room-features__spec-item">
                    <?php if ( $attrs['showIcons'] ) : ?>
                        <span class="cph-room-features__spec-icon icon-building" aria-hidden="true"></span>
                    <?php endif; ?>
                    <span class="cph-room-features__spec-label"><?php esc_html_e( 'Floor', 'cph' ); ?></span>
                    <span class="cph-room-features__spec-value"><?php echo $floor_level; ?></span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    
    <!-- Amenities -->
    <?php if ( ! empty( $amenities ) ) : ?>
        <div class="cph-room-features__amenities">
            <?php foreach ( $grouped_amenities as $category => $category_amenities ) : 
                if ( empty( $category_amenities ) ) continue;
                $category_label = isset( $category_labels[$category] ) ? $category_labels[$category] : $category_labels['all'];
            ?>
                <div class="cph-room-features__amenity-group cph-room-features__amenity-group--<?php echo esc_attr( $category ); ?>">
                    <h4 class="cph-room-features__amenity-heading"><?php echo esc_html( $category_label ); ?></h4>
                    <ul class="cph-room-features__amenity-list">
                        <?php foreach ( $category_amenities as $amenity ) : 
                            $amenity_icon  = ! empty( $amenity['icon'] ) ? esc_attr( $amenity['icon'] ) : '';
                            $amenity_label = ! empty( $amenity['label'] ) ? esc_html( $amenity['label'] ) : '';
                            $amenity_font_family = ! empty( $amenity['fontFamily'] ) && 'inherit' !== $amenity['fontFamily'] ? $amenity['fontFamily'] : '';
                            $amenity_label_style = $amenity_font_family ? 'font-family: ' . esc_attr( $amenity_font_family ) . ', sans-serif;' : '';
                            if ( ! $amenity_label ) continue;
                        ?>
                            <li class="cph-room-features__amenity-item">
                                <?php if ( $attrs['showIcons'] && $amenity_icon ) : ?>
                                    <span class="cph-room-features__amenity-icon icon-<?php echo $amenity_icon; ?>" aria-hidden="true"></span>
                                <?php endif; ?>
                                <span class="cph-room-features__amenity-label"<?php echo $amenity_label_style ? ' style="' . $amenity_label_style . '"' : ''; ?>><?php echo $amenity_label; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <!-- Long Description -->
    <?php if ( $long_desc ) : ?>
        <div class="cph-room-features__long-description">
            <h3 class="cph-room-features__heading"><?php esc_html_e( 'About This Room', 'cph' ); ?></h3>
            <div class="cph-room-features__description-content">
                <?php echo wpautop( $long_desc ); ?>
            </div>
        </div>
    <?php endif; ?>
    
</div>
