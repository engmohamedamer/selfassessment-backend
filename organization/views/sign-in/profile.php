<?php

use common\models\UserProfile;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('backend', 'Edit profile')
?>
    <?php $form = ActiveForm::begin() ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="">
        <div class="">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class=" actionBtns">
            <button type="submit" class="btn btn btn-success"><i class="icofont-verification-check mr-2 ml-2"></i> <?= Yii::t('backend', 'Update Data') ?></button>
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



    <?php echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
        'url'=>['avatar-upload'],
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpeg|png)$/i'),
        'maxFileSize' => 10485760,
    ]) ?>
<div class="row">
        <div class="col-lg-4">
    <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>
 </div>
        <div class="col-lg-6">
    <?php echo $form->field($model, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
 </div>
       
    </div>
    

    <?php ActiveForm::end() ?>

    </div>
        </div>
    </div>
</div>

