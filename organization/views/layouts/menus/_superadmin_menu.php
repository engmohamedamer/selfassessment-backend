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
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents' => true,
    'items' => [
        [
            'label' => Yii::t('backend', 'Main'),
            'options' => ['class' => 'header'],
        ],
        // [
        //     'label' => Yii::t('backend', 'Timeline'),
        //     'icon' => '<i class="fa fa-bar-chart-o"></i>',
        //     'url' => ['/timeline-event/index'],
        //     'badge' => TimelineEvent::find()->today()->count(),
        //     'badgeBgClass' => 'label-success',
        // ],


        [
            'label' => Yii::t('backend', 'Users'),
            'url' => '#',
            'icon' => '<i class="fa fa-users"></i>',
            'options' => ['class' => 'treeview'],
            'active' => (Yii::$app->controller->module->id == 'user'),
            'items' => [
                [
                    'label' => Yii::t('common', 'Contributors'),
                    'icon' => '<i class="fa fa-users"></i>',
                    'url' => ['/user/index'],
                    'active' => (Yii::$app->controller->id == 'user'),
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
        //     'icon' => '<i class="fa fa-thumb-tack"></i>',
        //     'active' => Yii::$app->controller->id === 'page',
        // ],
        // [
        //     'label' => Yii::t('backend', 'Articles'),
        //     'url' => '#',
        //     'icon' => '<i class="fa fa-files-o"></i>',
        //     'options' => ['class' => 'treeview'],
        //     'active' => 'content' === Yii::$app->controller->module->id &&
        //         ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
        //     'items' => [
        //         [
        //             'label' => Yii::t('backend', 'Articles'),
        //             'url' => ['/content/article/index'],
        //             'icon' => '<i class="fa fa-file-o"></i>',
        //             'active' => Yii::$app->controller->id === 'article',
        //         ],
        //         [
        //             'label' => Yii::t('backend', 'Categories'),
        //             'url' => ['/content/category/index'],
        //             'icon' => '<i class="fa fa-folder-open-o"></i>',
        //             'active' => Yii::$app->controller->id === 'category',
        //         ],
        //     ],
        // ],
        // [
        //     'label' => Yii::t('backend', 'Translation'),
        //     'options' => ['class' => 'header'],
        // ],
        // [
        //     'label' => Yii::t('backend', 'Translation'),
        //     'url' => ['/translation/default/index'],
        //     'icon' => '<i class="fa fa-language"></i>',
        //     'active' => (Yii::$app->controller->module->id == 'translation'),
        // ],
        // [
        //     'label' => Yii::t('backend', 'System'),
        //     'options' => ['class' => 'header'],
        // ],
        // [
        //     'label' => Yii::t('backend', 'Key-Value Storage'),
        //     'url' => ['/system/key-storage/index'],
        //     'icon' => '<i class="fa fa-arrows-h"></i>',
        //     'active' => (Yii::$app->controller->id == 'key-storage'),
        // ],
    ],
]) ?>