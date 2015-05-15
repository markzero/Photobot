<?php
namespace Photobot;


class Imgfunc {
    public static function do_brightness_filter($im, $level) {
        imagefilter($im, IMG_FILTER_BRIGHTNESS, $level);
        return $im;
    }


    public static function do_contrast_filter($im) {
        imagefilter($im, IMG_FILTER_CONTRAST, 50);
        return $im;
    }


    public static function do_grayscale_filter($im) {
        imagefilter($im, IMG_FILTER_GRAYSCALE, 50);
        return $im;
    }


    public static function do_colorize_filter($im) {
        imagefilter($im, IMG_FILTER_COLORIZE, 100, 0, 0);
        return $im;
    }


    public static function do_edgedetect_filter($im) {
        imagefilter($im, IMG_FILTER_EDGEDETECT);
        return $im;
    }


    public static function do_gaussianblur_filter($im) {
        imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
        return $im;
    }
}