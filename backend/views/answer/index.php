<?php

use common\models\Answer;
use common\models\searchs\AnswerSearch;
use nickdenry\grid\toggle\components\RoundSwitchColumn;
use yii\web\View;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */
/* @var $searchModel AnswerSearch */

$this->title = 'Ответы';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="model-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-10 pr0 mt24">
            <?php
            echo Html::a('Сбросить фильтры', ['index'], ['class' => 'btn btn-default']);
            ?>
        </div>
        <?php
        echo $this->render('_search', ['filterModel' => $searchModel]);
        ?>
    </div>

    <div class="box">
        <div class="box-body">
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
                    'respondent_name',
                    'respondent_email:email',
                    [
                        'attribute' => 'question_id',
                        'value' => function (Answer $model) {
                            return $model->question->name;
                        },
                    ],
                    [
                        'attribute' => 'question_rate',
                        'value' => function (Answer $model) {
                            return $model->question_rate + 1;
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:d.m.Y H:i'],
                        'headerOptions' => ['style' => 'min-width:150px;width:150px;', ],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['style' => 'min-width:30px;width:30px;', ],
                        'template' => '{delete}',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
