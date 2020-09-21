<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */
/* @var $identity User */

$identity = Yii::$app->user->identity;

?>

<header class="main-header">
    <?= Html::a('<span class="logo-mini">Admin</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fa fa-bars" title="<?= Yii::t('app', 'Toggle navigation') ?>"></i>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/img/avatar.png" class="user-image" alt=""/>
                        <span class="hidden-xs"><?= $identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="/img/avatar.png" class="img-circle" alt=""/>
                            <p>
                                <?= $identity->username ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(Yii::t('app', 'Profile'), ['/admin/update', 'id' => Yii::$app->user->id], ['class' => 'btn btn-default btn-flat']) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(Yii::t('app', 'Logout'), ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
