<?php

namespace bs\Flatpickr\assets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

class FlatpickrAsset extends AssetBundle
{
    public $sourcePath = '@bower/flatpickr/dist';
    public $locale;
    public $plugins = [];
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
        if (!empty($this->plugins) && is_array($this->plugins)) {
            if (ArrayHelper::keyExists('rangePlugin', $this->plugins)) {
                $this->js[] = 'plugins/rangePlugin.js';
            }
            if (ArrayHelper::keyExists('confirmDate', $this->plugins)) {
                $this->js[] = 'plugins/confirmDate/confirmDate.js';
                $this->css[] = 'plugins/confirmDate/confirmDate.css';
            }
            if (ArrayHelper::isIn('label', $this->plugins)) {
                $this->js[] = 'plugins/labelPlugin/labelPlugin.js';
            }
            if (ArrayHelper::keyExists('weekSelect', $this->plugins)) {
                $this->js[] = 'plugins/weekSelect/weekSelect.js';
            }
        }

        // theme
        if (!empty($this->theme)) {
            $this->css[] = 'themes/' . $this->theme . '.css';
        }

        parent::registerAssetFiles($view);
    }
}
