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

    registerBlockType('cph/hero', {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Hero Content', initialOpen: true },
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: function (media) {
                                    setAttributes({
                                        heroImageUrl: media && media.url ? media.url : attributes.heroImageUrl,
                                        heroImageAlt: media && media.alt ? media.alt : attributes.heroImageAlt
                                    });
                                },
                                allowedTypes: ['image'],
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, attributes.heroImageUrl ? 'Replace Hero Image' : 'Select Hero Image');
                                }
                            })
                        ),
                        el(TextControl, {
                            label: 'Hero Image Alt',
                            value: attributes.heroImageAlt || '',
                            onChange: function (value) { setAttributes({ heroImageAlt: value }); }
                        }),
                        el(TextControl, {
                            label: 'Tagline Line 1',
                            value: attributes.taglineLineOne || '',
                            onChange: function (value) { setAttributes({ taglineLineOne: value }); }
                        }),
                        el(TextControl, {
                            label: 'Tagline Line 2',
                            value: attributes.taglineLineTwo || '',
                            onChange: function (value) { setAttributes({ taglineLineTwo: value }); }
                        }),
                        el(TextControl, {
                            label: 'Brand Label',
                            value: attributes.brandLabel || '',
                            onChange: function (value) { setAttributes({ brandLabel: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Booking Bar', initialOpen: false },
                        el(TextareaControl, {
                            label: 'Booking Title (supports line breaks)',
                            value: attributes.bookingTitle || '',
                            onChange: function (value) { setAttributes({ bookingTitle: value }); }
                        }),
                        el(TextControl, {
                            label: 'Destination Label',
                            value: attributes.destinationLabel || '',
                            onChange: function (value) { setAttributes({ destinationLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Destination Value',
                            value: attributes.destinationValue || '',
                            onChange: function (value) { setAttributes({ destinationValue: value }); }
                        }),
                        el(TextControl, {
                            label: 'Dates Label',
                            value: attributes.datesLabel || '',
                            onChange: function (value) { setAttributes({ datesLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Check-in Value',
                            value: attributes.checkInValue || '',
                            onChange: function (value) { setAttributes({ checkInValue: value }); }
                        }),
                        el(TextControl, {
                            label: 'Check-out Value',
                            value: attributes.checkOutValue || '',
                            onChange: function (value) { setAttributes({ checkOutValue: value }); }
                        }),
                        el(TextControl, {
                            label: 'CTA Label',
                            value: attributes.ctaLabel || '',
                            onChange: function (value) { setAttributes({ ctaLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'CTA URL',
                            value: attributes.ctaUrl || '',
                            onChange: function (value) { setAttributes({ ctaUrl: value }); }
                        })
                    )
                ),
                el('section', { className: 'cph-hero-section' },
                    el('div', {
                        className: 'cph-hero',
                        style: {
                            minHeight: '420px',
                            position: 'relative',
                            backgroundImage: 'linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.35)), url(' + (attributes.heroImageUrl || '') + ')',
                            backgroundSize: 'cover',
                            backgroundPosition: 'center'
                        }
                    },
                        el('div', { className: 'cph-hero__inner' },
                            el('div', { className: 'cph-hero__tagline' },
                                el('h2', { className: 'cph-hero__tagline-line cph-hero__tagline-line--large' }, attributes.taglineLineOne || ''),
                                el('h2', { className: 'cph-hero__tagline-line' }, attributes.taglineLineTwo || ''),
                                el('hr', { className: 'cph-hero__divider' }),
                                el('p', { className: 'cph-hero__tagline-brand' }, attributes.brandLabel || '')
                            )
                        )
                    ),
                    el('div', { className: 'cph-booking-bar' },
                        el('div', { className: 'cph-booking-bar__inner' },
                            el('div', { className: 'cph-booking-bar__title-box' },
                                el('h3', { className: 'cph-booking-bar__title' }, attributes.bookingTitle || '')
                            ),
                            el('div', { className: 'cph-booking-bar__field' },
                                el('p', { className: 'cph-booking-bar__label' }, attributes.destinationLabel || ''),
                                el('p', { className: 'cph-booking-bar__value' }, attributes.destinationValue || '')
                            ),
                            el('div', { className: 'cph-booking-bar__field cph-booking-bar__field--dates' },
                                el('p', { className: 'cph-booking-bar__label' }, attributes.datesLabel || ''),
                                el('p', { className: 'cph-booking-bar__value cph-booking-bar__value--split' },
                                    el('span', {}, attributes.checkInValue || ''),
                                    el('span', { className: 'cph-booking-bar__dash' }, '-'),
                                    el('span', {}, attributes.checkOutValue || '')
                                )
                            ),
                            el('div', { className: 'cph-booking-bar__cta' },
                                el('span', { className: 'wp-block-button__link wp-element-button' }, attributes.ctaLabel || '')
                            )
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
