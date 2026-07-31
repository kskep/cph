<?php
$defaults = array(
    'heading'  => 'About Us',
    'body'     => '',
    'imageId'  => 0,
    'imageUrl' => '',
    'imageAlt' => 'Hotel team member preparing a breakfast table in a Rhodes courtyard',
);

$attrs       = wp_parse_args( $attributes, $defaults );
$heading     = trim( (string) $attrs['heading'] );
$body        = (string) $attrs['body'];
$image_id    = absint( $attrs['imageId'] );
$image_alt   = trim( (string) $attrs['imageAlt'] );
$image_html  = '';

if ( $image_id ) {
    $image_html = wp_get_attachment_image(
        $image_id,
        'large',
        false,
        array(
            'class'    => 'cph-about__image',
            'alt'      => $image_alt,
            'loading'  => 'lazy',
            'decoding' => 'async',
            'sizes'    => '(max-width: 782px) 100vw, 45vw',
        )
    );
}

if ( ! $image_html ) {
    $image_url  = $attrs['imageUrl'] ? $attrs['imageUrl'] : get_theme_file_uri( '/assets/images/cph/cph-about-rhodes.webp' );
    $image_html = sprintf(
        '<img class="cph-about__image" src="%1$s" alt="%2$s" loading="lazy" decoding="async">',
        esc_url( $image_url ),
        esc_attr( $image_alt )
    );
}

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'alignfull cph-about',
    )
);
?>
<section <?php echo $wrapper_attributes; ?>>
    <div class="cph-about__inner">
        <?php if ( $heading ) : ?>
            <header class="cph-about__header">
                <h2 class="cph-about__heading"><?php echo esc_html( $heading ); ?></h2>
            </header>
        <?php endif; ?>
        <div class="cph-about__layout">
            <figure class="cph-about__media">
                <?php echo $image_html; ?>
            </figure>
            <div class="cph-about__story">
                <?php echo wp_kses_post( $body ); ?>
            </div>
        </div>
    </div>
</section>
