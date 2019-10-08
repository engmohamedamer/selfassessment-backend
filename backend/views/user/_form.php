<?php

use common\models\User;
use common\models\UserProfile;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

$model->roles =Yii::$app->session->get('UserRole');

?>


    <?php $form = ActiveForm::begin() ?>




<div class="tabs-x  tabs-above tab-align-left tabs-krajee">
<ul class="nav nav-tabs">
    <li class="pull-left header"><ion-icon name="person"></ion-icon><?php echo Yii::t('backend', 'User Details') ?>  </li>
    <li class="pull-right active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true"><?php echo Yii::t('backend', 'Main Details') ?></a></li>
    <li class="pull-right"><a href="#tab_2-2" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('backend', 'Permissions') ?></a></li>
    
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab_1-1">
        <div class="row">
            <div class="col-md-12">
                <?php echo $form->field($profile, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
                    'url'=>['avatar-upload']
                ]) ?>
            </div>
        
            <div class="col-md-4 col-sm-12">
                <?php echo $form->field($model, 'username') ?>
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

        </div>


    </div>

    <div class="tab-pane" id="tab_2-2">

        <div class="row">
            <div class="col-md-6 col-sm-12">

                <?php  
                    if(User::IsOfficialNEoffice(Yii::$app->user->identity)){
                        echo $form->field($model, 'roles')->dropDownList(
                            [
                                User::ROLE_SCHOOL_OWNER => 'مالك المنشئة التعلييمة',
                                User::ROLE_SCHOOL_ADMIN => 'قائد المنشئة التعلييمة',
                                User::ROLE_SCHOOL_ACTIVITY_ADMIN => 'رائد نشاط'
                            ]
                        , ['prompt' =>Yii::t('common', 'Select')]); 
                    }else{
                        echo $form->field($model, 'roles')->dropDownList(User::ListRoles(), ['prompt' =>Yii::t('common', 'Select')]); 
                    }
                ?>
            </div>

            <div class="col-md-6 col-sm-12">
                <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
            </div>
        </div>

        <?php
        if($model->roles== User::ROLE_SCHOOL_ADMIN || $model->roles== User::ROLE_SCHOOL_ACTIVITY_ADMIN  || User::ROLE_SCHOOL_OWNER) {
            $style='display: block;';
        }else{
            $style='display: none;';
        }
        ?>


        <div class="row"  id="AdminType" style="<?=$style?>" >
            <div class="col-md-6 col-sm-12">
            <?php
                $arr = ArrayHelper::map(\backend\models\Schools::find()->select([" id , CONCAT(  ' ( ',school_identity_number , ' ) - ' , title  ) AS title " ] )->all(), 'id', 'title'); //all schools
                // Usage with ActiveForm and model
                echo $form->field($profile, 'school_id')->widget(\kartik\select2\Select2::classname(), [
                    'data' => $arr,
                    'options' => [
                        'placeholder' => Yii::t('common', 'Select'),
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
            ?>
            </div>
        </div>

        


    </div>



</div>
</div>
<div class="form-group">
    <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
</div>

    <?php ActiveForm::end() ?>


<?php
$script2 = '
$("#userform-roles").on("change", function() {
    if($(this).val() == "'.User::ROLE_SCHOOL_ADMIN.'"  || $(this).val() == "'.User::ROLE_SCHOOL_ACTIVITY_ADMIN.'" || $(this).val() == "'.User::ROLE_SCHOOL_OWNER.'"){
        $("#AdminType").show();
        $("#userform-school_id").prop("disabled", false);
    }else{
        $("#AdminType").hide();
        $("#userform-school_id").prop("disabled", true);

    }
      
});
';
$this->registerJs($script2, \yii\web\View::POS_END);

?>




