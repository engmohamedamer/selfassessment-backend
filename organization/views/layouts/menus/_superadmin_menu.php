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
            'icon' => '<i class="icofont-1x icofont-dashboard-web mr-2 ml-2"></i>',
            'options' => ['class' => 'nav-item'],
            'active' =>  (Yii::$app->controller->id == 'site'),
        ],

        [
            'label' => Yii::t('common', 'My Organization'),
            'url' => '#',
            'icon' => '<i class="icofont-1x icofont-institution mr-2 ml-2"></i>',
            'options' => ['class' => 'treeview'],
            'active' => (Yii::$app->controller->id == 'organization'),
            'items' => [
                [
                    'label' => Yii::t('common', 'Organization Show'),
                    'icon' => '<i class="icofont-eye-alt mr-2 ml-2"></i>',
                    'url' => ['/organization/view'],
                    'options' => ['class' => 'nav-item'],
                ],
                [
                    'label' => Yii::t('common', 'Organization Update'),
                    'icon' => '<i class="icofont-edit mr-2 ml-2"></i>',
                    'url' => ['/organization/update'],
                    'options' => ['class' => 'nav-item'],
                ],
                [
                    'label' => Yii::t('common', 'Organization Structure'),
                    'url' => '/organization-structure',
                    'icon' => '<i class="icofont-gears mr-2 ml-2"></i>',
                    'options' => ['class' => 'nav-item'],
                    'active' => (Yii::$app->controller->id == 'organization-structure'),
                ],
            ],
        ],

        [
            'label' => Yii::t('common', 'Contributors'),
            'url' => '/user/index',
            'icon' => '<i class="icofont-users-social mr-2 ml-2"></i>',
            'options' => ['class' => 'nav-item'],
            'active' => (Yii::$app->controller->id == 'user'),
        ],


        [
            'label' => Yii::t('common', 'Assessments List'),
            'url' => '/assessment',
            'icon' => '<i class="icofont-papers mr-2 ml-2"></i>',
            'options' => ['class' => 'nav-item'],
            'active' => (Yii::$app->controller->module->id == 'assessment'),
        ],


        [
            'label' => Yii::t('backend', 'Corrective Action Report'),
            'url' => '/corrective-action-report',
            'icon' => '<i class="icofont-tick-boxed mr-2 ml-2"></i>',
            'options' => ['class' => 'nav-item'],
            'active' => (Yii::$app->controller->id == 'corrective-action-report'),
        ],

    ],
]) ?>
