(function (wp) {
    var el = wp.element.createElement;
    var getBlockType = wp.blocks.getBlockType;
    var registerBlockType = wp.blocks.registerBlockType;
    var InnerBlocks = wp.blockEditor.InnerBlocks;
    var blockName = 'cph/footer';

    var footerTemplate = [
        [
            'core/group',
            {
                align: 'wide',
                className: 'cph-footer__inner cph-container',
                layout: { type: 'constrained' }
            },
            [
                [
                    'core/columns',
                    {
                        className: 'cph-footer__columns',
                        verticalAlignment: 'top'
                    },
                    [
                        [
                            'core/column',
                            {
                                className: 'cph-footer__menu-column',
                                verticalAlignment: 'top',
                                width: '25%'
                            },
                            [
                                [
                                    'core/heading',
                                    { className: 'cph-footer__heading', fontSize: 'xsmall', level: 4 },
                                    'Quick Links'
                                ],
                                [
                                    'core/list',
                                    {
                                        className: 'cph-footer__list',
                                        values: '<li><a href="/news">News</a></li><li><a href="/terms-of-use">Terms of Use</a></li>'
                                    }
                                ]
                            ]
                        ],
                        [
                            'core/column',
                            {
                                className: 'cph-footer__menu-column',
                                verticalAlignment: 'top',
                                width: '25%'
                            },
                            [
                                [
                                    'core/heading',
                                    { className: 'cph-footer__heading', fontSize: 'xsmall', level: 4 },
                                    'Company'
                                ],
                                [
                                    'core/list',
                                    {
                                        className: 'cph-footer__list',
                                        values: '<li><a href="/jobs">Jobs</a></li><li><a href="/about">About Us</a></li><li><a href="/financial-reports">Financial Reports</a></li>'
                                    }
                                ]
                            ]
                        ],
                        [
                            'core/column',
                            {
                                className: 'cph-footer__social-column',
                                verticalAlignment: 'top',
                                width: '25%'
                            },
                            [
                                [
                                    'core/heading',
                                    { className: 'cph-footer__heading', fontSize: 'xsmall', level: 4 },
                                    'Stay Connected'
                                ],
                                [
                                    'core/list',
                                    {
                                        className: 'cph-footer__list',
                                        values: '<li><a href="https://instagram.com/">Instagram</a></li><li><a href="https://facebook.com/">Facebook</a></li>'
                                    }
                                ]
                            ]
                        ],
                        [
                            'core/column',
                            {
                                className: 'cph-footer__contact-column',
                                verticalAlignment: 'top',
                                width: '25%'
                            },
                            [
                                [
                                    'core/heading',
                                    { className: 'cph-footer__heading', fontSize: 'xsmall', level: 4 },
                                    'Contact Us'
                                ],
                                [
                                    'core/paragraph',
                                    { className: 'cph-footer__contact-item', fontSize: 'xsmall' },
                                    '<strong>Address:</strong><br>Kolokotroni 114 Str.<br>Rhodes, Greece 85100'
                                ],
                                [
                                    'core/paragraph',
                                    { className: 'cph-footer__contact-item', fontSize: 'xsmall' },
                                    '<strong>Phone:</strong><br>+30 2241 02251<br>+30 2241 43064'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        [
            'core/group',
            {
                align: 'full',
                className: 'cph-footer__legal-strip',
                layout: { type: 'constrained' }
            },
            [
                [
                    'core/paragraph',
                    {
                        align: 'center',
                        className: 'cph-footer__legal-copy',
                        fontSize: 'xsmall'
                    },
                    'Copyright © 2026 CityPlusHotels, Rhodes, Greece'
                ]
            ]
        ]
    ];

    if (getBlockType(blockName)) {
        return;
    }

    registerBlockType(blockName, {
        edit: function (props) {
            return el('footer', { className: 'cph-footer alignfull' },
                el(InnerBlocks, {
                    template: footerTemplate,
                    templateLock: false
                })
            );
        },
        save: function () {
            return el(InnerBlocks.Content, {});
        }
    });
})(window.wp);
