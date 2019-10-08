<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;

use common\assets\AdminLte;
use common\assets\Html5shiv;
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
        'css/dashboard.css',
    ];
    /**
     * @var array
     */
    public $js = [
        'js/Chart.min.js',
        'js/utils.js',
        'js/chartscript.js',
        // 'js/app.js',
        // '/material/plugins/jquery-sparkline/dist/jquery.sparkline.min.js',
        // '/material/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        // '/material/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        // '/material/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        // '/material/plugins/chart.js/Chart.js',
        // '/material/js/pages/dashboard2.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        AdminLte::class,
        Html5shiv::class,
        BackendAsset::class
    ];
}
