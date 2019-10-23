<?php

use backend\models\City;
use backend\models\District;
use common\helpers\multiLang\MyMultiLanguageActiveField;
use common\models\Organization;
use common\models\User;
use common\models\UserProfile;
use common\widgets\OrganizationForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use trntv\filekit\widget\Upload;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


\organization\assets\OrgUpdate::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
/* @var $form yii\widgets\ActiveForm */


?>

<?= OrganizationForm::widget([
    'model' => $model,
    'theme'=> $theme,
    'user'=> $user,
    'profile'=> $profile,
    'themeFooterLinks'=> $themeFooterLinks
]) ?>
    