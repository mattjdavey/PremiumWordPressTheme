<h1>Premium Contact Form</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php">
    <?php settings_fields( 'premium-contact-options' ); ?>
    <?php do_settings_sections( 'premium_theme_contact' ); ?>
    <?php submit_button(); ?>
</form>