<?php namespace AppleThemePack;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class IconPicker {

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
        global $pagenow;

        $this->app = $app;

        add_action('admin_footer', array( $this, 'add_icon_picker_markup') );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
    }

    public function enqueue_scripts_styles(){
        
        wp_enqueue_style( 'apple-theme-pack-font-awesome', $this->app->config['css.url'] . 'font-awesome.min.css', array(), '20160911', 'all' );

        wp_enqueue_style( 'apple-theme-pack-icon-picker', $this->app->config['css.url'] . 'icon-picker.min.css', array(), '20160911', 'all' );

        wp_enqueue_script( 'apple-theme-pack-icon-picker', $this->app->config['js.url'] . 'admin/icon-picker.min.js', array(), '20160911', true );
    }

    /**
    * This function adds thick box script so that thickbox can be used to 
    * display the mega menu editor
    * @return void
    */
    public function add_icon_picker_markup()
    {
        global $pagenow;

        $icons = $this->get_fa_icons()[0];
    
        $current_url = admin_url().$pagenow;
    ?>

        <div class="overlay-icon-picker"></div>
        <div class="icons-container">
            <header class="close-icons-box"><i class="fa fa-close"></i></header>
            <header>
                <h3>Choose Icon <input type="text" id="search-icon" placeholder="search icons"/></h3>
            </header>
            <div class="icons-container-inner">
            <?php
                $icons = explode( ' ', $icons );
                unset($icons[0]);
                $i = 1;
                foreach ($icons as $key => $icon) 
                {
                ?>
                    <i class="fa <?php echo esc_attr($icon);?>"></i>
                <?php 
                } 
            ?>
        </div>
        </div>
    <?php
    }

    public function get_fa_icons(){
        return apply_filters( 'apple-theme-pack-icons', array(
            'fa-500px fa-adjust fa-adn fa-align-center fa-align-justify fa-align-left fa-align-right fa-amazon fa-ambulance fa-anchor fa-android fa-angellist fa-angle-double-down fa-angle-double-left fa-angle-double-right fa-angle-double-up fa-angle-down fa-angle-left fa-angle-right fa-angle-up fa-apple fa-archive fa-area-chart fa-arrow-circle-down fa-arrow-circle-left fa-arrow-circle-o-down fa-arrow-circle-o-left fa-arrow-circle-o-right fa-arrow-circle-o-up fa-arrow-circle-right fa-arrow-circle-up fa-arrow-down fa-arrow-left fa-arrow-right fa-arrow-up fa-arrows fa-arrows-alt fa-arrows-h fa-arrows-v fa-asterisk fa-at fa-automobile fa-backward fa-balance-scale fa-ban fa-bank fa-bar-chart fa-bar-chart-o fa-barcode fa-bars fa-battery-0 fa-battery-1 fa-battery-2 fa-battery-3 fa-battery-4 fa-battery-empty fa-battery-full fa-battery-half fa-battery-quarter fa-battery-three-quarters fa-bed fa-beer fa-behance fa-behance-square fa-bell fa-bell-o fa-bell-slash fa-bell-slash-o fa-bicycle fa-binoculars fa-birthday-cake fa-bitbucket fa-bitbucket-square fa-bitcoin fa-black-tie fa-bluetooth fa-bluetooth-b fa-bold fa-bolt fa-bomb fa-book fa-bookmark fa-bookmark-o fa-briefcase fa-btc fa-bug fa-building fa-building-o fa-bullhorn fa-bullseye fa-bus fa-buysellads fa-cab fa-calculator fa-calendar fa-calendar-check-o fa-calendar-minus-o fa-calendar-o fa-calendar-plus-o fa-calendar-times-o fa-camera fa-camera-retro fa-car fa-caret-down fa-caret-left fa-caret-right fa-caret-square-o-down fa-caret-square-o-left fa-caret-square-o-right fa-caret-square-o-up fa-caret-up fa-cart-arrow-down fa-cart-plus fa-cc fa-cc-amex fa-cc-diners-club fa-cc-discover fa-cc-jcb fa-cc-mastercard fa-cc-paypal fa-cc-stripe fa-cc-visa fa-certificate fa-chain fa-chain-broken fa-check fa-check-circle fa-check-circle-o fa-check-square
            fa-check-square-o fa-chevron-circle-down fa-chevron-circle-left fa-chevron-circle-right fa-chevron-circle-up fa-chevron-down fa-chevron-left fa-chevron-right fa-chevron-up fa-child fa-chrome fa-circle fa-circle-o fa-circle-o-notch fa-circle-thin fa-clipboard fa-clock-o fa-clone fa-close fa-cloud fa-cloud-download fa-cloud-upload fa-cny fa-code fa-code-fork fa-codepen fa-codiepie fa-coffee fa-cog fa-cogs fa-columns fa-comment fa-comment-o fa-commenting fa-commenting-o fa-comments fa-comments-o fa-compass fa-compress fa-connectdevelop fa-contao fa-copy fa-copyright fa-creative-commons fa-credit-card fa-credit-card-alt fa-crop fa-crosshairs fa-css3 fa-cube fa-cubes fa-cut fa-cutlery fa-dashboard fa-dashcube fa-database fa-dedent fa-delicious fa-desktop fa-deviantart fa-diamond fa-digg fa-dollar fa-dot-circle-o fa-download fa-dribbble fa-dropbox fa-drupal fa-edge fa-edit fa-eject fa-ellipsis-h fa-ellipsis-v fa-empire fa-envelope fa-envelope-o fa-envelope-square fa-eraser fa-eur fa-euro fa-exchange fa-exclamation fa-exclamation-circle fa-exclamation-triangle fa-expand fa-expeditedssl fa-external-link fa-external-link-square fa-eye fa-eye-slash fa-eyedropper fa-facebook fa-facebook-f fa-facebook-official fa-facebook-square fa-fast-backward fa-fast-forward fa-fax fa-feed fa-female fa-fighter-jet fa-file fa-file-archive-o fa-file-audio-o fa-file-code-o fa-file-excel-o fa-file-image-o fa-file-movie-o fa-file-o fa-file-pdf-o fa-file-photo-o fa-file-picture-o fa-file-powerpoint-o fa-file-sound-o fa-file-text fa-file-text-o fa-file-video-o fa-file-word-o fa-file-zip-o fa-files-o fa-film fa-filter fa-fire fa-fire-extinguisher fa-firefox fa-flag fa-flag-checkered fa-flag-o fa-flash fa-flask fa-flickr fa-floppy-o fa-folder fa-folder-o fa-folder-open fa-folder-open-o fa-font fa-fonticons fa-fort-awesome fa-forumbee fa-forward fa-foursquare fa-frown-o fa-futbol-o fa-gamepad fa-gavel fa-gbp fa-ge fa-gear fa-gears fa-genderless fa-get-pocket fa-gg fa-gg-circle fa-gift fa-git fa-git-square fa-github fa-github-alt fa-github-square fa-gittip fa-glass fa-globe fa-google fa-google-plus fa-google-plus-square fa-google-wallet fa-graduation-cap fa-gratipay fa-group fa-h-square fa-hacker-news fa-hand-grab-o fa-hand-lizard-o fa-hand-o-down fa-hand-o-left fa-hand-o-right fa-hand-o-up fa-hand-paper-o fa-hand-peace-o fa-hand-pointer-o fa-hand-rock-o fa-hand-scissors-o fa-hand-spock-o fa-hand-stop-o fa-hashtag fa-hdd-o fa-header fa-headphones fa-heart fa-heart-o fa-heartbeat fa-history fa-home fa-hospital-o fa-hotel fa-hourglass fa-hourglass-1 fa-hourglass-2 fa-hourglass-3 fa-hourglass-end fa-hourglass-half fa-hourglass-o fa-hourglass-start fa-houzz fa-html5 fa-i-cursor fa-ils fa-image fa-inbox fa-indent fa-industry fa-info fa-info-circle fa-inr fa-instagram fa-institution fa-internet-explorer fa-intersex fa-ioxhost fa-italic fa-joomla fa-jpy fa-jsfiddle fa-key fa-keyboard-o fa-krw fa-language fa-laptop fa-lastfm fa-lastfm-square fa-leaf fa-leanpub fa-legal fa-lemon-o fa-level-down fa-level-up fa-life-bouy fa-life-buoy fa-life-ring fa-life-saver fa-lightbulb-o fa-line-chart fa-link fa-linkedin fa-linkedin-square fa-linux fa-list fa-list-alt fa-list-ol fa-list-ul fa-location-arrow fa-lock fa-long-arrow-down fa-long-arrow-left fa-long-arrow-right fa-long-arrow-up fa-magic fa-magnet fa-mail-forward fa-mail-reply fa-mail-reply-all fa-male fa-map fa-map-marker fa-map-o fa-map-pin fa-map-signs fa-mars fa-mars-double fa-mars-stroke fa-mars-stroke-h fa-mars-stroke-v fa-maxcdn fa-meanpath fa-medium fa-medkit fa-meh-o fa-mercury fa-microphone fa-microphone-slash fa-minus fa-minus-circle fa-minus-square fa-minus-square-o fa-mixcloud fa-mobile fa-mobile-phone fa-modx fa-money fa-moon-o fa-mortar-board fa-motorcycle fa-mouse-pointer fa-music fa-navicon fa-neuter fa-newspaper-o fa-object-group fa-object-ungroup fa-odnoklassniki fa-odnoklassniki-square fa-opencart fa-openid fa-opera fa-optin-monster fa-outdent fa-pagelines fa-paint-brush fa-paper-plane fa-paper-plane-o fa-paperclip fa-paragraph fa-paste fa-pause fa-pause-circle fa-pause-circle-o fa-paw fa-paypal fa-pencil fa-pencil-square fa-pencil-square-o fa-percent fa-phone fa-phone-square fa-photo fa-picture-o fa-pie-chart fa-pied-piper fa-pied-piper-alt fa-pinterest fa-pinterest-p fa-pinterest-square fa-plane fa-play fa-play-circle fa-play-circle-o fa-plug fa-plus fa-plus-circle fa-plus-square fa-plus-square-o fa-power-off fa-print fa-product-hunt fa-puzzle-piece fa-qq fa-qrcode fa-question fa-question-circle fa-quote-left fa-quote-right fa-ra fa-random fa-rebel fa-recycle fa-reddit fa-reddit-alien fa-reddit-square fa-refresh fa-registered fa-remove fa-renren fa-reorder fa-repeat fa-reply fa-reply-all fa-retweet fa-rmb fa-road fa-rocket fa-rotate-left fa-rotate-right fa-rouble fa-rss fa-rss-square fa-rub fa-ruble fa-rupee fa-safari fa-save fa-scissors fa-scribd fa-search fa-search-minus fa-search-plus fa-sellsy fa-send fa-send-o fa-server fa-share fa-share-alt fa-share-alt-square fa-share-square fa-share-square-o fa-shekel fa-sheqel fa-shield fa-ship fa-shirtsinbulk fa-shopping-bag fa-shopping-basket fa-shopping-cart fa-sign-in fa-sign-out fa-signal fa-simplybuilt fa-sitemap fa-skyatlas fa-skype fa-slack fa-sliders fa-slideshare fa-smile-o fa-soccer-ball-o fa-sort fa-sort-alpha-asc fa-sort-alpha-desc fa-sort-amount-asc fa-sort-amount-desc fa-sort-asc fa-sort-desc fa-sort-down fa-sort-numeric-asc fa-sort-numeric-desc fa-sort-up fa-soundcloud fa-space-shuttle fa-spinner fa-spoon fa-spotify fa-square fa-square-o fa-stack-exchange fa-stack-overflow fa-star fa-star-half fa-star-half-empty fa-star-half-full fa-star-half-o fa-star-o fa-steam fa-steam-square fa-step-backward fa-step-forward fa-stethoscope fa-sticky-note fa-sticky-note-o fa-stop fa-stop-circle fa-stop-circle-o fa-street-view fa-strikethrough fa-stumbleupon fa-stumbleupon-circle fa-subscript fa-subway fa-suitcase fa-sun-o fa-superscript fa-support fa-table fa-tablet fa-tachometer fa-tag fa-tags fa-tasks fa-taxi fa-television fa-tencent-weibo fa-terminal fa-text-height fa-text-width fa-th fa-th-large fa-th-list fa-thumb-tack fa-thumbs-down fa-thumbs-o-down fa-thumbs-o-up fa-thumbs-up fa-ticket fa-times fa-times-circle fa-times-circle-o fa-tint fa-toggle-down fa-toggle-left fa-toggle-off fa-toggle-on fa-toggle-right fa-toggle-up fa-trademark fa-train fa-transgender fa-transgender-alt fa-trash fa-trash-o fa-tree fa-trello fa-tripadvisor fa-trophy fa-truck fa-try fa-tty fa-tumblr fa-tumblr-square fa-turkish-lira fa-tv fa-twitch fa-twitter fa-twitter-square fa-umbrella fa-underline fa-undo fa-university fa-unlink fa-unlock fa-unlock-alt fa-unsorted fa-upload fa-usb fa-usd fa-user fa-user-md fa-user-plus fa-user-secret fa-user-times fa-users fa-venus fa-venus-double fa-venus-mars fa-viacoin fa-video-camera fa-vimeo fa-vimeo-square fa-vine fa-vk fa-volume-down fa-volume-off fa-volume-up fa-warning fa-wechat fa-weibo fa-weixin fa-whatsapp fa-wheelchair fa-wifi fa-wikipedia-w fa-windows fa-won fa-wordpress fa-wrench fa-xing fa-xing-square fa-y-combinator fa-y-combinator-square fa-yahoo fa-yc fa-yc-square fa-yelp fa-yen fa-youtube fa-youtube-play fa-youtube-square'
        ) );
    }
}