<?php
namespace Photobot\Effect;

use Photobot\Effect;
use Photobot\Imgfunc;



class Edgedetect extends Effect {
    public function apply($im, $attrs) {
        parent::apply($im, $attrs);

        imagefilter($im, IMG_FILTER_EDGEDETECT);
        return $im;
    }
}