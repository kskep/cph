(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var getBlockType = wp.blocks.getBlockType;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var blockName = 'cph/contact-form';

    if (getBlockType(blockName)) {
        return;
    }

    registerBlockType(blockName, {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Section Header', initialOpen: true },
                        el(TextControl, {
                            label: 'Section Title',
                            value: attributes.sectionTitle || '',
                            onChange: function (value) { setAttributes({ sectionTitle: value }); }
                        }),
                        el(TextControl, {
                            label: 'Section Subtitle',
                            value: attributes.sectionSubtitle || '',
                            onChange: function (value) { setAttributes({ sectionSubtitle: value }); }
                        }),
                        el(TextControl, {
                            label: 'Booking Note',
                            value: attributes.bookingNote || '',
                            onChange: function (value) { setAttributes({ bookingNote: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Form Labels', initialOpen: false },
                        el(TextControl, {
                            label: 'Name Field Label',
                            value: attributes.nameLabel || '',
                            onChange: function (value) { setAttributes({ nameLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Email Field Label',
                            value: attributes.emailLabel || '',
                            onChange: function (value) { setAttributes({ emailLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Phone Field Label',
                            value: attributes.phoneLabel || '',
                            onChange: function (value) { setAttributes({ phoneLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Subject Field Label',
                            value: attributes.subjectLabel || '',
                            onChange: function (value) { setAttributes({ subjectLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Message Field Label',
                            value: attributes.messageLabel || '',
                            onChange: function (value) { setAttributes({ messageLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Submit Button Label',
                            value: attributes.submitLabel || '',
                            onChange: function (value) { setAttributes({ submitLabel: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Form Settings', initialOpen: false },
                        el(TextareaControl, {
                            label: 'Success Message',
                            value: attributes.successMessage || '',
                            onChange: function (value) { setAttributes({ successMessage: value }); }
                        }),
                        el(TextControl, {
                            label: 'Recipient Email (optional)',
                            value: attributes.recipientEmail || '',
                            onChange: function (value) { setAttributes({ recipientEmail: value }); }
                        })
                    )
                ),
                el('section', { className: 'cph-contact-section' },
                    el('div', { className: 'cph-contact__header' },
                        el('h2', { className: 'cph-contact__title' }, attributes.sectionTitle || ''),
                        attributes.sectionSubtitle ? el('p', { className: 'cph-contact__subtitle' }, attributes.sectionSubtitle) : null,
                        attributes.bookingNote ? el('p', { className: 'cph-contact__booking-note' }, 
                            el('span', { className: 'cph-contact__note-icon' }, 'i'),
                            ' ' + attributes.bookingNote
                        ) : null
                    ),
                    el('div', { className: 'cph-contact__form-preview' },
                        el('p', { style: { fontStyle: 'italic', color: '#666' } }, 'Contact form will be displayed here on the frontend.')
                    )
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
