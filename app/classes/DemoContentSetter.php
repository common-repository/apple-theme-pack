<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class DemoContentSetter {

    /**
    * Application Instance
    * @var string
    */
    public $app = '';  

    public $theme_name = 'tm-apple';

    private $pages = array();
    private $menu_items = array();

    public function __construct()
    {
    }
    public function setup(){

        if( ! $this->is_content_done('services-content-done') ){
            $this->add_service_section_content();
        }
        if( ! $this->is_content_done('skills-content-done') ){
            $this->add_skill_section_content();
        }
        if( ! $this->is_content_done('stats-content-done') ){
            $this->add_stats_section_content();
        }
        if( ! $this->is_content_done('projects-content-done') ){
            $this->add_project_section_content();
        }
        if( ! $this->is_content_done('pricing-content-done') ){
            $this->add_pricing_section_content();
        }
        if( ! $this->is_content_done('testimonials-content-done') ){
            $this->add_testimonial_section_content();
        }
        if( ! $this->is_content_done('clients-content-done') ){
            $this->add_clients_section_content();
        }
        if( ! $this->is_content_done('team-content-done') ){
            $this->add_our_team_section_content();
        }
        if( ! $this->is_content_done('features-content-done') ){
            $this->add_features_section_content();
        }
        if( ! $this->is_content_done('faqs-content-done') ){
            $this->add_faqs_section_content();
        }
        if( ! $this->is_content_done('news-content-done') ){
            $this->add_news_section_content();
        }
        if( ! $this->is_content_done( 'demo-pages-and-menu-done' ) ) {
            $this->add_demo_pages_and_menu();   
        }
    }

    public function get_apple_theme_options(){
        
        $options = get_option( 'apple-theme-pack-options' );
        return maybe_unserialize( $options );
    }

    public function update_apple_theme_option( $key, $value ){

        $options = $this->get_apple_theme_options();
        
        if( empty( $options ) ){
            
            $options = array();
            $options[ sanitize_key( $key ) ] = $value;
            update_option( 'apple-theme-pack-options', serialize( $options ) );
            return true;
        }

        $options[ sanitize_key( $key ) ] = $value;
        update_option( 'apple-theme-pack-options', serialize( $options ) );
        return true;
    }

    public function is_content_done( $option ){
        
        $option = sanitize_key( $option );
        $atp_options = $this->get_apple_theme_options();

        if( empty( $atp_options ) || ! array_key_exists( $option, $atp_options ) ||
        $atp_options[ $option ] !== true ){
            return false;
        }

        if( $atp_options[ $option ] === true ){
            return true;
        }

    }

     public function add_post_thumbnail( $parent_post_id, $source ){

        if( ! is_writable( wp_upload_dir()['path'] ) ){
            return false;
        }

        $f = new \SplFileInfo( $source );
        $extension = $f->getExtension();
        $basename = $f->getBasename();

        $target = wp_upload_dir()['path'].'/'.$basename;
        if( !file_exists( $target ) ){
            $filename = $dest = wp_upload_dir()['path'].'/'.$basename;
            copy( $source, $dest );
        }else{
            $filename = $dest = wp_upload_dir()['path'].'/'.uniqid( 'project_thumb_' ).'.'.$extension;
            copy( $source, $dest );
        }

        // Check the type of file. We'll use this as the 'post_mime_type'.
        $filetype = wp_check_filetype( basename( $filename ), null );

        // Get the path to the upload directory.
        $wp_upload_dir = wp_upload_dir();

        // Prepare an array of post data for the attachment.
        $attachment = array(
            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
            'post_mime_type' => $filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Insert the attachment.
        $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

        // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        // Generate the metadata for the attachment, and update the database record.
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        set_post_thumbnail( $parent_post_id, $attach_id );

        return true;
    }

    public function add_service_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']       =   wp_strip_all_tags( __( 'Quality Themes' ) );
        $postarr['post_content']     =   wp_kses_post( 'We make memorable, lightweight and beutiful themes for WordPress and other content management systems.' );
        $postarr['post_excerpt']     =   wp_kses_post( 'We make memorable, lightweight and beutiful themes for WordPress and other content management systems.' );
        $postarr['post_type']   = 'apple_service';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );

        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_service_icon', 'fa fa-lock' );
        update_post_meta( $post_id, 'apple_theme_service_link', null );

        $postarr = array();
        $postarr['post_title']      =  wp_strip_all_tags( __( 'Customizable Themes' ) );
        $postarr['post_content']    =  wp_kses_post( 'All the themes we make are highly customizable so that our customers can twaek the look and feel to their taste.' );
        $postarr['post_excerpt']    =  wp_kses_post( 'All the themes we make are highly customizable so that our customers can twaek the look and feel to their taste.' );
        $postarr['post_type']       = 'apple_service';
        $postarr['post_status']     =   'publish';

        $post_id = wp_insert_post( $postarr );

        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_service_icon', 'fa fa-lock' );
        update_post_meta( $post_id, 'apple_theme_service_link', null );

        $postarr = array();
        $postarr['post_title']   =  wp_strip_all_tags( __( 'Plugin Development' ) );
        $postarr['post_content'] =  wp_kses_post( 'We can extend WordPress upto any level so as to make it fit in your business requirements.' );
        $postarr['post_excerpt'] =  wp_kses_post( 'We can extend WordPress upto any level so as to make it fit in your business requirements.' );
        $postarr['post_type']    = 'apple_service';
        $postarr['post_status']  =   'publish';

        $post_id = wp_insert_post( $postarr );

        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_service_icon', 'fa fa-diamond' );
        update_post_meta( $post_id, 'apple_theme_service_link', null );

        $postarr = array();
        $postarr['post_title']      =   wp_strip_all_tags( __( 'Mobile Application' ) );
        $postarr['post_content']    =   wp_kses_post( 'We are also engaged in mobile apps development. We have team with extensive experience in this domain.' );
        $postarr['post_excerpt']    =   wp_kses_post( 'We are also engaged in mobile apps development. We have team with extensive experience in this domain.' );
        $postarr['post_type']       = 'apple_service';
        $postarr['post_status']     =   'publish';

        $post_id = wp_insert_post( $postarr );

        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_service_icon', 'fa fa-car' );
        update_post_meta( $post_id, 'apple_theme_service_link', null );

        update_option( 'apple_services_section_post_ids', implode( ',', $post_ids ) );

        $this->update_apple_theme_option( 'services-content-done', true );
    }

    public function add_skill_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']  =   wp_strip_all_tags( 'Php' );
        $postarr['post_type']   =   'apple_skill';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_skill_percentage', '100' );
        update_post_meta( $post_id, 'apple_theme_skill_color', '#EF1616' );

        $postarr = array();
        $postarr['post_title']  =   wp_strip_all_tags( 'Jquery' );
        $postarr['post_type']   = 'apple_skill';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_skill_percentage', '75' );
        update_post_meta( $post_id, 'apple_theme_skill_color', '#FFA500' );

        $postarr = array();
        $postarr['post_title']  =   wp_strip_all_tags( 'Html' );
        $postarr['post_type']   =   'apple_skill';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_skill_percentage', '80' );
        update_post_meta( $post_id, 'apple_theme_skill_color', '#99E027' );

        $postarr = array();
        $postarr['post_title']       =   wp_strip_all_tags( 'Css' );
        $postarr['post_type']   = 'apple_skill';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_skill_percentage', '60' );
        update_post_meta( $post_id, 'apple_theme_skill_color', '#00DCFF' );

        update_option( 'apple_skills_section_post_ids', implode( ',', $post_ids ) );

        $this->update_apple_theme_option( 'skills-content-done', true );
    }

    public function add_stats_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']  =   wp_strip_all_tags( "Customers" );
        $postarr['post_type']   = 'apple_stat';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_stat_count', '300' );
        update_post_meta( $post_id, 'apple_theme_stat_icon', 'fa fa-star-o' );

        $postarr = array();
        $postarr['post_title']  =   wp_strip_all_tags( "Awards" );
        $postarr['post_type']   =   'apple_stat';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_stat_count', '100' );
        update_post_meta( $post_id, 'apple_theme_stat_icon', 'fa fa-trophy' );

        $postarr = array();
        $postarr['post_title']  =   wp_strip_all_tags( "Downloads" );
        $postarr['post_type']   =   'apple_stat';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_stat_count', '800' );
        update_post_meta( $post_id, 'apple_theme_stat_icon', 'fa fa-bar-chart' );

        $postarr = array();
        $postarr['post_title']  =   wp_strip_all_tags( "Experience" );
        $postarr['post_type']   =   'apple_stat';
        $postarr['post_status'] =   'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_stat_count', '500' );
        update_post_meta( $post_id, 'apple_theme_stat_icon', 'fa fa-users' );

        update_option( 'apple_stats_section_post_ids', implode( ',', $post_ids ) );

        $this->update_apple_theme_option( 'stats-content-done', true );
    } 

    public function add_project_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( "Project One" );
        $postarr['post_type']   = 'apple_project';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        //$guid = plugins_url( 'assets/images/project-1.jpg', dirname( dirname( __FILE__ ) ) );
        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-1.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_project_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-1.jpg' );
        update_post_meta( $post_id, 'apple_theme_project_button_link', null );
        update_post_meta( $post_id, 'apple_theme_project_button_text', 'view details' );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Project Two" ) );
        $postarr['post_type']   = 'apple_project';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-2.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_project_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-2.jpg' );
        update_post_meta( $post_id, 'apple_theme_project_button_link', null );
        update_post_meta( $post_id, 'apple_theme_project_button_text', 'view details' );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Project Three" ) );
        $postarr['post_type']   = 'apple_project';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );


        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-3.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_project_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-3.jpg' );
        update_post_meta( $post_id, 'apple_theme_project_button_link', null );
        update_post_meta( $post_id, 'apple_theme_project_button_text', 'view details' );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Project Four" ) );
        $postarr['post_type']   = 'apple_project';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        
        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-4.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_project_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-4.jpg' );
        update_post_meta( $post_id, 'apple_theme_project_button_link', null );
        update_post_meta( $post_id, 'apple_theme_project_button_text', 'view details' );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Project Five" ) );
        $postarr['post_type']   = 'apple_project';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        
        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-5.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_project_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-5.jpg' );
        update_post_meta( $post_id, 'apple_theme_project_button_link', null );
        update_post_meta( $post_id, 'apple_theme_project_button_text', 'view details' );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Project Six" ) );
        $postarr['post_type']   = 'apple_project';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        
        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-6.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_project_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-6.jpg' );
        update_post_meta( $post_id, 'apple_theme_project_button_link', null );
        update_post_meta( $post_id, 'apple_theme_project_button_text', 'view details' );

        update_option( 'apple_projects_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'projects-content-done', true );
    }  

    public function add_pricing_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Brownse" ) );
        $postarr['post_type']   = 'apple_pricing';
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_pricing_currency_symbol', '$' );
        update_post_meta( $post_id, 'apple_theme_pricing_price', '100' );        
        update_post_meta( $post_id, 'apple_theme_pricing_subtitle', esc_html( 'Price for 10+ hours/person', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_1', esc_html( 'Easy to setup', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_2', esc_html( 'Auto demo installer', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_3', esc_html( 'Mobile responsive
        ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_4', esc_html( 'Built with bootstrap', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_5', esc_html( 'Unlimited support
            ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_button_link', '' );
        update_post_meta( $post_id, 'apple_theme_pricing_button_text', esc_html( 'Buy now', 'apple-theme-pack' ) );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Silver" ) );
        $postarr['post_type']   = 'apple_pricing';
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_pricing_currency_symbol', '$' );
        update_post_meta( $post_id, 'apple_theme_pricing_price', '100' );        
        update_post_meta( $post_id, 'apple_theme_pricing_subtitle', esc_html( 'Price for 10+ hours/person', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_1', esc_html( 'Easy to setup', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_2', esc_html( 'Auto demo installer', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_3', esc_html( 'Mobile responsive
        ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_4', esc_html( 'Built with bootstrap', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_5', esc_html( 'Unlimited support
            ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_button_link', '' );
        update_post_meta( $post_id, 'apple_theme_pricing_button_text', esc_html( 'Buy now', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_is_featured', true );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( __( "Gold" ) );
        $postarr['post_type']   = 'apple_pricing';
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_pricing_currency_symbol', '$' );
        update_post_meta( $post_id, 'apple_theme_pricing_price', '100' );        
        update_post_meta( $post_id, 'apple_theme_pricing_subtitle', esc_html( 'Price for 10+ hours/person', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_1', esc_html( 'Easy to setup', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_2', esc_html( 'Auto demo installer', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_3', esc_html( 'Mobile responsive
        ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_4', esc_html( 'Built with bootstrap', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_5', esc_html( 'Unlimited support
            ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_button_link', '' );
        update_post_meta( $post_id, 'apple_theme_pricing_button_text', esc_html( 'Buy now', 'apple-theme-pack' ) );        

        /*

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( "Platinum" );
        $postarr['post_type']   = 'apple_pricing';
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_pricing_currency_symbol', '$' );
        update_post_meta( $post_id, 'apple_theme_pricing_price', '100' );        
        update_post_meta( $post_id, 'apple_theme_pricing_subtitle', esc_html( 'Price for 10+ hours/person', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_1', esc_html( 'Easy to setup', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_2', esc_html( 'Auto demo installer', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_3', esc_html( 'Mobile responsive
        ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_4', esc_html( 'Built with bootstrap', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_feature_5', esc_html( 'Unlimited support
            ', 'apple-theme-pack' ) );
        update_post_meta( $post_id, 'apple_theme_pricing_button_link', '' );
        update_post_meta( $post_id, 'apple_theme_pricing_button_text', esc_html( 'Buy now', 'apple-theme-pack' ) );

        */

        update_option( 'apple_pricing_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'pricing-content-done', true );
    }

    public function add_testimonial_section_content(){

        $post_ids = array();

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Lina Perry" );
        $postarr['post_type']    = 'apple_testimonial';
        $postarr['post_content'] =  esc_html( 'John Doe and his crew are true craftsmen that produced high-quality work and were easy to work with too. The end result is magnificent and we get comments all of the time, from friends and strangers alike, how beautiful our home is.');
        $postarr['post_excerpt'] =  esc_html( 'John Doe and his crew are true craftsmen that produced high-quality work and were easy to work with too. The end result is magnificent and we get comments all of the time, from friends and strangers alike, how beautiful our home is.');
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/team-1.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_testimonial_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/team-1.jpg' );

        update_post_meta( $post_id, 'apple_theme_testimonial_designation', esc_html( 'Bright media production', 'apple-theme-pack' ) );


        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Anna Merry" );
        $postarr['post_type']    = 'apple_testimonial';
        $postarr['post_content'] =  esc_html( 'John Doe and his crew are true craftsmen that produced high-quality work and were easy to work with too. The end result is magnificent and we get comments all of the time, from friends and strangers alike, how beautiful our home is.');
        $postarr['post_excerpt'] =  esc_html( 'John Doe and his crew are true craftsmen that produced high-quality work and were easy to work with too. The end result is magnificent and we get comments all of the time, from friends and strangers alike, how beautiful our home is.');
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/team-2.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_testimonial_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/team-2.jpg' );

        update_post_meta( $post_id, 'apple_theme_testimonial_designation', esc_html( 'Regal Marketing', 'apple-theme-pack' ) );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Anushka M Mishra" );
        $postarr['post_type']    = 'apple_testimonial';
        $postarr['post_content'] =  esc_html( 'John Doe and his crew are true craftsmen that produced high-quality work and were easy to work with too. The end result is magnificent and we get comments all of the time, from friends and strangers alike, how beautiful our home is.');
        $postarr['post_excerpt'] =  esc_html( 'John Doe and his crew are true craftsmen that produced high-quality work and were easy to work with too. The end result is magnificent and we get comments all of the time, from friends and strangers alike, how beautiful our home is.');
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/team-3.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_testimonial_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/team-3.jpg' );

        update_post_meta( $post_id, 'apple_theme_testimonial_designation', esc_html( 'B4 Media Inc', 'apple-theme-pack' ) );

        update_option( 'apple_testimonials_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'testimonials-content-done', true );
    }

    public function add_clients_section_content(){

        $post_ids = array();

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Client one" );
        $postarr['post_type']    = 'apple_client';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/client1.png';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_client_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/client1.png' );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Client two" );
        $postarr['post_type']    = 'apple_client';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/client2.png';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_client_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/client2.png' );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Client three" );
        $postarr['post_type']    = 'apple_client';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/client3.png';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_client_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/client3.png' );

        $postarr = array();        
        $postarr['post_title']   =  wp_strip_all_tags( "Client four" );
        $postarr['post_type']    = 'apple_client';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/client4.png';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_client_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/client4.png' );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Client five" );
        $postarr['post_type']    = 'apple_client';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/client5.png';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_client_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/client5.png' );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Client six" );
        $postarr['post_type']    = 'apple_client';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/client6.png';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_client_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/client6.png' );

        update_option( 'apple_clients_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'clients-content-done', true );
    }

    public function add_our_team_section_content(){

        $post_ids = array();

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "John Smith" );
        $postarr['post_excerpt'] = wp_kses_post( 'Lorem Ipsum has been the industry standard dummy text ever since the 1500.' );
        $postarr['post_type']    = 'apple_team';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/team-1.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_team_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/team-1.jpg' );
        update_post_meta( $post_id, 'apple_theme_team_designation', esc_html( 'Developer' ) );
        update_post_meta( $post_id, 'apple_theme_team_facebook', '#' );
        update_post_meta( $post_id, 'apple_theme_team_twitter', '#' );
        update_post_meta( $post_id, 'apple_theme_team_youtube', '#' );
        update_post_meta( $post_id, 'apple_theme_team_linkedin', '' );
        update_post_meta( $post_id, 'apple_theme_team_pinterest', '' );
        update_post_meta( $post_id, 'apple_theme_team_instagram', '' );
        update_post_meta( $post_id, 'apple_theme_team_dribble', '' );
        update_post_meta( $post_id, 'apple_theme_team_gplus', '#' );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Roy Warner" );
        $postarr['post_excerpt'] = wp_kses_post( 'Lorem Ipsum has been the industry standard dummy text ever since the 1500.' );
        $postarr['post_type']    = 'apple_team';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/team-2.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_team_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/team-2.jpg' );
        update_post_meta( $post_id, 'apple_theme_team_designation', esc_html( 'Designer' ) );
        update_post_meta( $post_id, 'apple_theme_team_facebook', '' );
        update_post_meta( $post_id, 'apple_theme_team_twitter', '' );
        update_post_meta( $post_id, 'apple_theme_team_youtube', '' );
        update_post_meta( $post_id, 'apple_theme_team_linkedin', '#' );
        update_post_meta( $post_id, 'apple_theme_team_pinterest', '#' );
        update_post_meta( $post_id, 'apple_theme_team_instagram', '#' );
        update_post_meta( $post_id, 'apple_theme_team_dribble', '#' );
        update_post_meta( $post_id, 'apple_theme_team_gplus', '' );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Hari Chopra" );
        $postarr['post_excerpt'] = wp_kses_post( 'Lorem Ipsum has been the industry standard dummy text ever since the 1500.' );
        $postarr['post_type']    = 'apple_team';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/team-3.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_team_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/team-3.jpg' );
        update_post_meta( $post_id, 'apple_theme_team_designation', esc_html( 'Developer' ) );
        update_post_meta( $post_id, 'apple_theme_team_facebook', '' );
        update_post_meta( $post_id, 'apple_theme_team_twitter', '#' );
        update_post_meta( $post_id, 'apple_theme_team_youtube', '#' );
        update_post_meta( $post_id, 'apple_theme_team_linkedin', '' );
        update_post_meta( $post_id, 'apple_theme_team_pinterest', '#' );
        update_post_meta( $post_id, 'apple_theme_team_instagram', '' );
        update_post_meta( $post_id, 'apple_theme_team_dribble', '' );
        update_post_meta( $post_id, 'apple_theme_team_gplus', '#' );

        $postarr = array();        
        $postarr['post_title']   = wp_strip_all_tags( "Ishu Tiska" );
        $postarr['post_excerpt'] = wp_kses_post( 'Lorem Ipsum has been the industry standard dummy text ever since the 1500.' );
        $postarr['post_type']    = 'apple_team';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/team-4.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_team_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/team-4.jpg' );
        update_post_meta( $post_id, 'apple_theme_team_designation', esc_html( 'Designer' ) );
        update_post_meta( $post_id, 'apple_theme_team_facebook', '#' );
        update_post_meta( $post_id, 'apple_theme_team_twitter', '' );
        update_post_meta( $post_id, 'apple_theme_team_youtube', '#' );
        update_post_meta( $post_id, 'apple_theme_team_linkedin', '#' );
        update_post_meta( $post_id, 'apple_theme_team_pinterest', '' );
        update_post_meta( $post_id, 'apple_theme_team_instagram', '' );
        update_post_meta( $post_id, 'apple_theme_team_dribble', '#' );
        update_post_meta( $post_id, 'apple_theme_team_gplus', '' );

        update_option( 'apple_team_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'team-content-done', true );
    }

    public function add_features_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Theme Customizer" );
        $postarr['post_content'] = wp_kses_post( 'Quickly change look and feel of the website with a built-in customizer.' );
        $postarr['post_excerpt'] = wp_kses_post( 'Quickly change look and feel of the website with a built-in customizer.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-cogs' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Responsive Design" );
        $postarr['post_content'] = wp_kses_post( 'Apple is built on top of bootstrap framewrok and is 100% responsive.' );
        $postarr['post_excerpt'] = wp_kses_post( 'Apple is built on top of bootstrap framewrok and is 100% responsive.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-arrows' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Accessible" );
        $postarr['post_content'] = wp_kses_post( 'Apple is 100% accessible theme ensuring you don\'t miss your prospects.' );
        $postarr['post_excerpt'] = wp_kses_post( 'Apple is 100% accessible theme ensuring you don\'t miss your prospects.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-universal-access' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Localization Ready" );
        $postarr['post_content'] = wp_kses_post( 'We made it 100% localization ready. Use Apple in your own language.' );
        $postarr['post_excerpt'] = wp_kses_post( 'We made it 100% localization ready. Use Apple in your own language.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-language' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Browser Compatibility" );
        $postarr['post_content'] = wp_kses_post( 'We thoroughly test our themes to ensure consistency among all browsers.' );
        $postarr['post_excerpt'] = wp_kses_post( 'We thoroughly test our themes to ensure consistency among all browsers.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-check-square' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Seo Optimized" );
        $postarr['post_content'] = wp_kses_post( 'All our themes are well optimized for search engines.' );
        $postarr['post_excerpt'] = wp_kses_post( 'All our themes are well optimized for search engines.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-search-plus' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Page Speed Optmized" );
        $postarr['post_content'] = wp_kses_post( 'We ensure shorter turnaround for ultimate user experience.' );
        $postarr['post_excerpt'] = wp_kses_post( 'We ensure shorter turnaround for ultimate user experience.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-refresh' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Home Page Slider" );
        $postarr['post_content'] = wp_kses_post( 'Easily create slideshow for your home page to draw user attention.' );
        $postarr['post_excerpt'] = wp_kses_post( 'Easily create slideshow for your home page to draw user attention.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-image' ) );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Outstanding Support" );
        $postarr['post_content'] = wp_kses_post( 'You get one year tech support for free with all themes and plugins.' );
        $postarr['post_excerpt'] = wp_kses_post( 'You get one year tech support for free with all themes and plugins.' );
        $postarr['post_type']    = 'apple_feature';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_post_meta( $post_id, 'apple_theme_feature_icon', sanitize_text_field( 'fa fa-support' ) );

        update_option( 'apple_features_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'features-content-done', true );
    }

    public function add_faqs_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "What are the requirements of the theme" );
        $postarr['post_content'] = wp_kses_post( 'Apple requires that you have "Apple Theme Pack" plugin installed and activated. Apple Theme Pack is companion plugin for this theme and also work as framework to provide custom post types and demo content for the theme.' );
        $postarr['post_excerpt'] = wp_kses_post( 'Apple requires that you have "Apple Theme Pack" plugin installed and activated. Apple Theme Pack is companion plugin for this theme and also work as framework to provide custom post types and demo content for the theme.' );
        $postarr['post_type']    = 'apple_faq';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Do you provide support" );
        $postarr['post_content'] = wp_kses_post( 'Yes, We at ThemeMantra make sure that all the potential users of are products enjoy working with our products. We make sure to have your queries regarding theme solved as soon as possible. Pro customers enjoy quicker response time.' );
        $postarr['post_excerpt'] = wp_kses_post( 'Yes, We at ThemeMantra make sure that all the potential users of are products enjoy working with our products. We make sure to have your queries regarding theme solved as soon as possible. Pro customers enjoy quicker response time.' );
        $postarr['post_type']    = 'apple_faq';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Can I make child theme on top of it" );
        $postarr['post_content'] = wp_kses_post( 'Yes, ocourse. Our code do not restrict you from creating child theme based on our themes. You can easily build your custom version based on any of our themes.' );
        $postarr['post_excerpt'] = wp_kses_post( 'Yes, ocourse. Our code do not restrict you from creating child theme based on our themes. You can easily build your custom version based on any of our themes.' );
        $postarr['post_type']    = 'apple_faq';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $postarr = array();
        $postarr['post_title']   = wp_strip_all_tags( "Do you provide support for WooCommerce" );
        $postarr['post_content'] = wp_kses_post( 'WooCommerce support is available to pro customers only.' );
        $postarr['post_excerpt'] = wp_kses_post( 'WooCommerce support is available to pro customers only.' );
        $postarr['post_type']    = 'apple_faq';
        $postarr['post_status']  = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        update_option( 'apple_faqs_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'faqs-content-done', true );

    }

    public function add_news_section_content(){

        $post_ids = array();

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( "Quality WordPress Theme" );
        $postarr['post_type']   = 'apple_news';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-1.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_news_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-1.jpg' );

        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( "Customizable Slider" );
        $postarr['post_type']   = 'apple_news';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-2.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_news_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-2.jpg' );


        $postarr = array();
        $postarr['post_title']  = wp_strip_all_tags( "Experienced Support Team." );
        $postarr['post_type']   = 'apple_news';
        $postarr['post_content']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_excerpt']= esc_html( 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500.' );
        $postarr['post_status'] = 'publish';

        $post_id = wp_insert_post( $postarr );
        array_push( $post_ids, $post_id );

        $source = plugin_dir_path( dirname( dirname( __FILE__) )).'assets/images/project-3.jpg';
        $this->add_post_thumbnail( $post_id, $source );
        
        update_post_meta( $post_id, 'apple_theme_news_thumbnail', get_theme_root_uri().'/'.$this->theme_name.'/images/project-3.jpg' );

        update_option( 'apple_news_section_post_ids', implode( ',', $post_ids ) );
        $this->update_apple_theme_option( 'news-content-done', true );
    }

    public function uninstall() {
        
        $post_types = array(
            'services',
            'skills',
            'stats',
            'projects',
            'pricing',
            'team',
            'clients',
            'features',
            'faqs',
            'news',
            'testimonials'
        );

        foreach ( $post_types as $section ) {
            $posts = get_option( "apple_{$section}_section_post_ids" );
            if( ! empty( $posts ) ) {
                if( is_string( $posts ) ) {
                    $posts = explode( ',', $posts );
                }
                foreach ( $posts as $post_ID ) {
                    //soft delete
                    $force_delete = false;
                    wp_delete_post( $post_ID, $force_delete );
                }
            }
            $this->update_apple_theme_option( "{$section}-content-done", false );
        }

        $pages = get_option( 'apple_theme_demo_pages_ids' );

        if( ! empty( $pages ) ) {
            foreach ( $pages as $page_id ) {
                $force_delete = false;
                wp_delete_post( $page_id, $force_delete );
            }
        }

        $menu_items_ids = get_option( 'apple_theme_demo_menu_items_ids' );

        if( ! empty( $menu_items_ids ) ) {
            foreach ( $menu_items_ids as $item_id ) {
                $this->delete_menu_item( $item_id );
            }
        }

        $this->update_apple_theme_option( "demo-pages-and-menu-done", false );

        return true;
    }

    public function add_demo_pages_and_menu() {
        
        $menu_id = $this->create_menu( 'Apple Top Menu' );
        array_push( $this->menu_items, $this->create_menu_item_home( $menu_id ) );
        
        array_push( $this->pages, $this->insert_page( 'Services', '[section_services][/section_services]', $menu_id ) );
        array_push( $this->pages, $this->insert_page( 'Testimonials', '[section_testimonials][/section_testimonials]', $menu_id ) );
        array_push( $this->pages, $this->insert_page( 'Team', '[section_team][/section_team]', $menu_id ) );

        $this->assign_menu_to_theme_location();

        update_option( 'apple_theme_demo_pages_ids', $this->pages );
        update_option( 'apple_theme_demo_menu_items_ids', $this->menu_items );

        $this->update_apple_theme_option( 'demo-pages-and-menu-done', true );
    }

    public function insert_page( $title, $content, $menu_id ) {

        // Create post object
        $post = array(
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => get_current_user_id(),
        );
 
        // Insert the post into the database
        $page_id = wp_insert_post( $post );
        
        update_post_meta( $page_id, '_wp_page_template', 'fullwidth.php' );

        $header_image = plugins_url( 'assets/images/header-image.jpg', dirname( dirname( __FILE__ ) ) );
        update_post_meta( $page_id, 'apple_header_image_uri', $header_image );
        update_post_meta( $page_id, 'apple_disable_header_image', false );
        
        array_push( $this->menu_items, $this->create_menu_item( $menu_id, $page_id, $title ) );

        return $page_id;
    }

    public function create_menu( $menu_name ){
        // Check if the menu exists
        $menu_exists = wp_get_nav_menu_object( $menu_name );

        // If it doesn't exist, let's create it.
        if( !$menu_exists){
            $menu_id = wp_create_nav_menu($menu_name);
            return $menu_id;
        }else {
            return $menu_exists->term_id;
        }
    }

    public function assign_menu_to_theme_location() {

        $locations = get_theme_mod( 'nav_menu_locations' );

        $menu = get_term_by('name', 'Apple Top Menu', 'nav_menu');
        
        $locations['primary'] = $menu->term_id;

        set_theme_mod( 'nav_menu_locations', $locations );
    }

    public function create_menu_item_home( $menu_id ) {

        return wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __( 'Home', 'apple-theme-pack'),
            'menu-item-classes' => 'home',
            'menu-item-url' => home_url( '/' ), 
            'menu-item-status' => 'publish')
        );
    }

    public function create_menu_item( $menu_id, $page_id, $menu_title ) {

        return wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' =>  $menu_title,
            'menu-item-classes' => sanitize_title_with_dashes( $menu_title ),
            'menu-item-url' => get_permalink( $page_id ), 
            'menu-item-status' => 'publish')
        );
    }

    public function delete_menu_item( $item_id ) {
        $force_delete = true;
        wp_delete_post( $item_id, $force_delete );
    }
}
