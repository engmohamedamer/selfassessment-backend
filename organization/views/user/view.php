<?php

use common\models\OrganizationStructure;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->getPublicIdentity();
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="">
        <div class="">
            <h1>
            <?= $model->userProfile->firstname . ' ' . $model->userProfile->lastname  ?>
            </h1>
        </div>
        <div class=" actionBtns">
            <?php 
                if($model->status == User::STATUS_NOT_ACTIVE){
                   echo Html::a('<i class="icofont-verification-check mr-2 ml-2"></i>'.Yii::t('backend', 'Approve Request'),
                        ['active', 'id' => $model->id],
                        [   
                            'class' => 'btn btn-info',
                            'data' => [
                                'confirm' => Yii::t('common', 'Are you sure you want to active this user?'),
                                'method' => 'post',
                            ],
                        ]
                    );
                }
            ?>

            <a href="/user/update?id=<?= $model->id ?>" class="btn btn-success"><i class="icofont-ui-edit mr-2 ml-2"></i> <?= Yii::t('backend','Update Data') ?> </a>


            <?= Html::a('<i class="icofont-ui-delete mr-2 ml-2"></i>'.Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('common', 'Are you sure you want to delete this user?'),
                    'method' => 'post',
                ],
            ])?>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                <div class="col-md-3">
                    <?php if($model->userProfile->avatar != null):?>
                        <img class="img-thumbnail" style="width:200px" src="<?= $model->userProfile->avatar ?>" alt="<?= $model->userProfile->fullname ?>">
                    <?php else:?>    
                        <img class="img-thumbnail" style="width:200px" alt="<?= $model->userProfile->fullname ?>" avatar="<?= $model->userProfile->fullname ?>">
                    <?php endif;?>
                </div>
                <div class="col-md-9">
                    <?php echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => Yii::t('common','Name'),
                                'value' => function($model){
                                    return $model->userProfile->firstname . ' ' . $model->userProfile->lastname ;
                                },
                                'format'=>'raw',
                            ],
                            'email:email',
                            [
                                'attribute' => Yii::t('common','Sector'),
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
                                'attribute' => Yii::t('common','Phone'),
                                'value' => function($model){
                                    return $model->userProfile->mobile;
                                },
                                'format'=>'raw',
                            ],
                            [
                                'attribute' => Yii::t('common','Locale'),
                                'value' => function($model){
                                    return $model->userProfile->locale;
                                },
                                'format'=>'raw',
                            ],
                            [
                                'attribute'=> Yii::t('common','Tags'),
                                'value'=>function($model){
                                    return $model->tags;
                                },
                                'format'=>'raw'
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function($model){
                                    return User::statuses()[$model->status];
                                },
                                'format'=>'raw',
                            ],
                            'created_at:datetime',
                            'logged_at:datetime',
                        ],
                    ]) ?>
                </div>
                    </div>
            </div>
        </div>
    </div>
</div>
