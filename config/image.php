<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
    'driver' => 'gd',

    // Mảng resize image
    'array_resize_image' => [
        'sm_'  => ['width' => 100, 'height' => 5000],
        'md_'  => ['width' => 300, 'height' => 5000],
        'lg_'  => ['width' => 600, 'height' => 5000]
    ],


    // Mảng crop image
    'array_crop_image' => [
        'sm_'  => ['width' => 100, 'height' => 100],
        'md_'  => ['width' => 300, 'height' => 300],
        'lg_'  => ['width' => 600, 'height' => 600]
    ],
);
