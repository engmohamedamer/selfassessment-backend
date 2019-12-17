<?php

use common\grid\EnumColumn;
use common\models\User;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use kartik\grid\GridView;


use yii\web\JsExpression;


$url=\yii\helpers\Url::to(['/helper/users-list']);

/* @var $this yii\web\View */
/* @var $searchModel organization\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Contributors');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="">
        <div class="">
            <h1 class="m-0 text-dark">
                <?php 
                    if (Yii::$app->session->get('UserRole') == 'governmentAdmin') {
                        echo Yii::t('common','Organization Admins');
                    }else{
                        echo Yii::t('common','Contributors');
                    }

                ?>
                    
            </h1>
        </div>
        <div class=" actionBtns">
            <a href="/user/create" class="btn btn btn-primary"><i class="icofont-plus mr-2 ml-2"></i> <?= Yii::t('common', 'Create') ?></a>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.content-header -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <?php
                $gridColumns=[
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header'=> Yii::t('common', 'Full Name') ,
                        'attribute' => 'SearchFullName',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a( $model->userProfile['fullName'], ['/user/view?id='.$model->id],['target'=>'_blank']) ;
                        },
                        'filterType'=>GridView::FILTER_SELECT2,
                        'filter'=>'',
                        'filterWidgetOptions'=>[
                            'pluginOptions'=>[
                                'allowClear'=>true,
                                'ajax' => [
                                    'url' => $url,
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(owner) { return owner.text; }'),
                                'templateSelection' => new JsExpression('function (owner) { return owner.text; }'),
                            ],

                        ],
                        'filterInputOptions'=>['placeholder'=>Yii::t('common', 'Search')],

                    ],
                    [
                        'attribute' => 'email',
                        'format' => 'email',
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => Yii::t('common','Search')
                        ]
                    ],
                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'status',
                        'enum' => User::statuses(),
                        'filter' => User::statuses(),
                    ],
                    [
                        'attribute'=>'id',
                        'header'=>'القطاع',
                        'value'=>function(){
                            return 'قطاع الأعمال';
                        },
                    ],
                    [
                        'attribute'=>'id',
                        'header'=>'الأدارة',
                        'value'=>function(){
                            return 'الإدارة المالية';
                        },
                    ],
                    [
                        'attribute'=>'id',
                        'header'=>'القسم',
                        'value'=>function(){
                            return 'قسم الحسابات العامة';
                        },
                    ],
                    // [
                    //     'attribute' => 'updated_at',
                    //     'format' => 'datetime',
                    // ],
                    // [
                    //     'attribute' => 'logged_at',
                    //     'format' => 'datetime',
                    // ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template'=>'{view}{update}'
                    
                    ],
                ];

                echo GridView::widget([
                    'id' => 'kv-grid-demo',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'pjax' => true, // pjax is set to always true for this demo
                    // set your toolbar
                    'toolbar' =>  [
                        [
                            'content' =>
                                Html::button('<i class="fas fa-plus"></i>', [
                                    'class' => 'btn btn-success',
                                    'title' => Yii::t('kvgrid', 'Add Book'),
                                    'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");'
                                ]) . ' '.
                                Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                                    'class' => 'btn btn-outline-secondary',
                                    'title'=>Yii::t('kvgrid', 'Reset Grid'),
                                    'data-pjax' => 0,
                                ]),
                            'options' => ['class' => 'btn-group mr-2']
                        ],
                        '{export}',
                        '{toggleData}',
                    ],  
                    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                    // set export properties
                    'export' => [
                        'fontAwesome' => true
                    ],
                ]);
            ?>
            </div>
        </div>
    </div>
</div>
