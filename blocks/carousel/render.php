<?php
$default_slides = array(
    array(
        'eyebrow'  => 'New Places to Stay and Play.',
        'title'    => 'CPH Barcelona',
        'location' => 'CPH BARCELONA',
        'imageUrl' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=1600&h=900&fit=crop',
        'imageAlt' => 'CPH Barcelona',
        'ctaLabel' => 'Visit',
        'ctaUrl'   => '#',
    ),
    array(
        'eyebrow'  => 'New Places to Stay and Play.',
        'title'    => 'CPH NYC',
        'location' => 'CPH NYC',
        'imageUrl' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1600&h=900&fit=crop',
        'imageAlt' => 'CPH NYC',
        'ctaLabel' => 'Visit',
        'ctaUrl'   => '#',
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
                <?php foreach ( $slides as $index => $slide ) : ?>
                    <div class="cph-carousel-slide<?php echo 0 === $index ? ' is-active' : ''; ?>">
                        <div class="cph-carousel-slide__image">
                            <img src="<?php echo esc_url( $slide['imageUrl'] ); ?>" alt="<?php echo esc_attr( $slide['imageAlt'] ); ?>" />
                        </div>
                        <div class="cph-carousel-slide__overlay">
                            <p class="cph-carousel-slide__eyebrow"><?php echo esc_html( $slide['eyebrow'] ); ?></p>
                            <h3 class="cph-carousel-slide__title"><?php echo esc_html( $slide['title'] ); ?></h3>
                            <div class="wp-block-button is-style-text-btn cph-carousel-slide__link">
                                <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $slide['ctaUrl'] ); ?>"><?php echo esc_html( $slide['ctaLabel'] ); ?></a>
                            </div>
                        </div>
                        <p class="cph-carousel-slide__location"><?php echo esc_html( $slide['location'] ); ?></p>
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
