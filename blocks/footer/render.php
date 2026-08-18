<?php
$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'cph-footer alignfull',
    )
);
?>
<footer <?php echo $wrapper_attributes; ?>>
    <?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</footer>
