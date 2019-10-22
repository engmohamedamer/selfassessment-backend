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
    'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'data' => ['widget' => 'treeview']],
    'linkTemplate' => '<a href="{url}" class="nav-link">{icon}<p>{label}{right-icon}{badge}</p></a>',
    'submenuTemplate' => "\n<ul class=\"nav nav-treeview\">\n{items}\n</ul>\n",
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
            'options' => ['class' => 'nav-item has-treeview'],
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
            'label' => Yii::t('backend', 'Users Data'),
            'options' => ['class' => 'nav-header'],
        ],

        [
            'label' => Yii::t('common', 'Contributors'),
            'url' => '#',
            'icon' => '<i class="nav-icon fas fa-th"></i>',
            'options' => ['class' => 'nav-item has-treeview'],
            'active' => (Yii::$app->controller->module->id == 'user'),
            'items' => [

                [
                    'label' => Yii::t('common', 'Contributors'),
                    'icon' => '<i class="far fa-circle nav-icon"></i>',
                    'url' => ['/user/index'],
                    'options' => ['class' => 'nav-item'],
                ],
            ],
        ],
        
    ],
]) ?>
