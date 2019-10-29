<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */

foreach ($question->answers as $i => $answer) {
switch ($i){
    case 0:
        $label = Yii::t('survey','Min');
        break;
    case 1:
        $label = Yii::t('survey','Max');
        break;
    default:
        $label = false;
        break;
}
    echo $form->field($answer, "[$question->survey_question_id][$i]survey_answer_name", [
        'template' => "<div class='survey-questions-form-field-inline'>{label}{input}\n{error}</div>"
    ])->input('number',
        ['placeholder' => \Yii::t('survey', 'Enter an answer choice')])->label($label);

    echo Html::tag('br', '');
}
