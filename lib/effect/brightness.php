<?php
namespace Photobot\Effect;

use Photobot\Effect;
use Photobot\Imgfunc;



class Brightness extends Effect {
    public function apply($im, $attrs) {
        parent::apply($im, $attrs);

        if ($this->level < -255 || $this->level > 255) {
            throw new \Exception('Brightness level must be >=-255 and <=255');
        }

        imagefilter($im, IMG_FILTER_BRIGHTNESS, $this->level);
        return $im;
    }
}