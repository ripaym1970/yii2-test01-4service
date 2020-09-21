<?php

use common\widgets\Alert;
use yii\widgets\Breadcrumbs;

/* @var $content string */

?>

<div class="content-wrapper">
    <section class="content-header" style="line-height: 20px;">
        <?php
        if (isset($this->blocks['content-header'])) {
            echo '<h1>'. $this->blocks['content-header'] . '</h1>';
        }
        ?>
        <div>
            <?php
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
            ?>
        </div>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; 2020-<?= date('Y') ?></strong> All rights reserved.
</footer>

<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="control-sidebar-home-tab"></div>
        <div class="tab-pane" id="control-sidebar-settings-tab"></div>
    </div>
</aside>

<div class="control-sidebar-bg"></div>
