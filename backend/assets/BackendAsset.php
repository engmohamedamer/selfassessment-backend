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

class BackendAsset extends AssetBundle
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
        'https://fonts.googleapis.com/css?family=Quicksand:400,500,700',
        'material/css/AdminLTE.min.css',
        'material/css/bootstrap-material-design.min.css',
        'material/css/ripples.min.css',
        'material/css/MaterialAdminLTE.min.css',
        'material/css/skins/all-md-skins.min.css',
        'css/style.css'
    ];
    /**
     * @var array
     */
    public $js = [
        'https://unpkg.com/ionicons@4.2.2/dist/ionicons.js',
        'js/app.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        AdminLte::class,
        Html5shiv::class
    ];
}
