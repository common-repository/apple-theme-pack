<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class MetaBoxes {

    /**
    * Application Instance
    * @var string
     */
    public $app = '';  

    public function __construct( $app )
    {
        $this->app = $app;

        add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_box' ) );
        add_action( 'admin_notices',array( $this, 'postmeta_validation_fail_notice' ) );

        // for php >= 5.4.0
        if (session_status() == PHP_SESSION_NONE) {
               session_start();
        }
        //for php < 5.4.0
        if(session_id() == '') {
           session_start();
        }
    }

    /**
     * Register all meta boxes
     * @return void
     */
    public function register_meta_boxes( $current_post_type )
    {
        new IconPicker( $this->app );        
        if( $current_post_type === 'apple_service' ){
            $type = new PostTypeService( $this->app );
            $type->register_meta_boxes( $current_post_type );
        }
        if( $current_post_type === 'apple_skill' ){
            $type = new PostTypeSkill( $this->app );
            $type->register_meta_boxes( $current_post_type );
        }
        if( $current_post_type === 'apple_stat' ){
            $type = new PostTypeStat( $this->app );
            $type->register_meta_boxes( $current_post_type );
        }
        if( $current_post_type === 'apple_project' ){
            $type = new PostTypeProject( $this->app );
            $type->register_meta_boxes( $current_post_type );
        }
        if( $current_post_type === 'apple_pricing' ){
            $type = new PostTypePricing( $this->app );
            $type->register_meta_boxes( $current_post_type );            
        }
        if( $current_post_type === 'apple_testimonial' ){
            $type = new PostTypeTestimonial( $this->app );
            $type->register_meta_boxes( $current_post_type );   
        }
        if( $current_post_type === 'apple_client' ){
            $type = new PostTypeClient( $this->app );
            $type->register_meta_boxes( $current_post_type );   
        }
        if( $current_post_type === 'apple_team' ){
            $type = new PostTypeTeam( $this->app );
            $type->register_meta_boxes( $current_post_type );   
        }
        if( $current_post_type === 'apple_feature' ){
            $type = new PostTypeFeature( $this->app );
            $type->register_meta_boxes( $current_post_type );   
        }
        if( $current_post_type === 'apple_faq' ){
            $type = new PostTypeFaq( $this->app );
            $type->register_meta_boxes( $current_post_type );   
        }
        if( $current_post_type === 'apple_news' ){
            $type = new PostTypeNews( $this->app );
            $type->register_meta_boxes( $current_post_type );   
        }

        unset( $type );
    }

    /**
     * Saves all the meta options during save_post hook
     * @param $post_id
     * @return void
     */
    public function save_meta_box( $post_id )
    {  
        $current_post_type = get_post_type( $post_id );

        if( $current_post_type === 'apple_service' ){
            $type = new PostTypeService( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_skill' ){
            $type = new PostTypeSkill( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_stat' ){
            $type = new PostTypeStat( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_project' ){
            $type = new PostTypeProject( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_pricing' ){
            $type = new PostTypePricing( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_testimonial' ){
            $type = new PostTypeTestimonial( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_client' ){
            $type = new PostTypeClient( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_team' ){
            $type = new PostTypeTeam( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_feature' ){
            $type = new PostTypeFeature( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_faq' ){
            $type = new PostTypeFaq( $this->app );
            $type->save_meta_box( $post_id );            
        }
        if( $current_post_type === 'apple_news' ){
            $type = new PostTypeNews( $this->app );
            $type->save_meta_box( $post_id );            
        }
        unset( $type );
    }

    /**
     * Display an error message when the plugin dependencies check fails.
     * @return void
     */
    public function postmeta_validation_fail_notice()
    { 
        global $pagenow, $post_type;

        if( $pagenow !== 'post.php' )
        { 
            return; 
        }

        if( ! isset( $_SESSION['metabox'] ) 
            || ! isset( $_SESSION['metabox']['post_type'] ) 
            || ! isset( $_SESSION['metabox']['errors'] ) ) { 
            return; 
        }

        if( $_SESSION['metabox']['post_type'] !== $post_type || empty( $_SESSION['metabox']['errors'] ) )
        { 
            return; 
        }

        $errors = $_SESSION['metabox']['errors'];

        ?>
        <div class="error notice is-dismissible">
            <?php foreach ($errors as $errs): ?>
            <?php foreach ($errs as $error): ?>
                <p>
                    <?php echo wp_kses( $error, array( 'strong' => array(), 'i' => array() ) );?>
                </p>
            <?php endforeach;?>
            <?php endforeach;?>

            <p>
                <?php _e( 'Please fix above errors and save again', 'apple-theme-pack' ); ?>
            </p>
        </div>
        
        <?php 

        unset( $_SESSION['metabox'] );
    }

}
