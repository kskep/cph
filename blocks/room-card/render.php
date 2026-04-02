<?php
/**
 * Room Card Block Render Template
 * 
 * @package cph
 */

$defaults = array(
    'roomId'                => 0,
    'layout'                => 'vertical',
    'showDetails'           => true,
    'showAmenitiesPreview'  => true,
    'amenitiesPreviewCount' => 4,
    'desktopImageId'        => 0,
    'desktopImageUrl'       => '',
    'desktopImageAlt'       => '',
    'mobileImageId'         => 0,
    'mobileImageUrl'        => '',
    'mobileImageAlt'        => '',
    'shortDescription'      => '',
    'occupancy'             => 2,
    'bedType'               => 'King Bed',
    'roomSize'              => '',
    'viewType'              => '',
    'floorLevel'            => '',
    'amenities'             => array(
        array( 'icon' => 'wifi', 'label' => 'Free WiFi' ),
        array( 'icon' => 'ac', 'label' => 'Air Conditioning' ),
        array( 'icon' => 'tv', 'label' => 'Smart TV' ),
        array( 'icon' => 'minibar', 'label' => 'Minibar' ),
    ),
    'bookingUrl'            => '',
    'viewRoomText'          => 'View Room',
    'bookNowText'           => 'Book Now',
);

$attrs = wp_parse_args( $attributes, $defaults );

// If roomId is set, try to get room data from post
$room_post = null;
$room_title = 'Room';
$room_permalink = '#';

if ( ! empty( $attrs['roomId'] ) ) {
    $room_post = get_post( $attrs['roomId'] );
    if ( $room_post && $room_post->post_type === 'cph_room' ) {
        $room_title = get_the_title( $room_post );
        $room_permalink = get_permalink( $room_post );
        
        // Get room meta data if not manually set
        if ( empty( $attrs['shortDescription'] ) ) {
            $attrs['shortDescription'] = get_the_excerpt( $room_post );
        }
        
        // Get featured image if not manually set
        if ( empty( $attrs['desktopImageUrl'] ) ) {
            $featured_image = get_the_post_thumbnail_url( $room_post, 'large' );
            if ( $featured_image ) {
                $attrs['desktopImageUrl'] = $featured_image;
                $attrs['desktopImageAlt'] = get_post_meta( get_post_thumbnail_id( $room_post ), '_wp_attachment_image_alt', true );
            }
        }

        $term_amenities = cph_get_room_amenities_data( $room_post->ID );
        if ( ! empty( $term_amenities ) ) {
            $attrs['amenities'] = $term_amenities;
        }
    }
}

// Image handling with mobile fallback
$desktop_image_url = ! empty( $attrs['desktopImageUrl'] ) ? esc_url( $attrs['desktopImageUrl'] ) : 'https://via.placeholder.com/600x400?text=Room+Image';
$desktop_image_alt = ! empty( $attrs['desktopImageAlt'] ) ? esc_attr( $attrs['desktopImageAlt'] ) : esc_attr( $room_title );
$has_mobile_image  = ! empty( $attrs['mobileImageUrl'] ) && $attrs['mobileImageUrl'] !== $attrs['desktopImageUrl'];
$mobile_image_url  = $has_mobile_image ? esc_url( $attrs['mobileImageUrl'] ) : '';
$mobile_image_alt  = ! empty( $attrs['mobileImageAlt'] ) ? esc_attr( $attrs['mobileImageAlt'] ) : $desktop_image_alt;

// Room details
$short_description = ! empty( $attrs['shortDescription'] ) ? esc_html( $attrs['shortDescription'] ) : '';
$occupancy         = absint( $attrs['occupancy'] );
$bed_type          = ! empty( $attrs['bedType'] ) ? esc_html( $attrs['bedType'] ) : '';
$room_size         = ! empty( $attrs['roomSize'] ) ? esc_html( $attrs['roomSize'] ) : '';
$view_type         = ! empty( $attrs['viewType'] ) ? esc_html( $attrs['viewType'] ) : '';
$floor_level       = ! empty( $attrs['floorLevel'] ) ? esc_html( $attrs['floorLevel'] ) : '';
$booking_url       = ! empty( $attrs['bookingUrl'] ) ? esc_url( $attrs['bookingUrl'] ) : '';
$view_room_text    = esc_html( $attrs['viewRoomText'] );
$book_now_text     = esc_html( $attrs['bookNowText'] );

// Amenities
$amenities         = is_array( $attrs['amenities'] ) ? $attrs['amenities'] : array();
$amenities_preview = array_slice( $amenities, 0, absint( $attrs['amenitiesPreviewCount'] ) );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-room-card cph-room-card--' . esc_attr( $attrs['layout'] ),
    )
);
?>
<article <?php echo $wrapper_attributes; ?>>
    <div class="cph-room-card__image-wrapper">
        <!-- Desktop Image -->
        <img 
            src="<?php echo $desktop_image_url; ?>" 
            alt="<?php echo $desktop_image_alt; ?>" 
            class="cph-room-card__image cph-room-card__image--desktop"
            loading="lazy"
        >
        <?php if ( $has_mobile_image ) : ?>
            <!-- Mobile Image -->
            <img 
                src="<?php echo $mobile_image_url; ?>" 
                alt="<?php echo $mobile_image_alt; ?>" 
                class="cph-room-card__image cph-room-card__image--mobile"
                loading="lazy"
            >
        <?php endif; ?>
    </div>
    
    <div class="cph-room-card__content">
        <h3 class="cph-room-card__title">
            <?php echo esc_html( $room_title ); ?>
        </h3>
        
        <?php if ( $attrs['showDetails'] ) : ?>
            <div class="cph-room-card__details">
                <?php if ( $short_description ) : ?>
                    <p class="cph-room-card__description"><?php echo $short_description; ?></p>
                <?php endif; ?>
                
                <div class="cph-room-card__specs">
                    <?php if ( $occupancy ) : ?>
                        <span class="cph-room-card__spec">
                            <span class="cph-room-card__spec-label">Sleeps</span>
                            <span class="cph-room-card__spec-value"><?php echo $occupancy; ?></span>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ( $bed_type ) : ?>
                        <span class="cph-room-card__spec">
                            <span class="cph-room-card__spec-value"><?php echo $bed_type; ?></span>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ( $room_size ) : ?>
                        <span class="cph-room-card__spec">
                            <span class="cph-room-card__spec-value"><?php echo $room_size; ?></span>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ( $view_type ) : ?>
                        <span class="cph-room-card__spec">
                            <span class="cph-room-card__spec-value"><?php echo $view_type; ?></span>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ( $floor_level ) : ?>
                        <span class="cph-room-card__spec">
                            <span class="cph-room-card__spec-value"><?php echo $floor_level; ?></span>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ( $attrs['showAmenitiesPreview'] && ! empty( $amenities_preview ) ) : ?>
            <div class="cph-room-card__amenities">
                <?php foreach ( $amenities_preview as $amenity ) : 
                    $amenity_label = ! empty( $amenity['label'] ) ? esc_html( $amenity['label'] ) : '';
                    $amenity_icon_markup = cph_render_amenity_icon( $amenity );
                    if ( $amenity_label ) :
                ?>
                    <span class="cph-room-card__amenity">
                        <?php if ( $amenity_icon_markup ) : ?>
                            <span class="cph-room-card__amenity-icon"><?php echo wp_kses_post( $amenity_icon_markup ); ?></span>
                        <?php endif; ?>
                        <span class="cph-room-card__amenity-label"><?php echo $amenity_label; ?></span>
                    </span>
                <?php endif; endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="cph-room-card__actions">
            <a href="<?php echo $room_permalink; ?>" class="cph-room-card__button">
                <?php echo $view_room_text; ?>
            </a>
            <?php if ( $booking_url ) : ?>
                <a href="<?php echo $booking_url; ?>" class="cph-room-card__button cph-room-card__button--primary" target="_blank" rel="noopener noreferrer">
                    <?php echo $book_now_text; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>
