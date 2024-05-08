<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://Import-of-railways
 * @since      1.0.0
 *
 * @package    Import_Of_Railways
 * @subpackage Import_Of_Railways/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Import_Of_Railways
 * @subpackage Import_Of_Railways/admin
 * @author     Import-of-railways <Import-of-railways@Import-of-railways>
 */
class Import_Of_Railways_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        add_action('admin_menu', array($this, 'add_tab_menu_options'));

	}

    public function add_tab_menu_options()
    {
        add_menu_page(
            'Import Railways',
            'Import Railways',
            'manage_options',
            'import-railways',
            array($this, 'renderPageImport')
        );
    }

    public function renderPageImport()
    {
        require plugin_dir_path(dirname(__FILE__)) . 'admin/partials/import-of-railways-admin-display.php';
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Import_Of_Railways_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Import_Of_Railways_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/import-of-railways-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Import_Of_Railways_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Import_Of_Railways_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/import-of-railways-admin.js', array( 'jquery' ), $this->version, false );

	}

}
