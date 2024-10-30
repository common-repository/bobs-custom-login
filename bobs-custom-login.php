<?php

/**
 * The plugin bootstrap file
 *
 * @link:               
 * @since               1.0.0
 * @package             Bobs_Custom_Login
 *
 * @wordpress-plugin
 * Plugin Name:         Bobs Custom Login

 * Plugin URI:          http://www.travis.ga
 * Description:         Bobs Custom Login allows you to easily customize your admin login page according to your needs.
 * Version:             1.0.0
 * Author:              Nikolay Lubko
 * Author URI:          http://www.travis.ga
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         bobs-custom-login
 * Domain Path:         /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class bobs_Custom_Login_Main {
    private static $instance = null;
    private $plugin_path;
    private $plugin_url;
    private $text_domain = 'bobs-custom-login';

    /**
     * Creates or returns an instance of this class.
     */
    public static function get_instance() {
        // If an instance hasn't been created and set to $instance create an instance and set it to $instance.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
     */
    private function __construct() {
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_url  = plugin_dir_url( __FILE__ );

        load_plugin_textdomain( $this->text_domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

        register_activation_hook( __FILE__, array( $this, 'activation' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

        $this->run_plugin();
    }

    public function get_plugin_url() {
        return $this->plugin_url;
    }

    public function get_plugin_path() {
        return $this->plugin_path;
    }

    /**
     * Place code that runs at plugin activation here.
     */
    public function activation() {

    }

    /**
     * Place code that runs at plugin deactivation here.
     */
    public function deactivation() {

    }

    /**
     * Enqueue and register Admin JavaScript files here.
     */
    public function register_admin_scripts() {
        wp_enqueue_script( 'bobs-custom-login-backstretch', plugins_url( '/bobs-custom-login/admin/js/jquery.backstretch.min.js' ), array('jquery'), null, true );
    }

    /**
     * Enqueue and register Admin CSS files here.
     */
    public function register_admin_styles() {
    }

    /**
     * Enqueue and register Frontend JavaScript files here.
     */
    public function register_scripts() {
    }

    /**
     * Enqueue and register Frontend CSS files here.
     */
    public function register_styles() {
    }

    /**
     * Place code for your plugin's functionality here.
     */
    private function run_plugin() {

        // Settings Page
        require_once $this->plugin_path . 'admin/settings/class-settings.php';
        require_once $this->plugin_path . 'admin/settings/settings.php';
        require_once $this->plugin_path . 'admin/settings/apply-css.php';

    }
}

bobs_Custom_Login_Main::get_instance();
