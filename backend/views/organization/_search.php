<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-organization-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['placeholder' => 'Id']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'business_sector')->textInput(['maxlength' => true, 'placeholder' => 'Business Sector']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

    <?= $form->field($model, 'city_id')->textInput(['placeholder' => 'City']) ?>

    <?php /* echo $form->field($model, 'district_id')->textInput(['placeholder' => 'District']) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) */ ?>

    <?php /* echo $form->field($model, 'mobile')->textInput(['maxlength' => true, 'placeholder' => 'Mobile']) */ ?>

    <?php /* echo $form->field($model, 'conatct_name')->textInput(['maxlength' => true, 'placeholder' => 'Conatct Name']) */ ?>

    <?php /* echo $form->field($model, 'contact_email')->textInput(['maxlength' => true, 'placeholder' => 'Contact Email']) */ ?>

    <?php /* echo $form->field($model, 'contact_phone')->textInput(['maxlength' => true, 'placeholder' => 'Contact Phone']) */ ?>

    <?php /* echo $form->field($model, 'contact_position')->textInput(['maxlength' => true, 'placeholder' => 'Contact Position']) */ ?>

    <?php /* echo $form->field($model, 'limit_account')->textInput(['placeholder' => 'Limit Account']) */ ?>

    <?php /* echo $form->field($model, 'first_image_base_url')->textInput(['maxlength' => true, 'placeholder' => 'First Image Base Url']) */ ?>

    <?php /* echo $form->field($model, 'first_image_path')->textInput(['maxlength' => true, 'placeholder' => 'First Image Path']) */ ?>

    <?php /* echo $form->field($model, 'second_image_base_url')->textInput(['maxlength' => true, 'placeholder' => 'Second Image Base Url']) */ ?>

    <?php /* echo $form->field($model, 'second_image_path')->textInput(['maxlength' => true, 'placeholder' => 'Second Image Path']) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>