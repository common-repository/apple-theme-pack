<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class PostTypeTeam {

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
        add_filter( 'manage_apple_team_posts_columns', array( $this, 'print_custom_columns' ) );
        add_action( 'manage_apple_team_posts_custom_column', array( $this, 'print_custom_column_values' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
    }

    public function enqueue_scripts_styles(){

        global $post_type;

        if( $post_type !== 'apple_team' ){
            return false;
        }
    }

    /**
    * Register custom post type team
    * @return void
    */
    public function register_type(){

        $singular = 'apple_team';        
        $plural   = 'apple_teams';
        
        $labels   = array( 
            'name'                  => __( 'Team Members', 'apple-theme-pack' ),
            'singular_name'         => __( 'Team Member', 'apple-theme-pack' ),
            'add_new'               => __( 'Add New', 'apple-theme-pack' ),
            'add_new_item'          => __( 'Add New team', 'apple-theme-pack' ),
            'edit_item'             => __( 'Edit team', 'apple-theme-pack' ),
            'new_item'              => __( 'New team', 'apple-theme-pack' ),
            'view_item'             => __( 'View team', 'apple-theme-pack' ),
            'search_items'          => __( 'Search team', 'apple-theme-pack' ),
            'not_found'             => __( 'No team found', 'apple-theme-pack' ),
            'not_found_in_trash'    => __( 'No team found in Trash', 'apple-theme-pack' ),
            'parent_item_colon'     => __( 'Parent team :', 'apple-theme-pack' ),
            'menu_name'             => __( 'Team Members', 'apple-theme-pack' ) ,
        );

        $args = array( 
            'labels'                => $labels,
            'hierarchical'          => true,
            'description'           => 'Collection of team members',
            'supports'              => array( 'title', 'excerpt', 'thumbnail' ),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 25,
            'menu_icon'             => 'dashicons-groups',//image or icon
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
            esc_attr( 'apple-theme-pack-team-meta' ), // Unique ID
            __( 'Team Details', 'apple-theme-pack' ),// Box title
            array( $this, 'render_details_box'),
            $current_post_type,
            'normal'    //context
        );
    }

    public function render_details_box( $post ){
        /*add meta box content here */   
        ?>
            <p><label><?php esc_html_e( 'Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_link" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_link', true ) ); ?>"/>
            </p> 
            
            <p><label><?php esc_html_e( 'Designation', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_designation" value="<?php echo esc_attr( get_post_meta( $post->ID, 'apple_theme_team_designation', true ) ); ?>"/>
            </p> 
            
            <p><label><?php esc_html_e( 'Facebook Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_facebook" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_facebook', true ) ); ?>"/>
            </p> 

            <p><label><?php esc_html_e( 'Twitter Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_twitter" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_twitter', true ) ); ?>"/>
            </p> 

            <p><label><?php esc_html_e( 'Youtube Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_youtube" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_youtube', true ) ); ?>"/>
            </p> 

            <p><label><?php esc_html_e( 'Linkedin Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_linkedin" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_linkedin', true ) ); ?>"/>
            </p> 

            <p><label><?php esc_html_e( 'Pinterest Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_pinterest" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_pinterest', true ) ); ?>"/>
            </p> 

            <p><label><?php esc_html_e( 'Instagram Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_instagram" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_instagram', true ) ); ?>"/>
            </p> 

            <p><label><?php esc_html_e( 'Dribble Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_dribble" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_dribble', true ) ); ?>"/>
            </p> 

            <p><label><?php esc_html_e( 'Google Plus Link', 'apple-theme-pack' ); ?></label></p>
            <p><input class="widefat" type="text" name="apple_theme_team_gplus" value="<?php echo esc_url_raw( get_post_meta( $post->ID, 'apple_theme_team_gplus', true ) ); ?>"/>
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

        if( isset( $_POST['apple_theme_team_link'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_link', esc_url_raw( $_POST['apple_theme_team_link'] ) );
        }

        if( isset( $_POST['apple_theme_team_designation'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_designation', 
                sanitize_text_field( $_POST['apple_theme_team_designation'] ) );
        }

        if( isset( $_POST['apple_theme_team_facebook'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_facebook', esc_url_raw( $_POST['apple_theme_team_facebook'] ) );
        }

        if( isset( $_POST['apple_theme_team_twitter'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_twitter', esc_url_raw( $_POST['apple_theme_team_twitter'] ) );
        }

        if( isset( $_POST['apple_theme_team_youtube'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_youtube', esc_url_raw( $_POST['apple_theme_team_youtube'] ) );
        }

        if( isset( $_POST['apple_theme_team_linkedin'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_linkedin', esc_url_raw( $_POST['apple_theme_team_linkedin'] ) );
        }

        if( isset( $_POST['apple_theme_team_instagram'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_instagram', esc_url_raw( $_POST['apple_theme_team_instagram'] ) );
        }

        if( isset( $_POST['apple_theme_team_dribble'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_dribble', esc_url_raw( $_POST['apple_theme_team_dribble'] ) );
        }

        if( isset( $_POST['apple_theme_team_pinterest'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_pinterest', esc_url_raw( $_POST['apple_theme_team_pinterest'] ) );
        }

        if( isset( $_POST['apple_theme_team_gplus'] ) ){
            update_post_meta( $post_id, 'apple_theme_team_gplus', esc_url_raw( $_POST['apple_theme_team_gplus'] ) );
        }
    }
    
    /**
     * Prints custom columns
     * @return columns
     */
    public function print_custom_columns( $columns ){  
        $left_columns               = array_slice( $columns, 1 );
        $columns                    = array_slice( $columns, 1 ,1 );
        $columns[ 'team_id' ]       = __( 'Team member Id', 'text-domain' );
        return array_merge( $columns, $left_columns );
    }

    /**
     * Prints column values
     * @return void
     */
    public function print_custom_column_values( $column ) {

        global $post;
        if( $column === 'team_id' ) {
            echo esc_attr( $post->ID );
        }
    }

    public function postmeta_validation_fail_notice(){

    }
}   
