<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
use AppleTheme\sections;

class Shortcodes{ 

    public function add() {

        add_shortcode( 'section_services', array( $this, 'section_services' ) );
        add_shortcode( 'section_pricing', array( $this, 'section_pricing' ) );
        add_shortcode( 'section_projects', array( $this, 'section_projects' ) );
        add_shortcode( 'section_testimonials', array( $this, 'section_testimonials' ) );
        add_shortcode( 'section_team', array( $this, 'section_team' ) );
        add_shortcode( 'section_clients', array( $this, 'section_clients' ) );
        add_shortcode( 'section_features', array( $this, 'section_features' ) );
        add_shortcode( 'section_faqs', array( $this, 'section_faqs' ) );
        add_shortcode( 'section_news', array( $this, 'section_news' ) );
        add_shortcode( 'section_skills', array( $this, 'section_skills' ) );
        add_shortcode( 'section_stats', array( $this, 'section_stats' ) );
        add_shortcode( 'section_bb_cta', array( $this, 'section_bb_cta' ) );
        add_shortcode( 'section_rb_cta', array( $this, 'section_rb_cta' ) );
        add_shortcode( 'section_subscribe', array( $this, 'section_subscribe' ) );
        add_shortcode( 'section_quote', array( $this, 'section_quote' ) );
        add_shortcode( 'container', array( $this, 'container' ) );
        add_shortcode( 'title', array( $this, 'title' ) );
        add_shortcode( 'row', array( $this, 'row' ) );
        add_shortcode( 'column', array( $this, 'column' ) );
        add_shortcode( 'column_full', array( $this, 'column_full' ) );
        add_shortcode( 'column_half', array( $this, 'column_half' ) );
        add_shortcode( 'column_one_third', array( $this, 'column_one_third' ) );
        add_shortcode( 'column_two_third', array( $this, 'column_two_third' ) );
        add_shortcode( 'column_one_fourth', array( $this, 'column_one_fourth' ) );
        add_shortcode( 'column_three_fourth', array( $this, 'column_three_fourth' ) );
        add_shortcode( 'column_one_sixth', array( $this, 'column_one_sixth' ) );
        add_shortcode( 'div', array( $this, 'div' ) );
        add_shortcode( 'section_title', array( $this, 'title' ) );
        add_shortcode( 'section_subtitle', array( $this, 'subtitle' ) );
    }

    public function get_parsed_args( $args ) {

        return $this->string_to_boolean_array_values( shortcode_atts( array(
            'enabled'       =>  null,
            'post_ids'      =>  null,
            'show_title'    =>  null,
            'title'         =>  null,
            'show_subtitle' =>  null,
            'subtitle'      =>  null,
            'cols_per_row'  =>  null,
            'show_check_all_button' =>  null,
            'button_text'   =>  null,
            'button_link'   =>  null,
        ), $args ) );
    }

    public function string_to_boolean_array_values( $args ) {

        return array_map( function( $value ) {
            if( $value == "false" ){
                 $value = false;
            } elseif( $value == "true" ) {
                $value = true;
            }
            return $value;
        }, $args );

    }

    public function section_services( $args, $content = null ) {

        $args = $this->get_parsed_args( $args );

        sections::render_services( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_pricing( $args, $content = null ) {
        
        $args = $this->get_parsed_args( $args );

        sections::render_pricing( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'] );
    }

    public function section_projects( $args, $content = null ) {
        
        $args = $this->get_parsed_args( $args );

        sections::render_projects( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_testimonials( $args, $content = null ) {
        
        $args = $this->get_parsed_args( $args );

        sections::render_testimonials( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_team( $args, $content = null ) {

        $args = $this->get_parsed_args( $args );

        sections::render_team( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_clients( $args, $content = null ) {

        $args = $this->get_parsed_args( $args );

        sections::render_clients( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_features( $args, $content = null ) {
        
        $args = $this->get_parsed_args( $args );

        sections::render_features( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_faqs( $args, $content = null ) {

        $args = $this->get_parsed_args( $args );

        sections::render_faqs( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_news( $args, $content = null ) {

        $args = $this->get_parsed_args( $args );

        sections::render_news( $args['enabled'], $args['post_ids'], $args['show_title'], $args['title'], $args['show_subtitle'], $args['subtitle'], $args['cols_per_row'], $args['show_check_all_button'], $args['button_text'], $args['button_link'] );
    }

    public function section_skills( $args, $content = null ) {

        $args = shortcode_atts( array(
            'enabled'       =>  true,
            'post_ids'      =>  null,
            'cols_per_row'  =>  null,
        ), $args );

        sections::render_skills( $args['enabled'], $args['post_ids'], $args['cols_per_row'] );

    }

    public function section_stats( $args, $content = null ) {

        $args = shortcode_atts( array(
            'enabled'       =>  true,
            'post_ids'      =>  null,
            'cols_per_row'  =>  null,
        ), $args );

        sections::render_stats( $args['enabled'], $args['post_ids'], $args['cols_per_row'] );

    }

    public function section_bb_cta( $args, $content = null ) {

        $args = shortcode_atts( array(
            'enabled'       =>  true,
            'show_button'   =>  null,
            'text'          =>  null,
            'button_text'   =>  null,
            'button_link'   =>  null,
        ), $args );

        sections::render_bb_cta( $args['enabled'], $args['show_button'], $args['text'], $args['button_text'], $args['button_link'] );

    }

    public function section_rb_cta( $args, $content = null ) {

        $args = shortcode_atts( array(
            'enabled'       =>  true,
            'show_button'   =>  null,
            'text'          =>  null,
            'button_text'   =>  null,
            'button_link'   =>  null,
        ), $args );

        sections::render_rb_cta( $args['enabled'], $args['show_button'], $args['text'], $args['button_text'], $args['button_link'] );

    }

    public function section_subscribe( $args, $content = null ) {

        $args = shortcode_atts( array(
            'enabled'       =>  true,
            'text'          =>  null,
            'button_text'   =>  null,
            'button_link'   =>  null,
        ), $args );

        sections::render_subscribe( $args['enabled'], $args['text'], $args['button_text'], $args['button_link'] );

    }

    public function section_quote( $args, $content = null ) {
        echo do_shortcode( $content );

        if( ! is_page_template( 'default' ) ) : ?>
            <div class="quote-section section">
                <div class="container">
                    <?php include locate_template( "section-parts/section-quote.php" ); ?>
                </div>
            </div>
        <?php else:
                include locate_template( "section-parts/section-quote.php" );
        endif;
    }

    public function container( $args, $content = null ) {
        $args = shortcode_atts( array(
            'class'         =>  '',
        ), $args );
        ?>
            <div class="container <?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function row( $args, $content = null ) {
        ob_start();
        ?>
            <div class="row">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
        return ob_get_clean();
    }

    public function column( $args, $content = null ) {
        $args = shortcode_atts( array( 'class' => 'col-md-3' ), $args );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function column_full( $args, $content = null ) {
        $args = shortcode_atts( 
            array( 'class' => 'col-md-12' ), 
            $args 
        );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function column_half( $args, $content = null ) {
        $args = shortcode_atts( 
            array( 'class' => 'col-md-6' ), 
            $args 
        );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function column_one_third( $args, $content = null ) {
        $args = shortcode_atts( 
            array( 'class' => 'col-md-4' ), 
            $args 
        );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function column_two_third( $args, $content = null ) {
        $args = shortcode_atts( 
            array( 'class' => 'col-md-8' ), 
            $args 
        );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function column_one_fourth( $args, $content = null ) {
        $args = shortcode_atts( 
            array( 'class' => 'col-md-3' ), 
            $args 
        );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function column_three_fourth( $args, $content = null ) {
        $args = shortcode_atts( 
            array( 'class' => 'col-md-9' ), 
            $args 
        );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function column_one_sixth( $args, $content = null ) {
        $args = shortcode_atts( 
            array( 'class' => 'col-md-2' ), 
            $args 
        );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function div( $args, $content = null ) {
        $args = shortcode_atts( array( 'class' => 'col-md-3' ), $args );
        ?>
            <div class="<?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
    }

    public function title( $args, $content = null ) {
        $args = shortcode_atts( array( 'class' => '' ), $args );
        ?>
            <h1 class="section-title <?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </h1>
        <?php
    }

    public function subtitle( $args, $content = null ) {
        ob_start();
        $args = shortcode_atts( array( 'class' => '' ), $args );
        ?>
            <center>
            <p class="section-subtitle <?php echo esc_attr( $args['class'] ); ?>">
                <?php echo do_shortcode( $content ); ?>
            </p>
            </center>
        <?php
        return ob_get_clean();
    }
}
