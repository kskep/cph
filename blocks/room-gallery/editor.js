(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var getBlockType = wp.blocks.getBlockType;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
    var PanelBody = wp.components.PanelBody;
    var SelectControl = wp.components.SelectControl;
    var ToggleControl = wp.components.ToggleControl;
    var RangeControl = wp.components.RangeControl;
    var Button = wp.components.Button;
    var blockName = 'cph/room-gallery';

    if (getBlockType(blockName)) {
        return;
    }

    registerBlockType(blockName, {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            // Handle featured image selection
            function onSelectFeatured(media) {
                setAttributes({
                    featuredImageId: media && media.id ? media.id : 0,
                    featuredImageUrl: media && media.url ? media.url : '',
                    featuredImageAlt: media && media.alt ? media.alt : ''
                });
            }

            // Handle featured mobile image selection
            function onSelectFeaturedMobile(media) {
                setAttributes({
                    featuredImageMobileUrl: media && media.url ? media.url : '',
                    featuredImageMobileAlt: media && media.alt ? media.alt : ''
                });
            }

            // Handle gallery images selection
            function onSelectGallery(medias) {
                var galleryImages = medias.map(function (media) {
                    return {
                        id: media.id,
                        url: media.url,
                        alt: media.alt,
                        caption: media.caption
                    };
                });
                setAttributes({ galleryImages: galleryImages });
            }

            // Handle mobile gallery images selection
            function onSelectMobileGallery(medias) {
                var mobileImages = medias.map(function (media) {
                    return {
                        id: media.id,
                        url: media.url,
                        alt: media.alt
                    };
                });
                setAttributes({ mobileGalleryImages: mobileImages });
            }

            // Remove gallery image
            function removeGalleryImage(index) {
                var newGallery = attributes.galleryImages.filter(function (_, i) {
                    return i !== index;
                });
                setAttributes({ galleryImages: newGallery });
            }

            // Remove mobile gallery image
            function removeMobileGalleryImage(index) {
                var newMobileGallery = attributes.mobileGalleryImages.filter(function (_, i) {
                    return i !== index;
                });
                setAttributes({ mobileGalleryImages: newMobileGallery });
            }

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Layout Options', initialOpen: true },
                        el(SelectControl, {
                            label: 'Gallery Layout',
                            value: attributes.layout,
                            options: [
                                { label: 'Grid', value: 'grid' },
                                { label: 'Masonry', value: 'masonry' },
                                { label: 'Featured + Thumbnails', value: 'featured-thumbs' }
                            ],
                            onChange: function (value) { setAttributes({ layout: value }); }
                        }),
                        attributes.layout === 'grid' && el(RangeControl, {
                            label: 'Columns',
                            value: attributes.columns,
                            onChange: function (value) { setAttributes({ columns: value }); },
                            min: 1,
                            max: 4
                        }),
                        el(ToggleControl, {
                            label: 'Show Featured Image First (larger)',
                            checked: attributes.featuredFirst,
                            onChange: function (value) { setAttributes({ featuredFirst: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Enable Lightbox',
                            checked: attributes.enableLightbox,
                            onChange: function (value) { setAttributes({ enableLightbox: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Captions',
                            checked: attributes.showCaptions,
                            onChange: function (value) { setAttributes({ showCaptions: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Featured Image', initialOpen: false },
                        el('h3', {}, 'Desktop Featured Image'),
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: onSelectFeatured,
                                allowedTypes: ['image'],
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, 
                                        attributes.featuredImageUrl ? 'Replace Featured Image' : 'Select Featured Image'
                                    );
                                }
                            })
                        ),
                        attributes.featuredImageUrl && el('div', { style: { marginTop: '10px' } },
                            el('img', {
                                src: attributes.featuredImageUrl,
                                style: { maxWidth: '100%', maxHeight: '150px', objectFit: 'cover' }
                            })
                        ),
                        el('hr', { style: { margin: '16px 0' } }),
                        el('h3', {}, 'Mobile Featured Image (optional fallback)'),
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: onSelectFeaturedMobile,
                                allowedTypes: ['image'],
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, 
                                        attributes.featuredImageMobileUrl ? 'Replace Mobile Featured' : 'Select Mobile Featured'
                                    );
                                }
                            })
                        ),
                        attributes.featuredImageMobileUrl && el(Button, {
                            variant: 'tertiary',
                            onClick: function () { 
                                setAttributes({ featuredImageMobileUrl: '', featuredImageMobileAlt: '' }); 
                            },
                            style: { marginTop: '8px' }
                        }, 'Clear Mobile Featured')
                    ),
                    el(PanelBody, { title: 'Gallery Images', initialOpen: false },
                        el('h3', {}, 'Desktop Gallery Images'),
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: onSelectGallery,
                                allowedTypes: ['image'],
                                multiple: true,
                                gallery: true,
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, 
                                        attributes.galleryImages.length > 0 ? 'Add/Edit Gallery Images' : 'Select Gallery Images'
                                    );
                                }
                            })
                        ),
                        attributes.galleryImages.length > 0 && el('div', { 
                            style: { 
                                display: 'grid', 
                                gridTemplateColumns: 'repeat(3, 1fr)', 
                                gap: '8px',
                                marginTop: '10px' 
                            } 
                        },
                            attributes.galleryImages.map(function (image, index) {
                                return el('div', { 
                                    key: index,
                                    style: { position: 'relative' }
                                },
                                    el('img', {
                                        src: image.url,
                                        style: { width: '100%', height: '60px', objectFit: 'cover' }
                                    }),
                                    el(Button, {
                                        variant: 'tertiary',
                                        isDestructive: true,
                                        onClick: function () { removeGalleryImage(index); },
                                        style: { 
                                            position: 'absolute', 
                                            top: '2px', 
                                            right: '2px',
                                            padding: '2px 6px',
                                            fontSize: '10px',
                                            minHeight: 'auto'
                                        }
                                    }, '×')
                                );
                            })
                        ),
                        el('p', { style: { fontSize: '12px', color: '#666', marginTop: '8px' } },
                            'Tip: Select multiple images at once from the media library'
                        ),
                        el('hr', { style: { margin: '16px 0' } }),
                        el('h3', {}, 'Mobile Gallery Images (optional fallbacks)'),
                        el('p', { style: { fontSize: '12px', color: '#666' } },
                            'Upload mobile-optimized versions of your gallery images. If not provided, desktop images will be used.'
                        ),
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: onSelectMobileGallery,
                                allowedTypes: ['image'],
                                multiple: true,
                                gallery: true,
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, 
                                        attributes.mobileGalleryImages.length > 0 ? 'Add/Edit Mobile Images' : 'Select Mobile Gallery Images'
                                    );
                                }
                            })
                        ),
                        attributes.mobileGalleryImages.length > 0 && el('div', { 
                            style: { 
                                display: 'grid', 
                                gridTemplateColumns: 'repeat(3, 1fr)', 
                                gap: '8px',
                                marginTop: '10px' 
                            } 
                        },
                            attributes.mobileGalleryImages.map(function (image, index) {
                                return el('div', { 
                                    key: index,
                                    style: { position: 'relative' }
                                },
                                    el('img', {
                                        src: image.url,
                                        style: { width: '100%', height: '60px', objectFit: 'cover' }
                                    }),
                                    el(Button, {
                                        variant: 'tertiary',
                                        isDestructive: true,
                                        onClick: function () { removeMobileGalleryImage(index); },
                                        style: { 
                                            position: 'absolute', 
                                            top: '2px', 
                                            right: '2px',
                                            padding: '2px 6px',
                                            fontSize: '10px',
                                            minHeight: 'auto'
                                        }
                                    }, '×')
                                );
                            })
                        ),
                        attributes.mobileGalleryImages.length > 0 && el(Button, {
                            variant: 'tertiary',
                            isDestructive: true,
                            onClick: function () { setAttributes({ mobileGalleryImages: [] }); },
                            style: { marginTop: '8px' }
                        }, 'Clear All Mobile Images')
                    )
                ),
                el('div', { 
                    className: 'cph-room-gallery cph-room-gallery--preview',
                    style: {
                        padding: '20px',
                        background: '#f5f5f5',
                        border: '1px dashed #ccc',
                        borderRadius: '4px'
                    }
                },
                    el('div', { style: { marginBottom: '16px', fontWeight: 'bold' } }, 
                        'Room Gallery Block'
                    ),
                    el('p', {}, 'Layout: ' + attributes.layout),
                    attributes.featuredImageUrl && el('div', { style: { marginBottom: '16px' } },
                        el('img', {
                            src: attributes.featuredImageUrl,
                            style: { 
                                width: '100%', 
                                maxHeight: '200px', 
                                objectFit: 'cover',
                                borderRadius: '4px'
                            }
                        })
                    ),
                    attributes.galleryImages.length > 0 && el('div', {
                        style: {
                            display: 'grid',
                            gridTemplateColumns: 'repeat(' + (attributes.layout === 'grid' ? attributes.columns : 3) + ', 1fr)',
                            gap: '10px'
                        }
                    },
                        attributes.galleryImages.slice(0, 6).map(function (image, i) {
                            return el('img', {
                                key: i,
                                src: image.url,
                                style: { 
                                    width: '100%', 
                                    height: '80px', 
                                    objectFit: 'cover',
                                    borderRadius: '4px'
                                }
                            });
                        })
                    ),
                    (!attributes.featuredImageUrl && attributes.galleryImages.length === 0) && 
                        el('p', { style: { color: '#666', fontStyle: 'italic' } }, 'No images selected yet')
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
