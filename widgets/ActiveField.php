<?php

namespace obregonco\SemanticUI\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use obregonco\SemanticUI\helpers\Html;
use obregonco\SemanticUI\modules\Checkbox;
use obregonco\SemanticUI\modules\CheckboxList;
use obregonco\SemanticUI\modules\Dropdown;
use obregonco\SemanticUI\modules\RadioList;

class ActiveField extends \yii\widgets\ActiveField
{
    public $labelOptions = [];

    public $options = ['class' => 'field'];
    public $inputOptions = [];

    public $errorOptions = ['class' => 'ui red pointing label'];
    public $hintOptions = ['class' => 'ui pointing label'];

    private $formatOptions;

    public $template = "{label}\n{input}\n{hint}\n{error}";
    public $checkboxTemplate = '<div class="ui checkbox">{input}{label}{hint}{error}</div>';

    /**
     * @var string|null optional template to render the `{input}` placeholder content
     */
    public $inputTemplate;

    public function render($content = null)
    {
        $this->registerStyles();

        if ($content === null) {
            if ($this->inputTemplate) {
                $input = isset($this->parts['{input}']) ?
                    $this->parts['{input}'] : Html::activeTextInput($this->model, $this->attribute,
                        $this->inputOptions);
                $this->parts['{input}'] = strtr($this->inputTemplate, ['{input}' => $input]);
            }
        }

        return parent::render($content);
    }

    public function registerStyles()
    {
        $classNamesToSelectors = function ($classNames) {
            return '.' . implode('.', preg_split('/\s+/', $classNames, -1, PREG_SPLIT_NO_EMPTY));
        };
        $this->form->getView()->registerCss('
        ' . $classNamesToSelectors($this->errorOptions['class']) . ' {
            display: none;
        }
        ' . $classNamesToSelectors($this->form->errorCssClass) . ' ' . $classNamesToSelectors($this->errorOptions['class']) . ' {
            display: inline-block;
        }
        ');
    }

    protected function formatInput($content, $options)
    {
        $options = $options + ['class' => 'ui input'];
        $appendTo = ArrayHelper::remove($options, 'appendTo', '');
        $inlineLabel = ArrayHelper::remove($options, 'inlineLabel', '');
        $inlineLabelOptions = ArrayHelper::remove($options, 'inlineLabelOptions', false);
        if (!empty($inlineLabel)) {
            $this->parts['{label}'] = '';
            $options['class'] .= ' labeled';
            $label = $inlineLabel === true ? $this->model->getAttributeLabel($this->attribute) : $inlineLabel;
            $appendTo .= Html::tag('div', $label, $inlineLabelOptions);
        }

        return Html::tag('div', $appendTo . $content, $options);
    }

    public function textInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $uiOptions = ArrayHelper::remove($options, 'uiOptions', []);
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = $this->formatInput(Html::activeTextInput($this->model, $this->attribute, $options), $uiOptions);

        return $this;
    }

    public function passwordInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $uiOptions = ArrayHelper::remove($options, 'uiOptions', []);
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = $this->formatInput(Html::activePasswordInput($this->model, $this->attribute, $options), $uiOptions);

        return $this;
    }


    public function checkbox($options = [], $enclosedByLabel = true)
    {
        $this->parts['{label}'] = '';
        $this->parts['{input}'] = Checkbox::widget([
            'class' => Checkbox::className(),
            'model' => $this->model,
            'attribute' => $this->attribute,
            'options' => $options,
            'label' => Html::activeLabel($this->model, $this->attribute, $this->labelOptions)
        ]);
        return $this;
    }

    public function checkboxList($items, $options = [])
    {
        $this->parts['{input}'] = CheckboxList::widget([
            'class' => CheckboxList::className(),
            'model' => $this->model,
            'attribute' => $this->attribute,
            'items' => $items,
            'options' => $options
        ]);
        return $this;
    }

    public function radioList($items, $options = [])
    {
        $this->parts['{input}'] = RadioList::widget([
            'class' => RadioList::className(),
            'model' => $this->model,
            'attribute' => $this->attribute,
            'items' => $items,
            'options' => $options
        ]);
        return $this;
    }

    public function dropDownList($items, $options = [])
    {
        $multiple = ArrayHelper::remove($options, 'multiple', false);
        $upward = ArrayHelper::remove($options, 'upward', false);
        $compact = ArrayHelper::remove($options, 'compact', false);
        $disabled = ArrayHelper::remove($options, 'disabled', false);
        $fluid = ArrayHelper::remove($options, 'fluid', false);
        $search = ArrayHelper::remove($options, 'search', true);
        $defaultText = ArrayHelper::remove($options, 'defaultText', '');

        $this->parts['{input}'] = Dropdown::widget([
            'class' => Dropdown::className(),
            'model' => $this->model,
            'attribute' => $this->attribute,
            'items' => $items,
            'options' => $options,
            'search' => $search,
            'multiple' => $multiple,
            'upward' => $upward,
            'compact' => $compact,
            'disabled' => $disabled,
            'fluid' => $fluid,
            'defaultText' => $defaultText
        ]);
        return $this;
    }
}
