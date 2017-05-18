<?php

namespace obregonco\SemanticUI\assets;

use Yii;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class SemanticUIJSAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/bower/semantic/dist';

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        SemanticUICSSAsset::class,
    ];

    public function init()
    {
        $postfix = YII_DEBUG ? '' : '.min';
        $this->js[] = 'semantic' . $postfix . '.js';

        parent::init();
    }
}
