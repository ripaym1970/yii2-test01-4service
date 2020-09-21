<?php

use common\models\searchs\AnswerSearch;
use yii\web\View;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $filterModel AnswerSearch */

?>

<div class="col-md-2">
    <?php
    $form = ActiveForm::begin([
        'id'     => 'formsearch',
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'name'  => 'formsearch',
        ]
    ]);
    ?>

    <?php
    echo $form->field($filterModel, 'range_created_at', [
            'addon'   => [
                'prepend' => [
                    'content' => '<i class="fas fa-calendar-alt"></i>',
                ],
            ],
            'options' => ['class' => 'drp-container form-group'],
        ])
        ->widget(DateRangePicker::class, [
            'language' => Yii::$app->language,
            'options' => [
                'placeholder' => 'Выберите период создания...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'locale' => [
                    'format' => 'DD.MM.YYYY',
                    'cancelLabel' => 'Очистить',
                ],
            ],
            'pluginEvents' => [
                'apply.daterangepicker' => 'function() { 
                    formsearch.submit(); 
                }',
                'cancel.daterangepicker' => 'function(ev, picker) {
                    $(picker.element[0]).val("").trigger("change");
                    formsearch.submit(); 
                }',
            ],
        ])
        ->label(false)
    ;
    ?>
</div>
<?php
ActiveForm::end(); ?>
