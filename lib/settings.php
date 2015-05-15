<?php
namespace Photobot;



/**
 * Main entry point in WordPress admin area.
 */
class Settings {

    public $ajax;

    public $api;

    public $post_id;



    public static function init() {
        $settings = new Settings();

        if (isset($_GET['post'])) {
            $settings->post_id = (int) $_GET['post'];
        }

        $settings->init_ajax_hooks();
        $settings->init_api();
        Adminhooks::init();
        add_action('admin_enqueue_scripts', array($settings, 'scripts'));
    }


    public function scripts($hook) {
        global $post;

        //
        // If not two-columns view or list view
        //
        if ('post.php' != $hook && 'upload.php' != $hook) {
            return;
        }

        //
        // Only load main.js on post.php attachment & upload.php pages
        //
        if ((isset($post) && (!wp_attachment_is_image($post->ID) || 'post.php' != $hook)) && 'upload.php' != $hook) {
            return;
        }

        wp_enqueue_style('phbot-slickjs', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css');
        wp_enqueue_style('phbot-slickjs-theme', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick-theme.css');
        wp_enqueue_script('phbot-slickjs', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js', array('jquery'));
        wp_enqueue_script('phbot-imgpreload', 'https://raw.githubusercontent.com/DimitarChristoff/pre-loader/master/pre-loader.js');

        wp_enqueue_style('phbot-styles', PHBOT_ASSETS_URL . 'css/main.css');
        wp_register_script('photobot', PHBOT_ASSETS_URL . 'js/main.js', array('jquery'), PHBOT_VERSION, true);
        wp_enqueue_script('photobot');
        wp_localize_script('photobot', 'photobotLocal',
            array(
                'post_id' => isset($post->ID) ? $post->ID : '',
                'i18n' => array(
                    'apply_filters' => __('Apply Filters', PHBOT_LANG)
                )
            )
        );


    }


    public function init_ajax_hooks() {
        $this->ajax = new Ajax();
        $this->ajax->app = $this;
        $this->ajax->init();
    }


    public function init_api() {
        $this->api = new API();
        $this->api->init();
    }


    public static $effects = [
        'brightness',
        'contrast',
        'grayscale',
        'contrast',
        'colorize',
        'edgedetect',
        'emboss',
        'gaussianblur',
        'selectiveblur',
        'meanremoval',
        'smooth',
        'negate',
        'sepia'
    ];


    public function get_effects() {
        return self::$effects;
    }
}