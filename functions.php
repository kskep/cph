<?php
/**
 * Functions for the cph theme
 * 
 * @link 
 * @package cph
 * @author  Konstantinos
 * @license GNU General Public License v2 or later
 */

/* Sets up theme defaults */
function starter_block_theme_setup() {

		// Enqueue editor styles.
		add_editor_style(
			array(
				'./style.css',
                // Disable this if you don't want to include the CSS framework in the editor.
				'/assets/css/css-framework.css',
                // Disable this if you don't want to include the font icons CSS in the editor.
				'/assets/css/icon-fonts.css'
			)
		);
 
		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}

add_action( 'after_setup_theme', 'starter_block_theme_setup' );


// Loads styles and scripts
function starter_block_theme_enqueue_scripts() {
    
	wp_enqueue_style( 'starter-css', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css') );

	// Disable this if you want don't want to include the CSS Framework
    wp_enqueue_style( 'css-framework', get_stylesheet_directory_uri() . '/assets/css/css-framework.css', [], filemtime(get_stylesheet_directory() . '/assets/css/css-framework.css') );
 	// Disable this if you want don't want to include the Font Icons CSS 
	wp_enqueue_style('icons-css',get_stylesheet_directory_uri() . '/assets/css/icon-fonts.css',[],wp_get_theme()->get( 'Version' ));

    $component_styles = array(
        'moxy-header'   => '/assets/css/components/moxy-header.css',
        'moxy-hero'     => '/assets/css/components/moxy-hero.css',
        'moxy-sections' => '/assets/css/components/moxy-sections.css',
        'moxy-tabs'     => '/assets/css/components/moxy-tabs.css',
        'moxy-carousel' => '/assets/css/components/moxy-carousel.css',
        'moxy-modal'    => '/assets/css/components/moxy-modal.css',
        'moxy-footer'   => '/assets/css/components/moxy-footer.css',
    );

    foreach ( $component_styles as $handle => $relative_path ) {
        $absolute_path = get_stylesheet_directory() . $relative_path;

        if ( file_exists( $absolute_path ) ) {
            wp_enqueue_style( $handle, get_stylesheet_directory_uri() . $relative_path, array(), filemtime( $absolute_path ) );
        }
    }
    
    wp_enqueue_script('starter-js', get_stylesheet_directory_uri() . '/assets/js/js.js', array('jquery'), '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'starter_block_theme_enqueue_scripts' );


// Include CSS Class Manager Info to remind folk to install that plugin
require_once get_template_directory() . '/inc/css-class-manager-info.php';


// This registers the classes that appear in the dropdown for the CSS Class Manager plugin.
// IMPORTANT: in the CSS Class manager plugin preferences, the "Hide theme.json generated classes" option must be toggled off for these classes to show.
// Disable this if you want don't want to include the CSS Framework
function starter_add_custom_css( $css ) {

	$css_framework = file_get_contents( __DIR__ . '/assets/css/css-framework.css' );
    $css_icons = file_get_contents( __DIR__ . '/assets/css/icon-fonts.css' );

	return $css . $css_framework . $css_icons;
}
add_filter( 'css_class_manager_theme_classes_css', 'starter_add_custom_css' );


// Register Block Styles Examples
function starter_register_block_styles() {

    if ( ! function_exists( 'register_block_style' ) ) {
        return;
    }

    // Blue Button - example of a custom colored button with hover state
    register_block_style(
        'core/button',
        array(
            'name'         => 'blue-btn',
            'label'        => __( 'Blue', 'cph' ),
            'is_default'   => false,
        )
    );

        wp_enqueue_block_style(
            'core/button',
            array(
                'handle' => "starter-blue-btn",
                'src'    => get_theme_file_uri( "assets/css/block-styles/blue-button.css" ),
                'path'   => get_theme_file_path( "assets/css/block-styles/blue-button.css" ),
            )
        );

    // Text Only Button
    register_block_style(
        'core/button',
        array(
            'name'         => 'text-btn',
            'label'        => __( 'Text', 'cph' ),
            'is_default'   => false,
        )
    );

        wp_enqueue_block_style(
            'core/button',
            array(
                'handle' => "starter-text-btn",
                'src'    => get_theme_file_uri( "assets/css/block-styles/text-button.css" ),
                'path'   => get_theme_file_path( "assets/css/block-styles/text-button.css" ),
            )
        );

    // Group Style - removes the default top margin
    register_block_style(
        'core/group',
        array(
            'name'         => 'starter-group',
            'label'        => __( 'margin-top-0', 'cph' ),
            'is_default'   => false,
            'inline_style' => '
            .is-style-starter-group { margin-block-start: 0 !important; }
            ',
        ) 
    );

    // Check Mark List - simple unicode list style using "inline_style" as is very simple CSS
    register_block_style(
        'core/list',
        array(
            'name'         => 'checkmark-list',
            'label'        => __( 'Checkmark', 'cph' ),
            'inline_style' => '
            ul.is-style-checkmark-list {
                list-style-type: "\2713";
            }

            ul.is-style-checkmark-list li {
                padding-inline-start: 10px;
                margin-left: -9px;
            }',
        )
    );


    // Arrow Right List - simple unicode list style
    register_block_style(
        'core/list',
        array(
            'name'         => 'arrow-list',
            'label'        => __( 'Arrow Right', 'cph' ),
            'inline_style' => '
            ul.is-style-arrow-list {
                list-style-type: "\2192";
            }

            ul.is-style-arrow-list li {
                padding-inline-start: 10px;
                margin-left: -9px;
            }',
        )
    );

}
add_action( 'init', 'starter_register_block_styles' );


// Example of Register block pattern categories 
function starter_register_block_pattern_categories() {
    
    register_block_pattern_category(
            'cph/pages',
            array(
                'label'       => __( 'Pages', 'cph' ),
            )
        );
	register_block_pattern_category(
        'cph/hero',
		array(
            'label'       => __( 'Hero', 'cph' ),
		)
	);
    register_block_pattern_category(
        'cph/moxy',
        array(
            'label'       => __( 'Moxy Front Page', 'cph' ),
        )
    );
    
}
add_action( 'init', 'starter_register_block_pattern_categories' );