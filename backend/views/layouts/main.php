<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

$controller = Yii::$app->controller->id;
$action     = Yii::$app->controller->action->id;

if (Yii::$app->controller->action->id === 'login') { 
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render('main-login', [
        'content' => $content,
    ]);
} else {
    backend\assets\AppAsset::register($this);
?>

    <?php $this->beginPage() ?>
    <!DOCTYPE html>
        <html lang="<?= Yii::$app->language ?>">
            <head>
                <meta charset="<?= Yii::$app->charset ?>"/>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <?= Html::csrfMetaTags() ?>
                <title><?= Html::encode($this->title) ?></title>
                <?php $this->head() ?>
            </head>
            <body class="hold-transition skin-blue sidebar-mini" data-controller="<?=$controller?>" data-action="<?=$action?>">
            <?php $this->beginBody() ?>

                <div class="wrapper">
                    <?php
                    echo $this->render('header');
                    echo $this->render('left');
                    echo $this->render('content', [
                        'content' => $content,
                    ]);
                    ?>
                </div>

            <?php $this->endBody() ?>
            </body>
        </html>
    <?php $this->endPage() ?>
<?php } ?>
