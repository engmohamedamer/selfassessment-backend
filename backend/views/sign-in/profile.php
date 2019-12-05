<?php

use common\models\UserProfile;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('backend', 'Edit profile');
    ?>

<?php $form = ActiveForm::begin() ?>
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
   

    <div class="row">
        <div class="col-lg-12">
            <?php echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
                'url'=>['avatar-upload']
            ]) ?>
        </div>
        <div class="col-lg-6">
         <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-lg-6">
        <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-lg-6">
        <?php echo $form->field($model, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
        </div>
        <div class="col-lg-6">
        <?php echo $form->field($model, 'gender')->dropDownlist([
                UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
            ]) ?>

        </div>
    </div>









    <div class="form-group center-align mt-5 mb-5">
    </div>

    

    </div>
        </div>
    </div>
</div>

<?php ActiveForm::end() ?>
