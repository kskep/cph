(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var SelectControl = wp.components.SelectControl;
    var Button = wp.components.Button;
    var useSelect = wp.data.useSelect;

    registerBlockType('cph/header', {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var menus = useSelect(function (select) {
                return select('core').getEntityRecords('postType', 'wp_navigation', { per_page: -1 });
            }, []);

            var menuOptions = [{ label: 'Use fallback menu', value: 0 }];
            if (Array.isArray(menus)) {
                menus.forEach(function (menu) {
                    menuOptions.push({
                        label: menu.title && menu.title.rendered ? menu.title.rendered : ('Menu #' + menu.id),
                        value: menu.id
                    });
                });
            }

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Branding', initialOpen: true },
                        el(MediaUploadCheck, {},
                            el(MediaUpload, {
                                onSelect: function (media) {
                                    setAttributes({
                                        logoUrl: media && media.url ? media.url : attributes.logoUrl,
                                        logoAlt: media && media.alt ? media.alt : attributes.logoAlt
                                    });
                                },
                                allowedTypes: ['image'],
                                render: function (mediaProps) {
                                    return el(Button, { variant: 'secondary', onClick: mediaProps.open }, attributes.logoUrl ? 'Replace Logo' : 'Select Logo');
                                }
                            })
                        ),
                        el(TextControl, {
                            label: 'Logo Alt',
                            value: attributes.logoAlt || '',
                            onChange: function (value) { setAttributes({ logoAlt: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Top Utility', initialOpen: false },
                        el(TextControl, {
                            label: 'Language Label',
                            value: attributes.languageLabel || '',
                            onChange: function (value) { setAttributes({ languageLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Email Label',
                            value: attributes.emailLabel || '',
                            onChange: function (value) { setAttributes({ emailLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Email URL',
                            value: attributes.emailUrl || '',
                            onChange: function (value) { setAttributes({ emailUrl: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Navigation', initialOpen: false },
                        el(SelectControl, {
                            label: 'Navigation Menu',
                            value: attributes.navigationRef || 0,
                            options: menuOptions,
                            onChange: function (value) { setAttributes({ navigationRef: Number(value) || 0 }); }
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
                el('header', { className: 'cph-header js-cph-header', style: { position: 'relative' } },
                    el('div', { className: 'cph-header__inner' },
                        el('div', { className: 'cph-header__brand' },
                            attributes.logoUrl
                                ? el('a', { className: 'cph-header__logo-mark cph-header__logo-mark--image', href: '#' },
                                    el('img', { src: attributes.logoUrl, alt: attributes.logoAlt || '', style: { width: '100%', height: 'auto' } })
                                )
                                : el('a', { className: 'cph-header__logo-mark', href: '#' }, el('strong', {}, 'CPH'))
                        ),
                        el('div', { className: 'cph-header__right' },
                            el('div', { className: 'cph-header__utility' },
                                el('div', { className: 'cph-header__utility-inner' },
                                    el('p', { className: 'cph-header__utility-item cph-header__utility-item--language' }, attributes.languageLabel || ''),
                                    el('p', { className: 'cph-header__utility-item cph-header__utility-item--email' }, attributes.emailLabel || '')
                                )
                            ),
                            el('div', { className: 'cph-header__main' },
                                el('div', { className: 'cph-header__nav' }, 'Selected menu renders on frontend.'),
                                el('div', { className: 'cph-header__actions' },
                                    el('span', { className: 'wp-block-button__link wp-element-button' }, attributes.ctaLabel || '')
                                )
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
