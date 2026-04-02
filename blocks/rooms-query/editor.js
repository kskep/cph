(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var getBlockType = wp.blocks.getBlockType;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var SelectControl = wp.components.SelectControl;
    var TextControl = wp.components.TextControl;
    var ToggleControl = wp.components.ToggleControl;
    var RangeControl = wp.components.RangeControl;
    var useState = wp.element.useState;
    var useEffect = wp.element.useEffect;
    var blockName = 'cph/rooms-query';

    if (getBlockType(blockName)) {
        return;
    }

    registerBlockType(blockName, {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            
            var [hotelTerms, setHotelTerms] = useState([]);
            var [isLoading, setIsLoading] = useState(true);
            
            // Fetch hotel location terms
            useEffect(function () {
                wp.apiFetch({
                    path: '/wp/v2/cph_hotel_location?per_page=100'
                }).then(function (terms) {
                    setHotelTerms(terms);
                    setIsLoading(false);
                }).catch(function () {
                    setIsLoading(false);
                });
            }, []);

            // Build hotel options
            var hotelOptions = [{ label: 'All Hotels', value: '' }];
            if (hotelTerms.length > 0) {
                hotelTerms.forEach(function (term) {
                    hotelOptions.push({
                        label: term.name,
                        value: term.slug
                    });
                });
            }

            return el(Fragment, {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'Query Settings', initialOpen: true },
                        isLoading 
                            ? el('p', {}, 'Loading hotels...')
                            : el(SelectControl, {
                                label: 'Filter by Hotel Location',
                                help: 'Select a hotel to display only rooms from that location',
                                value: attributes.hotelLocation,
                                options: hotelOptions,
                                onChange: function (value) { setAttributes({ hotelLocation: value }); }
                            }),
                        el(RangeControl, {
                            label: 'Rooms Per Page',
                            value: attributes.postsPerPage,
                            onChange: function (value) { setAttributes({ postsPerPage: value }); },
                            min: 1,
                            max: 24
                        }),
                        el(RangeControl, {
                            label: 'Columns',
                            value: attributes.columns,
                            onChange: function (value) { setAttributes({ columns: value }); },
                            min: 1,
                            max: 4
                        })
                    ),
                    el(PanelBody, { title: 'Ordering', initialOpen: false },
                        el(SelectControl, {
                            label: 'Order By',
                            value: attributes.orderBy,
                            options: [
                                { label: 'Menu Order', value: 'menu_order' },
                                { label: 'Title', value: 'title' },
                                { label: 'Date Published', value: 'date' },
                                { label: 'Date Modified', value: 'modified' }
                            ],
                            onChange: function (value) { setAttributes({ orderBy: value }); }
                        }),
                        el(SelectControl, {
                            label: 'Order',
                            value: attributes.order,
                            options: [
                                { label: 'Ascending (A-Z, oldest first)', value: 'asc' },
                                { label: 'Descending (Z-A, newest first)', value: 'desc' }
                            ],
                            onChange: function (value) { setAttributes({ order: value }); }
                        })
                    ),
                    el(PanelBody, { title: 'Empty State', initialOpen: false },
                        el(ToggleControl, {
                            label: 'Show empty state message',
                            checked: attributes.showEmptyState,
                            onChange: function (value) { setAttributes({ showEmptyState: value }); }
                        }),
                        el(TextControl, {
                            label: 'Empty State Title',
                            value: attributes.emptyStateTitle,
                            onChange: function (value) { setAttributes({ emptyStateTitle: value }); }
                        }),
                        el(TextControl, {
                            label: 'Empty State Message',
                            value: attributes.emptyStateMessage,
                            onChange: function (value) { setAttributes({ emptyStateMessage: value }); }
                        })
                    )
                ),
                el('div', { 
                    className: 'cph-rooms-query cph-rooms-query--preview',
                    style: {
                        padding: '20px',
                        background: '#f5f5f5',
                        border: '1px dashed #ccc',
                        borderRadius: '4px'
                    }
                },
                    el('div', { style: { marginBottom: '16px', fontWeight: 'bold' } }, 
                        'Rooms Query Block'
                    ),
                    el('p', {}, 
                        attributes.hotelLocation 
                            ? 'Displaying rooms from: ' + attributes.hotelLocation
                            : 'Displaying all rooms'
                    ),
                    el('p', {}, 
                        'Grid: ' + attributes.columns + ' columns, ' + attributes.postsPerPage + ' rooms per page'
                    ),
                    el('div', {
                        className: 'cph-rooms-query__grid',
                        style: {
                            display: 'grid',
                            gridTemplateColumns: 'repeat(' + attributes.columns + ', 1fr)',
                            gap: '20px',
                            marginTop: '16px'
                        }
                    },
                        // Preview placeholders
                        [1, 2, 3].map(function (i) {
                            return el('div', {
                                key: i,
                                style: {
                                    background: '#fff',
                                    padding: '20px',
                                    borderRadius: '4px',
                                    minHeight: '150px',
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    border: '1px solid #ddd'
                                }
                            }, 'Room Card Preview ' + i);
                        })
                    )
                )
            );
        },
        save: function () {
            return null;
        }
    });
})(window.wp);
