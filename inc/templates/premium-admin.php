<h1>Premium Theme Options</h1>
<?php settings_errors(); ?>
<form action="options.php" method="post">

    <?php settings_fields('premium-settings-group'); ?>
    <?php do_settings_sections('premium'); ?>
    <?php submit_button(); ?>

</form>
