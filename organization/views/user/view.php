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
        <div class="col-6 actionBtns">
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
                <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'username',
                        //'auth_key',
                        'userProfile.firstname',
                        'userProfile.lastname',
                        'email:email',
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
