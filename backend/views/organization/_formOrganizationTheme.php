<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationTheme */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="organization-form">

    <?= $form->field($OrganizationTheme, 'brandPrimColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...')],
    ]) ?>

    <?= $form->field($OrganizationTheme, 'brandSecColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...')],
    ]) ?>

    <?= $form->field($OrganizationTheme, 'brandHTextColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...')],
    ]) ?>

    <?= $form->field($OrganizationTheme, 'brandPTextColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...')],
    ]) ?>

    <?= $form->field($OrganizationTheme, 'brandBlackColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...')],
    ]) ?>

    <?= $form->field($OrganizationTheme, 'brandGrayColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...')],
    ]) ?>

    <?= $form->field($OrganizationTheme, 'arfont')->textInput(['maxlength' => true, 'placeholder' => 'Arfont']) ?>

    <?= $form->field($OrganizationTheme, 'enfont')->textInput(['maxlength' => true, 'placeholder' => 'Enfont']) ?>

    <?= $form->field($OrganizationTheme, 'facebook')->textInput(['maxlength' => true, 'placeholder' => 'Facebook']) ?>

    <?= $form->field($OrganizationTheme, 'twitter')->textInput(['maxlength' => true, 'placeholder' => 'Twitter']) ?>

    <?= $form->field($OrganizationTheme, 'linkedin')->textInput(['maxlength' => true, 'placeholder' => 'Linkedin']) ?>

    <?= $form->field($OrganizationTheme, 'instagram')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) ?>

    <?= $form->field($OrganizationTheme, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>

</div>
