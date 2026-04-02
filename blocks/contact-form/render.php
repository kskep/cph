<?php
$defaults = array(
    'sectionTitle'     => 'Get in Touch',
    'sectionSubtitle'  => "Have a question? We'd love to hear from you.",
    'bookingNote'      => 'For room reservations, please use our booking system above.',
    'nameLabel'        => 'Full Name',
    'emailLabel'       => 'Email Address',
    'phoneLabel'       => 'Phone Number',
    'subjectLabel'     => 'Subject',
    'messageLabel'     => 'Your Message',
    'submitLabel'      => 'Send Message',
    'successMessage'   => "Thank you for your message. We'll get back to you soon.",
    'recipientEmail'   => '',
    'backgroundColor'  => 'custom-white',
);

$attrs = wp_parse_args( $attributes, $defaults );

$section_title    = esc_html( $attrs['sectionTitle'] );
$section_subtitle = esc_html( $attrs['sectionSubtitle'] );
$booking_note     = esc_html( $attrs['bookingNote'] );
$name_label       = esc_html( $attrs['nameLabel'] );
$email_label      = esc_html( $attrs['emailLabel'] );
$phone_label      = esc_html( $attrs['phoneLabel'] );
$subject_label    = esc_html( $attrs['subjectLabel'] );
$message_label    = esc_html( $attrs['messageLabel'] );
$submit_label     = esc_html( $attrs['submitLabel'] );
$success_message  = esc_html( $attrs['successMessage'] );
$recipient_email  = sanitize_email( $attrs['recipientEmail'] );
$bg_color         = esc_attr( $attrs['backgroundColor'] );

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-contact-section',
    )
);

$form_id = 'cph-contact-form-' . uniqid();
?>
<section <?php echo $wrapper_attributes; ?> id="contact">
    <div class="cph-contact-section__inner alignwide cph-container">
        <div class="cph-contact__header">
            <h2 class="cph-contact__title"><?php echo $section_title; ?></h2>
            <?php if ( $section_subtitle ) : ?>
                <p class="cph-contact__subtitle"><?php echo $section_subtitle; ?></p>
            <?php endif; ?>
            <?php if ( $booking_note ) : ?>
                <p class="cph-contact__booking-note">
                    <span class="cph-contact__note-icon">i</span>
                    <?php echo $booking_note; ?>
                </p>
            <?php endif; ?>
        </div>

        <form class="cph-contact__form" id="<?php echo esc_attr( $form_id ); ?>" method="post" action="">
            <?php wp_nonce_field( 'cph_contact_form', 'cph_contact_nonce' ); ?>
            <input type="hidden" name="cph_form_id" value="<?php echo esc_attr( $form_id ); ?>">
            
            <div class="cph-contact__grid">
                <div class="cph-contact__field cph-contact__field--name">
                    <label for="cph-name-<?php echo esc_attr( $form_id ); ?>" class="cph-contact__label">
                        <?php echo $name_label; ?>
                    </label>
                    <input 
                        type="text" 
                        id="cph-name-<?php echo esc_attr( $form_id ); ?>" 
                        name="cph_name" 
                        class="cph-contact__input" 
                        placeholder="Your name"
                        required
                    >
                </div>

                <div class="cph-contact__field cph-contact__field--email">
                    <label for="cph-email-<?php echo esc_attr( $form_id ); ?>" class="cph-contact__label">
                        <?php echo $email_label; ?>
                    </label>
                    <input 
                        type="email" 
                        id="cph-email-<?php echo esc_attr( $form_id ); ?>" 
                        name="cph_email" 
                        class="cph-contact__input" 
                        placeholder="your@email.com"
                        required
                    >
                </div>

                <div class="cph-contact__field cph-contact__field--phone">
                    <label for="cph-phone-<?php echo esc_attr( $form_id ); ?>" class="cph-contact__label">
                        <?php echo $phone_label; ?>
                    </label>
                    <input 
                        type="tel" 
                        id="cph-phone-<?php echo esc_attr( $form_id ); ?>" 
                        name="cph_phone" 
                        class="cph-contact__input" 
                        placeholder="+1 (555) 000-0000"
                    >
                </div>

                <div class="cph-contact__field cph-contact__field--subject">
                    <label for="cph-subject-<?php echo esc_attr( $form_id ); ?>" class="cph-contact__label">
                        <?php echo $subject_label; ?>
                    </label>
                    <select 
                        id="cph-subject-<?php echo esc_attr( $form_id ); ?>" 
                        name="cph_subject" 
                        class="cph-contact__input cph-contact__select"
                        required
                    >
                        <option value="">Select a subject</option>
                        <option value="general">General Inquiry</option>
                        <option value="events">Events & Meetings</option>
                        <option value="feedback">Feedback</option>
                        <option value="careers">Careers</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="cph-contact__field cph-contact__field--message">
                <label for="cph-message-<?php echo esc_attr( $form_id ); ?>" class="cph-contact__label">
                    <?php echo $message_label; ?>
                </label>
                <textarea 
                    id="cph-message-<?php echo esc_attr( $form_id ); ?>" 
                    name="cph_message" 
                    class="cph-contact__input cph-contact__textarea" 
                    rows="6"
                    placeholder="How can we help you?"
                    required
                ></textarea>
            </div>

            <div class="cph-contact__actions">
                <button type="submit" class="cph-contact__submit">
                    <?php echo $submit_label; ?>
                </button>
            </div>

            <div class="cph-contact__success" role="status" aria-live="polite" style="display: none;">
                <p><?php echo $success_message; ?></p>
            </div>
        </form>
    </div>
</section>