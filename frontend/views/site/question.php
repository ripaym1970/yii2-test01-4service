<?php

use common\models\Answer;
use common\models\Question;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

//use yii\captcha\Captcha;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $question Question */
/* @var $model Answer */

$this->title = 'Текущий опрос';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <h2>
        <?= $question->name; ?>
    </h2>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'answer-form']); ?>

            <?php
            echo $form->field($model, 'question_id')->hiddenInput()->label(false);
            echo $form->field($model, 'question_rate')
                ->radioList([0,1,2,3,4,5,6,7,8,9,10])
                ->label('Пожалуйста, выберите ваш ответ на вопрос.')
            ;
            ?>

            <?php
            echo $form->field($model, 'respondent_comment')
                ->textInput(['autofocus' => true]);
            ?>
            <?php
            echo $form->field($model, 'respondent_name');
            ?>

            <?php
            echo $form->field($model, 'respondent_email');
            ?>

            <?php
            //echo $form->field($modelForm, 'verifyCode')
            //    ->widget(Captcha::class, [
            //    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            //]);
            ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
