<?php


use backend\assets\BackendAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\Menu;
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
            'label' => Yii::t('backend', 'Users Data'),
            'options' => ['class' => 'nav-header'],
        ],

        [
            'label' => Yii::t('backend', 'Users'),
            'url' => '#',
            'icon' => '<i class="nav-icon fas fa-th"></i>',
            'options' => ['class' => 'nav-item has-treeview'],
            'active' => (Yii::$app->controller->module->id == 'user'),
            'items' => [

                [
                    'label' => Yii::t('backend', 'Managers'),
                    'icon' => '<i class="far fa-circle nav-icon"></i>',
                    'url' => ['/user/index?user_role=manager'],
                    'options' => ['class' => 'nav-item'],
                    'active' => (Yii::$app->request->get('user_role') == 'schoolAdmin'),
                    'visible' => (Yii::$app->user->can('administrator') or  Yii::$app->user->can('manager') ),
                ],
            ],
        ],


        [
            'label' => Yii::t('common', 'Organizations'),
            'url' => '/organization',
            'icon' => '<i class="nav-icon fas fa-th"></i>',
            'options' => ['class' => 'nav-item'],
        ],


        [
            'label' => Yii::t('backend', 'Content'),
            'options' => ['class' => 'nav-header'],
        ],
        [
            'label' => Yii::t('backend', 'Static pages'),
            'url' => ['/content/page/index'],
            'icon' => '<i class="nav-icon fas fa-th"></i>',
            'active' => Yii::$app->controller->id === 'page',
            'options' => ['class' => 'nav-item'],
        ],
        [
            'label' => Yii::t('backend', 'Articles'),
            'url' => '#',
            'icon' => '<i class="nav-icon fas fa-th"></i>',
            'options' => ['class' => 'nav-item has-treeview'],
            'active' => 'content' === Yii::$app->controller->module->id &&
                ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
            'items' => [
                [
                    'label' => Yii::t('backend', 'Articles'),
                    'url' => ['/content/article/index'],
                    'icon' => '<i class="nav-icon fas fa-th"></i>',
                    'active' => Yii::$app->controller->id === 'article',
                ],
                [
                    'label' => Yii::t('backend', 'Categories'),
                    'url' => ['/content/category/index'],
                    'icon' => '<i class="nav-icon fas fa-th"></i>',
                    'active' => Yii::$app->controller->id === 'category',
                ],
            ],
        ],

        [
            'label' => Yii::t('backend', 'Key-Value Storage'),
            'url' => ['/system/key-storage/index'],
            'icon' => '<i class="nav-icon fas fa-th"></i>',
            'active' => (Yii::$app->controller->id == 'key-storage'),
            'options' => ['class' => 'nav-item'],
        ],

       
        

        
    ],
]) ?>