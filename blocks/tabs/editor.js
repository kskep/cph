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
            eyebrow: 'Check In and Start Exploring',
            title: '',
            titleMobile: '',
            lead: 'Your #CityPlus experience begins here.',
            copy: 'A smooth arrival, a warm welcome and everything you need to start discovering Rhodes Island.',
            copySecondary: 'Our reception team is available around the clock from April to October, and 16 hours daily from November to March, ensuring a smooth and comfortable experience throughout your stay.',
            copyMobile: '',
            imageUrl: 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800&h=1000&fit=crop',
            imageAlt: 'Cocktail at the CityPlus bar',
            additionalImages: [],
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
            imageAlt: 'Modern CityPlus guest room',
            additionalImages: [],
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
            imageAlt: 'CityPlus lobby',
            additionalImages: [],
            imageMobileUrl: '',
            imageMobileAlt: '',
            ctaLabel: 'Details',
            ctaUrl: '#'
        },
        {
            tabLabel: '24/7 Beverages and Bites',
            tabLabelMobile: '',
            title: '24/7 Beverages and Bites',
            titleMobile: '',
            copy: 'Hungry at midnight? Thirsty at dawn? Our grab-and-go options and bar service keep you fueled around the clock, because hunger does not check the time.',
            copyMobile: '',
            imageUrl: 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800&h=1000&fit=crop',
            imageAlt: 'CityPlus beverages and bites',
            additionalImages: [],
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
                                label: 'Eyebrow',
                                value: tab.eyebrow || '',
                                onChange: function (value) { updateTab(index, 'eyebrow', value); }
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
                            el(TextControl, {
                                label: 'Lead',
                                value: tab.lead || '',
                                onChange: function (value) { updateTab(index, 'lead', value); }
                            }),
                            el(TextareaControl, {
                                label: 'Copy - Desktop',
                                value: tab.copy || '',
                                onChange: function (value) { updateTab(index, 'copy', value); }
                            }),
                            el(TextareaControl, {
                                label: 'Copy Secondary - Desktop',
                                value: tab.copySecondary || '',
                                onChange: function (value) { updateTab(index, 'copySecondary', value); }
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
                            el(MediaUploadCheck, {},
                                el(MediaUpload, {
                                    onSelect: function (media) {
                                        updateTab(index, 'additionalImages', (Array.isArray(media) ? media : [media]).map(function (image) {
                                            return {
                                                id: image.id,
                                                url: image.url,
                                                alt: image.alt || ''
                                            };
                                        }));
                                    },
                                    allowedTypes: ['image'],
                                    multiple: true,
                                    gallery: true,
                                    value: (tab.additionalImages || []).map(function (image) { return image.id; }),
                                    render: function (mediaProps) {
                                        return el(Button, {
                                            variant: 'secondary',
                                            onClick: mediaProps.open,
                                            style: { marginTop: '8px' }
                                        }, (tab.additionalImages || []).length ? 'Edit Slider Images' : 'Add Slider Images');
                                    }
                                })
                            ),
                            (tab.additionalImages || []).length > 0 && el('div', {
                                style: {
                                    display: 'grid',
                                    gridTemplateColumns: 'repeat(3, 1fr)',
                                    gap: '8px',
                                    marginTop: '8px'
                                }
                            }, (tab.additionalImages || []).map(function (image) {
                                return el('img', {
                                    key: image.id || image.url,
                                    src: image.url,
                                    alt: image.alt || '',
                                    style: { width: '100%', height: '60px', objectFit: 'cover' }
                                });
                            })),
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
