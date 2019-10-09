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
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="btns-list">
        <?php echo Html::a(Yii::t('backend', 'Create New User'), ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
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
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{login} {view} {update} {delete}',
                'buttons' => [
                    'login' => function ($url) {
                        return Html::a(
                            '<i class="fa fa-sign-in" aria-hidden="true"></i>',
                            $url,
                            [
                                'title' => Yii::t('backend', 'Login')
                            ]
                        );
                    },
                ],
                'visibleButtons' => [
                    'login' => Yii::$app->user->can('administrator')
                ]

            ],
        ],
    ]); ?>

</div>

