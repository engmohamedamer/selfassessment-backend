<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $node common\models\OrganizationStructure */

?>

<div class="organization-structure-form">

    <?= $form->field($node, 'child_allowed')->checkbox() ?>


</div>
