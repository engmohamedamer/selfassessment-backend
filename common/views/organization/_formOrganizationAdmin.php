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
<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsAdmins[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'email',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> <?= Yii::t('common', 'Organization Admin') ?>
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i><?= Yii::t('common', 'Organization Admin') ?></button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsAdmins as $index => $modelAdmin): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address"><?= Yii::t('common', 'Organization Admin') ?> : <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?= $form->field($modelAdmin, "[{$index}]full_name")->textInput(['maxlength' => true]) ?>
                        <?php echo $form->field($modelAdmin, "[{$index}]email") ?>
                        <?php echo $form->field($modelAdmin, "[{$index}]password")->passwordInput() ?>
                        <?php echo $form->field($modelAdmin, "[{$index}]gender")->dropDownlist([
                            UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                            UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
                        ]) ?>
                        <?= $form->field($modelAdmin, "[{$index}]mobile")->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>
