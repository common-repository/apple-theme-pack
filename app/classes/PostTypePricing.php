<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class PostTypePricing {

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
        add_filter( 'manage_apple_pricing_posts_columns', array( $this, 'print_custom_columns' ) );
        add_action( 'manage_apple_pricing_posts_custom_column', array( $this, 'print_custom_column_values' ) );
    }

    /**
    * Register custom post type pricing
    * @return void
    */
    public function register_type(){

        $singular = 'apple_pricing';        
        $plural   = 'apple_pricings';
        
        $labels   = array( 
            'name'                  => __( 'Pricings', 'apple-theme-pack' ),
            'singular_name'         => __( 'Pricing', 'apple-theme-pack' ),
            'add_new'               => __( 'Add New', 'apple-theme-pack' ),
            'add_new_item'          => __( 'Add New pricing', 'apple-theme-pack' ),
            'edit_item'             => __( 'Edit pricing', 'apple-theme-pack' ),
            'new_item'              => __( 'New pricing', 'apple-theme-pack' ),
            'view_item'             => __( 'View pricing', 'apple-theme-pack' ),
            'search_items'          => __( 'Search pricing', 'apple-theme-pack' ),
            'not_found'             => __( 'No pricing found', 'apple-theme-pack' ),
            'not_found_in_trash'    => __( 'No pricing found in Trash', 'apple-theme-pack' ),
            'parent_item_colon'     => __( 'Parent pricing :', 'apple-theme-pack' ),
            'menu_name'             => __( 'Pricing', 'apple-theme-pack' ) ,
        );

        $args = array( 
            'labels'                => $labels,
            'hierarchical'          => true,
            'description'           => 'Collection of pricing',
            'supports'              => array( 'title' ),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 25,
            'menu_icon'             => 'dashicons-awards',//image or icon
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
            esc_attr( 'apple-theme-pack-pricing-meta' ), // Unique ID
            __( 'Pricing Details', 'apple-theme-pack' ),// Box title
            array( $this, 'render_details_box'),
            $current_post_type,
            'normal'    //context
        );
    }

    public function render_details_box( $post ){
        ?>                     
            <p><label><?php esc_html_e( 'Currency symbol', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_currency_symbol" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_currency_symbol', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Price', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_price" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_price', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Sub title', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_subtitle" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_subtitle', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Is featured package', 'apple-theme-pack' ); ?></label>
            </p>
            <p>
            <?php 
            if( get_post_meta( $post->ID, 'apple_theme_pricing_is_featured', true ) == 1 ) { ?>
                <input class="widefat" type="radio" name="apple_theme_pricing_is_featured" checked value="<?php echo esc_attr( 1 ); ?>"/> 
                <?php echo esc_html( 'Yes', 'tm-apple' ); ?>
                <input class="widefat" type="radio" name="apple_theme_pricing_is_featured" value="<?php echo esc_attr( 0 ); ?>"/>
                <?php echo esc_html( 'No', 'tm-apple' );
            } else { ?>
                <input class="widefat" type="radio" name="apple_theme_pricing_is_featured" value="<?php echo esc_attr( 1 ); ?>"/>
                <?php echo esc_html( 'Yes', 'tm-apple' ); ?>
                <input class="widefat" type="radio" name="apple_theme_pricing_is_featured" checked value="<?php echo esc_attr( 0 ); ?>"/>
                <?php echo esc_html( 'No', 'tm-apple' );
            } 
            ?>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature One', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_1" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_1', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature Two', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_2" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_2', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature Three', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_3" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_3', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature Four', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_4" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_4', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature Five', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_5" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_5', true ) ); ?>"/>
            </p>
            
            <p>
                <label><?php esc_html_e( 'Feature Six', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_6" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_6', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature Seven', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_7" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_7', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature Eight', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_8" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_8', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature nine', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_9" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_9', true ) ); ?>"/>
            </p>

            <p>
                <label><?php esc_html_e( 'Feature Ten', 'apple-theme-pack' ); ?></label>
            </p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_feature_10" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_feature_10', true ) ); ?>"/>
            </p>

            <p><label><?php esc_html_e( 'Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_link" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_pricing_link', true ) ); ?>"/>
            </p>

            <p><label><?php esc_html_e( 'Button text', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_pricing_button_text" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_pricing_button_text', true ) ); ?>"/>
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
        
        if( isset( $_POST['apple_theme_pricing_currency_symbol'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_currency_symbol', sanitize_text_field( $_POST['apple_theme_pricing_currency_symbol'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_price'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_price', 
                sanitize_text_field( $_POST['apple_theme_pricing_price'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_subtitle'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_subtitle', sanitize_text_field( $_POST['apple_theme_pricing_subtitle'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_is_featured'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_is_featured', sanitize_text_field( $_POST['apple_theme_pricing_is_featured'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_feature_1'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_1', sanitize_text_field( $_POST['apple_theme_pricing_feature_1'] ) );
        }

        if( isset( $_POST['apple_theme_pricing_feature_2'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_2', sanitize_text_field( $_POST['apple_theme_pricing_feature_2'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_feature_3'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_3', sanitize_text_field( $_POST['apple_theme_pricing_feature_3'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_feature_4'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_4', sanitize_text_field( $_POST['apple_theme_pricing_feature_4'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_feature_5'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_5', sanitize_text_field( $_POST['apple_theme_pricing_feature_5'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_feature_6'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_6', sanitize_text_field( $_POST['apple_theme_pricing_feature_6'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_feature_7'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_7', sanitize_text_field( $_POST['apple_theme_pricing_feature_7'] ) );
        }
        if( isset( $_POST['apple_theme_pricing_feature_8'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_8', sanitize_text_field( $_POST['apple_theme_pricing_feature_8'] ) );
        }

        if( isset( $_POST['apple_theme_pricing_feature_9'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_9', sanitize_text_field( $_POST['apple_theme_pricing_feature_9'] ) );
        }

        if( isset( $_POST['apple_theme_pricing_feature_10'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_feature_10', sanitize_text_field( $_POST['apple_theme_pricing_feature_10'] ) );
        }

        if( isset( $_POST['apple_theme_pricing_link'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_link', esc_url_raw( $_POST['apple_theme_pricing_link'] ) );
        }
        
        if( isset( $_POST['apple_theme_pricing_button_text'] ) ){
            update_post_meta( $post_id, 'apple_theme_pricing_button_text', sanitize_text_field( $_POST['apple_theme_pricing_button_text'] ) );
        }
    }

    /**
     * Prints custom columns
     * @return columns
     */
    public function print_custom_columns( $columns ){  
        $left_columns               = array_slice( $columns, 1 );
        $columns                    = array_slice( $columns, 1 ,1 );
        $columns[ 'pricing_id' ]    = __( 'Pricing Id', 'text-domain' );
        return array_merge( $columns, $left_columns );
    }

    /**
     * Prints column values
     * @return void
     */
    public function print_custom_column_values( $column ) {

        global $post;
        if( $column === 'pricing_id' ) {
            echo esc_attr( $post->ID );
        }
    }
    
    public function postmeta_validation_fail_notice(){

    }
}   
