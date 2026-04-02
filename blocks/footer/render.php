<?php
$defaults = array(
    'menuOneRef'       => 0,
    'menuTwoRef'       => 0,
    'socialHeading'    => 'Stay Connected',
    'promoCopy'        => 'Explore the possibilities. What you need, when you need it.',
    'promoButtonLabel' => 'Learn More',
    'promoButtonUrl'   => 'https://mobileapp.marriott.com/',
    'legalCopy'        => 'Copyright © 2026 CityPlusHotels, Rhodes, Greece',
);

$attrs = wp_parse_args( $attributes, $defaults );

$social_heading     = esc_html( $attrs['socialHeading'] );
$legal_copy         = esc_html( $attrs['legalCopy'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-footer alignfull',
    )
);
?>
<footer <?php echo $wrapper_attributes; ?>>
    <div class="cph-footer__inner alignwide">
        <div class="wp-block-columns are-vertically-aligned-top cph-footer__columns">
            <div class="wp-block-column is-vertically-aligned-top cph-footer__menu-column" style="flex-basis:25%">
                <h4 class="cph-footer__heading">Quick Links</h4>
                <ul class="cph-footer__list">
                    <li class="cph-footer__list-item">News</li>
                    <li class="cph-footer__list-item">Hotel Development</li>
                    <li class="cph-footer__list-item">Terms of Use</li>
                </ul>
            </div>
            <div class="wp-block-column is-vertically-aligned-top cph-footer__menu-column" style="flex-basis:25%">
                <h4 class="cph-footer__heading">Company</h4>
                <ul class="cph-footer__list">
                    <li class="cph-footer__list-item"><a class="cph-footer__list-link" href="/jobs">Jobs</a></li>
                    <li class="cph-footer__list-item">About CPH</li>
                    <li class="cph-footer__list-item">Privacy Statement</li>
                </ul>
            </div>
            <div class="wp-block-column is-vertically-aligned-top cph-footer__social-column" style="flex-basis:25%">
                <h4 class="cph-footer__heading"><?php echo $social_heading; ?></h4>
                <ul class="cph-footer__list">
                    <li class="cph-footer__list-item">Instagram</li>
                    <li class="cph-footer__list-item">Facebook</li>
                    <li class="cph-footer__list-item">YouTube</li>
                </ul>
            </div>
            <div class="wp-block-column is-vertically-aligned-top cph-footer__contact-column" style="flex-basis:25%">
                <h4 class="cph-footer__heading">Contact Us</h4>
                <p class="cph-footer__contact-item"><strong>Address:</strong><br>123 Hotel Street<br>Rhodes, Greece 85100</p>
                <p class="cph-footer__contact-item"><strong>Phone:</strong><br>+30 123 456 7890</p>
                <p class="cph-footer__contact-item"><strong>Email:</strong><br>info@cityplushotels.gr</p>
            </div>
        </div>
    </div>
    <div class="cph-footer__legal-strip alignfull">
        <p class="cph-footer__legal-copy"><?php echo $legal_copy; ?></p>
    </div>
</footer>
