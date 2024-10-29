<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

require 'PostTypeService.php';
require 'PostTypeSkill.php';
require 'PostTypeStat.php';
require 'PostTypeProject.php';
require 'PostTypePricing.php';
require 'PostTypeTestimonial.php';
require 'PostTypeClient.php';
require 'PostTypeTeam.php';
require 'PostTypeFeature.php';
require 'PostTypeFaq.php';
require 'PostTypeNews.php';

class CustomPostTypes {

    /**
    * Application Instance
    * @var string
    */
    public $app = '';  

    /**
     * Constructor
     * @return void
     */
    public function __construct( $app )
    {
        $this->app = $app;
    }

    /**
    * Register custom post types
    * @return void
    */
    public function register_post_types() {
        
        new PostTypeService( $this->app );
        new PostTypeSkill( $this->app );
        new PostTypeStat( $this->app );
        new PostTypeProject( $this->app );
        new PostTypePricing( $this->app );
        new PostTypeTestimonial( $this->app );
        new PostTypeClient( $this->app );
        new PostTypeTeam( $this->app );
        new PostTypeFeature( $this->app );
        new PostTypeFaq( $this->app );
        new PostTypeNews( $this->app );
    }
}   
