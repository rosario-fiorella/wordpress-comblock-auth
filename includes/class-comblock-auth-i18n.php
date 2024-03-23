<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_i18n
{
	/**
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain()
	{
		load_plugin_textdomain(
			COMBLOCK_AUTH_DOMAIN,
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
