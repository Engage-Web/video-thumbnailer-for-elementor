<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//register settings

function vtfe_options_add() {
	register_setting( 'vtfe_settings', 'vtfe_settings', array( 'sanitize_callback' => 'vtfe_sanitize_settings' ) );
}

function vtfe_sanitize_settings( $settings ) {
	$settings = is_array( $settings ) ? $settings : array();

	return array(
		'elementor_default_switch'      => isset( $settings['elementor_default_switch'] ) && 'true' === $settings['elementor_default_switch'] ? 'true' : 'false',
		'elementor_default_crop_switch' => isset( $settings['elementor_default_crop_switch'] ) && 'true' === $settings['elementor_default_crop_switch'] ? 'true' : 'false',
	);
}

//add settings page to menu

function vtfe_add_options() {
	add_options_page( __( 'Video Thumbnailer for Elementor', 'video-thumbnailer-for-elementor' ), __( 'Video Thumbnailer for Elementor', 'video-thumbnailer-for-elementor' ), 'manage_options', 'vtfe_settings', 'vtfe_settings_page' );
}

//add actions

add_action( 'admin_init', 'vtfe_options_add' );
add_action( 'admin_menu', 'vtfe_add_options' );

//start settings page

function vtfe_settings_page() {
	$options = get_option( 'vtfe_settings' );
	$options = is_array( $options ) ? $options : array();
	$default_switch      = isset( $options['elementor_default_switch'] ) ? $options['elementor_default_switch'] : 'false';
	$default_crop_switch = isset( $options['elementor_default_crop_switch'] ) ? $options['elementor_default_crop_switch'] : 'false';
	?>
<div>
    <form method="post" action="options.php" class="vtfe_form">
        <h1 class="text-center mb-3">Video Thumbnailer for Elementor - Settings</h1>
        <?php settings_fields( 'vtfe_settings' ); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-3 bg-primary text-white rounded">
                        <h2 class="text-black bg-white p-2 rounded">Default to on or off</h2>
                        <h3 class="text-white">
                            <input type="radio" id="vtfe_settings[elementor_default_switch]-on" name="vtfe_settings[elementor_default_switch]" value="true" <?php checked( $default_switch, 'true' ); ?>>
                            <label for="vtfe_settings[elementor_default_switch]-on">
                                <?php esc_html_e( 'Default On', 'video-thumbnailer-for-elementor' ); ?>
                            </label>
                        </h3>
                        <h3 class="text-white">
                            <input type="radio" id="vtfe_settings[elementor_default_switch]-off" name="vtfe_settings[elementor_default_switch]" value="false" <?php checked( $default_switch, 'false' ); ?>>
                            <label for="vtfe_settings[elementor_default_switch]-off">
                                <?php esc_html_e( 'Default Off', 'video-thumbnailer-for-elementor' ); ?>
                            </label>
                        </h3>
                        <p> Use this setting to switch the automatic thumbnails on by default for all Elementor videos. This will only work for videos where you have not set it directly for that particular video in the Elementor interface yet. Once set, you may have to clear the cache for any pages with Elementor videos to see the change. </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3 bg-primary text-white rounded">
                        <h2 class="text-black bg-white p-2 rounded">Default to crop or not</h2>
                        <h3 class="text-white">
                            <input type="radio" id="vtfe_settings[elementor_default_crop_switch]-on" name="vtfe_settings[elementor_default_crop_switch]" value="true" <?php checked( $default_crop_switch, 'true' ); ?>>
                            <label for="vtfe_settings[elementor_default_crop_switch]-on">
                                <?php esc_html_e( 'Default On', 'video-thumbnailer-for-elementor' ); ?>
                            </label>
                        </h3>
                        <h3 class="text-white">
                            <input type="radio" id="vtfe_settings[elementor_default_crop_switch]-off" name="vtfe_settings[elementor_default_crop_switch]" value="false" <?php checked( $default_crop_switch, 'false' ); ?>>
                            <label for="vtfe_settings[elementor_default_crop_switch]-off">
                                <?php esc_html_e( 'Default Off', 'video-thumbnailer-for-elementor' ); ?>
                            </label>
                        </h3>
                        <p> Use this setting to crop video thumbnails (as opposed to resizing for the space) by default for all Elementor videos. This will only work for videos where you have not set it directly for that particular video in the Elementor interface yet. Once set, you may have to clear the cache for any pages with Elementor videos to see the change. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center p-4">
            <p>
				<input name="submit" id="submit" value="Save Changes" type="submit" class="button button-primary">
            </p>
            <h2>Donate</h2>
            <p>We have developed and continue to maintain this free plugin but if you have found it useful and wish to contribute towards our development costs at Engage Web, donating via PayPal is safe, fast and easy!</p>
			<p><a class="button button-secondary" href="https://www.paypal.com/donate/?hosted_button_id=6V8QKMWESU7AU" target="_blank" rel="noopener noreferrer">Donate with PayPal</a></p>
        </div>
    </form>
</div>
<?php
}
