<?php

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyAnswer;
use backend\modules\assessment\models\SurveyQuestion;
use common\models\Organization;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\CorrectiveActionReport */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="corrective-action-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id')->textInput(['placeholder' => 'Id']) ?>

    <?= $form->field($model, 'org_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(Organization::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('backend', 'Choose Organization')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>


    <?= $form->field($model, 'survey_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(Survey::find()->orderBy('survey_id')->asArray()->all(), 'survey_id', 'survey_name'),
        'options' => ['placeholder' => Yii::t('backend', 'Choose Survey')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'question_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(SurveyQuestion::find()->orderBy('survey_question_id')->asArray()->all(), 'survey_question_id', 'survey_question_id'),
        'options' => ['placeholder' => Yii::t('backend', 'Choose Survey question')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'answer_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(SurveyAnswer::find()->orderBy('survey_answer_id')->asArray()->all(), 'survey_answer_id', 'survey_answer_id'),
        'options' => ['placeholder' => Yii::t('backend', 'Choose Survey answer')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'corrective_action')->textInput(['maxlength' => true, 'placeholder' => 'Corrective Action']) ?>

    <?= $form->field($model, 'corrective_action_date')->input('date'); ?>

    <?php // echo $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
