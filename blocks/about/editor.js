(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var getBlockType = wp.blocks.getBlockType;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
    var RichText = wp.blockEditor.RichText;
    var useBlockProps = wp.blockEditor.useBlockProps;
    var Button = wp.components.Button;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var blockName = 'cph/about';
    var fallbackAlt = 'Hotel team member preparing a breakfast table in a Rhodes courtyard';

    if (getBlockType(blockName)) {
        return;
    }

    registerBlockType(blockName, {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var blockProps = useBlockProps({ className: 'alignfull cph-about' });

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'About Image', initialOpen: true },
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                allowedTypes: ['image'],
                                value: attributes.imageId || 0,
                                onSelect: function (media) {
                                    setAttributes({
                                        imageId: media && media.id ? media.id : 0,
                                        imageUrl: media && media.url ? media.url : '',
                                        imageAlt: media && media.alt ? media.alt : attributes.imageAlt
                                    });
                                },
                                render: function (mediaProps) {
                                    return el(Button, {
                                        variant: 'secondary',
                                        onClick: mediaProps.open
                                    }, attributes.imageUrl ? 'Replace Image' : 'Choose Image');
                                }
                            })
                        ),
                        attributes.imageUrl && el(Button, {
                            variant: 'tertiary',
                            onClick: function () {
                                setAttributes({ imageId: 0, imageUrl: '', imageAlt: fallbackAlt });
                            },
                            style: { marginLeft: '8px' }
                        }, 'Use Default Image'),
                        el(TextControl, {
                            label: 'Image Alt Text',
                            help: 'Describe the image for guests who cannot see it.',
                            value: attributes.imageAlt || '',
                            onChange: function (value) {
                                setAttributes({ imageAlt: value });
                            }
                        })
                    )
                ),
                el('section', blockProps,
                    el('div', { className: 'cph-about__inner' },
                        el('header', { className: 'cph-about__header' },
                            el(RichText, {
                                tagName: 'h2',
                                identifier: 'heading',
                                className: 'cph-about__heading',
                                value: attributes.heading || '',
                                allowedFormats: [],
                                placeholder: 'About Us',
                                onChange: function (value) {
                                    setAttributes({ heading: value });
                                }
                            })
                        ),
                        el('div', { className: 'cph-about__layout' },
                            attributes.imageUrl
                                ? el('figure', { className: 'cph-about__media' },
                                    el('img', {
                                        className: 'cph-about__image',
                                        src: attributes.imageUrl,
                                        alt: attributes.imageAlt || ''
                                    })
                                )
                                : el('figure', {
                                    className: 'cph-about__media cph-about__media--fallback',
                                    role: 'img',
                                    'aria-label': attributes.imageAlt || fallbackAlt
                                }),
                            el(RichText, {
                                tagName: 'div',
                                identifier: 'body',
                                className: 'cph-about__story',
                                value: attributes.body || '',
                                allowedFormats: ['core/bold', 'core/italic', 'core/link'],
                                placeholder: 'Tell the CityPlus story...',
                                onChange: function (value) {
                                    setAttributes({ body: value });
                                }
                            })
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
