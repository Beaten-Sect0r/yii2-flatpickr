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
    public $plugin;

    /**
     * @var string
     */
    public $theme;
    
    /**
     * Disable input
     *
     * @var bool
     */
    public $disabled = false;

    /**
     * Show group buttons
     *
     * @var bool
     */
    public $groupBtnShow = false;

    /**
     * Buttons template
     *
     * @var string
     */
    public $groupBtnTemplate = '{toggle} {clear}';

    /**
     * Buttons
     *
     * @var array
     */
    public $groupBtn = [
        'toggle' => [
            'btnClass' => 'btn btn-default',
            'iconClass' => 'glyphicon glyphicon-calendar',
        ],
        'clear' => [
            'btnClass' => 'btn btn-default',
            'iconClass' => 'glyphicon glyphicon-remove',
        ],
    ];

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
        if ($this->groupBtnShow) {
            $this->clientOptions['wrap'] = true;
        } else {
            $this->clientOptions['wrap'] = false;
        }

        $this->registerClientScript();
        $content = '';
        $options['data-input'] = '';
        if ($this->disabled) {
            $options['disabled'] = 'disabled';
        }

        if ($this->groupBtnShow) {
            $content .= '<div class="flatpickr-' . $this->options['id'] . ' input-group">';

            if ($this->hasModel()) {
                $content .= Html::activeTextInput($this->model, $this->attribute, ArrayHelper::merge($this->options, $options));
            } else {
                $content .= Html::textInput($this->name, $this->value, ArrayHelper::merge($this->options, $options));
            }

            $content .= '<div class="input-group-btn">';
            if (preg_match_all('/{(toggle|clear)}/i', $this->groupBtnTemplate, $matches)) {
                foreach ($matches[1] as $btnName) {
                    $content .= $this->renderGroupBtn($btnName);
                }
            }
            $content .= '</div>';
            $content .= '</div>';
        } else {
            if ($this->hasModel()) {
                $content = Html::activeTextInput($this->model, $this->attribute, ArrayHelper::merge($this->options, $options));
            } else {
                $content = Html::textInput($this->name, $this->value, ArrayHelper::merge($this->options, $options));
            }
        }

        return $content;
    }

    /**
     * Register widget client scripts.
     */
    protected function registerClientScript()
    {
        $view = $this->getView();

        if ($this->groupBtnShow) {
            $selector = Json::encode('.flatpickr-' . $this->options['id']);
        } else {
            $selector = Json::encode('#' . $this->options['id']);
        }

        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        FlatpickrAsset::register($view);
        FlatpickrAsset::addPluginFiles($this->plugin, $view);
        if (!empty($this->theme)) {
            FlatpickrAsset::register($view)->css[] = 'themes/' . $this->theme . '.css';
        }
        if ($this->locale !== null && $this->locale !== 'en') {
            FlatpickrAsset::register($view)->js[] = 'l10n/' . $this->locale . '.js';
        }

        $view->registerJs("flatpickr($selector, {$options});");
    }

    /**
     * @param string $btnName
     * @return string
     */
    private function renderGroupBtn($btnName)
    {
        $content = '';
        if (isset($this->groupBtn[$btnName])) {
            if (isset($this->groupBtn[$btnName]['btnClass'])) {
                $btnClass = $this->groupBtn[$btnName]['btnClass'];
            } else {
                $btnClass = 'btn btn-default';
            }

            if (isset($this->groupBtn[$btnName]['iconClass'])) {
                $iconClass = $this->groupBtn[$btnName]['iconClass'];
            } else {
                $iconClass = '';
            }

            $disabled = '';
            if ($this->disabled) {
                $disabled = 'disabled="disabled"';
            }

            $content = <<<HTML
                <button class="$btnClass" type="button" $disabled data-$btnName>
                    <span class="$iconClass"></span>
                </button>
HTML;
        }

        return $content;
    }
}
