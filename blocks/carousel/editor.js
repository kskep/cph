(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var registerBlockType = wp.blocks.registerBlockType;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var Button = wp.components.Button;

    var DEFAULT_SLIDES = [
        {
            eyebrow: 'New Places to Stay and Play.',
            title: 'CPH Barcelona',
            location: 'CPH BARCELONA',
            imageUrl: 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=1600&h=900&fit=crop',
            imageAlt: 'CPH Barcelona',
            ctaLabel: 'Visit',
            ctaUrl: '#'
        },
        {
            eyebrow: 'New Places to Stay and Play.',
            title: 'CPH NYC',
            location: 'CPH NYC',
            imageUrl: 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1600&h=900&fit=crop',
            imageAlt: 'CPH NYC',
            ctaLabel: 'Visit',
            ctaUrl: '#'
        }
    ];

    registerBlockType('cph/carousel', {
        edit: function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;
            var slides = Array.isArray(attributes.slides) && attributes.slides.length ? attributes.slides.slice(0, 2) : DEFAULT_SLIDES;

            function updateSlide(index, key, value) {
                var nextSlides = slides.map(function (slide, slideIndex) {
                    if (slideIndex !== index) {
                        return slide;
                    }
                    var nextSlide = Object.assign({}, slide);
                    nextSlide[key] = value;
                    return nextSlide;
                });
                setAttributes({ slides: nextSlides });
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
                    slides.map(function (slide, index) {
                        return el(PanelBody, { title: 'Slide ' + (index + 1), initialOpen: false, key: index },
                            el(TextControl, {
                                label: 'Eyebrow',
                                value: slide.eyebrow || '',
                                onChange: function (value) { updateSlide(index, 'eyebrow', value); }
                            }),
                            el(TextControl, {
                                label: 'Title',
                                value: slide.title || '',
                                onChange: function (value) { updateSlide(index, 'title', value); }
                            }),
                            el(TextControl, {
                                label: 'Location Label',
                                value: slide.location || '',
                                onChange: function (value) { updateSlide(index, 'location', value); }
                            }),
                            el(TextControl, {
                                label: 'CTA Label',
                                value: slide.ctaLabel || '',
                                onChange: function (value) { updateSlide(index, 'ctaLabel', value); }
                            }),
                            el(TextControl, {
                                label: 'CTA URL',
                                value: slide.ctaUrl || '',
                                onChange: function (value) { updateSlide(index, 'ctaUrl', value); }
                            }),
                            el(TextControl, {
                                label: 'Image Alt',
                                value: slide.imageAlt || '',
                                onChange: function (value) { updateSlide(index, 'imageAlt', value); }
                            }),
                            el(MediaUploadCheck, {},
                                el(MediaUpload, {
                                    onSelect: function (media) {
                                        var nextSlides = slides.map(function (existingSlide, slideIndex) {
                                            if (slideIndex !== index) {
                                                return existingSlide;
                                            }
                                            var nextSlide = Object.assign({}, existingSlide);
                                            nextSlide.imageUrl = media && media.url ? media.url : existingSlide.imageUrl;
                                            nextSlide.imageAlt = media && media.alt ? media.alt : existingSlide.imageAlt;
                                            return nextSlide;
                                        });
                                        setAttributes({ slides: nextSlides });
                                    },
                                    allowedTypes: ['image'],
                                    render: function (mediaProps) {
                                        return el(Button, { variant: 'secondary', onClick: mediaProps.open }, slide.imageUrl ? 'Replace Image' : 'Select Image');
                                    }
                                })
                            )
                        );
                    })
                ),
                el('section', { className: 'cph-carousel-section' },
                    el('div', { className: 'cph-carousel-section__label-wrap' },
                        el('div', { className: 'cph-section-label' },
                            el('h2', { className: 'cph-section-label__heading' }, attributes.sectionTitle || '')
                        )
                    ),
                    el('div', { className: 'cph-carousel-slides', style: { height: '420px' } },
                        slides.length ? el('div', { className: 'cph-carousel-slide is-active', style: { position: 'relative', opacity: 1 } },
                            el('div', { className: 'cph-carousel-slide__overlay' },
                                el('p', { className: 'cph-carousel-slide__eyebrow' }, slides[0].eyebrow || ''),
                                el('h3', { className: 'cph-carousel-slide__title' }, slides[0].title || ''),
                                el('span', { className: 'wp-block-button__link wp-element-button' }, slides[0].ctaLabel || '')
                            ),
                            el('p', { className: 'cph-carousel-slide__location' }, slides[0].location || '')
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
