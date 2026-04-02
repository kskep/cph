(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var getBlockType = wp.blocks.getBlockType;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var Button = wp.components.Button;
    var blockName = 'cph/tabs';

    if (getBlockType(blockName)) {
        return;
    }

    var DEFAULT_TABS = [
        {
            tabLabel: 'Check in at the Bar',
            tabLabelMobile: '',
            title: 'Check in at the Bar',
            titleMobile: '',
            copy: 'Forget the front desk. CPH instantly eases you into a playful stay with a cocktail (or mocktail) to go along with your room key when you check in at the bar. We\'re accommodating like that.',
            copyMobile: '',
            imageUrl: 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800&h=1000&fit=crop',
            imageAlt: 'Cocktail at the CPH bar',
            imageMobileUrl: '',
            imageMobileAlt: '',
            ctaLabel: 'Details',
            ctaUrl: '#'
        },
        {
            tabLabel: 'Your Room',
            tabLabelMobile: '',
            title: 'Your Room',
            titleMobile: '',
            copy: 'Our rooms are smartly designed for the way you actually travel. With modular furniture, furiously fast Wi-Fi, and plush bedding that\'ll make you hit snooze at least five times.',
            copyMobile: '',
            imageUrl: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=1000&fit=crop',
            imageAlt: 'Modern CPH guest room',
            imageMobileUrl: '',
            imageMobileAlt: '',
            ctaLabel: 'Details',
            ctaUrl: '#'
        },
        {
            tabLabel: 'Not Your Average Lobby',
            tabLabelMobile: '',
            title: 'Not Your Average Lobby',
            titleMobile: '',
            copy: 'Our lobbies are designed for socializing. Think chic seating, games, and an atmosphere that makes you want to linger longer and meet someone new.',
            copyMobile: '',
            imageUrl: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=1000&fit=crop',
            imageAlt: 'CPH lobby',
            imageMobileUrl: '',
            imageMobileAlt: '',
            ctaLabel: 'Details',
            ctaUrl: '#'
        },
        {
            tabLabel: '24/7 Beverages & Bites',
            tabLabelMobile: '',
            title: '24/7 Beverages & Bites',
            titleMobile: '',
            copy: 'Hungry at midnight? Thirsty at dawn? Our grab-and-go options and bar service keep you fueled around the clock, because hunger does not check the time.',
            copyMobile: '',
            imageUrl: 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800&h=1000&fit=crop',
            imageAlt: 'CPH beverages and bites',
            imageMobileUrl: '',
            imageMobileAlt: '',
            ctaLabel: 'Details',
            ctaUrl: '#'
        }
    ];

    registerBlockType(blockName, {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var tabs = Array.isArray(attributes.tabs) && attributes.tabs.length ? attributes.tabs.slice(0, 4) : DEFAULT_TABS;

            function updateTab(index, key, value) {
                var nextTabs = tabs.map(function (tab, tabIndex) {
                    if (tabIndex !== index) {
                        return tab;
                    }
                    var nextTab = Object.assign({}, tab);
                    nextTab[key] = value;
                    return nextTab;
                });
                setAttributes({ tabs: nextTabs });
            }

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Section', initialOpen: true },
                        el(TextControl, {
                            label: 'Section Title',
                            value: attributes.sectionTitle || '',
                            onChange: function (value) { setAttributes({ sectionTitle: value }); }
                        })
                    ),
                    tabs.map(function (tab, index) {
                        return el(PanelBody, { title: 'Tab ' + (index + 1), initialOpen: false, key: index },
                            el('h4', {}, 'Tab & Title Text'),
                            el(TextControl, {
                                label: 'Tab Label - Desktop',
                                value: tab.tabLabel || '',
                                onChange: function (value) { updateTab(index, 'tabLabel', value); }
                            }),
                            el(TextControl, {
                                label: 'Tab Label - Mobile (optional)',
                                value: tab.tabLabelMobile || '',
                                onChange: function (value) { updateTab(index, 'tabLabelMobile', value); }
                            }),
                            el(TextControl, {
                                label: 'Title - Desktop',
                                value: tab.title || '',
                                onChange: function (value) { updateTab(index, 'title', value); }
                            }),
                            el(TextControl, {
                                label: 'Title - Mobile (optional)',
                                value: tab.titleMobile || '',
                                onChange: function (value) { updateTab(index, 'titleMobile', value); }
                            }),
                            el('h4', {}, 'Copy Text'),
                            el(TextareaControl, {
                                label: 'Copy - Desktop',
                                value: tab.copy || '',
                                onChange: function (value) { updateTab(index, 'copy', value); }
                            }),
                            el(TextareaControl, {
                                label: 'Copy - Mobile (optional)',
                                value: tab.copyMobile || '',
                                onChange: function (value) { updateTab(index, 'copyMobile', value); }
                            }),
                            el('h4', {}, 'CTA'),
                            el(TextControl, {
                                label: 'CTA Label',
                                value: tab.ctaLabel || '',
                                onChange: function (value) { updateTab(index, 'ctaLabel', value); }
                            }),
                            el(TextControl, {
                                label: 'CTA URL',
                                value: tab.ctaUrl || '',
                                onChange: function (value) { updateTab(index, 'ctaUrl', value); }
                            }),
                            el('hr', { style: { margin: '16px 0' } }),
                            el('h4', {}, 'Desktop Image'),
                            el(TextControl, {
                                label: 'Image Alt',
                                value: tab.imageAlt || '',
                                onChange: function (value) { updateTab(index, 'imageAlt', value); }
                            }),
                            el(MediaUploadCheck, {},
                                el(MediaUpload, {
                                    onSelect: function (media) {
                                        var nextTabs = tabs.map(function (existingTab, tabIndex) {
                                            if (tabIndex !== index) {
                                                return existingTab;
                                            }
                                            var nextTab = Object.assign({}, existingTab);
                                            nextTab.imageUrl = media && media.url ? media.url : existingTab.imageUrl;
                                            nextTab.imageAlt = media && media.alt ? media.alt : existingTab.imageAlt;
                                            return nextTab;
                                        });
                                        setAttributes({ tabs: nextTabs });
                                    },
                                    allowedTypes: ['image'],
                                    render: function (mediaProps) {
                                        return el(Button, { variant: 'secondary', onClick: mediaProps.open }, tab.imageUrl ? 'Replace Image' : 'Select Image');
                                    }
                                })
                            ),
                            el('hr', { style: { margin: '16px 0' } }),
                            el('h4', {}, 'Mobile Image (optional)'),
                            el(TextControl, {
                                label: 'Mobile Image Alt',
                                value: tab.imageMobileAlt || '',
                                onChange: function (value) { updateTab(index, 'imageMobileAlt', value); }
                            }),
                            el(MediaUploadCheck, {},
                                el(MediaUpload, {
                                    onSelect: function (media) {
                                        var nextTabs = tabs.map(function (existingTab, tabIndex) {
                                            if (tabIndex !== index) {
                                                return existingTab;
                                            }
                                            var nextTab = Object.assign({}, existingTab);
                                            nextTab.imageMobileUrl = media && media.url ? media.url : existingTab.imageMobileUrl;
                                            nextTab.imageMobileAlt = media && media.alt ? media.alt : existingTab.imageMobileAlt;
                                            return nextTab;
                                        });
                                        setAttributes({ tabs: nextTabs });
                                    },
                                    allowedTypes: ['image'],
                                    render: function (mediaProps) {
                                        return el(Button, { variant: 'secondary', onClick: mediaProps.open }, tab.imageMobileUrl ? 'Replace Mobile Image' : 'Select Mobile Image');
                                    }
                                })
                            ),
                            tab.imageMobileUrl && el(Button, {
                                variant: 'tertiary',
                                onClick: function () { updateTab(index, 'imageMobileUrl', ''); },
                                style: { marginTop: '8px' }
                            }, 'Clear Mobile Image')
                        );
                    })
                ),
                el('section', { className: 'cph-tabs-section' },
                    el('div', { className: 'cph-section-label' },
                        el('h2', { className: 'cph-section-label__heading' }, attributes.sectionTitle || '')
                    ),
                    el('div', { className: 'cph-tabs__buttons' },
                        tabs.map(function (tab, index) {
                            return el('div', { className: 'wp-block-button cph-tab-trigger' + (index === 0 ? ' is-active' : ''), key: index },
                                el('span', { className: 'wp-block-button__link wp-element-button' }, tab.tabLabel || '')
                            );
                        })
                    ),
                    el('div', { className: 'cph-tabs__panels' },
                        tabs.length ? el('div', { className: 'cph-tab-panel is-active' },
                            el('div', { className: 'cph-tab-panel__content' },
                                el('h3', { className: 'cph-tab-panel__title' }, tabs[0].title || ''),
                                el('p', { className: 'cph-tab-panel__copy' }, tabs[0].copy || ''),
                                el('span', { className: 'wp-block-button__link wp-element-button' }, tabs[0].ctaLabel || '')
                            )
                        ) : null
                    )
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
