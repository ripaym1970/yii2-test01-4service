<?php

use common\models\Question;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Question */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="model-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
