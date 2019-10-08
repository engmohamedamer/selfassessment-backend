<?php

namespace backend\assets;

use yii\web\AssetBundle;

class BackendArabic extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://fonts.googleapis.com/css?family=Cairo:400,600,700',
        'css/AdminLTE-RTL.css',
        'css/styleAr.css'
        
    ];




    public $depends = [
       
    ];
}
