<?php
namespace Photobot;


/**
 * Class for handling website's endpoints for outputing pictures.
 */
class API {

    public $path;

    public $action;

    public $post_id;

    public $attrs;


    public function init() {
        add_action('send_headers', array($this, 'delegate_action'));
    }


    public function delegate_action($wp_instance) {
        $this->path = $_SERVER['REQUEST_URI'];

        if (strpos($this->path, '/photobot/') === 0) {
            $this->set_action_attrs();
        }

        if (isset($this->action)) {
            $this->output();
        }
    }


    public function set_action_attrs() {
        $path_stuff = explode('/', $this->path);
        $path_stuff = array_filter($path_stuff, function($item) {
            return strlen($item) > 0;
        });
        $path_stuff = array_values($path_stuff);

        if (!empty($path_stuff[1])) {
            $this->action = $path_stuff[1];
        }

        if (!empty($path_stuff[2])) {
            $this->post_id = $path_stuff[2];
        }

        $this->attrs = array_slice($path_stuff, 3);
    }


    public function do_action() {
        $path = get_attached_file($this->post_id);

        $size = getimagesize($path);
        if (!$size) return;

        // TODO: depending on $size['mime'] name the function imagecreatefrom...
        // and check if that function exits
        $source = imagecreatefromjpeg($path);

        $klass = 'Photobot\\Effect\\' . ucfirst($this->action);
        $effect = new $klass;

        try {
            $source = $effect->apply($source, $this->attrs);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            exit;
        }

        header("Content-type: {$size['mime']}");

        // TODO: depending on $size['mime'] name the function e.g. imagepng
        // and check if that function exits
        imagejpeg($source);

        imagedestroy($source);
    }


    public function output() {
        if (!isset($this->post_id)) {
            return;
        }

        $img = $this->do_action();
    }
}