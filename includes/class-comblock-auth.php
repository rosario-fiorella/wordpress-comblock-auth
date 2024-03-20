<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth
{
	/**
	 * @since 1.0.0
	 * @access protected
	 * @var Comblock_Auth_Loader $loader
	 */
	protected $loader;

	/**
	 * @since 1.0.0
	 * @access protected
	 * @var string $comblock_auth
	 */
	protected $comblock_auth;

	/**
	 * @since 1.0.0
	 * @access protected
	 * @var string $version
	 */
	protected $version;

	/**
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->version = COMBLOCK_AUTH_VERSION;
		$this->comblock_auth = COMBLOCK_DOMAIN;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_register_hooks();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function load_dependencies()
	{
		require_once plugin_dir_path(__DIR__) . 'includes/class-comblock-auth-activator.php';
		require_once plugin_dir_path(__DIR__) . 'includes/class-comblock-auth-deactivator.php';
		require_once plugin_dir_path(__DIR__) . 'includes/class-comblock-auth-uninstaller.php';
		require_once plugin_dir_path(__DIR__) . 'includes/class-comblock-auth-loader.php';
		require_once plugin_dir_path(__DIR__) . 'includes/class-comblock-auth-i18n.php';
		require_once plugin_dir_path(__DIR__) . 'admin/class-comblock-auth-admin.php';
		require_once plugin_dir_path(__DIR__) . 'public/class-comblock-auth-public.php';

		$this->loader = new Comblock_Auth_Loader();
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function set_locale()
	{
		$plugin_i18n = new Comblock_Auth_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function define_admin_hooks()
	{
		$plugin_admin = new Comblock_Auth_Admin($this->get_comblock_auth(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function define_public_hooks()
	{
		$plugin_public = new Comblock_Auth_Public($this->get_comblock_auth(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function define_register_hooks()
	{
		register_activation_hook(__FILE__, [Comblock_Auth_Activator::class, 'activate']);
		register_deactivation_hook(__FILE__, [Comblock_Auth_Deactivator::class, 'deactivate']);
		register_uninstall_hook(__FILE__, [Comblock_Auth_Uninstaller::class, 'uninstall']);
	}

	/**
	 * @since 1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * @since 1.0.0
	 * @return string
	 */
	public function get_comblock_auth()
	{
		return $this->comblock_auth;
	}

	/**
	 * @since 1.0.0
	 * @return Comblock_Auth_Loader
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * @since 1.0.0
	 * @return string
	 */
	public function get_version()
	{
		return $this->version;
	}
}
