<?php

namespace bs\Flatpickr;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use bs\Flatpickr\assets\FlatpickrAsset;

class Widget extends InputWidget
{
    /**
     * Plugin settings
     * @link https://chmln.github.io/flatpickr/
     *
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var string
     */
    public $locale;

    /**
     * @var string
     */
    public $theme;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        // init default clientOptions
        $this->clientOptions = ArrayHelper::merge([
            'locale' => $this->locale,
        ], $this->clientOptions);
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->registerClientScript();

        if ($this->hasModel()) {
            $content = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $content = Html::textInput($this->name, $this->value, $this->options);
        }

        return $content;
    }

    /**
     * Register widget client scripts.
     */
    protected function registerClientScript()
    {
        $view = $this->getView();

        $selector = Json::encode('#' . $this->options['id']);
        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        FlatpickrAsset::register($view);
        if(!empty($this->theme)) {
           FlatpickrAsset::register($view)->css[] = 'themes/' . $this->theme . '.css'; 
        }
        if(!empty($this->locale)) {
            FlatpickrAsset::register($view)->js[] = 'l10n/' . $this->locale . '.js';
        }

        $view->registerJs("flatpickr($selector, {$options});");
    }
}
