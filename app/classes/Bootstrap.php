<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

require 'CustomPostTypes.php';
require 'IconPicker.php';
require 'MetaBoxes.php';
require 'Shortcodes.php';

class Bootstrap{

    /**
    * Application instance
    * @var string
    */
    private $app = ''; 

    /**
    * Welcome page name
    * @var string
    */
    private $welcome_screen = ''; 

    /**
     * Bootstraps all the application
     * @return void
     */
    public function __construct( $app )
    {        
        $this->app = $app;     

        $this->welcome_screen = 'apple-theme-pack-welcome-screen';
    }

	/**
	 * Bootstraps all the application
	 * @return void
	 */
	public function initialize()
	{      
        add_action( 'init', array( $this, 'register_post_types' ) );

        register_activation_hook( 

            //ABSPATH.PLUGINDIR.'/plugin/main.php', 
            dirname( dirname( dirname( __FILE__ ) ) ).'/main.php',

                array( $this, 'activate_application' )
        );

        register_deactivation_hook(

           dirname( dirname( dirname( __FILE__ ) ) ).'/main.php',

            array( $this, 'deactivate_application' )
        );

        add_action( 'load-post-new.php', array( $this, 'register_meta_boxes' ) );
        add_action( 'load-post.php', array( $this, 'register_meta_boxes' ) );

        add_action( 'plugins_loaded', array( $this, 'load_plugin_text_domain' ) );

        add_action( 'admin_init', array( $this, 'redirect_welcome_screen' ), 1 );

        //add_action( 'admin_init', array( $this, 'register_admin_pages_scripts_and_styles' ) );

        add_action( 'admin_menu', array( $this, 'register_admin_pages' ) );

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

        //add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        add_action( 'tgmpa_register', array( $this, 'deps_check') );

        $shortcodes = new Shortcodes();
        $shortcodes->add();
	}

	/**
	 * Does activation.
	 * @return void
	 */
	public function activate_application()
    {       
        //lets add all the default options needed by application
 		$this->initialize_options();

        //lets perform database create/update routine.
        //$this->additional_bootstrap->db_init();

 	 	//Flush rewrite rules so that users can access custom post types on the 
        //front-end right away. Also, this applies to themes as well, the only 
        //difference is all this activation stuff needs to happen in the 
        //after_switch_theme action.        
        $this->register_post_types();
        
        //$d = new DemoContentSetter( $this->app );
        //$d->setup();

        //flush rewrite rules        
        flush_rewrite_rules();

        //activates welcome screen
        $this->activate_welcome_screen();
    }

    /**
     * Does deactivation.
     * @return void
     */
    public function deactivate_application() 
    {        
    }

    /**
	* Registers all custom post types.
	* @return void
	*/
    public function register_post_types()
    {
        // register some post types and taxonomies here
        $type = new CustomPostTypes( $this->app );
        $type->register_post_types();
        //$type->register_taxonomies();
    }

    /**
    * Registers all custom post types.
    * @return void
    */
    public function register_meta_boxes()
    {
        new MetaBoxes( $this->app );
    }

    public function register_admin_pages(){
        
        add_plugins_page( __('Welcome screen', 'apple-theme-pack' )
            , __( 'Apple Theme Pack', 'apple-theme-pack' )
            , 'manage_options'
            , $this->welcome_screen
            , array( $this, 'print_welcome_screen' ) 
        );
    }

    public function enqueue_admin_scripts(){

        wp_enqueue_style( 'apple-theme-pack-admin-style', $this->app->config['css.url'] . 'admin-style.min.css', array(), '20160911', 'all' );

        //wp_enqueue_style( $handle, $src, $deps, $ver, $in_footer);
        wp_enqueue_script( 'apple-theme-pack-admin-common', $this->app->config['js.url'] . 'admin/admin-common.min.js', array(), '20160911', true );
    }

    /**
	 * Initialize default optoins
	 * @return void
	 */
    public function initialize_options()
    {
        //Util::update_option( 'app_ver', Config::get( 'app.ver' ), 'sanitize_text_field' );
    }

    /**
     * This function loads text domain for
     * making the software ready for localization
     * @return void
     */
    public function load_plugin_text_domain()
    {
        load_plugin_textdomain( $this->app->textDomain, false, 
            plugin_basename( dirname( dirname( __FILE__ ) ) ) . '/languages' );
    }

    /**
     * Display welcome screen.
     * @return void
     */
    public function print_welcome_screen()
    {        
        ?>
        <h1> <?php _e( 'Welcome to Apple Theme Pack', 'apple-theme-pack' ); ?> </h1>
        
        <div class="wrap">
        <?php _e( sprintf( 'Apple Theme Pack is active. Apple Theme Pack is companion plugin of Apple Theme and is supposed to be used with Apple Theme only. If you already have installed and activated Apple Theme go to <a target = "_blank" href="%s">customize page</a> to change front page content and play with colors. If you have not installed Apple Theme yet, you can install one <a target="_blank" href="%s">here</a>', esc_url_raw( admin_url().'customize.php' ), esc_url_raw( admin_url().'theme-install.php' ) ) , 'apple-theme-pack' ); ?>
        </div>
        
        <?php

        include dirname( dirname( __FILE__ ) ) . '/views/admin/welcome/main.php';
    }

    /**
     * Does activate welcome screen.
     * @return void
     */
    public function activate_welcome_screen()
    {
        set_transient( 'atp-welcome-screen-activated', 1, 30 );
    }

    /**
     * Redirect automatically to the welcome page
     */
    public function redirect_welcome_screen()
    {
        // only do this if the user can activate plugins
        if ( ! current_user_can( 'manage_options' ) )
            return;
 
        // don't do anything if the transient isn't set
        if ( ! get_transient( 'atp-welcome-screen-activated' ) )
            return;
 
        delete_transient( 'atp-welcome-screen-activated' );

        wp_safe_redirect( admin_url( 'plugins.php?page='.$this->welcome_screen ) );

        exit;
    }

    /**
     * Register the required plugins for this theme.
     *
     * This function is hooked into tgmpa_init, which is fired within the
     * TGM_Plugin_Activation class constructor.
     */
    public function deps_check()
    {
        $configs = array (
            'dismissable' => false,
            'dismiss_msg' => "Apple needs you to fulfill following requirements",
        );
        $plugins = array(
            array(
                'name'      =>  'Apple Theme Pack',
                'slug'      =>  'apple-theme-pack',
                'required'  =>  true,
            ),
            array(
                'name'      =>  'WooCommerce',
                'slug'      =>  'woocommerce',
                'required'  =>  false,
            ),
            array(
                'name'      =>  'Contact Form 7',
                'slug'      =>  'contact-form-7',
                'required'  =>  false,
            ),
            array(
                'name'      =>  'Breadcrumb NavXT',
                'slug'      =>  'breadcrumb-navxt',
                'required'  =>  false,
            )
        );

        tgmpa( $plugins, $configs );
    }
}