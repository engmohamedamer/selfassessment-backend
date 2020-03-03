<?php

use common\grid\EnumColumn;
use common\models\OrganizationStructure;
use common\models\User;
use kartik\grid\GridView;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\bootstrap\ActiveForm;


$url=\yii\helpers\Url::to(['/helper/users-list']);

/* @var $this yii\web\View */
/* @var $searchModel organization\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Contributors');
$this->params['breadcrumbs'][] = $this->title;

// echo newerton\fancybox\FancyBox::widget([
//     'target' => '.fancybox',
//     'helpers' => true,
//     'mouse' => true,
//     'config' => [
//         'maxWidth' => '350',
//         'maxHeight' => '500',
//         'padding' => 0,
//         'fitToView' => false,
//         'autoSize' => false,
//         'closeClick' => false,
//         'openEffect' => 'elastic',
//         'closeEffect' => 'elastic',
//         'prevEffect' => 'elastic',
//         'nextEffect' => 'elastic',
//     ]
// ]);
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
        <?php if(!Yii::$app->user->identity->userProfile->organization->sso_login || $_REQUEST['user_role'] != 'user'):?>
        <div class=" actionBtns">
            <?php if(isset($_REQUEST['user_role']) and $_REQUEST['user_role'] == 'user'):
                $form = ActiveForm::begin();
            ?>
            <div class="allowReg listingReg">
                <?= $form->field($orgModel,'allow_registration')->checkBox([
                'onclick' =>'
                    document.getElementById("w0").submit()
                ']); ?>
            </div>
            <?php ActiveForm::end(); endif;?>
            <a href="/user/create" class="btn btn btn-success"><i class="icofont-plus mr-2 ml-2"></i> <?= Yii::t('common', 'Create') ?></a>
        </div>
        <?php elseif(Yii::$app->user->identity->userProfile->organization->sso_login):?>
            <a class="fancybox" style="color: #ef4f6a;margin-right: 5px;" data-fancybox-type="iframe" href="/user/sso-login">
                <i class="fas fa-info-circle"></i><?= Yii::t('common', 'Login using SSO') ?>
            </a>

        <?php endif;?>
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
                $template = '{view}{update}{delete}';
                if (Yii::$app->user->identity->userProfile->organization->sso_login and $_REQUEST['user_role'] == 'user') {
                    $template = '{view}{delete}';
                }
                $gridColumns=[
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header'=> Yii::t('common', 'Contributor Name') ,
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
                        'header'=>'قطاع العمل',
                        'value' => function($model){
                            $sectors = OrganizationStructure::find()->where(['root'=>$model->userProfile->sector->root])->andWhere(['<=','id',$model->userProfile->sector->id])->all();
                            $txt = '';
                            foreach ($sectors as $value) {
                                $txt .=  $value->name .' / ';
                            }
                            return trim($txt,' / ');
                        },
                    ],
                    [
                        'attribute'=>'id',
                        'header'=> Yii::t('common','Tag'),
                        'value'=>function($model){
                            return $model->tags;
                        },
                        'format'=>'raw'
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template'=> $template,
                        'width'=>'10%',

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
