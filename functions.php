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
                'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&family=Open+Sans:wght@400;600;700&display=swap',
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
    wp_enqueue_style( 'cph-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&family=Open+Sans:wght@400;600;700&display=swap', array(), null );

	// Disable this if you want don't want to include the CSS Framework
    wp_enqueue_style( 'css-framework', get_stylesheet_directory_uri() . '/assets/css/css-framework.css', [], filemtime(get_stylesheet_directory() . '/assets/css/css-framework.css') );
 	// Disable this if you want don't want to include the Font Icons CSS 
	wp_enqueue_style('icons-css',get_stylesheet_directory_uri() . '/assets/css/icon-fonts.css',[],wp_get_theme()->get( 'Version' ));

    $component_styles = array(
        'cph-header'        => '/assets/css/components/cph-header.css',
        'cph-hero'          => '/assets/css/components/cph-hero.css',
        'cph-sections'      => '/assets/css/components/cph-sections.css',
        'cph-tabs'          => '/assets/css/components/cph-tabs.css',
        'cph-carousel'      => '/assets/css/components/cph-carousel.css',
        'cph-modal'         => '/assets/css/components/cph-modal.css',
        'cph-footer'        => '/assets/css/components/cph-footer.css',
        'cph-contact-form'  => '/assets/css/components/cph-contact-form.css',
        'cph-room-card'     => '/assets/css/components/cph-room-card.css',
        'cph-rooms-query'   => '/assets/css/components/cph-rooms-query.css',
        'cph-room-gallery'  => '/assets/css/components/cph-room-gallery.css',
        'cph-room-features' => '/assets/css/components/cph-room-features.css',
        'cph-room-booking'  => '/assets/css/components/cph-room-booking.css',
    );

    foreach ( $component_styles as $handle => $relative_path ) {
        $absolute_path = get_stylesheet_directory() . $relative_path;

        if ( file_exists( $absolute_path ) ) {
            wp_enqueue_style( $handle, get_stylesheet_directory_uri() . $relative_path, array(), filemtime( $absolute_path ) );
        }
    }
    
    wp_enqueue_script( 'starter-js', get_stylesheet_directory_uri() . '/assets/js/js.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/js.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'starter_block_theme_enqueue_scripts' );


// Removes custom Site Editor template overrides for this theme when requested by an administrator.
function cph_reset_block_theme_overrides() {
    if ( empty( $_GET['cph_reset_fse'] ) || ! is_user_logged_in() || ! current_user_can( 'edit_theme_options' ) ) {
        return;
    }

    if ( wp_doing_ajax() ) {
        return;
    }

    $theme_slug    = get_stylesheet();
    $deleted_count = 0;
    $post_types    = array( 'wp_template', 'wp_template_part' );

    foreach ( $post_types as $post_type ) {
        $post_ids = get_posts(
            array(
                'post_type'      => $post_type,
                'post_status'    => 'any',
                'numberposts'    => -1,
                'fields'         => 'ids',
                'suppress_filters' => false,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'wp_theme',
                        'field'    => 'slug',
                        'terms'    => $theme_slug,
                    ),
                ),
            )
        );

        foreach ( $post_ids as $post_id ) {
            if ( wp_delete_post( $post_id, true ) ) {
                $deleted_count++;
            }
        }
    }

    $redirect_url = remove_query_arg( 'cph_reset_fse' );
    $redirect_url = add_query_arg( 'cph_reset_fse_done', $deleted_count, $redirect_url );

    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'init', 'cph_reset_block_theme_overrides' );


function cph_render_block_theme_reset_notice() {
    if ( ! is_admin() || ! current_user_can( 'edit_theme_options' ) || ! isset( $_GET['cph_reset_fse_done'] ) ) {
        return;
    }

    $count = absint( $_GET['cph_reset_fse_done'] );
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php echo esc_html( sprintf( 'CPH CPH reset complete. Removed %d custom template override(s).', $count ) ); ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'cph_render_block_theme_reset_notice' );


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
        'cph/cph',
        array(
            'label'       => __( 'CPH Front Page', 'cph' ),
        )
    );
    
}
add_action( 'init', 'starter_register_block_pattern_categories' );

// Register Custom Post Type for Rooms
function cph_register_room_post_type() {
    $labels = array(
        'name'                  => _x( 'Rooms', 'Post type general name', 'cph' ),
        'singular_name'         => _x( 'Room', 'Post type singular name', 'cph' ),
        'menu_name'             => _x( 'Rooms', 'Admin Menu text', 'cph' ),
        'add_new'               => __( 'Add New', 'cph' ),
        'add_new_item'          => __( 'Add New Room', 'cph' ),
        'new_item'              => __( 'New Room', 'cph' ),
        'edit_item'             => __( 'Edit Room', 'cph' ),
        'view_item'             => __( 'View Room', 'cph' ),
        'all_items'             => __( 'All Rooms', 'cph' ),
        'search_items'          => __( 'Search Rooms', 'cph' ),
        'not_found'             => __( 'No rooms found.', 'cph' ),
        'not_found_in_trash'    => __( 'No rooms found in Trash.', 'cph' ),
        'featured_image'        => _x( 'Room Featured Image', 'Overrides the "Featured Image" phrase', 'cph' ),
        'set_featured_image'    => _x( 'Set room image', 'Overrides the "Set featured image" phrase', 'cph' ),
        'remove_featured_image' => _x( 'Remove room image', 'Overrides the "Remove featured image" phrase', 'cph' ),
        'use_featured_image'    => _x( 'Use as room image', 'Overrides the "Use as featured image" phrase', 'cph' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'rooms' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes', 'excerpt' ),
        'show_in_rest'       => true,
        'taxonomies'         => array( 'cph_hotel_location' ),
    );

    register_post_type( 'cph_room', $args );
}
add_action( 'init', 'cph_register_room_post_type', 0 );

// Register Hidden Hotel Location Taxonomy
function cph_register_hotel_location_taxonomy() {
    $labels = array(
        'name'          => _x( 'Hotels', 'taxonomy general name', 'cph' ),
        'singular_name' => _x( 'Hotel', 'taxonomy singular name', 'cph' ),
        'search_items'  => __( 'Search Hotels', 'cph' ),
        'all_items'     => __( 'All Hotels', 'cph' ),
        'edit_item'     => __( 'Edit Hotel', 'cph' ),
        'update_item'   => __( 'Update Hotel', 'cph' ),
        'add_new_item'  => __( 'Add New Hotel', 'cph' ),
        'new_item_name' => __( 'New Hotel Name', 'cph' ),
        'menu_name'     => __( 'Hotels', 'cph' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
        'public'            => false,
        'show_in_nav_menus' => false,
        'show_in_rest'      => true,
        'show_tagcloud'     => false,
        'show_in_quick_edit'=> true,
    );

    register_taxonomy( 'cph_hotel_location', array( 'cph_room' ), $args );
}
add_action( 'init', 'cph_register_hotel_location_taxonomy', 0 );

function cph_register_custom_blocks() {
    $block_paths = array(
        get_template_directory() . '/blocks/header',
        get_template_directory() . '/blocks/footer',
        get_template_directory() . '/blocks/hero',
        get_template_directory() . '/blocks/tabs',
        get_template_directory() . '/blocks/carousel',
        get_template_directory() . '/blocks/contact-form',
        get_template_directory() . '/blocks/room-card',
        get_template_directory() . '/blocks/rooms-query',
        get_template_directory() . '/blocks/room-gallery',
        get_template_directory() . '/blocks/room-features',
        get_template_directory() . '/blocks/room-booking',
    );

    foreach ( $block_paths as $block_path ) {
        if ( file_exists( $block_path . '/block.json' ) ) {
            // Unregister if already registered to prevent duplicates
            $block_data = json_decode( file_get_contents( $block_path . '/block.json' ), true );
            if ( ! empty( $block_data['name'] ) && WP_Block_Type_Registry::get_instance()->is_registered( $block_data['name'] ) ) {
                unregister_block_type( $block_data['name'] );
            }
            register_block_type( $block_path );
        }
    }
}
add_action( 'init', 'cph_register_custom_blocks', 20 );
