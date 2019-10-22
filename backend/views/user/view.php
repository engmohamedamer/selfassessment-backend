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
            <h1 class="m-0 text-dark">Username</h1>
        </div>
        <div class="col-md-6 actionBtns">
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger mr-2',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
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
    



    <?php echo DetailView::widget([
        'model' => $model->userProfile,
        'attributes' => [
            'firstname',
            'lastname',
        ],
    ]) ?>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            //'auth_key',
            'email:email',

            [
                'attribute' => 'status',
                'value' => function($model){
                    return User::statuses()[$model->status];
                },
                'format'=>'raw',
            ],

            'created_at:datetime',
            //'updated_at:datetime',
            'logged_at:datetime',
        ],
    ]) ?>




</div>
</div>
</div>
</div>
