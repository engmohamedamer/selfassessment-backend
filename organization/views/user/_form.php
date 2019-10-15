<?php

use common\models\User;
use common\models\UserProfile;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model organization\models\UserForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

$model->roles =Yii::$app->session->get('UserRole');

?>

    <?php $form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $form->field($profile, 'picture')->widget(\common\b4widget\upload\MyUpload::class, [
                                    'url'=>['avatar-upload']
                                ]) ?>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <?php echo $form->field($model, 'email') ?>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <?php echo $form->field($model, 'password')->passwordInput() ?>
                            </div>
                        
                            <div class="col-md-4 col-sm-12">
                                <?php echo $form->field($profile, 'firstname') ?>
                            </div>

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
                                <?php echo $form->field($profile, 'mobile') ?>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
                            </div>

                        </div>


                    </div>

                </div>

                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            

            </div>
        </div>
    </div>
</div>

    <?php ActiveForm::end() ?>

