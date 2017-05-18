<?php

namespace obregonco\SemanticUI;

use obregonco\SemanticUI\assets\SemanticUIJSAsset;

class Widget extends \yii\base\Widget
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * @var array
     */
    public $clientOptions = [];

    public function init()
    {
        parent::init();
        isset($this->options['id'])
            ? $this->setId($this->options['id'])
            : $this->options['id'] = $this->getId();
    }

    public function registerJsAsset()
    {
        SemanticUIJSAsset::register($this->getView());
    }
}
