<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/content.css',
        'css/ckeditor.css',
        'js/ckeditor5/ckeditor5-content.css',
        'js/ckeditor5/ckeditor5-editor.css',
        'js/ckeditor5/ckeditor5.css',
        'js/ckeditor5/ckeditor5.css.map',
        'js/ckeditor5-premium-features/ckeditor5-premium-features-content.css'
    ];
    public $js = [
        'js/site.js',
        'js/ckeditor5/ckeditor5.js.map',
        'js/ckeditor5/ckeditor5.umd.js',
        'js/ckeditor5/ckeditor5.js',
        'js/ckeditor5/ckeditor5.umd.js.map',
        'js/ckeditor5-premium-features/ckeditor5-premium-features.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}

