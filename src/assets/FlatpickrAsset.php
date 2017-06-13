<?php

namespace bs\Flatpickr\assets;

use Yii;
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

    /**
     * @param string $plugin
     * @param \yii\web\View $view
     */
    public static function addPluginFiles($plugin, $view)
    {
        switch ($plugin) {
            case 'confirmDate':
                $view->registerJsFile(self::getPathUrl() . '/plugins/confirmDate/confirmDate.js');
                $view->registerCssFile(self::getPathUrl() . '/plugins/confirmDate/confirmDate.css');
                break;
            case 'weekSelect':
                $js[] = '/plugins/weekSelect/weekSelect.js';
                $view->registerJsFile(self::getPathUrl() . '/plugins/weekSelect/weekSelect.js');
                break;
        }
    }

    public static function getPathUrl() {
        return Yii::$app->assetManager->getPublishedUrl('@bower/flatpickr-calendar/dist');
    }
}
