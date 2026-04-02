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
    wp_enqueue_style( 'font-awesome-free', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), null );
    wp_enqueue_style( 'dashicons' );

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

function cph_flush_room_rewrite_rules_once() {
    if ( get_option( 'cph_room_rewrite_flushed' ) ) {
        return;
    }

    cph_register_room_post_type();
    cph_register_hotel_location_taxonomy();
    flush_rewrite_rules( false );
    update_option( 'cph_room_rewrite_flushed', 1 );
}
add_action( 'init', 'cph_flush_room_rewrite_rules_once', 20 );

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

function cph_get_amenity_icon_family_choices() {
    return array(
        'none'            => __( 'No Icon', 'cph' ),
        'icon-font'       => __( 'Theme Icon Font', 'cph' ),
        'dashicons'       => __( 'Dashicons', 'cph' ),
        'font-awesome'    => __( 'Font Awesome Free', 'cph' ),
    );
}

function cph_register_room_amenity_taxonomy() {
    $labels = array(
        'name'              => _x( 'Amenities', 'taxonomy general name', 'cph' ),
        'singular_name'     => _x( 'Amenity', 'taxonomy singular name', 'cph' ),
        'search_items'      => __( 'Search Amenities', 'cph' ),
        'all_items'         => __( 'All Amenities', 'cph' ),
        'edit_item'         => __( 'Edit Amenity', 'cph' ),
        'update_item'       => __( 'Update Amenity', 'cph' ),
        'add_new_item'      => __( 'Add New Amenity', 'cph' ),
        'new_item_name'     => __( 'New Amenity Name', 'cph' ),
        'menu_name'         => __( 'Amenities', 'cph' ),
    );

    register_taxonomy(
        'cph_room_amenity',
        array( 'cph_room' ),
        array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => false,
            'show_in_rest'      => true,
            'show_tagcloud'     => false,
            'meta_box_cb'       => 'post_categories_meta_box',
            'rewrite'           => false,
        )
    );
}
add_action( 'init', 'cph_register_room_amenity_taxonomy', 0 );

function cph_add_room_amenity_term_fields() {
    $icon_families = cph_get_amenity_icon_family_choices();
    ?>
    <div class="form-field term-icon-family-wrap">
        <label for="cph-room-amenity-icon-family"><?php esc_html_e( 'Icon Family', 'cph' ); ?></label>
        <select id="cph-room-amenity-icon-family" name="cph_room_amenity_icon_family">
            <?php foreach ( $icon_families as $value => $label ) : ?>
                <option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
            <?php endforeach; ?>
        </select>
        <p><?php esc_html_e( 'Choose which icon library this amenity should use.', 'cph' ); ?></p>
    </div>
    <div class="form-field term-icon-value-wrap">
        <label for="cph-room-amenity-icon-value"><?php esc_html_e( 'Icon Class or Code', 'cph' ); ?></label>
        <input type="text" id="cph-room-amenity-icon-value" name="cph_room_amenity_icon_value" value="">
        <p><?php esc_html_e( 'Examples: fa-solid fa-wifi, dashicons dashicons-admin-site, or a theme icon class name.', 'cph' ); ?></p>
        <p>
            <a href="https://fontawesome.com/search?m=free" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Browse free Font Awesome icons', 'cph' ); ?></a>
            <?php esc_html_e( 'or', 'cph' ); ?>
            <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'browse Dashicons', 'cph' ); ?></a>
        </p>
        <p>
            <?php esc_html_e( 'Quick guide:', 'cph' ); ?>
            <?php esc_html_e( 'pick an icon library above, open one of the links, copy the icon class, and paste it here.', 'cph' ); ?>
            <?php esc_html_e( 'For Font Awesome use values like', 'cph' ); ?>
            <code>fa-solid fa-wifi</code>.
            <?php esc_html_e( 'For Dashicons use values like', 'cph' ); ?>
            <code>dashicons dashicons-admin-site</code>.
        </p>
    </div>
    <?php
}
add_action( 'cph_room_amenity_add_form_fields', 'cph_add_room_amenity_term_fields' );

function cph_edit_room_amenity_term_fields( $term ) {
    $selected      = get_term_meta( $term->term_id, 'icon_family', true );
    $icon_value    = get_term_meta( $term->term_id, 'icon_value', true );
    $icon_families = cph_get_amenity_icon_family_choices();
    ?>
    <tr class="form-field term-icon-family-wrap">
        <th scope="row"><label for="cph-room-amenity-icon-family"><?php esc_html_e( 'Icon Family', 'cph' ); ?></label></th>
        <td>
            <select id="cph-room-amenity-icon-family" name="cph_room_amenity_icon_family">
                <?php foreach ( $icon_families as $value => $label ) : ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $selected ? $selected : 'none', $value ); ?>><?php echo esc_html( $label ); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description"><?php esc_html_e( 'Choose which icon library this amenity should use.', 'cph' ); ?></p>
        </td>
    </tr>
    <tr class="form-field term-icon-value-wrap">
        <th scope="row"><label for="cph-room-amenity-icon-value"><?php esc_html_e( 'Icon Class or Code', 'cph' ); ?></label></th>
        <td>
            <input type="text" id="cph-room-amenity-icon-value" name="cph_room_amenity_icon_value" value="<?php echo esc_attr( $icon_value ); ?>" class="regular-text">
            <p class="description"><?php esc_html_e( 'Examples: fa-solid fa-wifi, dashicons dashicons-admin-site, or a theme icon class name.', 'cph' ); ?></p>
            <p class="description">
                <a href="https://fontawesome.com/search?m=free" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Browse free Font Awesome icons', 'cph' ); ?></a>
                <?php esc_html_e( 'or', 'cph' ); ?>
                <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'browse Dashicons', 'cph' ); ?></a>
            </p>
            <p class="description">
                <?php esc_html_e( 'Quick guide:', 'cph' ); ?>
                <?php esc_html_e( 'pick an icon library above, open one of the links, copy the icon class, and paste it here.', 'cph' ); ?>
                <?php esc_html_e( 'For Font Awesome use values like', 'cph' ); ?>
                <code>fa-solid fa-wifi</code>.
                <?php esc_html_e( 'For Dashicons use values like', 'cph' ); ?>
                <code>dashicons dashicons-admin-site</code>.
            </p>
        </td>
    </tr>
    <?php
}
add_action( 'cph_room_amenity_edit_form_fields', 'cph_edit_room_amenity_term_fields' );

function cph_save_room_amenity_term_fields( $term_id ) {
    $icon_families = cph_get_amenity_icon_family_choices();
    $icon_family   = isset( $_POST['cph_room_amenity_icon_family'] ) ? sanitize_text_field( wp_unslash( $_POST['cph_room_amenity_icon_family'] ) ) : 'none';
    $icon_value    = isset( $_POST['cph_room_amenity_icon_value'] ) ? sanitize_text_field( wp_unslash( $_POST['cph_room_amenity_icon_value'] ) ) : '';

    if ( ! array_key_exists( $icon_family, $icon_families ) ) {
        $icon_family = 'none';
    }

    update_term_meta( $term_id, 'icon_family', $icon_family );

    if ( '' === $icon_value ) {
        delete_term_meta( $term_id, 'icon_value' );
    } else {
        update_term_meta( $term_id, 'icon_value', $icon_value );
    }
}
add_action( 'created_cph_room_amenity', 'cph_save_room_amenity_term_fields' );
add_action( 'edited_cph_room_amenity', 'cph_save_room_amenity_term_fields' );

function cph_get_room_amenities_data( $room_id ) {
    $terms = get_the_terms( $room_id, 'cph_room_amenity' );

    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return array();
    }

    $amenities = array();

    foreach ( $terms as $term ) {
        $icon_family = get_term_meta( $term->term_id, 'icon_family', true );
        $icon_value  = get_term_meta( $term->term_id, 'icon_value', true );

        $amenities[] = array(
            'label'       => $term->name,
            'category'    => 'general',
            'iconFamily'  => $icon_family ? $icon_family : 'none',
            'iconValue'   => $icon_value,
        );
    }

    return $amenities;
}

function cph_render_amenity_icon( $amenity ) {
    $icon_family = ! empty( $amenity['iconFamily'] ) ? $amenity['iconFamily'] : 'none';
    $icon_value  = ! empty( $amenity['iconValue'] ) ? trim( $amenity['iconValue'] ) : '';

    if ( 'none' === $icon_family || '' === $icon_value ) {
        return '';
    }

    if ( 'font-awesome' === $icon_family || 'dashicons' === $icon_family || 'icon-font' === $icon_family ) {
        return '<span class="cph-room-amenity-icon ' . esc_attr( $icon_value ) . '" aria-hidden="true"></span>';
    }

    return '';
}

function cph_add_room_details_meta_box() {
    add_meta_box(
        'cph-room-details',
        __( 'Room Details', 'cph' ),
        'cph_render_room_details_meta_box',
        'cph_room',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'cph_add_room_details_meta_box' );

function cph_render_room_details_meta_box( $post ) {
    wp_nonce_field( 'cph_save_room_details', 'cph_room_details_nonce' );

    $fields = array(
        'occupancy'     => get_post_meta( $post->ID, 'occupancy', true ),
        'bed_type'      => get_post_meta( $post->ID, 'bed_type', true ),
        'room_size'     => get_post_meta( $post->ID, 'room_size', true ),
        'view_type'     => get_post_meta( $post->ID, 'view_type', true ),
        'floor_level'   => get_post_meta( $post->ID, 'floor_level', true ),
        'booking_url'   => get_post_meta( $post->ID, 'booking_url', true ),
        'gallery_images'=> get_post_meta( $post->ID, 'gallery_images', true ),
    );

    $gallery_ids = '';
    if ( is_array( $fields['gallery_images'] ) ) {
        $gallery_ids = implode( ',', array_map( 'absint', $fields['gallery_images'] ) );
    }
    ?>
    <p><?php esc_html_e( 'Use the main editor for the full room description, the Excerpt for the short summary, and the Featured Image for the main room image.', 'cph' ); ?></p>
    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <th scope="row"><label for="cph-occupancy"><?php esc_html_e( 'Occupancy', 'cph' ); ?></label></th>
                <td><input type="number" min="1" id="cph-occupancy" name="cph_room_details[occupancy]" value="<?php echo esc_attr( $fields['occupancy'] ); ?>" class="small-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cph-bed-type"><?php esc_html_e( 'Bed Type', 'cph' ); ?></label></th>
                <td><input type="text" id="cph-bed-type" name="cph_room_details[bed_type]" value="<?php echo esc_attr( $fields['bed_type'] ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cph-room-size"><?php esc_html_e( 'Room Size', 'cph' ); ?></label></th>
                <td><input type="text" id="cph-room-size" name="cph_room_details[room_size]" value="<?php echo esc_attr( $fields['room_size'] ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cph-view-type"><?php esc_html_e( 'View Type', 'cph' ); ?></label></th>
                <td><input type="text" id="cph-view-type" name="cph_room_details[view_type]" value="<?php echo esc_attr( $fields['view_type'] ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cph-floor-level"><?php esc_html_e( 'Floor Level', 'cph' ); ?></label></th>
                <td><input type="text" id="cph-floor-level" name="cph_room_details[floor_level]" value="<?php echo esc_attr( $fields['floor_level'] ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cph-booking-url"><?php esc_html_e( 'Booking URL', 'cph' ); ?></label></th>
                <td><input type="url" id="cph-booking-url" name="cph_room_details[booking_url]" value="<?php echo esc_attr( $fields['booking_url'] ); ?>" class="large-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="cph-gallery-images"><?php esc_html_e( 'Gallery Image IDs', 'cph' ); ?></label></th>
                <td>
                    <input type="text" id="cph-gallery-images" name="cph_room_details[gallery_images]" value="<?php echo esc_attr( $gallery_ids ); ?>" class="large-text">
                    <p class="description"><?php esc_html_e( 'Optional. Enter media attachment IDs separated by commas for the gallery grid.', 'cph' ); ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <p><?php esc_html_e( 'Select room amenities from the Amenities box in the right sidebar.', 'cph' ); ?></p>
    <?php
}

function cph_save_room_details_meta_box( $post_id ) {
    if ( empty( $_POST['cph_room_details_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cph_room_details_nonce'] ) ), 'cph_save_room_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( empty( $_POST['post_type'] ) || 'cph_room' !== $_POST['post_type'] ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $raw_fields = isset( $_POST['cph_room_details'] ) ? wp_unslash( $_POST['cph_room_details'] ) : array();

    $text_fields = array( 'bed_type', 'room_size', 'view_type', 'floor_level' );
    foreach ( $text_fields as $field ) {
        $value = isset( $raw_fields[ $field ] ) ? sanitize_text_field( $raw_fields[ $field ] ) : '';
        if ( '' === $value ) {
            delete_post_meta( $post_id, $field );
        } else {
            update_post_meta( $post_id, $field, $value );
        }
    }

    $occupancy = isset( $raw_fields['occupancy'] ) ? absint( $raw_fields['occupancy'] ) : 0;
    if ( $occupancy > 0 ) {
        update_post_meta( $post_id, 'occupancy', $occupancy );
    } else {
        delete_post_meta( $post_id, 'occupancy' );
    }

    $booking_url = isset( $raw_fields['booking_url'] ) ? esc_url_raw( $raw_fields['booking_url'] ) : '';
    if ( '' === $booking_url ) {
        delete_post_meta( $post_id, 'booking_url' );
    } else {
        update_post_meta( $post_id, 'booking_url', $booking_url );
    }

    $gallery_ids = array();
    if ( ! empty( $raw_fields['gallery_images'] ) ) {
        $gallery_ids = array_filter( array_map( 'absint', array_map( 'trim', explode( ',', $raw_fields['gallery_images'] ) ) ) );
    }
    if ( ! empty( $gallery_ids ) ) {
        update_post_meta( $post_id, 'gallery_images', array_values( $gallery_ids ) );
    } else {
        delete_post_meta( $post_id, 'gallery_images' );
    }

}
add_action( 'save_post_cph_room', 'cph_save_room_details_meta_box' );

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
            // Register each block once from its block.json metadata.
            register_block_type( $block_path );
        }
    }
}
add_action( 'init', 'cph_register_custom_blocks', 20 );
