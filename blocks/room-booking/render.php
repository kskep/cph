<?php
/**
 * Room Booking Block Render Template
 * 
 * @package cph
 */

$defaults = array(
    'bookingUrl'        => '',
    'buttonText'        => 'Check Availability',
    'buttonStyle'       => 'primary',
    'additionalText'    => 'Best price guaranteed • Free cancellation',
    'showAdditionalText'=> true,
    'showHotelSwitcher' => false,
    'title'             => 'Book Your Stay',
    'subtitle'          => 'Reserve this room directly with our preferred partners',
    'layout'            => 'vertical',
    'stickyOnScroll'    => false,
);

$attrs = wp_parse_args( $attributes, $defaults );

// Get current room post data if in context
$room_post = get_post();
$is_room = $room_post && $room_post->post_type === 'cph_room';

// Get booking URL from room meta if not manually set
$booking_url = $attrs['bookingUrl'];
if ( empty( $booking_url ) && $is_room ) {
    $booking_url = get_post_meta( $room_post->ID, 'booking_url', true );
}

// Get hotel location
$hotel_location = null;
$hotel_terms = array();
if ( $is_room ) {
    $hotel_terms = get_the_terms( $room_post->ID, 'cph_hotel_location' );
    if ( ! empty( $hotel_terms ) && ! is_wp_error( $hotel_terms ) ) {
        $hotel_location = $hotel_terms[0];
    }
}

// Get all hotels for switcher
$all_hotels = get_terms( array(
    'taxonomy'   => 'cph_hotel_location',
    'hide_empty' => false,
) );

$button_class = 'cph-room-booking__button cph-room-booking__button--' . esc_attr( $attrs['buttonStyle'] );
$layout_class = 'cph-room-booking--' . esc_attr( $attrs['layout'] );
$sticky_class = $attrs['stickyOnScroll'] ? 'cph-room-booking--sticky' : '';

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-room-booking ' . $layout_class . ' ' . $sticky_class,
    )
);
?>
<div <?php echo $wrapper_attributes; ?>>
    <div class="cph-room-booking__inner">
        <?php if ( $attrs['title'] ) : ?>
            <h3 class="cph-room-booking__title"><?php echo esc_html( $attrs['title'] ); ?></h3>
        <?php endif; ?>
        
        <?php if ( $attrs['subtitle'] ) : ?>
            <p class="cph-room-booking__subtitle"><?php echo esc_html( $attrs['subtitle'] ); ?></p>
        <?php endif; ?>
        
        <?php if ( $attrs['showHotelSwitcher'] && ! empty( $all_hotels ) && ! is_wp_error( $all_hotels ) ) : ?>
            <div class="cph-room-booking__hotel-switcher">
                <label for="cph-hotel-select" class="cph-room-booking__label"><?php esc_html_e( 'Select Hotel', 'cph' ); ?></label>
                <select id="cph-hotel-select" class="cph-room-booking__select" name="hotel_location">
                    <?php foreach ( $all_hotels as $hotel ) : 
                        $selected = ( $hotel_location && $hotel_location->term_id === $hotel->term_id ) ? 'selected' : '';
                    ?>
                        <option value="<?php echo esc_attr( $hotel->slug ); ?>" <?php echo $selected; ?>>
                            <?php echo esc_html( $hotel->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        
        <?php if ( $booking_url ) : ?>
            <a href="<?php echo esc_url( $booking_url ); ?>" 
               class="<?php echo $button_class; ?>" 
               target="_blank" 
               rel="noopener noreferrer">
                <span class="cph-room-booking__button-text"><?php echo esc_html( $attrs['buttonText'] ); ?></span>
                <span class="cph-room-booking__button-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        <?php else : ?>
            <button class="<?php echo $button_class; ?>" disabled>
                <span class="cph-room-booking__button-text"><?php echo esc_html( $attrs['buttonText'] ); ?></span>
            </button>
            <p class="cph-room-booking__notice"><?php esc_html_e( 'Booking link coming soon', 'cph' ); ?></p>
        <?php endif; ?>
        
        <?php if ( $attrs['showAdditionalText'] && $attrs['additionalText'] ) : ?>
            <p class="cph-room-booking__additional-text"><?php echo esc_html( $attrs['additionalText'] ); ?></p>
        <?php endif; ?>
    </div>
</div>
