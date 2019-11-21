<?php

namespace organization\assets;

use common\assets\AdminLte;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class DashboardAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $css = [
        "js/chart.js/Chart.min.css"

    ];
    /**
     * @var array
     */
    public $js = [
        "js/chart.js/Chart.min.js",
        'js/views/landingCharts.js',

        // "js/HomeCharts.js",
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        AdminLte::class,
    ];
}
