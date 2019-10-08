<?php

use backend\widgets\Menu;


echo Menu::widget([
    'options' => ['class' => 'sidebar-menu tree', 'data' => ['widget' => 'tree']],
    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents' => true,
    'items' => [
        

        [
            'label' => Yii::t('backend', 'Main'),
            'url' => '/',
            'icon' => '<i class="fa fa-home"></i>',
            'options' => ['class' => 'header'],
        ],

        /* ------------------- Schools Section ----------------------------*/
        // [
        //     'label' => Yii::t('backend', 'Schools Management'),
        //     'options' => ['class' => 'header'],
        // ],

        [
            'label' => Yii::t('backend', 'Schools Management'),
            'url' => '#',
            'icon' => '<i class="fa fa-graduation-cap"></i>',
            'options' => ['class' => 'treeview'],
            'active' => 'schools' === Yii::$app->controller->module->id && ('aa' === Yii::$app->controller->id || 'bb' === Yii::$app->controller->id),
            'items' => [
                [
                    'label' => Yii::t('backend', 'Schools Data'),
                    'url' => ['/schools/index'],
                    'icon' => '<i class="fa fa-graduation-cap"></i>',
                    'active' => Yii::$app->controller->id === 'schools',
                ],
                [
                    'label' => Yii::t('backend', 'School Activity Plan'),
                    'url' => ['/school-activity-plan/index'],
                    'icon' => '<i class="fa fa-graduation-cap"></i>',
                    'active' => Yii::$app->controller->id === 'school-activity-plan',
                ],
                [
                    'label' => Yii::t('backend', 'School Category'),
                    'url' => ['/school-category/index'],
                    'icon' => '<i class="fa fa-graduation-cap"></i>',
                    'active' => Yii::$app->controller->id === 'school-category',
                ],
                [
                    'label' => Yii::t('backend', 'School Gender'),
                    'url' => ['/school-gender/index'],
                    'icon' => '<i class="fa fa-graduation-cap"></i>',
                    'active' => Yii::$app->controller->id === 'school-gender',
                ],
            ],
        ],



        /* ------------------- End Schools Section ----------------------------*/


        // event section
        // [
        //     'label' => Yii::t('backend', 'Manage Events'),
        //     'options' => ['class' => 'header'],
        // ],

        [
            'label' => Yii::t('backend', 'Manage Events'),
            'url' => '#',
            'icon' => '<i class="fa fa-calendar"></i>',
            'options' => ['class' => 'treeview'],
            'active' => 'schools' === Yii::$app->controller->module->id && ('aa' === Yii::$app->controller->id || 'bb' === Yii::$app->controller->id),
            'items' => [
                [
                    'label' => Yii::t('backend', 'School Events'),
                    'url' => ['/event/index'],
                    'icon' => '<i class="fa fa-calendar"></i>',
                    'active' => Yii::$app->controller->id === 'events',
                ],
                // [
                //     'label' => Yii::t('backend', 'Event Request'),
                //     'url' => ['/event-request/index'],
                //     'icon' => '<i class="fa fa-calendar"></i>',
                //     'active' => Yii::$app->controller->id === 'event-request',
                // ],
                
               [
                   'label' => Yii::t('backend', 'Event Beneficiary'),
                   'url' => ['/event-beneficiary'],
                   'icon' => '<i class="fa fa-calendar"></i>',
                   'active' => Yii::$app->controller->id === 'event-beneficiary',
               ],
               [
                   'label' => Yii::t('backend', 'Event Calssification'),
                   'url' => ['/event-calssification'],
                   'icon' => '<i class="fa fa-calendar"></i>',
                   'active' => Yii::$app->controller->id === 'event-calssification',
               ],
               [
                   'label' => Yii::t('backend', 'Event Field'),
                   'url' => ['/event-field'],
                   'icon' => '<i class="fa fa-calendar"></i>',
                   'active' => Yii::$app->controller->id === 'event-field',
               ],
//                [
//                    'label' => Yii::t('backend', 'Event Goal'),
//                    'url' => ['/event-goal'],
//                    'icon' => '<i class="fa fa-file-o"></i>',
//                    'active' => Yii::$app->controller->id === 'event-goal',
//                ],
            ],
        ],
        [
            'label' => Yii::t('backend', 'Users'),
            'url' => '#',
            'icon' => '<i class="fa fa-users"></i>',
            'options' => ['class' => 'treeview'],
            'active' => (Yii::$app->controller->module->id == 'user'),
            'items' => [

                [
                    'label' => Yii::t('backend', 'Managers'),
                    'icon' => '<i class="fa fa-user"></i>',
                    'url' => ['/user/index?user_role=manager'],
                    'active' => (Yii::$app->request->get('user_role') == 'schoolAdmin'),
                    'visible' => (Yii::$app->user->can('administrator') or  Yii::$app->user->can('manager') ),
                ],

                [
                    'label' => Yii::t('backend', 'Schools Owner'),
                    'icon' => '<i class="fa fa-users"></i>',
                    'url' => ['/user/index?user_role=schoolOwner'],
                    'active' => (Yii::$app->controller->id == 'user'),
                ],

                [
                    'label' => Yii::t('backend', 'Schools Rep.'),
                    'icon' => '<i class="fa fa-user"></i>',
                    'url' => ['/user/index?user_role=schoolAdmin'],
                    'active' => (Yii::$app->controller->id == 'user'),
                ],

                [
                    'label' => Yii::t('backend', 'Schools Activity Admin'),
                    'icon' => '<i class="fa fa-user"></i>',
                    'url' => ['/user/index?user_role=schoolActivityAdmin'],
                    'active' => (Yii::$app->controller->id == 'user'),
                ],




                [
                    'label' => Yii::t('backend', 'National Education office official'),
                    'icon' => '<i class="fa fa-user"></i>',
                    'url' => ['/user/index?user_role=officialNEoffice'],
                    'active' => (Yii::$app->controller->id == 'user'),
                    'visible' => (Yii::$app->user->can('administrator') or  Yii::$app->user->can('manager') ),
                ],






            ],
        ],

        // [
        //     'label' => Yii::t('backend', 'Announcement'),
        //     'options' => ['class' => 'header'],
        // ],
        [
            'label' => Yii::t('backend', 'Announcement'),
            'url' => ['/announcement/index'],
            'icon' => '<i class="fa fa-bell"></i>',
            'active' => Yii::$app->controller->id === 'announcement',
        ],
        // [
        //     'label' => Yii::t('backend', 'Manage News'),
        //     'options' => ['class' => 'header'],
        // ],

        [
            'label' => Yii::t('backend', 'School News'),
            'url' => ['/news/index'],
            'icon' => '<i class="fa fa-newspaper-o"></i>',
            'active' => Yii::$app->controller->id === 'news',
        ],
        [
            'label' => Yii::t('backend', 'Message'),
            'url' => ['/message/index'],
            'icon' => '<i class="fa fa-envelope"></i>',
            'active' => Yii::$app->controller->id === 'message',
        ],

        // end event section

//        [
//            'label' => Yii::t('backend', 'Content'),
//            'options' => ['class' => 'header'],
//        ],
//        [
//            'label' => Yii::t('backend', 'Static pages'),
//            'url' => ['/content/page/index'],
//            'icon' => '<i class="fa fa-thumb-tack"></i>',
//            'active' => Yii::$app->controller->id === 'page',
//        ],
//        [
//            'label' => Yii::t('backend', 'Articles'),
//            'url' => '#',
//            'icon' => '<i class="fa fa-files-o"></i>',
//            'options' => ['class' => 'treeview'],
//            'active' => 'content' === Yii::$app->controller->module->id &&
//                ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
//            'items' => [
//                [
//                    'label' => Yii::t('backend', 'Articles'),
//                    'url' => ['/content/article/index'],
//                    'icon' => '<i class="fa fa-file-o"></i>',
//                    'active' => Yii::$app->controller->id === 'article',
//                ],
//                [
//                    'label' => Yii::t('backend', 'Categories'),
//                    'url' => ['/content/category/index'],
//                    'icon' => '<i class="fa fa-folder-open-o"></i>',
//                    'active' => Yii::$app->controller->id === 'category',
//                ],
//            ],
//        ],

       [
           'label' => Yii::t('backend', 'Key-Value Storage'),
           'url' => ['/system/key-storage/index'],
           'icon' => '<i class="fa fa-arrows-h"></i>',
           'active' => (Yii::$app->controller->id == 'key-storage'),
       ],
//        [
//            'label' => Yii::t('backend', 'Cache'),
//            'url' => ['/system/cache/index'],
//            'icon' => '<i class="fa fa-refresh"></i>',
//        ],
//
//        [
//            'label' => Yii::t('backend', 'Logs'),
//            'url' => ['/system/log/index'],
//            'icon' => '<i class="fa fa-warning"></i>',
//            'badge' => SystemLog::find()->count(),
//            'badgeBgClass' => 'label-danger',
//        ],
        

        
    ],
]) ?>