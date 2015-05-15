<?php
namespace Photobot;


abstract class Effect {

    public $level;
    public $arg2;
    public $arg3;
    public $arg4;


    public function apply($im, $attrs) {
        if (!isset($attrs[0]) || !is_numeric($attrs[0])) {
            return;
        }

        $this->level = (int) $attrs[0];

        if (isset($attrs[1])) $this->arg2 = $attrs[1];
        if (isset($attrs[2])) $this->arg3 = $attrs[2];
        if (isset($attrs[3])) $this->arg4 = $attrs[3];
    }
}