<?php
/**
 * Rooms Query Block Render Template
 * 
 * @package cph
 */

$defaults = array(
    'hotelLocation'     => '',
    'postsPerPage'      => 12,
    'columns'           => 3,
    'orderBy'           => 'menu_order',
    'order'             => 'asc',
    'showEmptyState'    => true,
    'emptyStateTitle'   => 'No rooms available',
    'emptyStateMessage' => 'Please check back later for room availability.',
    'showFilters'       => false,
);

$attrs = wp_parse_args( $attributes, $defaults );

// Build query args
$query_args = array(
    'post_type'      => 'cph_room',
    'posts_per_page' => absint( $attrs['postsPerPage'] ),
    'orderby'        => sanitize_key( $attrs['orderBy'] ),
    'order'          => sanitize_key( $attrs['order'] ),
    'post_status'    => 'publish',
);

// Add hotel location filter if specified
if ( ! empty( $attrs['hotelLocation'] ) ) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'cph_hotel_location',
            'field'    => 'slug',
            'terms'    => sanitize_text_field( $attrs['hotelLocation'] ),
        ),
    );
}

$rooms_query = new WP_Query( $query_args );
$columns_class = 'cph-rooms-query__grid--cols-' . absint( $attrs['columns'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-rooms-query',
    )
);
?>
<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $rooms_query->have_posts() ) : ?>
        <div class="cph-rooms-query__grid <?php echo esc_attr( $columns_class ); ?>">
            <?php while ( $rooms_query->have_posts() ) : $rooms_query->the_post(); 
                $room_id = get_the_ID();
                $room_title = get_the_title();
                $room_permalink = get_permalink();
                $room_excerpt = get_the_excerpt();
                
                // Get room meta
                $occupancy   = get_post_meta( $room_id, 'occupancy', true ) ?: 2;
                $bed_type    = get_post_meta( $room_id, 'bed_type', true ) ?: 'King Bed';
                $room_size   = get_post_meta( $room_id, 'room_size', true ) ?: '';
                $view_type   = get_post_meta( $room_id, 'view_type', true ) ?: '';
                $floor_level = get_post_meta( $room_id, 'floor_level', true ) ?: '';
                $booking_url = get_post_meta( $room_id, 'booking_url', true ) ?: '';
                
                // Get room images
                $desktop_image = get_the_post_thumbnail_url( $room_id, 'large' );
                $mobile_image  = get_post_meta( $room_id, 'mobile_image', true ) ?: $desktop_image;
                $desktop_alt   = get_post_meta( get_post_thumbnail_id( $room_id ), '_wp_attachment_image_alt', true );
                $mobile_alt    = get_post_meta( $room_id, 'mobile_image_alt', true ) ?: $desktop_alt;
                
                // Get amenities
                $amenities = cph_get_room_amenities_data( $room_id );
                if ( empty( $amenities ) ) {
                    $amenities = array(
                        array( 'label' => 'Free WiFi', 'iconFamily' => 'none', 'iconValue' => '' ),
                        array( 'label' => 'Air Conditioning', 'iconFamily' => 'none', 'iconValue' => '' ),
                        array( 'label' => 'Smart TV', 'iconFamily' => 'none', 'iconValue' => '' ),
                    );
                }
                $amenities_preview = array_slice( $amenities, 0, 4 );
            ?>
                <article class="cph-room-card cph-room-card--vertical">
                    <div class="cph-room-card__image-wrapper">
                        <?php if ( $desktop_image ) : ?>
                            <img 
                                src="<?php echo esc_url( $desktop_image ); ?>" 
                                alt="<?php echo esc_attr( $desktop_alt ); ?>" 
                                class="cph-room-card__image cph-room-card__image--desktop"
                                loading="lazy"
                            >
                        <?php endif; ?>
                        <?php if ( $mobile_image ) : ?>
                            <img 
                                src="<?php echo esc_url( $mobile_image ); ?>" 
                                alt="<?php echo esc_attr( $mobile_alt ); ?>" 
                                class="cph-room-card__image cph-room-card__image--mobile"
                                loading="lazy"
                            >
                        <?php endif; ?>
                    </div>
                    
                    <div class="cph-room-card__content">
                        <h3 class="cph-room-card__title"><?php echo esc_html( $room_title ); ?></h3>
                        
                        <?php if ( $room_excerpt ) : ?>
                            <p class="cph-room-card__description"><?php echo esc_html( $room_excerpt ); ?></p>
                        <?php endif; ?>
                        
                        <div class="cph-room-card__specs">
                            <?php if ( $occupancy ) : ?>
                                <span class="cph-room-card__spec">
                                    <span class="cph-room-card__spec-label">Sleeps</span>
                                    <span class="cph-room-card__spec-value"><?php echo esc_html( $occupancy ); ?></span>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ( $bed_type ) : ?>
                                <span class="cph-room-card__spec">
                                    <span class="cph-room-card__spec-value"><?php echo esc_html( $bed_type ); ?></span>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ( $room_size ) : ?>
                                <span class="cph-room-card__spec">
                                    <span class="cph-room-card__spec-value"><?php echo esc_html( $room_size ); ?></span>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ( $view_type ) : ?>
                                <span class="cph-room-card__spec">
                                    <span class="cph-room-card__spec-value"><?php echo esc_html( $view_type ); ?></span>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ( ! empty( $amenities_preview ) ) : ?>
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
                            <a href="<?php echo esc_url( $room_permalink ); ?>" class="cph-room-card__button">
                                <?php esc_html_e( 'View Room', 'cph' ); ?>
                            </a>
                            <?php if ( $booking_url ) : ?>
                                <a href="<?php echo esc_url( $booking_url ); ?>" class="cph-room-card__button cph-room-card__button--primary" target="_blank" rel="noopener noreferrer">
                                    <?php esc_html_e( 'Book Now', 'cph' ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        
        <?php wp_reset_postdata(); ?>
        
    <?php elseif ( $attrs['showEmptyState'] ) : ?>
        <div class="cph-rooms-query__empty">
            <h3 class="cph-rooms-query__empty-title"><?php echo esc_html( $attrs['emptyStateTitle'] ); ?></h3>
            <p class="cph-rooms-query__empty-message"><?php echo esc_html( $attrs['emptyStateMessage'] ); ?></p>
        </div>
    <?php endif; ?>
</div>
