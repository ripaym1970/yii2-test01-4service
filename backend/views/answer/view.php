<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Answer;

/* @var $this View */
/* @var $model Answer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ответы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="model-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method'  => 'post',
            ],
        ]);
        ?>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'respondent_name',
            'respondent_email:email',
            'respondent_comment:ntext',
            'question_id',
            'active:boolean',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i'],
                'headerOptions' => ['style' => 'min-width:70px;width:70px;', ],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i'],
                'headerOptions' => ['style' => 'min-width:70px;width:70px;', ],
            ],
        ],
    ]);
    ?>
</div>
