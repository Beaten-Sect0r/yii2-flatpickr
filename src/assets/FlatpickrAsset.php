<?php

namespace bs\Flatpickr\assets;

use Yii;
use yii\web\AssetBundle;

class FlatpickrAsset extends AssetBundle
{
    public $sourcePath = '@bower/flatpickr-calendar/dist';
    public $locale;
    public $plugin;
    public $theme;
    public $js = [
        'flatpickr.min.js',
    ];
    public $css = [
        'flatpickr.min.css',
    ];

    public function registerAssetFiles($view)
    {
        // language
        if ($this->locale !== null && $this->locale !== 'en') {
            $this->js[] = 'l10n/' . $this->locale . '.js';
        }

        // plugin
        switch ($this->plugin) {
            case 'confirmDate':
                $this->js[] = 'plugins/confirmDate/confirmDate.js';
                $this->css[] = 'plugins/confirmDate/confirmDate.css';
                break;
            case 'label':
                $this->js[] = 'plugins/labelPlugin/labelPlugin.js';
                break;
            case 'weekSelect':
                $this->js[] = 'plugins/weekSelect/weekSelect.js';
                break;
            case 'range':
                $this->js[] = 'plugins/rangePlugin.js';
                break;
        }

        // theme
        if (!empty($this->theme)) {
            $this->css[] = 'themes/' . $this->theme . '.css';
        }

        parent::registerAssetFiles($view);
    }
}
