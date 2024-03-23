<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Activator
{
	/**
	 * @since 1.0.0
	 */
	public static function activate(): void
	{
		$page = new Comblock_Auth_Page();
		$page->add_pages();
	}
}
