<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */
$this->title = Yii::t('backend', 'Edit account')
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-6">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">

                <?php $form = ActiveForm::begin() ?>
		<div class="row">
			<div class="col-lg-6"><?php echo $form->field($model, 'username') ?></div>
			<div class="col-lg-6"><?php echo $form->field($model, 'email') ?></div>
			<div class="col-lg-6"><?php echo $form->field($model, 'password')->passwordInput() ?></div>
			<div class="col-lg-6"><?php echo $form->field($model, 'password_confirm')->passwordInput() ?></div>
		</div>
                

                

                

                

                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
