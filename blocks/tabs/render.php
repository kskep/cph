<?php
$default_tabs = array(
    array(
        'tabLabel'        => 'Check in at the Bar',
        'tabLabelMobile'  => '',
        'eyebrow'         => 'Check In and Start Exploring',
        'title'           => '',
        'titleMobile'     => '',
        'lead'            => 'Your #CityPlus experience begins here.',
        'copy'            => 'A smooth arrival, a warm welcome and everything you need to start discovering Rhodes Island.',
        'copySecondary'   => 'Our reception team is available around the clock from April to October, and 16 hours daily from November to March, ensuring a smooth and comfortable experience throughout your stay.',
        'copyMobile'      => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800&h=1000&fit=crop',
        'imageAlt'        => 'Cocktail at the CityPlus bar',
        'additionalImages' => array(),
        'imageMobileUrl'  => '',
        'imageMobileAlt'  => '',
        'ctaLabel'        => 'Details',
        'ctaUrl'          => '#',
    ),
    array(
        'tabLabel'        => 'Your Room',
        'tabLabelMobile'  => '',
        'title'           => 'Your Room',
        'titleMobile'     => '',
        'copy'            => "Our rooms are smartly designed for the way you actually travel. With modular furniture, furiously fast Wi-Fi, and plush bedding that'll make you hit snooze at least five times.",
        'copyMobile'      => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=1000&fit=crop',
        'imageAlt'        => 'Modern CityPlus guest room',
        'additionalImages' => array(),
        'imageMobileUrl'  => '',
        'imageMobileAlt'  => '',
        'ctaLabel'        => 'Details',
        'ctaUrl'          => '#',
    ),
    array(
        'tabLabel'        => 'Not Your Average Lobby',
        'tabLabelMobile'  => '',
        'title'           => 'Not Your Average Lobby',
        'titleMobile'     => '',
        'copy'            => 'Our lobbies are designed for socializing. Think chic seating, games, and an atmosphere that makes you want to linger longer and meet someone new.',
        'copyMobile'      => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=1000&fit=crop',
        'imageAlt'        => 'CityPlus lobby',
        'additionalImages' => array(),
        'imageMobileUrl'  => '',
        'imageMobileAlt'  => '',
        'ctaLabel'        => 'Details',
        'ctaUrl'          => '#',
    ),
    array(
        'tabLabel'        => '24/7 Beverages and Bites',
        'tabLabelMobile'  => '',
        'title'           => '24/7 Beverages and Bites',
        'titleMobile'     => '',
        'copy'            => "Hungry at midnight? Thirsty at dawn? Our grab-and-go options and bar service keep you fueled around the clock, because hunger doesn't check the time.",
        'copyMobile'      => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800&h=1000&fit=crop',
        'imageAlt'        => 'CityPlus beverages and bites',
        'additionalImages' => array(),
        'imageMobileUrl'  => '',
        'imageMobileAlt'  => '',
        'ctaLabel'        => 'Details',
        'ctaUrl'          => '#',
    ),
);

$section_title = isset( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : 'How We Play';
$input_tabs    = isset( $attributes['tabs'] ) && is_array( $attributes['tabs'] ) ? array_values( $attributes['tabs'] ) : array();
$tabs          = array();

for ( $i = 0; $i < 4; $i++ ) {
    $tabs[] = isset( $input_tabs[ $i ] ) && is_array( $input_tabs[ $i ] )
        ? wp_parse_args( $input_tabs[ $i ], $default_tabs[ $i ] )
        : $default_tabs[ $i ];
}

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-tabs-section js-cph-tabs',
    )
);
?>
<section <?php echo $wrapper_attributes; ?> id="how-we-play">
    <div class="cph-tabs-section__inner alignwide cph-container">
        <div class="cph-section-label">
            <h2 class="cph-section-label__heading"><?php echo esc_html( $section_title ); ?></h2>
        </div>
        <div class="wp-block-buttons cph-tabs__buttons">
            <?php foreach ( $tabs as $index => $tab ) : 
                $has_mobile_tab_label = '' !== trim( (string) $tab['tabLabelMobile'] ) && $tab['tabLabelMobile'] !== $tab['tabLabel'];
            ?>
                <div class="wp-block-button is-style-text-btn cph-tab-trigger<?php echo 0 === $index ? ' is-active' : ''; ?>">
                    <?php if ( $has_mobile_tab_label ) : ?>
                        <a class="wp-block-button__link wp-element-button cph-tab-trigger__desktop" href="#how-we-play"><?php echo esc_html( $tab['tabLabel'] ); ?></a>
                        <a class="wp-block-button__link wp-element-button cph-tab-trigger__mobile" href="#how-we-play"><?php echo esc_html( $tab['tabLabelMobile'] ); ?></a>
                    <?php else : ?>
                        <a class="wp-block-button__link wp-element-button" href="#how-we-play"><?php echo esc_html( $tab['tabLabel'] ); ?></a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="cph-tabs__panels">
            <?php foreach ( $tabs as $index => $tab ) : 
                $has_mobile_title = '' !== trim( (string) $tab['titleMobile'] ) && $tab['titleMobile'] !== $tab['title'];
                $has_mobile_copy = '' !== trim( (string) $tab['copyMobile'] ) && $tab['copyMobile'] !== $tab['copy'];
                $has_mobile_image = '' !== trim( (string) $tab['imageMobileUrl'] ) && $tab['imageMobileUrl'] !== $tab['imageUrl'];
                $tab_image_url = str_replace( 'u0026', '&', (string) $tab['imageUrl'] );
                $tab_image_mobile_url = str_replace( 'u0026', '&', (string) $tab['imageMobileUrl'] );
                $tab_image_mobile_alt = ! empty( $tab['imageMobileAlt'] ) ? $tab['imageMobileAlt'] : $tab['imageAlt'];
                $tab_images = array(
                    array(
                        'url'       => $tab_image_url,
                        'alt'       => $tab['imageAlt'],
                        'mobileUrl' => $has_mobile_image ? $tab_image_mobile_url : '',
                    ),
                );
                foreach ( is_array( $tab['additionalImages'] ) ? $tab['additionalImages'] : array() as $additional_image ) {
                    if ( ! empty( $additional_image['url'] ) ) {
                        $tab_images[] = array(
                            'url'       => str_replace( 'u0026', '&', (string) $additional_image['url'] ),
                            'alt'       => $additional_image['alt'] ?? '',
                            'mobileUrl' => '',
                        );
                    }
                }
                $tab_title = trim( (string) $tab['title'] );
                $tab_lead = trim( (string) ( $tab['lead'] ?? '' ) );
                $tab_copy_secondary = trim( (string) ( $tab['copySecondary'] ?? '' ) );
                $normalize_copy = static function ( $value ) {
                    return preg_replace( '/\s+/', ' ', trim( wp_strip_all_tags( (string) $value ) ) );
                };
                if ( '' !== $tab_lead && $normalize_copy( $tab_title ) === $normalize_copy( $tab_lead ) ) {
                    $tab_title = '';
                }
                $copy_paragraphs = array();
                foreach ( preg_split( '/\R{2,}/', (string) $tab['copy'] ) as $copy_paragraph ) {
                    $copy_paragraph = trim( $copy_paragraph );
                    if ( '' === $copy_paragraph ) {
                        continue;
                    }
                    $normalized_paragraph = $normalize_copy( $copy_paragraph );
                    if ( '' !== $tab_lead && $normalized_paragraph === $normalize_copy( $tab_lead ) ) {
                        continue;
                    }
                    if ( '' !== $tab_copy_secondary && $normalized_paragraph === $normalize_copy( $tab_copy_secondary ) ) {
                        continue;
                    }
                    $copy_paragraphs[] = $copy_paragraph;
                }
            ?>
                <div class="cph-tab-panel<?php echo 0 === $index ? ' is-active' : ''; ?>">
                    <div class="wp-block-columns cph-tab-panel__layout are-vertically-aligned-stretch">
                        <div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:50%">
                            <?php if ( count( $tab_images ) > 1 ) : ?>
                                <div class="cph-tab-panel__image cph-tab-image-slider js-cph-image-slider">
                                    <?php foreach ( $tab_images as $image_index => $image ) : ?>
                                        <div class="cph-tab-image-slider__slide<?php echo 0 === $image_index ? ' is-active' : ''; ?>" aria-hidden="<?php echo 0 === $image_index ? 'false' : 'true'; ?>">
                                            <picture>
                                                <?php if ( ! empty( $image['mobileUrl'] ) ) : ?>
                                                    <source media="(max-width: 782px)" srcset="<?php echo esc_url( $image['mobileUrl'] ); ?>">
                                                <?php endif; ?>
                                                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                            </picture>
                                        </div>
                                    <?php endforeach; ?>
                                    <button class="cph-tab-image-slider__arrow cph-tab-image-slider__arrow--prev" type="button" aria-label="<?php esc_attr_e( 'Previous image', 'cph' ); ?>">&#8249;</button>
                                    <button class="cph-tab-image-slider__arrow cph-tab-image-slider__arrow--next" type="button" aria-label="<?php esc_attr_e( 'Next image', 'cph' ); ?>">&#8250;</button>
                                    <div class="cph-tab-image-slider__dots">
                                        <?php foreach ( $tab_images as $image_index => $image ) : ?>
                                            <button class="cph-tab-image-slider__dot<?php echo 0 === $image_index ? ' is-active' : ''; ?>" type="button" aria-label="<?php echo esc_attr( sprintf( __( 'Show image %d', 'cph' ), $image_index + 1 ) ); ?>" aria-pressed="<?php echo 0 === $image_index ? 'true' : 'false'; ?>"></button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="cph-tab-panel__image cph-tab-panel__image--desktop">
                                    <img src="<?php echo esc_url( $tab_image_url ); ?>" alt="<?php echo esc_attr( $tab['imageAlt'] ); ?>" />
                                </div>
                                <?php if ( $has_mobile_image ) : ?>
                                    <div class="cph-tab-panel__image cph-tab-panel__image--mobile">
                                        <img src="<?php echo esc_url( $tab_image_mobile_url ); ?>" alt="<?php echo esc_attr( $tab_image_mobile_alt ); ?>" />
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="wp-block-column is-vertically-aligned-center cph-tab-panel__content-column" style="flex-basis:50%">
                            <div class="cph-tab-panel__content">
                                <?php if ( ! empty( $tab['eyebrow'] ) ) : ?>
                                    <p class="cph-tab-panel__eyebrow"><?php echo esc_html( $tab['eyebrow'] ); ?></p>
                                <?php endif; ?>
                                <?php if ( '' !== $tab_title || $has_mobile_title ) : ?>
                                    <?php if ( $has_mobile_title ) : ?>
                                        <h3 class="cph-tab-panel__title cph-tab-panel__title--desktop"><?php echo esc_html( $tab_title ); ?></h3>
                                        <h3 class="cph-tab-panel__title cph-tab-panel__title--mobile"><?php echo esc_html( $tab['titleMobile'] ); ?></h3>
                                    <?php else : ?>
                                        <h3 class="cph-tab-panel__title"><?php echo esc_html( $tab_title ); ?></h3>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ( $has_mobile_copy ) : ?>
                                    <p class="cph-tab-panel__copy cph-tab-panel__copy--desktop"><?php echo esc_html( $tab['copy'] ); ?></p>
                                    <p class="cph-tab-panel__copy cph-tab-panel__copy--mobile"><?php echo esc_html( $tab['copyMobile'] ); ?></p>
                                <?php else : ?>
                                    <?php if ( '' !== $tab_lead ) : ?>
                                        <p class="cph-tab-panel__lead"><?php echo esc_html( $tab_lead ); ?></p>
                                    <?php endif; ?>
                                    <?php foreach ( $copy_paragraphs as $copy_paragraph ) : ?>
                                        <p class="cph-tab-panel__copy"><?php echo nl2br( esc_html( trim( $copy_paragraph ) ) ); ?></p>
                                    <?php endforeach; ?>
                                    <?php if ( '' !== $tab_copy_secondary ) : ?>
                                        <p class="cph-tab-panel__copy"><?php echo esc_html( $tab_copy_secondary ); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="wp-block-button is-style-text-btn cph-tab-panel__link">
                                    <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $tab['ctaUrl'] ); ?>"><?php echo esc_html( $tab['ctaLabel'] ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
