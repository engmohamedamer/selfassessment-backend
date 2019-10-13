<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="organization-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'business_sector')->textInput(['maxlength' => true, 'placeholder' => 'Business Sector']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

    <?= $form->field($model, 'city_id')->textInput(['placeholder' => 'City']) ?>

    <?= $form->field($model, 'district_id')->textInput(['placeholder' => 'District']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true, 'placeholder' => 'Mobile']) ?>

    <?= $form->field($model, 'conatct_name')->textInput(['maxlength' => true, 'placeholder' => 'Conatct Name']) ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true, 'placeholder' => 'Contact Email']) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true, 'placeholder' => 'Contact Phone']) ?>

    <?= $form->field($model, 'contact_position')->textInput(['maxlength' => true, 'placeholder' => 'Contact Position']) ?>

    <?= $form->field($model, 'limit_account')->textInput(['placeholder' => 'Limit Account']) ?>

    <?= $form->field($model, 'first_image_base_url')->textInput(['maxlength' => true, 'placeholder' => 'First Image Base Url']) ?>

    <?= $form->field($model, 'first_image_path')->textInput(['maxlength' => true, 'placeholder' => 'First Image Path']) ?>

    <?= $form->field($model, 'second_image_base_url')->textInput(['maxlength' => true, 'placeholder' => 'Second Image Base Url']) ?>

    <?= $form->field($model, 'second_image_path')->textInput(['maxlength' => true, 'placeholder' => 'Second Image Path']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
