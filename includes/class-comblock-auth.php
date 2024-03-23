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
		$this->comblock_auth = COMBLOCK_AUTH_DOMAIN;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function load_dependencies()
	{
		$plugin_dir_path = plugin_dir_path(__DIR__);

		require_once $plugin_dir_path . 'includes/class-comblock-auth-loader.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-i18n.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-user.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-data_mapper.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-view-resolver.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-view-manager.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-shortcode-render.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-view-login.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-view-dashboard.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-post-manager.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-page.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-shortcode.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-activator.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-deactivator.php';
		require_once $plugin_dir_path . 'includes/class-comblock-auth-uninstaller.php';
		require_once $plugin_dir_path . 'admin/class-comblock-auth-admin.php';
		require_once $plugin_dir_path . 'public/class-comblock-auth-public.php';

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

		$plugin_file = plugin_dir_path(__DIR__) . 'index.php';

		$this->loader->add_activation($plugin_file, Comblock_Auth_Activator::class, 'activate');
		$this->loader->add_deactivation($plugin_file, Comblock_Auth_Deactivator::class, 'deactivate');
		$this->loader->add_uninstall($plugin_file, Comblock_Auth_Uninstaller::class, 'uninstall');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function define_public_hooks()
	{
		$public = new Comblock_Auth_Public($this->get_comblock_auth(), $this->get_version());
		$auth_user = new Comblock_Auth_User();
		$shortcode = new Comblock_Auth_Shortcode();

		$this->loader->add_action('wp_enqueue_scripts', $public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $public, 'enqueue_scripts');
		$this->loader->add_action('template_redirect', $auth_user, 'do_logout');
		$this->loader->add_action('template_redirect', $auth_user, 'do_login');
		$this->loader->add_action('template_redirect', $auth_user, 'login_redirect');
		$this->loader->add_shortcode('comblock_login', $shortcode, 'login');
		$this->loader->add_shortcode('comblock_dashboard', $shortcode, 'dashboard');
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
