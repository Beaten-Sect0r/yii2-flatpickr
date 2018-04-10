# Yii2 Flatpickr

Click on a :star:!

[![Total Downloads](https://poser.pugx.org/beaten-sect0r/yii2-flatpickr/downloads?format=flat-square)](https://packagist.org/packages/beaten-sect0r/yii2-flatpickr)
[![Latest Stable Version](https://poser.pugx.org/beaten-sect0r/yii2-flatpickr/v/stable?format=flat-square)](https://packagist.org/packages/beaten-sect0r/yii2-flatpickr)
[![Latest Unstable Version](https://poser.pugx.org/beaten-sect0r/yii2-flatpickr/v/unstable?format=flat-square)](https://packagist.org/packages/beaten-sect0r/yii2-flatpickr)
[![License](https://poser.pugx.org/beaten-sect0r/yii2-flatpickr/license?format=flat-square)](https://packagist.org/packages/beaten-sect0r/yii2-flatpickr)

[Flatpickr](https://chmln.github.io/flatpickr/) is a lightweight and powerful datetime picker.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
composer require --prefer-dist beaten-sect0r/yii2-flatpickr "*"
```

or add

```
"beaten-sect0r/yii2-flatpickr": "*"
```

to the require section of your `composer.json` file.

## Usage

```php
<?php

use bs\Flatpickr\FlatpickrWidget;

?>

<?= $form->field($model, 'published_at')->widget(FlatpickrWidget::class, [
    'locale' => strtolower(substr(Yii::$app->language, 0, 2)),
    // https://chmln.github.io/flatpickr/plugins/
    'plugins' => [
         'confirmDate' => [
               'confirmIcon'=> "<i class='fa fa-check'></i>",
               'confirmText' => 'OK',
               'showAlways' => false,
               'theme' => 'light',
         ],
    ],
    'groupBtnShow' => true,
    'options' => [
        'class' => 'form-control',
    ],
    'clientOptions' => [
        // config options https://chmln.github.io/flatpickr/options/
        'allowInput' => true,
        'defaultDate' => $model->published_at ? date(DATE_ATOM, $model->published_at) : null,
        'enableTime' => true,
        'time_24hr' => true,
    ],
]) ?>
```
