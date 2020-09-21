<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\View;
use common\widgets\Menu;

/* @var $this View */
/* @var $identity User */

$identity = Yii::$app->user->identity;
$isAdmin     = $identity->isAdmin('admin');
$isModerator = $identity->isModerator('moderator') || $isAdmin;
$isEditor    = $identity->isEditor('editor') || $isModerator || $isAdmin;

$action = empty($_SERVER['REQUEST_URI'])?'':$_SERVER['REQUEST_URI'];

$items   = [
    [
        'label'   => Yii::t('app','Menu'),
        'options' => ['class' => 'header header0 pointer'],
    ],

    [
        'label'   => Yii::t('app', 'Вопросы'),
        'options' => ['class' => 'menu menu1'],
        'icon'    => 'question-circle',
        'url'     => ['/question'],
        'visible' => $isAdmin,
        'active'  => $action == '/question',
    ],
    [
        'label'   => Yii::t('app', 'Ответы'),
        'options' => ['class' => 'menu menu1'],
        'icon'    => 'list-ol',
        'url'     => ['/answer'],
        'visible' => $isAdmin,
        'active'  => $action == '/answer',
    ],
];

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/avatar.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=$identity->username?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <aside class="main-sidebar">
            <section class="sidebar">
                <?php
                echo Menu::widget([
                    'options' => [
                        'class'       => 'sidebar-menu tree',
                        'data-widget' => 'tree'
                    ],
                    'items'   => $items,
                ]);
                echo '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . $identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
                ?>
            </section>
        </aside>
    </section>
</aside>

<?php
$js_menu = <<< JS
$(document).ready(function() {
    $(".header0").on('click', function() {
        $(".menu").slideToggle();
    });
    $(".header1").on('click', function() {
        $(".menu1").slideToggle();
    });
    $(".header2").on('click', function() {
        $(".menu2").slideToggle();
    });
    $(".header3").on('click', function() {
        $(".menu3").slideToggle();
    });
    $(".header4").on('click', function() {
        $(".menu4").slideToggle();
    });
    $(".header5").on('click', function() {
        $(".menu5").slideToggle();
    });
    $(".header6").on('click', function() {
        $(".menu6").slideToggle();
    });
    $(".header7").on('click', function() {
        $(".menu7").slideToggle();
    });
    $(".header8").on('click', function() {
        $(".menu8").slideToggle();
    });
    $(".header9").on('click', function() {
        $(".menu9").slideToggle();
    });
    $(".header10").on('click', function() {
        $(".menu10").slideToggle();
    });
    $(".header11").on('click', function() {
        $(".menu11").slideToggle();
    });
    $(".header100").on('click', function() {
        $(".menu100").slideToggle();
    });
    
    $(".menu").on('click', function() {
        console.log($(this));
    });
});
JS;

$this->registerJs($js_menu, View::POS_END);


