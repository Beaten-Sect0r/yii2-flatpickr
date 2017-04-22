<?php

namespace bs\Flatpickr\assets;

use yii\web\AssetBundle;

class FlatpickrAsset extends AssetBundle
{
    public $sourcePath = '@bower/flatpickr-calendar/dist';
    public $js = [
        'flatpickr.min.js',
    ];
    public $css = [
        'flatpickr.min.css',
    ];
}
