<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */
$this->title = Yii::t('backend', 'Edit account')
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title"><? echo Yii::t('backend', 'Edit account')?></h3>
            </div>
            <div class="card-body">

                <?php $form = ActiveForm::begin() ?>

                <?php echo $form->field($model, 'username') ?>

                <?php echo $form->field($model, 'email') ?>

                <?php echo $form->field($model, 'password')->passwordInput() ?>

                <?php echo $form->field($model, 'password_confirm')->passwordInput() ?>

                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
