<?php
/*
Plugin Name: WP CLI WooCommerce Wizard
Plugin URI: https://github.com/montrealist/wp-cli-woo-activate
Description: Completes WooCommerce wizard 
Author: Max Kovalenkov
Version: 1.0.0
Author URI: https://liro.ca/
*/

class WP_CLI_Woo_Activate
{
    public function hey()
    {
        WP_CLI::line('Hello!');
    }

    /**
     * Activates WooCommerce
     *
     * @since  0.0.1
     * @author Max Kovalenkov
     */
    public function a()
    {
        // $options = array(
        //     'return'     => true,   // Return 'STDOUT'; use 'all' for full object.
        //     'parse'      => 'json', // Parse captured STDOUT to JSON array.
        //     'launch'     => false,  // Reuse the current process.
        //     'exit_error' => true,   // Halt script execution on error.
        // );
        // $plugins = WP_CLI::runcommand('plugin list --format=json', $options);
        // error_log(print_r($plugins ,true));
        $options = array(
            'return'     => true,   // Return 'STDOUT'; use 'all' for full object.
            'exit_error' => true,   // Halt script execution on error. // TODO: false and an error message if WooCommerce plugin is not present?
        );
        WP_CLI::line('Starting');
        $out = WP_CLI::runcommand('plugin activate woocommerce', $options);
        // error_log(print_r($out, true));
        WP_CLI::line($out);

        // WP_CLI::runcommand('wp option set woocommerce_onboarding_opt_in "yes"');
        // WP_CLI::line( 'Set option woocommerce_onboarding_opt_in' );
    }
}

/**
 * Registers our command when CLI is initialized.
 *
 * @since  1.0.0
 * @author Max Kovalenkov
 */
function wp_cli_woo_register_commands()
{
    WP_CLI::add_command('woo', 'WP_CLI_Woo_Activate');
}

if (defined('WP_CLI') && WP_CLI) { // TODO: is this needed?
    add_action('cli_init', 'wp_cli_woo_register_commands');
}
