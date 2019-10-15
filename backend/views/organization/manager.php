<?php

use yii\helpers\Html;
use common\models\User;
use common\models\UserProfile;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $roles yii\rbac\Role[] */
?>
<div class="user-update">

    <?php $form = ActiveForm::begin() ?>
		<!-- /.content-header -->
		<div class="row">
		    <div class="col-lg-12">
		        <div class="card">
		            <div class="card-body">

		                <ul class="nav nav-pills">
		                    <li class="nav-item pull-left header">
		                        <h3 class="card-title"><?php echo Yii::t('backend', 'User Details') ?>  </a></h3>    
		                    </li>
		                    <!-- <li class="nav-item ml-auto active"><a class="nav-link" href="#tab_1-1" data-toggle="tab" aria-expanded="true"><?php echo Yii::t('backend', 'Main Details') ?></a></li> -->
		                </ul>
		                <div class="tab-content mt-2">
		                    <div class="tab-pane active" id="tab_1-1">
		                        <div class="row">
		                            <div class="col-md-12">
		                                <?php echo $form->field($profile, 'picture')->widget(\common\b4widget\upload\MyUpload::class, [
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

		                </div>

		                <div class="form-group">
		                    <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
		                </div>
		            

		            </div>
		        </div>
		    </div>
		</div>

    <?php ActiveForm::end() ?>


</div>

<?php

if($saved == true){
     $this->registerJs("

     $(function() {
          parent.jQuery.fancybox.close();
          location.reload();
           // parent.location.reload();
     });
    ");
}

?>
