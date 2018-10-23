<h1>Premium Custom CSS</h1>
<?php settings_errors(); ?>

<form id="save-custom-css-form" method="post" action="options.php">
    <?php settings_fields( 'premium-custom-css-options' ); ?>
    <?php do_settings_sections( 'premium_css' ); ?>
    <?php submit_button(); ?>
</form>