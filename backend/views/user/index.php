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

$this->title = Yii::t('backend', 'Managers');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-lg-6">
            <h1 class="m-0 text-dark"><?= Yii::t('backend', 'Managers') ?></h1>
        </div>
        <div class="col-lg-6 actionBtns">
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
                        'filterInputOptions'=>['placeholder'=>Yii::t('common', 'Full Name')],

                    ],


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
                    ],
                    [
                        'attribute' => 'logged_at',
                        'format' => 'datetime',
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

                ]);
            ?>
            </div>
        </div>
    </div>
</div>
