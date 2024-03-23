<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Uninstaller
{
	/**
	 * @since 1.0.0
	 */
	public static function uninstall(): void
	{
		$page = new Comblock_Auth_Page();
		$page->delete_pages();
	}
}
