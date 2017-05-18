<?php

namespace obregonco\SemanticUI\widgets;

class GridView extends \yii\grid\GridView
{
    /**
     * @var array
     */
    public $tableOptions = ['class' => 'ui table'];

    /**
     * @var string
     */
    public $dataColumnClass = \obregonco\SemanticUI\widgets\DataColumn::class;

    /**
     * @var array
     */
    public $pager = ['class' => \obregonco\SemanticUI\widgets\LinkPager::class];
}
