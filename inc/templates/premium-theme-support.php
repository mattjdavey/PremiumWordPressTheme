<h1>Premium Theme Support</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php">
    <?php settings_fields( 'premium-theme-support' ); ?>
    <?php do_settings_sections( 'premium_theme' ); ?>
    <?php submit_button(); ?>
</form>