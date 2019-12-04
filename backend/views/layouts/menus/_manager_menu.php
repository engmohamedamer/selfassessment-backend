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
    'options' => ['class' => 'sidebar-menu tree', 'data' => ['widget' => 'tree']],
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span><span class="pull-right-container">{right-icon}{badge}</span></a>',
    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents' => true,
    'items' => [
        
       
        [
            'label' => Yii::t('backend', 'Dashboard'),
            'url' => '/',
            'icon' => '<i class="icofont-1x icofont-dashboard-web"></i>',
            'options' => ['class' => 'nav-item'],
            'active' =>  (Yii::$app->controller->id == 'site'),

        ],


        // [
        //     'label' => Yii::t('backend', 'Users Data'),
        //     'options' => ['class' => 'header'],
        // ],
        
        // [
        //     'label' => Yii::t('backend', 'Users'),
        //     'url' => '#',
        //     'icon' => '<i class="nav-icon fas fa-users"></i>',
        //     'options' => ['class' => 'treeview'],
        //     'active' => (Yii::$app->controller->module->id == 'user'),
        //     'items' => [

                
        //     ],
        // ],


        [
            'label' => Yii::t('common', 'Organizations'),
            'url' => '/organization',
            'icon' => '<i class="icofont-1x icofont-institution"></i>',
            'options' => ['class' => 'nav-item'],
            'active' =>  (Yii::$app->controller->id == 'organization'),

        ],

        [
            'label' => Yii::t('common', 'Tamkeen Adminstrators'),
            'icon' => '<i class="icofont-1x icofont-user-suited"></i>',
            'url' => '#',
            'options' => ['class' => 'treeview'],
            'active' => (Yii::$app->request->get('user_role') == 'manager'),
            'visible' => (Yii::$app->user->can('administrator') or  Yii::$app->user->can('manager') ),
            'items' => [

                [
                    'label' => Yii::$app->user->identity->userProfile->fullName,
                    'icon' => '<img src="./img/anonymous.jpg"/>',
                    'url' => ['/user/view?id=2'],
                    'options' => ['class' => 'sub-nav-item'],
        
                ],
                [
                    'label' => Yii::t('common', 'Add Adminstrator'),
                    'icon' => '<i class="icofont-ui-add"></i>',
                    'url' => ['/user/index?user_role=manager'],
                    'options' => ['class' => 'sub-nav-item add-admin'],
        
                ],
                [
                    'label' => Yii::t('common', 'All Adminstrators'),
                    'url' => ['/user/index?user_role=manager'],
                    'options' => ['class' => 'sub-nav-item all-admins'],
        
                ],
                
                
            ],
            

        ],



        // [
        //     'label' => Yii::t('backend', 'Content'),
        //     'options' => ['class' => 'header'],
        // ],
        // [
        //     'label' => Yii::t('backend', 'Static pages'),
        //     'url' => ['/content/page/index'],
        //     'icon' => '<i class="nav-icon fas fa-th"></i>',
        //     'active' => Yii::$app->controller->id === 'page',
        //     'options' => ['class' => 'nav-item'],
        // ],
        // [
        //     'label' => Yii::t('backend', 'Articles'),
        //     'url' => '#',
        //     'icon' => '<i class="nav-icon fas fa-th"></i>',
        //     'options' => ['class' => 'treeview menu-open'],
        //     'active' => 'content' === Yii::$app->controller->module->id &&
        //         ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
        //     'items' => [
        //         [
        //             'label' => Yii::t('backend', 'Articles'),
        //             'url' => ['/content/article/index'],
        //             'icon' => '<i class="nav-icon fas fa-th"></i>',
        //             'active' => Yii::$app->controller->id === 'article',
        //         ],
        //         [
        //             'label' => Yii::t('backend', 'Categories'),
        //             'url' => ['/content/category/index'],
        //             'icon' => '<i class="nav-icon fas fa-th"></i>',
        //             'active' => Yii::$app->controller->id === 'category',
        //         ],
        //     ],
        // ],

        // [
        //     'label' => Yii::t('backend', 'Key-Value Storage'),
        //     'url' => ['/system/key-storage/index'],
        //     'icon' => '<i class="nav-icon fas fa-th"></i>',
        //     'active' => (Yii::$app->controller->id == 'key-storage'),
        //     'options' => ['class' => 'nav-item'],
        // ],

       
        

        
    ],
]) ?>