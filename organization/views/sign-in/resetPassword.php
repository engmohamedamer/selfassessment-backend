<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\ResetPasswordForm */
\organization\assets\LoginAsset::register($this);
$this->title = Yii::t('frontend', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container" id="addschool">
  <div class="row justify-content-center">
    <h1>تعديل كلمة المرور</h1>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-12 col-md-5 schoolForm">
         <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
           <?php echo $form->field($model, 'password')->passwordInput() ?>
          </div>
        </div>
        
        
       
        <div class="col-12 col-md-12 text-center">
          
        <button type="submit" class="btn btn-yellow">تعديل كلمة المرور</button>
        
    
        </div>
      </div>
       <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>



<!--Login Register Area Strat
<div class="login-register-area pb-50">
    <div class="container">
        <div class="row  justify-content-md-center">
          
            <div class="col-md-12 col-12">
                <div class="customer-login-register">
                    <div class="form-login-title">
                        <h2 class="text-center"><?= Yii::t('frontend','Password Reset') ?></h2>
                    </div>
                    <div class="login-form" style='width: 80%; margin: auto;'>
                        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>


                        <?php echo $form->field($model, 'password')->passwordInput() ?>

                        <div class="login-submit">
                            <button type="submit" class="form-button"><?= Yii::t('frontend','Reset Password') ?></button>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
          

        </div>
    </div>
</div>
<!--Login Register Area End-->
