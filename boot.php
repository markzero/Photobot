<?php
function photobot_boot($class)
{
    if (substr($class, 0, 9) == 'Photobot\\') {
        $filename = PHBOT_PATH . 'lib' .
            strtolower(str_replace('\\', '/', substr($class, 8))) . '.php';

        if (file_exists($filename)) {
            require($filename);
        }
    }
}

function phbot_init()
{
    spl_autoload_register('photobot_boot');
    add_action('init', array('\Photobot\Settings', 'init'), 100, 0);
}

