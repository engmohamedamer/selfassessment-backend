<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \organization\models\LoginForm */

\organization\assets\LoginAsset::register($this);
?>
<div class="wrapper">

<div class="container" id="addschool">
  <div class="row justify-content-center">
    <h1>استرجاع كلمة المرور</h1>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-12 col-md-5 schoolForm">
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <?php echo $form->field($model, 'email') ?>
          </div>
        </div>
        
        
       
        <div class="col-12 col-md-12 text-center">
          
        <button type="submit" class="btn btn-yellow">استرجاع كلمة المرور</button>
        
    
        </div>
      </div>
       <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
</div>

