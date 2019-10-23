<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->getPublicIdentity();
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1>
            <?= $model->userProfile->firstname . ' ' . $model->userProfile->lastname  ?>
            </h1>
        </div>
        <div class="col-md-6 actionBtns">
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                    <img src="<?= $model->userProfile->avatar ?>" class="img-thumbnail">
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
                                'attribute' => Yii::t('common','Gender'),
                                'value' => function($model){
                                    return $model->userProfile->genderList()[$model->userProfile->gender];
                                },
                                'format'=>'raw',
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
