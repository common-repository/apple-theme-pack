<?php namespace AppleThemePack;

require 'Bootstrap.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Application{ 

    /**
    * text domain
    * @var string
    */
    public $textDomain = 'apple-theme-pack'; 	

    /**
    * Application Plugin name
    * @var string
    */
    public $name = 'apple_theme_pack';

	/**
	 * Array of all default Config values.
	 * @var array
	 */
	public $config = array();

    /**
    * Html generator instance
    * @var string
    */
    public $html = '';

    /**
     * Runs the application. 
     * @return void
     */
    public function run()
    {       
        // now set application paths and urls
        $this->set_application_paths_urls();
        //now we will bootstrap the application
        $this->bootstrap();
    }

	/**
	 * Bootstraps entire application
	 * @return void
	 */
	protected function bootstrap()
	{
        $bootstrap = new Bootstrap($this);
        $bootstrap->initialize();
	}

    /**
    * Sets applicatoin paths and urls
    * @return void
    */
    public function set_application_paths_urls()
    {
        // now lets set appliction paths and urls
        $this->set_application_urls();
        $this->set_application_paths();
    }

    /**
     * Sets application urls
     * @return void
     */
    protected function set_application_urls()
    {        
        $plugin_folder = plugin_dir_url( dirname( dirname( __FILE__ ) ) );
        $this->config['assets.url'] = $plugin_folder . 'assets/';
        $this->config['js.url']     = $plugin_folder . 'assets/js/';
        $this->config['css.url']    = $plugin_folder . 'assets/css/';
        $this->config['image.url']  = $plugin_folder . 'assets/images/';
        $this->config['base.url']   = $plugin_folder;
    }

    /**
     * Sets application paths
     * @return void
     */
    protected function set_application_paths()
    {
        $path = dirname( dirname( dirname( __FILE__ ) ) ) . '/app';
        $this->config['assets.path']    = $path . '/assets/';
        $this->config['js.path']        = $path . '/assets/js/';
        $this->config['css.path']       = $path . '/assets/css/';
        $this->config['image.path']     = $path . '/assets/images/';
        $this->config['base.path']      = $path;
        $this->config['views.path']     = $path .'/views/';
    }

}
