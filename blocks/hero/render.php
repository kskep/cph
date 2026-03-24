<?php
$defaults = array(
    'heroImageUrl'      => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=1920&h=1080&fit=crop',
    'heroImageAlt'      => 'Moxy hotel exterior',
    'taglineLineOne'    => 'Play On',
    'taglineLineTwo'    => '#AtTheMoxy',
    'brandLabel'        => 'Moxy Hotels',
    'bookingTitle'      => "Book\nYour\nStay",
    'destinationLabel'  => 'Destination',
    'destinationValue'  => 'Where to?',
    'datesLabel'        => 'Stay Dates',
    'checkInValue'      => 'Tue, Mar 24',
    'checkOutValue'     => 'Wed, Mar 25',
    'ctaLabel'          => 'Hotel Search',
    'ctaUrl'            => '#',
);

$attrs = wp_parse_args( $attributes, $defaults );

$hero_image_url = esc_url( $attrs['heroImageUrl'] );
$hero_image_alt = esc_attr( $attrs['heroImageAlt'] );
$tagline_one    = esc_html( $attrs['taglineLineOne'] );
$tagline_two    = esc_html( $attrs['taglineLineTwo'] );
$brand_label    = esc_html( $attrs['brandLabel'] );
$booking_title  = nl2br( esc_html( $attrs['bookingTitle'] ) );
$dest_label     = esc_html( $attrs['destinationLabel'] );
$dest_value     = esc_html( $attrs['destinationValue'] );
$dates_label    = esc_html( $attrs['datesLabel'] );
$checkin_value  = esc_html( $attrs['checkInValue'] );
$checkout_value = esc_html( $attrs['checkOutValue'] );
$cta_label      = esc_html( $attrs['ctaLabel'] );
$cta_url        = esc_url( $attrs['ctaUrl'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'moxy-hero-section',
    )
);
?>
<section <?php echo $wrapper_attributes; ?> id="book-your-stay">
    <div class="moxy-hero" style="min-height:600px;background-image:linear-gradient(rgba(0,0,0,0.35),rgba(0,0,0,0.35)),url('<?php echo $hero_image_url; ?>');background-size:cover;background-position:center;">
        <div class="moxy-hero__inner">
            <div class="moxy-hero__tagline">
                <h2 class="moxy-hero__tagline-line moxy-hero__tagline-line--large"><?php echo $tagline_one; ?></h2>
                <h2 class="moxy-hero__tagline-line"><?php echo $tagline_two; ?></h2>
                <hr class="moxy-hero__divider" />
                <p class="moxy-hero__tagline-brand"><?php echo $brand_label; ?></p>
            </div>
        </div>
    </div>
    <div class="moxy-booking-bar">
        <div class="moxy-booking-bar__inner">
            <div class="moxy-booking-bar__title-box">
                <h3 class="moxy-booking-bar__title"><?php echo $booking_title; ?></h3>
            </div>
            <div class="moxy-booking-bar__field">
                <p class="moxy-booking-bar__label"><?php echo $dest_label; ?></p>
                <p class="moxy-booking-bar__value"><?php echo $dest_value; ?></p>
            </div>
            <div class="moxy-booking-bar__field moxy-booking-bar__field--dates">
                <p class="moxy-booking-bar__label"><?php echo $dates_label; ?></p>
                <p class="moxy-booking-bar__value moxy-booking-bar__value--split">
                    <span><?php echo $checkin_value; ?></span>
                    <span class="moxy-booking-bar__dash">&mdash;</span>
                    <span><?php echo $checkout_value; ?></span>
                </p>
            </div>
            <div class="wp-block-button moxy-booking-bar__cta">
                <a class="wp-block-button__link wp-element-button" href="<?php echo $cta_url; ?>"><?php echo $cta_label; ?></a>
            </div>
        </div>
    </div>
</section>
