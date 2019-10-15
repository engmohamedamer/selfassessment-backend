<?php

use common\grid\EnumColumn;
use common\models\User;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use kartik\grid\GridView;


use yii\web\JsExpression;


$url=\yii\helpers\Url::to(['/helper/users-list']);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-6">
            <h1 class="m-0 text-dark">Users</h1>
        </div>
        <div class="col-6 actionBtns">
            <?php echo Html::a(Yii::t('backend', 'Create New User'), ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.content-header -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Contributors List</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
            <?php
                $gridColumns=[
                    //'id',
                    ['class' => 'yii\grid\SerialColumn'],
                    //'username',
                    'email:email',
                    [
                        'class' => EnumColumn::class,
                        'attribute' => 'status',
                        'enum' => User::statuses(),
                        'filter' => User::statuses()
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'datetime',
                        // 'filter' => DateTimeWidget::widget([
                        //     'model' => $searchModel,
                        //     'attribute' => 'created_at',
                        //     'phpDatetimeFormat' => 'dd.MM.yyyy',
                        //     'momentDatetimeFormat' => 'DD.MM.YYYY',
                        //     'clientEvents' => [
                        //         'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
                        //     ],
                        // ])
                    ],
                    [
                        'attribute' => 'logged_at',
                        'format' => 'datetime',
                        // 'filter' => DateTimeWidget::widget([
                        //     'model' => $searchModel,
                        //     'attribute' => 'logged_at',
                        //     'phpDatetimeFormat' => 'dd.MM.yyyy',
                        //     'momentDatetimeFormat' => 'DD.MM.YYYY',
                        //     'clientEvents' => [
                        //         'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
                        //     ],
                        // ])
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                    
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
                    // parameters from the demo form
                    //'bordered' => $bordered,
                    //'striped' => $striped,
                    //'condensed' => $condensed,
                    //'responsive' => $responsive,
                    //        'hover' => $hover,
                    //        'showPageSummary' => $pageSummary,
                    //        'panel' => [
                    //            'type' => GridView::TYPE_PRIMARY,
                    //            'heading' => $heading,
                    //        ],
                    //        'persistResize' => false,
                    //        'toggleDataOptions' => ['minCount' => 10],
                    //        'exportConfig' => $exportConfig,
                    //        'itemLabelSingle' => 'book',
                    //        'itemLabelPlural' => 'books'
                ]);


            ?>
            </div>
        </div>
    </div>
</div>
