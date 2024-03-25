<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
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

    $page = new Comblock_Auth_Page();
    $page->delete_pages();
} catch (Throwable $e) {
    error_log($e->getMessage());
}
