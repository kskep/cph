(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var getBlockType = wp.blocks.getBlockType;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var SelectControl = wp.components.SelectControl;
    var ToggleControl = wp.components.ToggleControl;
    var useState = wp.element.useState;
    var useEffect = wp.element.useEffect;
    var blockName = 'cph/room-booking';

    if (getBlockType(blockName)) {
        return;
    }

    registerBlockType(blockName, {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            
            var [hotelTerms, setHotelTerms] = useState([]);
            
            // Fetch hotel location terms
            useEffect(function () {
                wp.apiFetch({
                    path: '/wp/v2/cph_hotel_location?per_page=100'
                }).then(function (terms) {
                    setHotelTerms(terms);
                });
            }, []);

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Booking Settings', initialOpen: true },
                        el(TextControl, {
                            label: 'Booking URL',
                            help: 'External booking engine link',
                            type: 'url',
                            value: attributes.bookingUrl || '',
                            onChange: function (value) { setAttributes({ bookingUrl: value }); }
                        }),
                        el(TextControl, {
                            label: 'Button Text',
                            value: attributes.buttonText || '',
                            onChange: function (value) { setAttributes({ buttonText: value }); }
                        }),
                        el(SelectControl, {
                            label: 'Button Style',
                            value: attributes.buttonStyle,
                            options: [
                                { label: 'Primary (Coral)', value: 'primary' },
                                { label: 'Secondary (Outline)', value: 'secondary' },
                                { label: 'Dark', value: 'dark' }
                            ],
                            onChange: function (value) { setAttributes({ buttonStyle: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Hotel Switcher',
                            help: 'Allow users to switch between hotels',
                            checked: attributes.showHotelSwitcher,
                            onChange: function (value) { setAttributes({ showHotelSwitcher: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Content', initialOpen: false },
                        el(TextControl, {
                            label: 'Title',
                            value: attributes.title || '',
                            onChange: function (value) { setAttributes({ title: value }); }
                        }),
                        el(TextControl, {
                            label: 'Subtitle',
                            value: attributes.subtitle || '',
                            onChange: function (value) { setAttributes({ subtitle: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Show Additional Text',
                            checked: attributes.showAdditionalText,
                            onChange: function (value) { setAttributes({ showAdditionalText: value }); }
                        }),
                        el(TextareaControl, {
                            label: 'Additional Text',
                            help: 'Text displayed below the button (e.g., guarantees, benefits)',
                            value: attributes.additionalText || '',
                            onChange: function (value) { setAttributes({ additionalText: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Layout', initialOpen: false },
                        el(SelectControl, {
                            label: 'Layout Style',
                            value: attributes.layout,
                            options: [
                                { label: 'Vertical (stacked)', value: 'vertical' },
                                { label: 'Horizontal (inline)', value: 'horizontal' }
                            ],
                            onChange: function (value) { setAttributes({ layout: value }); }
                        }),
                        el(ToggleControl, {
                            label: 'Sticky on Scroll',
                            help: 'Keep the booking block visible while scrolling (for single room pages)',
                            checked: attributes.stickyOnScroll,
                            onChange: function (value) { setAttributes({ stickyOnScroll: value }); }
                        })
                    )
                ),
                el('div', { 
                    className: 'cph-room-booking cph-room-booking--preview cph-room-booking--' + attributes.layout,
                    style: {
                        padding: '30px',
                        background: '#F9C740',
                        borderRadius: '8px',
                        textAlign: 'center'
                    }
                },
                    el('h3', { style: { margin: '0 0 10px', color: '#1F2223' } }, 
                        attributes.title || 'Book Your Stay'
                    ),
                    attributes.subtitle && el('p', { style: { margin: '0 0 20px', color: '#1F2223', fontSize: '14px' } }, 
                        attributes.subtitle
                    ),
                    
                    attributes.showHotelSwitcher && hotelTerms.length > 0 && el('div', {
                        style: { marginBottom: '20px' }
                    },
                        el('select', {
                            style: {
                                padding: '10px',
                                borderRadius: '4px',
                                border: '1px solid #ccc',
                                width: '100%'
                            }
                        },
                            hotelTerms.map(function(term) {
                                return el('option', { value: term.slug }, term.name);
                            })
                        )
                    ),
                    
                    el('a', {
                        href: attributes.bookingUrl || '#',
                        style: {
                            display: 'inline-block',
                            padding: '15px 30px',
                            background: '#1F2223',
                            color: '#fff',
                            textDecoration: 'none',
                            borderRadius: '4px',
                            fontWeight: 'bold'
                        }
                    }, attributes.buttonText || 'Check Availability'),
                    
                    attributes.showAdditionalText && el('p', { 
                        style: { 
                            margin: '15px 0 0', 
                            fontSize: '12px', 
                            color: '#1F2223',
                            opacity: '0.8'
                        } 
                    }, attributes.additionalText || 'Best price guaranteed • Free cancellation')
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
