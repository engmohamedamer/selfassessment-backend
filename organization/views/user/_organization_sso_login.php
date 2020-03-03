<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
?>


  
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

   
    <div class="col-md-12 cloneDivHeader">
        <h5><i class="fas fa-sign-in-alt"></i> <b><?= Yii::t('common', 'Login using SSO') ?></b>
        </h5>
        <div class="clearfix"></div>
    </div>

    <div class="col-md-12 container-items"><!-- widgetContainer -->

        <div class="form-group">
            <div class="checkbox">
                <label for="organization-allow_sso">
                    <?= $form->field($organization,'sso_login')->checkBox(); ?>
            </label>

            </div>
        </div>
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($organization, 'authServerUrl')->textInput(['maxlength' => true, 'placeholder' => 'https://sso.xxxx.land/auth']) ?>
        </div>    
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($organization, 'realm')->textInput(['maxlength' => true, 'placeholder' => 'xxxxx']) ?>
        </div> 
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($organization, 'clientId')->textInput(['maxlength' => true, 'placeholder' => 'xxxxx']) ?>
        </div> 
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <?php echo  $form->field($organization, 'clientSecret')->textInput(['maxlength' => true, 'placeholder' => 'xxxx-xxx-xxxxxx-xxxxx']) ?>
        </div> 
        
    </div>

    <?= Html::submitButton(Yii::t('common', 'Save Data'), ['class' =>'btn btn-success mr-5 ml-5']) ?>

    <?php ActiveForm::end(); ?>


