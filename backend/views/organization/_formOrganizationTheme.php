<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationTheme */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="organization-form">

    <?= $form->field($OrganizationTheme, 'brandPrimColor')->textInput(['maxlength' => true, 'placeholder' => 'BrandPrimColor']) ?>

    <?= $form->field($OrganizationTheme, 'brandSecColor')->textInput(['maxlength' => true, 'placeholder' => 'BrandSecColor']) ?>

    <?= $form->field($OrganizationTheme, 'brandHTextColor')->textInput(['maxlength' => true, 'placeholder' => 'BrandHTextColor']) ?>

    <?= $form->field($OrganizationTheme, 'brandPTextColor')->textInput(['maxlength' => true, 'placeholder' => 'BrandPTextColor']) ?>

    <?= $form->field($OrganizationTheme, 'brandBlackColor')->textInput(['maxlength' => true, 'placeholder' => 'BrandBlackColor']) ?>

    <?= $form->field($OrganizationTheme, 'brandGrayColor')->textInput(['maxlength' => true, 'placeholder' => 'BrandGrayColor']) ?>

    <?= $form->field($OrganizationTheme, 'arfont')->textInput(['maxlength' => true, 'placeholder' => 'Arfont']) ?>

    <?= $form->field($OrganizationTheme, 'enfont')->textInput(['maxlength' => true, 'placeholder' => 'Enfont']) ?>

    <?= $form->field($OrganizationTheme, 'facebook')->textInput(['maxlength' => true, 'placeholder' => 'Facebook']) ?>

    <?= $form->field($OrganizationTheme, 'twitter')->textInput(['maxlength' => true, 'placeholder' => 'Twitter']) ?>

    <?= $form->field($OrganizationTheme, 'linkedin')->textInput(['maxlength' => true, 'placeholder' => 'Linkedin']) ?>

    <?= $form->field($OrganizationTheme, 'instagram')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) ?>

    <?= $form->field($OrganizationTheme, 'locale')->textInput(['maxlength' => true, 'placeholder' => 'Locale']) ?>

</div>
