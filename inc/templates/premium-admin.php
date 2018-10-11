<h1>Premium Sidebar Options</h1>
<?php settings_errors(); ?>
<?php 
    $picture = esc_attr( get_option( 'profile_picture' ) );
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    $fullName = $firstName . ' ' . $lastName;
    $description = esc_attr( get_option( 'user_description' ) );
?>

<div class="premium-sidebar-preview">
    <div class="premium-sidbar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
        </div>
        <h1 class="premium-username"><?php print $fullName ?></h1>
        <h2 class="premium-description"><?php print $description ?></h2>
        <div class="icons-wrapper">
        
        </div>
    </div>
</div>

<form action="options.php" method="post" class="premium-general-form">

    <?php settings_fields('premium-settings-group'); ?>
    <?php do_settings_sections('premium'); ?>
    <?php submit_button('Save Changes', 'primary','btnSubmit'); ?>

</form>
