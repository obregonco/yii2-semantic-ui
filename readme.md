# Yii2 Semantic UI extension

[Semantic UI](http://semantic-ui.com) extension for [Yii2](http://www.yiiframework.com)

## Installation

yii2-semantic-ui 2.* works with Semantic UI 2.*

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run

```
php composer.phar require obregonco/yii2-semantic-ui "~2"
```

or add

```
"obregonco/yii2-semantic-ui": "~2"
```

to the require section of your ```composer.json```

## Usage

Add SemanticUICSSAsset to AppAsset:

```php
<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'obregonco\SemanticUI\assets\SemanticUICSSAsset'
    ];
}
```

Use Semantic UI widgets and elements. Standard Yii2 widgets also adopted.

You may replace yii2 standard widgets. Write in bootstrap.php:

```php
Yii::$container->set(\yii\grid\GridView::className(), \obregonco\SemanticUI\widgets\GridView::class);
Yii::$container->set(\yii\widgets\ActiveForm::className(), \obregonco\SemanticUI\widgets\ActiveForm::class);
Yii::$container->set(\yii\bootstrap\ActiveForm::className(), \obregonco\SemanticUI\widgets\ActiveForm::class);
Yii::$container->set(\yii\widgets\Breadcrumbs::className(), \obregonco\SemanticUI\collections\Breadcrumb::class);
Yii::$container->set(\yii\grid\CheckboxColumn::className(), \obregonco\SemanticUI\widgets\CheckboxColumn::class);
```

Be very careful with it.


## Examples

- Inside an `ActiveForm` object 
```php
                $form->field($model, 'username')->label(false)->textInput([
                    'autofocus' => true,
                    'placeHolder' => $model->getAttributeLabel('username'),
                    'uiOptions' => [
                            'appendTo' => '<i class="user icon"></i>',
                            'class' => 'ui left icon input',
                    ]
                ])

```

## Author
[Obregon.co](https://github.com/obregonco/)
[Ricardo O](https://github.com/robregonm/)

### Credits

Original maintainer [Aleksandr Zelenin](https://github.com/zelenin/)
