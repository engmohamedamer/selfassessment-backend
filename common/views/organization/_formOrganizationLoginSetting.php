<?php

use common\models\UserProfile;
use kartik\color\ColorInput;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\OrganizationTheme */
/* @var $form yii\widgets\ActiveForm */

?>


  

   
    <div class="col-md-12 cloneDivHeader">
        <h5><i class="fas fa-sign-in-alt"></i> <b><?= Yii::t('common', 'Login using SSO') ?></b>
        </h5>
        <div class="clearfix"></div>
    </div>

    <div class="col-md-12 container-items"><!-- widgetContainer -->

        <div class="form-group">
            <div class="checkbox">
                <label for="organization-allow_sso">
                    <input type="checkbox" id="organization-allow_sso" value="1" onclick="">
                    <?= Yii::t('common', 'Allow Login using organization SSO.') ?>
            </label>

            </div>
        </div>
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <label class="control-label">AuthServerUrl</label>
            <input type="text" id="" class="form-control"  value="" placeholder="https://sso.xxxx.land/auth">
        </div>    
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <label class="control-label">Realm</label>
            <input type="text" id="" class="form-control"  value="" placeholder="xxxxx">
        </div> 
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <label class="control-label">ClientId</label>
            <input type="text" id="" class="form-control"  value="" placeholder="xxxxx">
        </div> 
        <div class="form-group highlight-addon field-organizationtheme-facebook">
            <label class="control-label">ClientSecret</label>
            <input type="text" id="" class="form-control"  value="" placeholder="xxxx-xxx-xxxxxx-xxxxx">
        </div> 
        
    </div>


