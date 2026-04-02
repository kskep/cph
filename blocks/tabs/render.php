<?php
$default_tabs = array(
    array(
        'tabLabel'        => 'Check in at the Bar',
        'tabLabelMobile'  => '',
        'title'           => 'Check in at the Bar',
        'titleMobile'     => '',
        'copy'            => "Forget the front desk. CPH instantly eases you into a playful stay with a cocktail (or mocktail) to go along with your room key when you check in at the bar. We're accommodating like that.",
        'copyMobile'      => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800&h=1000&fit=crop',
        'imageAlt'        => 'Cocktail at the CPH bar',
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
        'imageAlt'        => 'Modern CPH guest room',
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
        'imageAlt'        => 'CPH lobby',
        'imageMobileUrl'  => '',
        'imageMobileAlt'  => '',
        'ctaLabel'        => 'Details',
        'ctaUrl'          => '#',
    ),
    array(
        'tabLabel'        => '24/7 Beverages & Bites',
        'tabLabelMobile'  => '',
        'title'           => '24/7 Beverages & Bites',
        'titleMobile'     => '',
        'copy'            => "Hungry at midnight? Thirsty at dawn? Our grab-and-go options and bar service keep you fueled around the clock, because hunger doesn't check the time.",
        'copyMobile'      => '',
        'imageUrl'        => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800&h=1000&fit=crop',
        'imageAlt'        => 'CPH beverages and bites',
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
                $tab_label_mobile = ! empty( $tab['tabLabelMobile'] ) ? $tab['tabLabelMobile'] : $tab['tabLabel'];
            ?>
                <div class="wp-block-button is-style-text-btn cph-tab-trigger<?php echo 0 === $index ? ' is-active' : ''; ?>">
                    <a class="wp-block-button__link wp-element-button cph-tab-trigger__desktop" href="#how-we-play"><?php echo esc_html( $tab['tabLabel'] ); ?></a>
                    <a class="wp-block-button__link wp-element-button cph-tab-trigger__mobile" href="#how-we-play"><?php echo esc_html( $tab_label_mobile ); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="cph-tabs__panels">
            <?php foreach ( $tabs as $index => $tab ) : 
                // Fallback logic for mobile content
                $tab_title_mobile = ! empty( $tab['titleMobile'] ) ? $tab['titleMobile'] : $tab['title'];
                $tab_copy_mobile    = ! empty( $tab['copyMobile'] ) ? $tab['copyMobile'] : $tab['copy'];
                $tab_image_mobile   = ! empty( $tab['imageMobileUrl'] ) ? $tab['imageMobileUrl'] : $tab['imageUrl'];
                $tab_image_mobile_alt = ! empty( $tab['imageMobileAlt'] ) ? $tab['imageMobileAlt'] : $tab['imageAlt'];
            ?>
                <div class="cph-tab-panel<?php echo 0 === $index ? ' is-active' : ''; ?>">
                    <div class="wp-block-columns cph-tab-panel__layout are-vertically-aligned-stretch">
                        <div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:50%">
                            <div class="cph-tab-panel__image cph-tab-panel__image--desktop">
                                <img src="<?php echo esc_url( $tab['imageUrl'] ); ?>" alt="<?php echo esc_attr( $tab['imageAlt'] ); ?>" />
                            </div>
                            <div class="cph-tab-panel__image cph-tab-panel__image--mobile">
                                <img src="<?php echo esc_url( $tab_image_mobile ); ?>" alt="<?php echo esc_attr( $tab_image_mobile_alt ); ?>" />
                            </div>
                        </div>
                        <div class="wp-block-column is-vertically-aligned-center cph-tab-panel__content-column" style="flex-basis:50%">
                            <div class="cph-tab-panel__content">
                                <h3 class="cph-tab-panel__title cph-tab-panel__title--desktop"><?php echo esc_html( $tab['title'] ); ?></h3>
                                <h3 class="cph-tab-panel__title cph-tab-panel__title--mobile"><?php echo esc_html( $tab_title_mobile ); ?></h3>
                                <p class="cph-tab-panel__copy cph-tab-panel__copy--desktop"><?php echo esc_html( $tab['copy'] ); ?></p>
                                <p class="cph-tab-panel__copy cph-tab-panel__copy--mobile"><?php echo esc_html( $tab_copy_mobile ); ?></p>
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
