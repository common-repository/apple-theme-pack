<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class PostTypeStat {

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
        add_filter( 'manage_apple_stat_posts_columns', array( $this, 'print_custom_columns' ) );
        add_action( 'manage_apple_stat_posts_custom_column', array( $this, 'print_custom_column_values' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
    }

    public function enqueue_scripts_styles(){

        global $post_type;

        if( $post_type !== 'apple_stat' ){
            return false;
        }

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script( 'wp-color-picker' );
    }

    /**
    * Register custom post type stat
    * @return void
    */
    public function register_type(){

        $singular = 'apple_stat';        
        $plural   = 'apple_stats';
        
        $labels   = array( 
            'name'                  => __( 'Stats', 'apple-theme-pack' ),
            'singular_name'         => __( 'Stat', 'apple-theme-pack' ),
            'add_new'               => __( 'Add New', 'apple-theme-pack' ),
            'add_new_item'          => __( 'Add New stat', 'apple-theme-pack' ),
            'edit_item'             => __( 'Edit stat', 'apple-theme-pack' ),
            'new_item'              => __( 'New stat', 'apple-theme-pack' ),
            'view_item'             => __( 'View stat', 'apple-theme-pack' ),
            'search_items'          => __( 'Search stat', 'apple-theme-pack' ),
            'not_found'             => __( 'No stat found', 'apple-theme-pack' ),
            'not_found_in_trash'    => __( 'No stat found in Trash', 'apple-theme-pack' ),
            'parent_item_colon'     => __( 'Parent stat :', 'apple-theme-pack' ),
            'menu_name'             => __( 'Stats', 'apple-theme-pack' ) ,
        );

        $args = array( 
            'labels'                => $labels,
            'hierarchical'          => true,
            'description'           => 'Collection of stats',
            'supports'              => array( 'title' ),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 25,
            'menu_icon'             => 'dashicons-chart-area',//image or icon
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
            esc_attr( 'apple-theme-pack-stat-meta' ), // Unique ID
            __( 'stat Details', 'apple-theme-pack' ),// Box title
            array( $this, 'render_details_box'),
            $current_post_type,
            'normal'    //context
        );
    }

    public function render_details_box( $post ){
        ?>
            <p><label><?php esc_html_e( 'Count', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_stat_count" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_stat_count', true ) ); ?>"/>
            </p>
            <p>
                <label><?php esc_html_e( 'Icon', 'apple-theme-pack' ); ?></label>
            </p>
            <p>               
               <input class="picked-icon" type="text" name="apple_theme_stat_icon" 
                value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_stat_icon', true ) ); ?>"/>
               <a href="#" class="button show-icon-box">
                <?php esc_html_e('Add/update icon','apple-theme-pack'); ?>
               </a>
               <i class="selected-icon <?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_stat_icon', true ) ); ?> ">          
               </i>
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

        if( isset( $_POST['apple_theme_stat_count'] ) ){
            update_post_meta( $post_id, 'apple_theme_stat_count', absint( sanitize_text_field( $_POST['apple_theme_stat_count'] ) ) );
        }
        if( isset( $_POST['apple_theme_stat_icon'] ) ){
            update_post_meta( $post_id, 'apple_theme_stat_icon', sanitize_text_field( $_POST['apple_theme_stat_icon'] ) );
        }
    }

    /**
     * Prints custom columns
     * @return columns
     */
    public function print_custom_columns( $columns ){  
        $left_columns               = array_slice( $columns, 1 );
        $columns                    = array_slice( $columns, 1 ,1 );
        $columns[ 'stat_id' ]       = __( 'Stat Id', 'text-domain' );
        return array_merge( $columns, $left_columns );
    }

    /**
     * Prints column values
     * @return void
     */
    public function print_custom_column_values( $column ) {

        global $post;
        if( $column === 'stat_id' ) {
            echo esc_attr( $post->ID );
        }
    }
    
    public function postmeta_validation_fail_notice(){

    }
}   
