<?php
namespace Photobot\Effect;

use Photobot\Effect;
use Photobot\Imgfunc;



class Contrast extends Effect {
    public function apply($im, $attrs) {
        parent::apply($im, $attrs);

        imagefilter($im, IMG_FILTER_CONTRAST, $this->level);
        return $im;
    }
}