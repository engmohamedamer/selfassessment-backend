<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */

foreach ($question->answers as $i => $answer) {
	if ($i == 0) {
		$lable =  'Date From';
	}else{
		$lable =  'Date To';
	}
    echo $form->field($answer, "[$question->survey_question_id][$i]survey_answer_name", [
    'template' => "<div class='survey-questions-form-field'><div class='inline-input'>{label}{input}</div>\n{error}</div>",
    ])->input('date')->label(\Yii::t('survey', $lable));
    echo Html::tag('br', '');
}

echo Yii::t('survey','Will be presented one date/time field where respondent can enter the answer in free form');

