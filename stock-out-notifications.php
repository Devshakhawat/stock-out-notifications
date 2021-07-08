<?php
/**
 * Plugin Name: Stock Out Notifications
 * Plugin URI: https://shakhawat.me
 * Description: This plugin is made as assignment purpose
 * Version: 1.0.0
 * Author: Shakhawat
 * Author URI: shakhawat.me
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: stock-out-notifications
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin base class
 *
 * @since 1.0.0
 */
final class Stock_Out_Notifications {
    
     /**
     * Plugin version 
     *
     * @var string version
     */
    const version = '1.0.0';

    /**
     * Class construct of Abandoned Cart Notification
     * 
     * Setup required hooks and actions
     *
     * @return void
     */
    private function __construct() {
        $this->son_define_constants();
        // Activation hook.
		register_activation_hook( __FILE__, array( $this, 'stock_out_notifications_activation' ) );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Define all constants
     *
     * @return void
     */
    public function son_define_constants() {
        define( 'SON_VERSION', self::version );
        define( 'SON_FILE', __FILE__ );
        define( 'SON_DIR', __DIR__ );
        define( 'SON_URL', plugins_url( '', SON_FILE ) );
        define( 'SON_ASSETS', SON_URL . '/assets' );
        define( 'SON_BASE', plugin_basename( SON_FILE ) );
    }

    /**
     * Plugins activated
     *
     * @since 1.0.0
     */
    public function stock_out_notifications_activation() {
        $installer = new Wpcommerz\Installer();
        $installer->run();
    } 

    /**
     * Plugin init callback
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function init_plugin() {
        new Wpcommerz\Outof_Stock_Form_Display();
      
    }

    /**
     * Singleton instance
     * 
     * @param null
     *
     * @return \Stock_Out_Notifications
     */
    public static function init() {
        static $instantiate = false;

        if( ! $instantiate ) {
            $instantiate = new self();
        }
        return $instantiate;
    }

}

//Kickoff plugin
function son_instance() {
    return Stock_Out_Notifications::init();
}
son_instance();