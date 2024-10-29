<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class PostTypeTestimonial {

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
        $this->register_type();
        add_filter( 'manage_apple_testimonial_posts_columns', array( $this, 'print_custom_columns' ) );
        add_action( 'manage_apple_testimonial_posts_custom_column', array( $this, 'print_custom_column_values' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
    }

    public function enqueue_scripts_styles(){

        global $post_type;

        if( $post_type !== 'apple_testimonial' ){
            return false;
        }
    }

    /**
    * Register custom post type testimonial
    * @return void
    */
    public function register_type(){

        $singular = 'apple_testimonial';        
        $plural   = 'apple_testimonials';
        
        $labels   = array( 
            'name'                  => __( 'Testimonials', 'apple-theme-pack' ),
            'singular_name'         => __( 'Testimonial', 'apple-theme-pack' ),
            'add_new'               => __( 'Add New', 'apple-theme-pack' ),
            'add_new_item'          => __( 'Add New testimonial', 'apple-theme-pack' ),
            'edit_item'             => __( 'Edit testimonial', 'apple-theme-pack' ),
            'new_item'              => __( 'New testimonial', 'apple-theme-pack' ),
            'view_item'             => __( 'View testimonial', 'apple-theme-pack' ),
            'search_items'          => __( 'Search testimonial', 'apple-theme-pack' ),
            'not_found'             => __( 'No testimonial found', 'apple-theme-pack' ),
            'not_found_in_trash'    => __( 'No testimonial found in Trash', 'apple-theme-pack' ),
            'parent_item_colon'     => __( 'Parent testimonial :', 'apple-theme-pack' ),
            'menu_name'             => __( 'Testimonials', 'apple-theme-pack' ) ,
        );

        $args = array( 
            'labels'                => $labels,
            'hierarchical'          => true,
            'description'           => 'Collection of testimonials',
            'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 25,
            'menu_icon'             => 'dashicons-megaphone',//image or icon
            'show_in_nav_menus'     => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'has_archive'           => true,
            'query_var'             => true,
            'can_export'            => true,
            'rewrite'               => true,
            'capability_type'       => 'post',
        );

        register_post_type( $singular, $args );
    }

    /**
    * Register custom taxonomies
    * @return void
    */
    public function register_taxonomies()
    {      
    }   

    public function register_meta_boxes( $current_post_type ){
        
        add_meta_box( 
            esc_attr( 'apple-theme-pack-testimonial-meta' ), // Unique ID
            __( 'testimonial Details', 'apple-theme-pack' ),// Box title
            array( $this, 'render_details_box'),
            $current_post_type,
            'normal'    //context
        );
    }

    public function render_details_box( $post ){
        ?>
            <p><label><?php esc_html_e( 'Author designation', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_testimonial_designation" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_testimonial_designation', true ) ); ?>"/>
            </p>
        <?php
        
        echo $this->render_nonce_field();
    }

    /**
    * Renders hidden input field for nonce
    * @param $field
    * @return html
    */
    public function render_nonce_field()
    { 
        return '<input type="hidden" name="apple-theme-pack-metabox-nonce" value="'.wp_create_nonce( 'apple-theme-pack-metabox-nonce' ).'"/>';
    } 

    public function save_meta_box( $post_id ){
        // For some reasons save_post action triggers even when new post form is displayed
        // So we have to check if this is new post request or save post request. On new post
        // request we will not go any further but return back.        
        if( empty( $_POST ) )
        {
            return;
        }

        // If this is auto save lets return the post id and do nothing
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
            return $post_id;
        }

        // If this is revision, lets do nothing but return
        if ( isset( $_POST['post_type'] ) && 'revision' === $_POST['post_type'] ){
            return $post_id;
        }

        if( isset( $_POST['save'] ) )
        {          
            $nonce = $_POST[ 'apple-theme-pack-metabox-nonce' ];

            // check to see if the submitted nonce matches with the
            // generated nonce we created earlier
            if ( ! wp_verify_nonce( $nonce, 'apple-theme-pack-metabox-nonce' ) )
            {
                die ( __( 'You do not have permissions!') );
            }

            //check user permissions
            if( ! current_user_can( 'edit_posts' ) )
            {
                die ( __( 'You do not have permissions!') );
            }
        }

        // do validation here

        if( isset( $_POST['apple_theme_testimonial_designation'] ) ){
            update_post_meta( $post_id, 'apple_theme_testimonial_designation', absint( sanitize_text_field( $_POST['apple_theme_testimonial_designation'] ) ) );
        }
    }

    /**
     * Prints custom columns
     * @return columns
     */
    public function print_custom_columns( $columns ){  
        $left_columns                   = array_slice( $columns, 1 );
        $columns                        = array_slice( $columns, 1 ,1 );
        $columns[ 'testimonial_id' ]    = __( 'Testimonial Id', 'text-domain' );
        return array_merge( $columns, $left_columns );
    }

    /**
     * Prints column values
     * @return void
     */
    public function print_custom_column_values( $column ) {

        global $post;
        if( $column === 'testimonial_id' ) {
            echo esc_attr( $post->ID );
        }
    }
    
    public function postmeta_validation_fail_notice(){

    }
}   
