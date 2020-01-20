<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $node common\models\OrganizationStructure */

?>

<div class="organization-structure-form">

    <?= $form->field($node, 'child_allowed')->checkbox() ?>
    <input type="hidden" id="organizationstructure-organization_id"
           class="form-control" name="OrganizationStructure[organization_id]"
           value="<?php echo \Yii::$app->user->identity->userProfile->organization_id;  ?>" >


</div>
