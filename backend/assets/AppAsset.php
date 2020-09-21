<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/AdminLTE.min.css',
        'css/_all-skins.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/adminlte.min.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\CdnProAssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
