(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var SelectControl = wp.components.SelectControl;
    var ToggleControl = wp.components.ToggleControl;
    var Button = wp.components.Button;

    registerBlockType('cph/room-features', {
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
                newAmenities.push({ icon: '', label: '', category: 'general' });
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
                    el(PanelBody, { title: 'Room Specifications', initialOpen: true },
                        el(TextControl, {
                            label: 'Maximum Occupancy (guests)',
                            type: 'number',
                            value: attributes.occupancy || '',
                            onChange: function (value) { setAttributes({ occupancy: parseInt(value) || 2 }); }
                        }),
                        el(TextControl, {
                            label: 'Bed Configuration',
                            help: 'e.g., "King Bed", "Two Queen Beds"',
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
                            help: 'e.g., "Ocean View", "City View", "Garden View"',
                            value: attributes.viewType || '',
                            onChange: function (value) { setAttributes({ viewType: value }); }
                        }),
                        el(TextControl, {
                            label: 'Floor Level',
                            help: 'e.g., "Ground Floor", "2nd Floor", "Penthouse"',
                            value: attributes.floorLevel || '',
                            onChange: function (value) { setAttributes({ floorLevel: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Descriptions', initialOpen: false },
                        el(TextareaControl, {
                            label: 'Short Description',
                            help: 'Brief summary for room cards/listings',
                            value: attributes.shortDescription || '',
                            onChange: function (value) { setAttributes({ shortDescription: value }); }
                        }),
                        el(TextareaControl, {
                            label: 'Long Description',
                            help: 'Detailed description for single room page',
                            value: attributes.longDescription || '',
                            onChange: function (value) { setAttributes({ longDescription: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Amenities', initialOpen: false },
                        el(ToggleControl, {
                            label: 'Show Icons',
                            checked: attributes.showIcons,
                            onChange: function (value) { setAttributes({ showIcons: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Group by Category',
                            checked: attributes.groupByCategory,
                            onChange: function (value) { setAttributes({ groupByCategory: value }); }
                        }),
                        el('div', { style: { marginTop: '16px' } },
                            el('h4', {}, 'Amenity List'),
                            attributes.amenities.map(function (amenity, index) {
                                return el('div', { 
                                    key: index, 
                                    style: { 
                                        marginBottom: '12px', 
                                        padding: '12px', 
                                        background: '#f0f0f0', 
                                        borderRadius: '4px' 
                                    } 
                                },
                                    el(TextControl, {
                                        label: 'Icon Class',
                                        value: amenity.icon || '',
                                        onChange: function (value) { updateAmenity(index, 'icon', value); }
                                    }),
                                    el(TextControl, {
                                        label: 'Amenity Label',
                                        value: amenity.label || '',
                                        onChange: function (value) { updateAmenity(index, 'label', value); }
                                    }),
                                    el(SelectControl, {
                                        label: 'Category',
                                        value: amenity.category || 'general',
                                        options: [
                                            { label: 'General', value: 'general' },
                                            { label: 'Technology', value: 'technology' },
                                            { label: 'Comfort', value: 'comfort' },
                                            { label: 'Dining', value: 'dining' },
                                            { label: 'Security', value: 'security' },
                                            { label: 'Bathroom', value: 'bathroom' },
                                            { label: 'Accessibility', value: 'accessibility' }
                                        ],
                                        onChange: function (value) { updateAmenity(index, 'category', value); }
                                    }),
                                    el(Button, {
                                        variant: 'tertiary',
                                        isDestructive: true,
                                        onClick: function () { removeAmenity(index); },
                                        style: { marginTop: '8px' }
                                    }, 'Remove')
                                );
                            }),
                            el(Button, {
                                variant: 'secondary',
                                onClick: addAmenity,
                                style: { marginTop: '8px' }
                            }, '+ Add Amenity')
                        )
                    ),
                    el(PanelBody, { title: 'Display Options', initialOpen: false },
                        el(SelectControl, {
                            label: 'Display Style',
                            value: attributes.displayStyle,
                            options: [
                                { label: 'List', value: 'list' },
                                { label: 'Grid', value: 'grid' },
                                { label: 'Icons Only', value: 'icons' },
                                { label: 'Compact', value: 'compact' }
                            ],
                            onChange: function (value) { setAttributes({ displayStyle: value }); }
                        })
                    )
                ),
                el('div', { 
                    className: 'cph-room-features cph-room-features--preview',
                    style: {
                        padding: '20px',
                        background: '#f5f5f5',
                        border: '1px dashed #ccc',
                        borderRadius: '4px'
                    }
                },
                    el('div', { style: { marginBottom: '16px', fontWeight: 'bold' } }, 
                        'Room Features Block'
                    ),
                    
                    // Specs preview
                    el('div', { className: 'cph-room-features__specs' },
                        el('h4', {}, 'Room Specifications'),
                        el('ul', {},
                            attributes.occupancy && el('li', {}, 'Sleeps: ' + attributes.occupancy),
                            attributes.bedType && el('li', {}, 'Bed: ' + attributes.bedType),
                            attributes.roomSize && el('li', {}, 'Size: ' + attributes.roomSize),
                            attributes.viewType && el('li', {}, 'View: ' + attributes.viewType),
                            attributes.floorLevel && el('li', {}, 'Floor: ' + attributes.floorLevel)
                        )
                    ),
                    
                    // Amenities preview
                    attributes.amenities.length > 0 && el('div', { className: 'cph-room-features__amenities', style: { marginTop: '16px' } },
                        el('h4', {}, 'Amenities'),
                        el('div', {
                            style: {
                                display: 'grid',
                                gridTemplateColumns: 'repeat(2, 1fr)',
                                gap: '8px'
                            }
                        },
                            attributes.amenities.map(function (amenity, i) {
                                return el('span', { key: i },
                                    amenity.icon && el('span', {}, '[' + amenity.icon + '] '),
                                    amenity.label
                                );
                            })
                        )
                    ),
                    
                    // Description preview
                    (attributes.shortDescription || attributes.longDescription) && el('div', { style: { marginTop: '16px' } },
                        el('h4', {}, 'Description'),
                        attributes.shortDescription && el('p', { style: { fontStyle: 'italic' } }, attributes.shortDescription),
                        attributes.longDescription && el('div', {}, attributes.longDescription)
                    )
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
