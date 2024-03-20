<?php

/**
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/public
 */
class Comblock_Auth_Public
{
	/**
	 * @since 1.0.0
	 * @access private
	 * @var string $comblock_auth
	 */
	private $comblock_auth;

	/**
	 * @since 1.0.0
	 * @access private
	 * @var string $version
	 */
	private $version;

	/**
	 * @since 1.0.0
	 * @param string $comblock_auth
	 * @param string $version
	 */
	public function __construct($comblock_auth, $version)
	{
		$this->comblock_auth = $comblock_auth;
		$this->version = $version;
	}

	/**
	 * @since 1.0.0
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style($this->comblock_auth, plugin_dir_url(__FILE__) . 'css/comblock-auth-public.css', [], $this->version, 'all');
	}

	/**
	 * @since 1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->comblock_auth, plugin_dir_url(__FILE__) . 'js/comblock-auth-public.js', ['jquery'], $this->version, false);
	}
}
