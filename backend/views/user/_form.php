<?php

use common\models\User;
use common\models\UserProfile;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

$model->roles =Yii::$app->session->get('UserRole');

?>

<?php $form = ActiveForm::begin() ?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-6">
            <h1 class="m-0 text-dark">Update User</h1>
        </div>
        <div class="col-6">
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

                <ul class="nav nav-pills">
                    <li class="nav-item pull-left header">
                        <h3 class="card-title"><?php echo Yii::t('backend', 'User Details') ?>  </a></h3>
                    </li>
                </ul>



                <div class="row">
                    <div class="col-md-4">
                        <div class="well">
                                <?php echo $form->field($profile, 'picture')->widget(\common\b4widget\upload\MyUpload::class, [
                                    'url'=>['avatar-upload']
                                ]) ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="well">
                                        <?php echo $form->field($model, 'email') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="well">
                                        <?php echo $form->field($model, 'password')->passwordInput() ?>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="well">
                                        <?php echo $form->field($profile, 'firstname') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="well">
                                        <?php echo $form->field($profile, 'lastname') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">


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
        <div class="row">
            <div class="form-group">
                <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>

        </div>
    </div>
</div>

<?php ActiveForm::end() ?>

