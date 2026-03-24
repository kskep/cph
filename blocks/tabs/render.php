<?php
$default_tabs = array(
    array(
        'tabLabel' => 'Check in at the Bar',
        'title'    => 'Check in at the Bar',
        'copy'     => "Forget the front desk. Moxy instantly eases you into a playful stay with a cocktail (or mocktail) to go along with your room key when you check in at the bar. We're accommodating like that.",
        'imageUrl' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800&h=1000&fit=crop',
        'imageAlt' => 'Cocktail at the Moxy bar',
        'ctaLabel' => 'Details',
        'ctaUrl'   => '#',
    ),
    array(
        'tabLabel' => 'Your Room',
        'title'    => 'Your Room',
        'copy'     => "Our rooms are smartly designed for the way you actually travel. With modular furniture, furiously fast Wi-Fi, and plush bedding that'll make you hit snooze at least five times.",
        'imageUrl' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=1000&fit=crop',
        'imageAlt' => 'Modern Moxy guest room',
        'ctaLabel' => 'Details',
        'ctaUrl'   => '#',
    ),
    array(
        'tabLabel' => 'Not Your Average Lobby',
        'title'    => 'Not Your Average Lobby',
        'copy'     => 'Our lobbies are designed for socializing. Think chic seating, games, and an atmosphere that makes you want to linger longer and meet someone new.',
        'imageUrl' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=1000&fit=crop',
        'imageAlt' => 'Moxy lobby',
        'ctaLabel' => 'Details',
        'ctaUrl'   => '#',
    ),
    array(
        'tabLabel' => '24/7 Beverages & Bites',
        'title'    => '24/7 Beverages & Bites',
        'copy'     => "Hungry at midnight? Thirsty at dawn? Our grab-and-go options and bar service keep you fueled around the clock, because hunger doesn't check the time.",
        'imageUrl' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800&h=1000&fit=crop',
        'imageAlt' => 'Moxy beverages and bites',
        'ctaLabel' => 'Details',
        'ctaUrl'   => '#',
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
        'class' => 'moxy-tabs-section js-moxy-tabs',
    )
);
?>
<section <?php echo $wrapper_attributes; ?> id="how-we-play">
    <div class="moxy-tabs-section__inner alignwide">
        <div class="moxy-section-label">
            <h2 class="moxy-section-label__heading"><?php echo esc_html( $section_title ); ?></h2>
        </div>
        <div class="wp-block-buttons moxy-tabs__buttons">
            <?php foreach ( $tabs as $index => $tab ) : ?>
                <div class="wp-block-button is-style-text-btn moxy-tab-trigger<?php echo 0 === $index ? ' is-active' : ''; ?>">
                    <a class="wp-block-button__link wp-element-button" href="#how-we-play"><?php echo esc_html( $tab['tabLabel'] ); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="moxy-tabs__panels">
            <?php foreach ( $tabs as $index => $tab ) : ?>
                <div class="moxy-tab-panel<?php echo 0 === $index ? ' is-active' : ''; ?>">
                    <div class="wp-block-columns moxy-tab-panel__layout are-vertically-aligned-stretch">
                        <div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:50%">
                            <div class="moxy-tab-panel__image">
                            <img src="<?php echo esc_url( $tab['imageUrl'] ); ?>" alt="<?php echo esc_attr( $tab['imageAlt'] ); ?>" />
                            </div>
                        </div>
                        <div class="wp-block-column is-vertically-aligned-center moxy-tab-panel__content-column" style="flex-basis:50%">
                            <div class="moxy-tab-panel__content">
                                <h3 class="moxy-tab-panel__title"><?php echo esc_html( $tab['title'] ); ?></h3>
                                <p class="moxy-tab-panel__copy"><?php echo esc_html( $tab['copy'] ); ?></p>
                                <div class="wp-block-button is-style-text-btn moxy-tab-panel__link">
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
