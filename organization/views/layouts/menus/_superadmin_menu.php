<?php


use organization\assets\BackendAsset;
use organization\modules\system\models\SystemLog;
use organization\widgets\Menu;
use common\models\TimelineEvent;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;
use yii\widgets\Breadcrumbs;




echo Menu::widget([
    'options' => ['class' => 'sidebar-menu tree', 'data' => ['widget' => 'tree']],
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span><span class="pull-right-container">{right-icon}{badge}</span></a>',
    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents' => true,
    'items' => [
        
       
        [
            'label' => Yii::t('backend', 'Dashboard'),
            'url' => '/',
            'icon' => '<i class="nav-icon fas fa-tachometer-alt"></i>',
            'options' => ['class' => 'nav-item'],
        ],

        [
            'label' => Yii::t('common', 'My Organization'),
            'url' => '#',
            'icon' => '<i class="nav-icon fas fa-th"></i>',
            'options' => ['class' => 'treeview'],
            'active' => (Yii::$app->controller->module->id == 'organization'),
            'items' => [
                [
                    'label' => Yii::t('common', 'Organization Show'),
                    'icon' => '<i class="far fa-circle nav-icon"></i>',
                    'url' => ['/organization/view'],
                    'options' => ['class' => 'nav-item'],
                ],
                [
                    'label' => Yii::t('common', 'Organization Update'),
                    'icon' => '<i class="far fa-circle nav-icon"></i>',
                    'url' => ['/organization/update'],
                    'options' => ['class' => 'nav-item'],
                ],
            ],
        ],

        [
            'label' => Yii::t('common', 'Contributors'),
            'url' => '/user/index',
            'icon' => '<i class="fas fa-users nav-icon"></i>',
            'options' => ['class' => 'nav-item'],
            'active' => (Yii::$app->controller->module->id == 'user'),
        ],
        
    ],
]) ?>
