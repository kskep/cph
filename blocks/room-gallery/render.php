<?php
/**
 * Room Gallery Block Render Template
 * 
 * @package cph
 */

$defaults = array(
    'featuredImageId'        => 0,
    'featuredImageUrl'       => '',
    'featuredImageAlt'       => '',
    'featuredImageMobileUrl' => '',
    'featuredImageMobileAlt' => '',
    'galleryImages'          => array(),
    'mobileGalleryImages'    => array(),
    'layout'                 => 'grid',
    'columns'                => 3,
    'featuredFirst'          => true,
    'enableLightbox'         => true,
    'showCaptions'           => false,
);

$attrs = wp_parse_args( $attributes, $defaults );

// Get current room post data if in context
$room_post = get_post();
$is_room = $room_post && $room_post->post_type === 'cph_room';

// If no featured image set, try to get from room post
if ( empty( $attrs['featuredImageUrl'] ) && $is_room ) {
    $featured = get_the_post_thumbnail_url( $room_post->ID, 'large' );
    if ( $featured ) {
        $attrs['featuredImageUrl'] = $featured;
        $attrs['featuredImageAlt'] = get_post_meta( get_post_thumbnail_id( $room_post->ID ), '_wp_attachment_image_alt', true );
    }
}

// If no gallery images set, try to get from room post meta
if ( empty( $attrs['galleryImages'] ) && $is_room ) {
    $gallery_ids = get_post_meta( $room_post->ID, 'gallery_images', true );
    if ( is_array( $gallery_ids ) ) {
        foreach ( $gallery_ids as $img_id ) {
            $img_url = wp_get_attachment_image_url( $img_id, 'large' );
            $img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
            if ( $img_url ) {
                $attrs['galleryImages'][] = array(
                    'id'    => $img_id,
                    'url'   => $img_url,
                    'alt'   => $img_alt,
                );
            }
        }
    }
}

// Prepare images
$featured_desktop = ! empty( $attrs['featuredImageUrl'] ) ? esc_url( $attrs['featuredImageUrl'] ) : '';
$featured_mobile  = ! empty( $attrs['featuredImageMobileUrl'] ) ? esc_url( $attrs['featuredImageMobileUrl'] ) : $featured_desktop;
$featured_alt     = ! empty( $attrs['featuredImageAlt'] ) ? esc_attr( $attrs['featuredImageAlt'] ) : __( 'Room featured image', 'cph' );
$featured_alt_mobile = ! empty( $attrs['featuredImageMobileAlt'] ) ? esc_attr( $attrs['featuredImageMobileAlt'] ) : $featured_alt;

$gallery = is_array( $attrs['galleryImages'] ) ? $attrs['galleryImages'] : array();
$mobile_gallery = is_array( $attrs['mobileGalleryImages'] ) ? $attrs['mobileGalleryImages'] : array();

// Layout classes
$layout_class = 'cph-room-gallery__layout--' . esc_attr( $attrs['layout'] );
$columns_class = $attrs['layout'] === 'grid' ? 'cph-room-gallery__grid--cols-' . absint( $attrs['columns'] ) : '';

// Check if we have any images
$has_images = ! empty( $featured_desktop ) || ! empty( $gallery );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-room-gallery ' . $layout_class,
        'data-enable-lightbox' => $attrs['enableLightbox'] ? 'true' : 'false',
    )
);
?>
<?php if ( $has_images ) : ?>
<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $attrs['featuredFirst'] && $featured_desktop ) : ?>
        <!-- Featured Image -->
        <div class="cph-room-gallery__featured">
            <a href="<?php echo $featured_desktop; ?>" 
               class="cph-room-gallery__link"
               data-lightbox="room-gallery"
               data-title="<?php echo $featured_alt; ?>">
                <img 
                    src="<?php echo $featured_desktop; ?>" 
                    alt="<?php echo $featured_alt; ?>" 
                    class="cph-room-gallery__image cph-room-gallery__image--desktop cph-room-gallery__image--featured"
                    loading="lazy"
                >
                <?php if ( $featured_mobile ) : ?>
                    <img 
                        src="<?php echo $featured_mobile; ?>" 
                        alt="<?php echo $featured_alt_mobile; ?>" 
                        class="cph-room-gallery__image cph-room-gallery__image--mobile cph-room-gallery__image--featured"
                        loading="lazy"
                    >
                <?php endif; ?>
                <?php if ( $attrs['enableLightbox'] ) : ?>
                    <span class="cph-room-gallery__zoom-icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 19H5V5H11V3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H11V19ZM21 12L17 12V15L13 11L17 7V10L21 10V12Z" fill="currentColor"/>
                        </svg>
                    </span>
                <?php endif; ?>
            </a>
        </div>
    <?php endif; ?>
    
    <?php if ( ! empty( $gallery ) ) : ?>
        <!-- Gallery Grid -->
        <div class="cph-room-gallery__grid <?php echo esc_attr( $columns_class ); ?>">
            <?php foreach ( $gallery as $index => $image ) : 
                $img_url   = ! empty( $image['url'] ) ? esc_url( $image['url'] ) : '';
                $img_alt   = ! empty( $image['alt'] ) ? esc_attr( $image['alt'] ) : '';
                $img_caption = ! empty( $image['caption'] ) ? esc_attr( $image['caption'] ) : '';
                
                // Get mobile fallback
                $mobile_img = isset( $mobile_gallery[$index] ) && ! empty( $mobile_gallery[$index]['url'] ) 
                    ? esc_url( $mobile_gallery[$index]['url'] ) 
                    : $img_url;
                $mobile_alt = isset( $mobile_gallery[$index] ) && ! empty( $mobile_gallery[$index]['alt'] ) 
                    ? esc_attr( $mobile_gallery[$index]['alt'] ) 
                    : $img_alt;
                
                if ( ! $img_url ) continue;
            ?>
                <div class="cph-room-gallery__item">
                    <a href="<?php echo $img_url; ?>" 
                       class="cph-room-gallery__link"
                       data-lightbox="room-gallery"
                       data-title="<?php echo $img_caption ? $img_caption : $img_alt; ?>">
                        <img 
                            src="<?php echo $img_url; ?>" 
                            alt="<?php echo $img_alt; ?>" 
                            class="cph-room-gallery__image cph-room-gallery__image--desktop"
                            loading="lazy"
                        >
                        <img 
                            src="<?php echo $mobile_img; ?>" 
                            alt="<?php echo $mobile_alt; ?>" 
                            class="cph-room-gallery__image cph-room-gallery__image--mobile"
                            loading="lazy"
                        >
                        <?php if ( $attrs['showCaptions'] && $img_caption ) : ?>
                            <span class="cph-room-gallery__caption"><?php echo esc_html( $img_caption ); ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php else : ?>
    <div <?php echo $wrapper_attributes; ?>>
        <p class="cph-room-gallery__empty"><?php esc_html_e( 'No images available for this room.', 'cph' ); ?></p>
    </div>
<?php endif; ?>
