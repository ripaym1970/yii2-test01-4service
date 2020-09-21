<?php

use common\models\searchs\QuestionSearch;
use nickdenry\grid\toggle\components\RoundSwitchColumn;
use yii\web\View;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;


/* @var $this View */
/* @var $dataProvider ActiveDataProvider */
/* @var $searchModel QuestionSearch */

$this->title = 'Вопросы';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="model-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4 pr0 mt24">
            <?php
            echo Html::a('Добавить', ['create'], ['class' => 'btn btn-success mr5']);
            echo Html::a('Сбросить фильтры', ['index'], ['class' => 'btn btn-default']);
            ?>
        </div>
    </div>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'headerOptions' => ['width' => '70', ],
                'template' => '{view} {update}',
            ],
            [
                'class' => RoundSwitchColumn::class,
                'attribute' => 'active',
                /* other column options, i.e. */
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'active',
                    ['' => 'Все', 0 => 'Нет', 1 => 'Да'],
                    ['class' => 'form-control', 'style' => 'padding:6px 2px;width:70px;']
                ),
                'headerOptions' => ['width' => '70px'],
            ],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'min-width:35px;width:35px;', ],
                'contentOptions' => ['align' => 'right', ],
            ],
            'name',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i'],
                'headerOptions' => ['style' => 'min-width:150px;width:150px;', ],
            ],
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'min-width:30px;width:30px;', ],
                'template' => '{delete}',
            ],
        ],
    ]);
    ?>

</div>
