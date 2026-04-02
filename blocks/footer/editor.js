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
    var useSelect = wp.data.useSelect;
    var blockName = 'cph/footer';

    if (getBlockType(blockName)) {
        return;
    }

    registerBlockType(blockName, {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var menus = useSelect(function (select) {
                return select('core').getEntityRecords('postType', 'wp_navigation', { per_page: -1 });
            }, []);

            var menuOptions = [{ label: 'Use fallback links', value: 0 }];
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
                    el(PanelBody, { title: 'Menus', initialOpen: true },
                        el(SelectControl, {
                            label: 'Footer Menu 1',
                            value: attributes.menuOneRef || 0,
                            options: menuOptions,
                            onChange: function (value) { setAttributes({ menuOneRef: Number(value) || 0 }); }
                        }),
                        el(SelectControl, {
                            label: 'Footer Menu 2',
                            value: attributes.menuTwoRef || 0,
                            options: menuOptions,
                            onChange: function (value) { setAttributes({ menuTwoRef: Number(value) || 0 }); }
                        })
                    ),
                    el(PanelBody, { title: 'Content', initialOpen: false },
                        el(TextControl, {
                            label: 'Social Heading',
                            value: attributes.socialHeading || '',
                            onChange: function (value) { setAttributes({ socialHeading: value }); }
                        }),
                        el(TextareaControl, {
                            label: 'Promo Copy',
                            value: attributes.promoCopy || '',
                            onChange: function (value) { setAttributes({ promoCopy: value }); }
                        }),
                        el(TextControl, {
                            label: 'Promo Button Label',
                            value: attributes.promoButtonLabel || '',
                            onChange: function (value) { setAttributes({ promoButtonLabel: value }); }
                        }),
                        el(TextControl, {
                            label: 'Promo Button URL',
                            value: attributes.promoButtonUrl || '',
                            onChange: function (value) { setAttributes({ promoButtonUrl: value }); }
                        }),
                        el(TextareaControl, {
                            label: 'Legal Copy',
                            value: attributes.legalCopy || '',
                            onChange: function (value) { setAttributes({ legalCopy: value }); }
                        })
                    )
                ),
                el('footer', { className: 'cph-footer' },
                    el('div', { className: 'cph-footer__inner' },
                        el('p', {}, 'Locked footer layout. Edit content fields in the sidebar.')
                    )
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
