<?php
function wp_parse_args( $args, $defaults ) { return array_merge( $defaults, $args ); }
function get_block_wrapper_attributes( $attributes ) { return 'class="' . $attributes['class'] . '"'; }
function esc_html( $value ) { return htmlspecialchars( $value, ENT_QUOTES ); }
function esc_attr( $value ) { return esc_html( $value ); }
function esc_url( $value ) { return esc_attr( $value ); }
function esc_attr_e( $value ) { echo esc_attr( $value ); }
function __( $value ) { return $value; }
function wp_strip_all_tags( $value ) { return strip_tags( $value ); }

$attributes = array(
    'tabs' => array(
        array(
            'imageUrl' => 'primary.jpg',
            'imageAlt' => 'Primary',
            'additionalImages' => array(
                array( 'url' => 'second.jpg', 'alt' => 'Second' ),
                array( 'url' => 'third.jpg', 'alt' => 'Third' ),
            ),
        ),
    ),
);

ob_start();
require dirname( __DIR__ ) . '/blocks/tabs/render.php';
$html = ob_get_clean();

assert( 1 === substr_count( $html, 'js-cph-image-slider' ) );
assert( 3 === substr_count( $html, 'cph-tab-image-slider__slide' ) );
assert( false !== strpos( $html, 'second.jpg' ) );
