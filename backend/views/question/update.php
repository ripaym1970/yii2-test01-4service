<?php

use yii\web\View;
use yii\helpers\Html;
use common\models\Question;

/* @var $this View */
/* @var $model Question */

$this->title = Yii::t('app','Редактирование');
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

?>

<div class="model-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
