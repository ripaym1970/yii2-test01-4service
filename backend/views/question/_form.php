<?php

use common\models\Question;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model Question */

?>

<div class="model-form">

    <?php
    $form = ActiveForm::begin();
    echo $form->errorSummary($model);

    echo $form->field($model, 'name')->textInput(['maxlength' => true]);
    echo $form->field($model, 'active')->checkbox();

    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

</div>
