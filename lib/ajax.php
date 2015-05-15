<?php
namespace Photobot;



class Ajax {

    public $app;


    public function init() {
        add_action('wp_ajax_reveal_fxslider', array($this, 'reveal_fxslider'));
    }


    public function reveal_fxslider() {
        $post_id = $_GET['post_id'];
//         $url = wp_get_attachment_url($post_id);
        $url = 'http://awesomeheader.dev/photobot/';

//         $image = wp_get_image_editor($url);
//         $image->resize(150, 150);

        $result = '<div id="phbot-fxslider" style="">';
        $html = '';

        foreach ($this->app->get_effects() as $effect) {
            $html .= '<div data-effect="'.$effect.'"><img src="" data-preload="'
                .$url.trailingslashit($effect).trailingslashit($post_id).'50"><p>'.ucfirst($effect).'</p></div>';
        }

        $result .= $html . '</div>';

        echo $result;
        wp_die();
    }
}