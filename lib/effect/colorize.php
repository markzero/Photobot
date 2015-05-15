<?php
namespace Photobot\Effect;

use Photobot\Effect;
use Photobot\Imgfunc;



class Colorize extends Effect {
    public function apply($im, $attrs) {
        parent::apply($im, $attrs);

        imagefilter($im, IMG_FILTER_COLORIZE, $this->level, $this->arg2, $this->arg3, $this->arg4);
        return $im;
    }
}