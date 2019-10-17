<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationTheme */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="organization-form">

    <?php echo  $form->field($OrganizationTheme, 'brandPrimColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...'),'value'=>$OrganizationTheme->brandPrimColor ?: '#8e44ad'],
    ]) ?>

    <?php echo  $form->field($OrganizationTheme, 'brandSecColor')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => Yii::t('common','Select color ...'),'value'=>$OrganizationTheme->brandSecColor ?: '#f7f3ff'],
    ]) ?>

    <?php // echo  $form->field($OrganizationTheme, 'brandHTextColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>

    <?php // echo  $form->field($OrganizationTheme, 'brandPTextColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>

    <?php // echo  $form->field($OrganizationTheme, 'brandBlackColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>

    <?php // echo  $form->field($OrganizationTheme, 'brandGrayColor')->widget(ColorInput::classname(), ['options' => ['placeholder' => Yii::t('common','Select color ...')],    ]) ?>

    <?php // echo  $form->field($OrganizationTheme, 'arfont')->textInput(['maxlength' => true, 'placeholder' => 'Arfont']) ?>

    <?php // echo  $form->field($OrganizationTheme, 'enfont')->textInput(['maxlength' => true, 'placeholder' => 'Enfont']) ?>

    <?php echo  $form->field($OrganizationTheme, 'facebook')->textInput(['maxlength' => true, 'placeholder' => 'Facebook']) ?>

    <?php echo  $form->field($OrganizationTheme, 'twitter')->textInput(['maxlength' => true, 'placeholder' => 'Twitter']) ?>

    <?php echo  $form->field($OrganizationTheme, 'linkedin')->textInput(['maxlength' => true, 'placeholder' => 'Linkedin']) ?>

    <?php echo  $form->field($OrganizationTheme, 'instagram')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) ?>

    <?php echo  $form->field($OrganizationTheme, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>

</div>
