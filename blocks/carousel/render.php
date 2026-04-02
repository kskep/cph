<?php
$default_slides = array(
    array(
        'eyebrow'         => 'New Places to Stay and Play.',
        'eyebrowMobile'   => '',
        'title'           => 'CPH Barcelona',
        'titleMobile'     => '',
        'location'        => 'CPH BARCELONA',
        'locationMobile'  => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=1600&h=900&fit=crop',
        'imageAlt'        => 'CPH Barcelona',
        'imageMobileUrl'  => '',
        'imageMobileAlt'  => '',
        'ctaLabel'        => 'Visit',
        'ctaUrl'          => '#',
    ),
    array(
        'eyebrow'         => 'New Places to Stay and Play.',
        'eyebrowMobile'   => '',
        'title'           => 'CPH NYC',
        'titleMobile'     => '',
        'location'        => 'CPH NYC',
        'locationMobile'  => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1600&h=900&fit=crop',
        'imageAlt'        => 'CPH NYC',
        'imageMobileUrl'  => '',
        'imageMobileAlt'  => '',
        'ctaLabel'        => 'Visit',
        'ctaUrl'          => '#',
    ),
);

$section_title = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : 'Now Playing';
$input_slides  = isset( $attributes['slides'] ) && is_array( $attributes['slides'] ) ? array_values( $attributes['slides'] ) : array();
$slides        = array();

for ( $i = 0; $i < 2; $i++ ) {
    $slides[] = isset( $input_slides[ $i ] ) && is_array( $input_slides[ $i ] )
        ? wp_parse_args( $input_slides[ $i ], $default_slides[ $i ] )
        : $default_slides[ $i ];
}

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-carousel-section js-cph-carousel',
    )
);
?>
<section <?php echo $wrapper_attributes; ?> id="now-playing">
    <div class="cph-carousel-section__inner alignwide">
        <div class="cph-carousel-section__label-wrap" style="display:flex;justify-content:flex-end;">
            <div class="cph-section-label">
                <h2 class="cph-section-label__heading"><?php echo esc_html( $section_title ); ?></h2>
            </div>
        </div>
        <div class="cph-carousel-frame">
            <div class="cph-carousel-slides">
                <?php foreach ( $slides as $index => $slide ) : 
                    // Fallback logic for mobile content
                    $slide_eyebrow_mobile  = ! empty( $slide['eyebrowMobile'] ) ? $slide['eyebrowMobile'] : $slide['eyebrow'];
                    $slide_title_mobile    = ! empty( $slide['titleMobile'] ) ? $slide['titleMobile'] : $slide['title'];
                    $slide_location_mobile = ! empty( $slide['locationMobile'] ) ? $slide['locationMobile'] : $slide['location'];
                    $slide_image_mobile    = ! empty( $slide['imageMobileUrl'] ) ? $slide['imageMobileUrl'] : $slide['imageUrl'];
                    $slide_image_mobile_alt = ! empty( $slide['imageMobileAlt'] ) ? $slide['imageMobileAlt'] : $slide['imageAlt'];
                ?>
                    <div class="cph-carousel-slide<?php echo 0 === $index ? ' is-active' : ''; ?>">
                        <div class="cph-carousel-slide__image cph-carousel-slide__image--desktop">
                            <img src="<?php echo esc_url( $slide['imageUrl'] ); ?>" alt="<?php echo esc_attr( $slide['imageAlt'] ); ?>" />
                        </div>
                        <div class="cph-carousel-slide__image cph-carousel-slide__image--mobile">
                            <img src="<?php echo esc_url( $slide_image_mobile ); ?>" alt="<?php echo esc_attr( $slide_image_mobile_alt ); ?>" />
                        </div>
                        <div class="cph-carousel-slide__content">
                            <div class="cph-carousel-slide__overlay">
                                <p class="cph-carousel-slide__eyebrow cph-carousel-slide__eyebrow--desktop"><?php echo esc_html( $slide['eyebrow'] ); ?></p>
                                <p class="cph-carousel-slide__eyebrow cph-carousel-slide__eyebrow--mobile"><?php echo esc_html( $slide_eyebrow_mobile ); ?></p>
                                <h3 class="cph-carousel-slide__title cph-carousel-slide__title--desktop"><?php echo esc_html( $slide['title'] ); ?></h3>
                                <h3 class="cph-carousel-slide__title cph-carousel-slide__title--mobile"><?php echo esc_html( $slide_title_mobile ); ?></h3>
                                <div class="wp-block-button is-style-text-btn cph-carousel-slide__link">
                                    <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $slide['ctaUrl'] ); ?>"><?php echo esc_html( $slide['ctaLabel'] ); ?></a>
                                </div>
                            </div>
                            <p class="cph-carousel-slide__location cph-carousel-slide__location--desktop"><?php echo esc_html( $slide['location'] ); ?></p>
                            <p class="cph-carousel-slide__location cph-carousel-slide__location--mobile"><?php echo esc_html( $slide_location_mobile ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="wp-block-buttons cph-carousel-frame__arrows">
                <div class="wp-block-button cph-carousel-arrow js-carousel-prev">
                    <a class="wp-block-button__link wp-element-button" href="#now-playing">Prev</a>
                </div>
                <div class="wp-block-button cph-carousel-arrow js-carousel-next">
                    <a class="wp-block-button__link wp-element-button" href="#now-playing">Next</a>
                </div>
            </div>
            <div class="wp-block-buttons cph-carousel-dots">
                <?php foreach ( $slides as $index => $slide ) : ?>
                    <div class="wp-block-button cph-carousel-dot<?php echo 0 === $index ? ' is-active' : ''; ?>">
                        <a class="wp-block-button__link wp-element-button" href="#now-playing"><?php echo esc_html( (string) ( $index + 1 ) ); ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
