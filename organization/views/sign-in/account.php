<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */
$this->title = Yii::t('backend', 'Edit account')
?>
<?php $form = ActiveForm::begin() ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="">
        <div class="">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class=" actionBtns">
            <button type="submit" class="btn btn btn-primary"><i class="icofont-verification-check mr-2 ml-2"></i> <?= Yii::t('backend', 'Update') ?></button>
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
                			<div class="col-lg-6"><?php echo $form->field($model, 'username') ?></div>
                			<div class="col-lg-6"><?php echo $form->field($model, 'email') ?></div>
                			<div class="col-lg-6"><?php echo $form->field($model, 'password')->passwordInput() ?></div>
                			<div class="col-lg-6"><?php echo $form->field($model, 'password_confirm')->passwordInput() ?></div>
                		</div>

                

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
