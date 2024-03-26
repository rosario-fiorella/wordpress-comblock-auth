<?php

/**
 * @link              https://github.com/rosario-fiorella/wordpress-comblock-auth/
 * @since             1.0.0
 * @package           wordpress-comblock-auth
 * @author            Rosario Fiorella
 *
 * @wordpress-plugin
 * Plugin Name:       Comblock Front-End Login
 * Plugin URI:        https://github.com/rosario-fiorella/wordpress-comblock-auth/
 * Description:       WordPress plugin that allows you to authenticate users in the front-end in a reserved area .
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Rosario Fiorella
 * Author URI:        https://github.com/rosario-fiorella/
 * Text Domain:       comblock-auth
 * Update URI:        /
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('WPINC')) {
    die;
}

if (defined('WP_CLI') && WP_CLI) {
    return;
}

/**
 * @see https://semver.org
 */
define('COMBLOCK_AUTH_VERSION', '1.0.0');
define('COMBLOCK_AUTH_DOMAIN', 'comblock-auth');
define('COMBLOCK_AUTH_PLUGIN_FILE', __FILE__);

require_once plugin_dir_path(__FILE__) . 'includes/class-comblock-auth.php';

try {
    $comblock_auth = new Comblock_Auth();
    $comblock_auth->run();
} catch (Throwable $e) {
    add_action(
        'admin_notices',
        /**
         * @since 1.0.0
         * @return void
         */
        function () use ($e): void {
            printf(
                '<div class="error">
                    <pre>%s</pre>
                    <p>in <strong>%s</strong> at line <strong>%s</strong></p>
                </div>',
                esc_html($e->getMessage()),
                esc_html($e->getFile()),
                esc_html($e->getLine())
            );
        }
    );
}
