<?php

use common\models\UserProfile;
use kartik\color\ColorInput;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationTheme */
/* @var $form yii\widgets\ActiveForm */

?>

    <div class="row">
        <div class="col-md-12">
            <?php echo $form->field($profile, 'picture')->widget(Upload::class, [
                'url'=>['avatar-upload']
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <?php echo $form->field($user, 'email') ?>
        </div>

        <div class="col-md-4 col-sm-12">
            <?php echo $form->field($user, 'password')->passwordInput() ?>
        </div>



        <div class="col-md-4 col-sm-12">
            <?php echo $form->field($profile, 'firstname') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <?php echo $form->field($profile, 'lastname') ?>
        </div>
        <div class="col-md-4 col-sm-12">

            <?php echo $form->field($profile, 'gender')->dropDownlist([
                UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
            ]) ?>
        </div>

        <div class="col-md-4 col-sm-12">
            <?php echo $form->field($user, 'mobile') ?>
        </div>
        <div class="addAnotherOrgAdmin  col-sm-12" style='text-align:center; margin:20px auto;'>
                <a  href='#' class=""><i class="icofont-plus-circle mr-2 ml-2"></i> <?= Yii::t('common','Add Another Admin');?></a>
            </div>

    </div>

