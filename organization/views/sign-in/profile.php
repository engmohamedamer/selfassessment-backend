<?php

use common\models\UserProfile;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('backend', 'Edit profile')
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
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


    <?php $form = ActiveForm::begin() ?>

    <?php echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
        'url'=>['avatar-upload']
    ]) ?>
<div class="row">
        <div class="col-lg-4">
    <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>
 </div>
        <div class="col-lg-4">
    <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>
 </div>
        <div class="col-lg-4">
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
    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

    </div>
        </div>
    </div>
</div>

