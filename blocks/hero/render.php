<?php
$defaults = array(
    'heroImageUrl'         => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=1920&h=1080&fit=crop',
    'heroImageAlt'         => 'CPH hotel exterior',
    'heroImageMobileUrl'   => '',
    'heroImageMobileAlt'   => '',
    'taglineLineOne'       => 'Play On',
    'taglineLineOneMobile' => '',
    'taglineLineTwo'       => '#AtTheCPH',
    'taglineLineTwoMobile' => '',
    'brandLabel'           => 'CPH Hotels',
    'brandLabelMobile'     => '',
    'bookingTitle'         => "Book\nYour\nStay",
    'bookingTitleMobile'   => '',
    'destinationLabel'     => 'Destination',
    'destinationValue'     => 'Where to?',
    'datesLabel'           => 'Stay Dates',
    'checkInValue'         => 'Tue, Mar 24',
    'checkOutValue'        => 'Wed, Mar 25',
    'ctaLabel'             => 'Hotel Search',
    'ctaUrl'               => '#',
);

$attrs = wp_parse_args( $attributes, $defaults );

// Desktop image
$hero_image_url = esc_url( $attrs['heroImageUrl'] );
$hero_image_alt = esc_attr( $attrs['heroImageAlt'] );

// Mobile image (fallback to desktop if empty)
$hero_image_mobile_url = ! empty( $attrs['heroImageMobileUrl'] ) ? esc_url( $attrs['heroImageMobileUrl'] ) : $hero_image_url;
$hero_image_mobile_alt = ! empty( $attrs['heroImageMobileAlt'] ) ? esc_attr( $attrs['heroImageMobileAlt'] ) : $hero_image_alt;

// Text with mobile fallback
$tagline_one        = esc_html( $attrs['taglineLineOne'] );
$tagline_one_mobile = ! empty( $attrs['taglineLineOneMobile'] ) ? esc_html( $attrs['taglineLineOneMobile'] ) : $tagline_one;

$tagline_two        = esc_html( $attrs['taglineLineTwo'] );
$tagline_two_mobile = ! empty( $attrs['taglineLineTwoMobile'] ) ? esc_html( $attrs['taglineLineTwoMobile'] ) : $tagline_two;

$brand_label        = esc_html( $attrs['brandLabel'] );
$brand_label_mobile = ! empty( $attrs['brandLabelMobile'] ) ? esc_html( $attrs['brandLabelMobile'] ) : $brand_label;

$booking_title        = nl2br( esc_html( $attrs['bookingTitle'] ) );
$booking_title_mobile = ! empty( $attrs['bookingTitleMobile'] ) ? nl2br( esc_html( $attrs['bookingTitleMobile'] ) ) : $booking_title;

$dest_label    = esc_html( $attrs['destinationLabel'] );
$dest_value    = esc_html( $attrs['destinationValue'] );
$dates_label   = esc_html( $attrs['datesLabel'] );
$checkin_value = esc_html( $attrs['checkInValue'] );
$checkout_value= esc_html( $attrs['checkOutValue'] );
$cta_label     = esc_html( $attrs['ctaLabel'] );
$cta_url       = esc_url( $attrs['ctaUrl'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-hero-section',
    )
);
?>
<section <?php echo $wrapper_attributes; ?> id="book-your-stay">
    <div class="cph-hero">
        <!-- Desktop Background -->
        <div class="cph-hero__bg cph-hero__bg--desktop" 
             style="background-image:linear-gradient(rgba(0,0,0,0.35),rgba(0,0,0,0.35)),url('<?php echo $hero_image_url; ?>');">
        </div>
        <!-- Mobile Background -->
        <div class="cph-hero__bg cph-hero__bg--mobile" 
             style="background-image:linear-gradient(rgba(0,0,0,0.35),rgba(0,0,0,0.35)),url('<?php echo $hero_image_mobile_url; ?>');">
        </div>
        <div class="cph-hero__inner">
            <div class="cph-hero__tagline">
                <!-- Line 1 -->
                <h2 class="cph-hero__tagline-line cph-hero__tagline-line--large cph-hero__tagline-line--desktop"><?php echo $tagline_one; ?></h2>
                <h2 class="cph-hero__tagline-line cph-hero__tagline-line--large cph-hero__tagline-line--mobile"><?php echo $tagline_one_mobile; ?></h2>
                <!-- Line 2 -->
                <h2 class="cph-hero__tagline-line cph-hero__tagline-line--desktop"><?php echo $tagline_two; ?></h2>
                <h2 class="cph-hero__tagline-line cph-hero__tagline-line--mobile"><?php echo $tagline_two_mobile; ?></h2>
                <hr class="cph-hero__divider" />
                <!-- Brand -->
                <p class="cph-hero__tagline-brand cph-hero__tagline-brand--desktop"><?php echo $brand_label; ?></p>
                <p class="cph-hero__tagline-brand cph-hero__tagline-brand--mobile"><?php echo $brand_label_mobile; ?></p>
            </div>
        </div>
    </div>
    <div class="cph-booking-bar">
        <div class="cph-booking-bar__inner">
            <div class="cph-booking-bar__title-box">
                <!-- Desktop Title -->
                <h3 class="cph-booking-bar__title cph-booking-bar__title--desktop"><?php echo $booking_title; ?></h3>
                <!-- Mobile Title -->
                <h3 class="cph-booking-bar__title cph-booking-bar__title--mobile"><?php echo $booking_title_mobile; ?></h3>
            </div>
            <div class="cph-booking-bar__field">
                <p class="cph-booking-bar__label"><?php echo $dest_label; ?></p>
                <p class="cph-booking-bar__value"><?php echo $dest_value; ?></p>
            </div>
            <div class="cph-booking-bar__field cph-booking-bar__field--dates">
                <p class="cph-booking-bar__label"><?php echo $dates_label; ?></p>
                <p class="cph-booking-bar__value cph-booking-bar__value--split">
                    <span><?php echo $checkin_value; ?></span>
                    <span class="cph-booking-bar__dash">&mdash;</span>
                    <span><?php echo $checkout_value; ?></span>
                </p>
            </div>
            <div class="wp-block-button cph-booking-bar__cta">
                <a class="wp-block-button__link wp-element-button" href="<?php echo $cta_url; ?>"><?php echo $cta_label; ?></a>
            </div>
        </div>
    </div>
</section>
