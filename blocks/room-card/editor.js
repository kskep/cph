(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var Button = wp.components.Button;
    var SelectControl = wp.components.SelectControl;
    var ToggleControl = wp.components.ToggleControl;
    var RangeControl = wp.components.RangeControl;
    var RepeaterControl = wp.components;

    registerBlockType('cph/room-card', {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            // Handle amenity changes
            function updateAmenity(index, field, value) {
                var newAmenities = attributes.amenities.map(function (amenity, i) {
                    if (i === index) {
                        var updated = Object.assign({}, amenity);
                        updated[field] = value;
                        return updated;
                    }
                    return amenity;
                });
                setAttributes({ amenities: newAmenities });
            }

            function addAmenity() {
                var newAmenities = attributes.amenities.slice();
                newAmenities.push({ icon: '', label: '' });
                setAttributes({ amenities: newAmenities });
            }

            function removeAmenity(index) {
                var newAmenities = attributes.amenities.filter(function (_, i) {
                    return i !== index;
                });
                setAttributes({ amenities: newAmenities });
            }

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Room Selection', initialOpen: true },
                        el(TextControl, {
                            label: 'Room Post ID (optional)',
                            help: 'Enter a room post ID to auto-populate from that room, or leave blank to use manual fields below',
                            type: 'number',
                            value: attributes.roomId || '',
                            onChange: function (value) { setAttributes({ roomId: parseInt(value) || 0 }); }
                        })
                    ),
                    el(PanelBody, { title: 'Layout Options', initialOpen: false },
                        el(SelectControl, {
                            label: 'Card Layout',
                            value: attributes.layout,
                            options: [
                                { label: 'Vertical (image on top)', value: 'vertical' },
                                { label: 'Horizontal (image on left)', value: 'horizontal' }
                            ],
                            onChange: function (value) { setAttributes({ layout: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Room Details',
                            checked: attributes.showDetails,
                            onChange: function (value) { setAttributes({ showDetails: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Amenities Preview',
                            checked: attributes.showAmenitiesPreview,
                            onChange: function (value) { setAttributes({ showAmenitiesPreview: value }); }
                        }),
                        el(RangeControl, {
                            label: 'Amenities to Show',
                            value: attributes.amenitiesPreviewCount,
                            onChange: function (value) { setAttributes({ amenitiesPreviewCount: value }); },
                            min: 1,
                            max: 8
                        })
                    ),
                    el(PanelBody, { title: 'Room Images', initialOpen: false },
                        el('h3', {}, 'Desktop Image'),
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: function (media) {
                                    setAttributes({
                                        desktopImageId: media && media.id ? media.id : 0,
                                        desktopImageUrl: media && media.url ? media.url : '',
                                        desktopImageAlt: media && media.alt ? media.alt : ''
                                    });
                                },
                                allowedTypes: ['image'],
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, 
                                        attributes.desktopImageUrl ? 'Replace Desktop Image' : 'Select Desktop Image'
                                    );
                                }
                            })
                        ),
                        el(TextControl, {
                            label: 'Desktop Image Alt Text',
                            value: attributes.desktopImageAlt || '',
                            onChange: function (value) { setAttributes({ desktopImageAlt: value }); }
                        }),
                        el('hr', { style: { margin: '16px 0' } }),
                        el('h3', {}, 'Mobile Image (optional fallback)'),
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: function (media) {
                                    setAttributes({
                                        mobileImageId: media && media.id ? media.id : 0,
                                        mobileImageUrl: media && media.url ? media.url : '',
                                        mobileImageAlt: media && media.alt ? media.alt : ''
                                    });
                                },
                                allowedTypes: ['image'],
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, 
                                        attributes.mobileImageUrl ? 'Replace Mobile Image' : 'Select Mobile Image'
                                    );
                                }
                            })
                        ),
                        el(TextControl, {
                            label: 'Mobile Image Alt Text',
                            value: attributes.mobileImageAlt || '',
                            onChange: function (value) { setAttributes({ mobileImageAlt: value }); }
                        }),
                        attributes.mobileImageUrl && el(Button, {
                            variant: 'tertiary',
                            onClick: function () { 
                                setAttributes({ mobileImageId: 0, mobileImageUrl: '', mobileImageAlt: '' }); 
                            },
                            style: { marginTop: '8px' }
                        }, 'Clear Mobile Image')
                    ),
                    el(PanelBody, { title: 'Room Details', initialOpen: false },
                        el(TextareaControl, {
                            label: 'Short Description',
                            value: attributes.shortDescription || '',
                            onChange: function (value) { setAttributes({ shortDescription: value }); }
                        }),
                        el(TextControl, {
                            label: 'Maximum Occupancy (guests)',
                            type: 'number',
                            value: attributes.occupancy || '',
                            onChange: function (value) { setAttributes({ occupancy: parseInt(value) || 2 }); }
                        }),
                        el(TextControl, {
                            label: 'Bed Configuration',
                            value: attributes.bedType || '',
                            onChange: function (value) { setAttributes({ bedType: value }); }
                        }),
                        el(TextControl, {
                            label: 'Room Size',
                            help: 'e.g., "450 sq ft / 42 m²"',
                            value: attributes.roomSize || '',
                            onChange: function (value) { setAttributes({ roomSize: value }); }
                        }),
                        el(TextControl, {
                            label: 'View Type',
                            help: 'e.g., "Ocean View", "City View"',
                            value: attributes.viewType || '',
                            onChange: function (value) { setAttributes({ viewType: value }); }
                        }),
                        el(TextControl, {
                            label: 'Floor Level',
                            help: 'e.g., "Ground Floor", "2nd Floor"',
                            value: attributes.floorLevel || '',
                            onChange: function (value) { setAttributes({ floorLevel: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Amenities', initialOpen: false },
                        el('p', { style: { marginBottom: '12px', color: '#666' } }, 
                            'Add amenities to display on the room card. First ' + attributes.amenitiesPreviewCount + ' will be shown.'
                        ),
                        attributes.amenities.map(function (amenity, index) {
                            return el('div', { 
                                key: index, 
                                style: { 
                                    marginBottom: '16px', 
                                    padding: '12px', 
                                    background: '#f0f0f0', 
                                    borderRadius: '4px' 
                                } 
                            },
                                el(TextControl, {
                                    label: 'Amenity Icon Class (optional)',
                                    value: amenity.icon || '',
                                    onChange: function (value) { updateAmenity(index, 'icon', value); }
                                }),
                                el(TextControl, {
                                    label: 'Amenity Label',
                                    value: amenity.label || '',
                                    onChange: function (value) { updateAmenity(index, 'label', value); }
                                }),
                                el(Button, {
                                    variant: 'tertiary',
                                    isDestructive: true,
                                    onClick: function () { removeAmenity(index); },
                                    style: { marginTop: '8px' }
                                }, 'Remove Amenity')
                            );
                        }),
                        el(Button, {
                            variant: 'secondary',
                            onClick: addAmenity,
                            style: { marginTop: '8px' }
                        }, '+ Add Amenity')
                    ),
                    el(PanelBody, { title: 'Buttons', initialOpen: false },
                        el(TextControl, {
                            label: 'Booking/External URL',
                            value: attributes.bookingUrl || '',
                            onChange: function (value) { setAttributes({ bookingUrl: value }); }
                        }),
                        el(TextControl, {
                            label: 'View Room Button Text',
                            value: attributes.viewRoomText || '',
                            onChange: function (value) { setAttributes({ viewRoomText: value }); }
                        }),
                        el(TextControl, {
                            label: 'Book Now Button Text',
                            value: attributes.bookNowText || '',
                            onChange: function (value) { setAttributes({ bookNowText: value }); }
                        })
                    )
                ),
                el('div', { className: 'cph-room-card cph-room-card--' + attributes.layout + ' cph-room-card--preview' },
                    el('div', { className: 'cph-room-card__image-wrapper' },
                        el('img', {
                            src: attributes.desktopImageUrl || 'https://via.placeholder.com/600x400?text=Room+Image',
                            alt: attributes.desktopImageAlt || 'Room preview',
                            className: 'cph-room-card__image'
                        })
                    ),
                    el('div', { className: 'cph-room-card__content' },
                        el('h3', { className: 'cph-room-card__title' }, 'Room Title (preview)'),
                        attributes.showDetails && el('div', { className: 'cph-room-card__details' },
                            el('p', { className: 'cph-room-card__description' }, attributes.shortDescription || 'Short description will appear here'),
                            el('div', { className: 'cph-room-card__specs' },
                                el('span', {}, 'Sleeps ' + (attributes.occupancy || 2)),
                                el('span', {}, attributes.bedType || 'King Bed'),
                                attributes.roomSize && el('span', {}, attributes.roomSize),
                                attributes.viewType && el('span', {}, attributes.viewType)
                            )
                        ),
                        attributes.showAmenitiesPreview && el('div', { className: 'cph-room-card__amenities' },
                            attributes.amenities.slice(0, attributes.amenitiesPreviewCount).map(function (amenity, i) {
                                return el('span', { key: i, className: 'cph-room-card__amenity' }, amenity.label);
                            })
                        ),
                        el('div', { className: 'cph-room-card__actions' },
                            el('span', { className: 'cph-room-card__button' }, attributes.viewRoomText || 'View Room'),
                            el('span', { className: 'cph-room-card__button cph-room-card__button--primary' }, attributes.bookNowText || 'Book Now')
                        )
                    )
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
