<h1>Premium Theme Options</h1>
<?php settings_errors(); ?>
<?php 
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    $fullName = $firstName . ' ' . $lastName;
    $description = esc_attr( get_option( 'user_description' ) );
?>

<div class="premium-sidebar-preview">
    <div class="premium-sidbar">
        <h1 class="premium-username"><?php print $fullName ?></h1>
        <h2 class="premium-description"><?php print $description ?></h2>
        <div class="icons-wrapper">
        
        </div>
    </div>
</div>

<form action="options.php" method="post" class="premium-general-form">

    <?php settings_fields('premium-settings-group'); ?>
    <?php do_settings_sections('premium'); ?>
    <?php submit_button(); ?>

</form>
