<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */
$this->title = Yii::t('backend', 'Edit account')
?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="col-md-6">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="col-md-6 actionBtns">
                    <button type="submit" class="btn btn-success"><i class="icofont-verification-check"></i> <?= Yii::t('backend','Update Data');?></button>

                </div>
                <!-- /.col -->
            </div>
<!-- /.content-header -->
            <div class="card-body">

                <?php $form = ActiveForm::begin() ?>
		<div class="row">
			<div class="col-lg-6"><?php echo $form->field($model, 'username') ?></div>
			<div class="col-lg-6"><?php echo $form->field($model, 'email') ?></div>
			<div class="col-lg-6"><?php echo $form->field($model, 'password')->passwordInput() ?></div>
			<div class="col-lg-6"><?php echo $form->field($model, 'password_confirm')->passwordInput() ?></div>
		</div>








                <div class="form-group  center-align mt-5 mb-5" >
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
