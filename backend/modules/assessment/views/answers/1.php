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
    // echo Html::checkbox('checkbox', false, ['class' => 'pseudo-checkbox']);
    if ($question->survey->survey_point > 0) {
        echo $form->field($answer, "[$question->survey_question_id][$i]correct")->checkbox(['value' => "1"]);
    }
    echo $form->field($answer, "[$question->survey_question_id][$i]survey_answer_name")->input('text',
        ['placeholder' => \Yii::t('survey', 'Enter an answer choice'),'required'=>true])->label(false);

    echo $form->field($answer, "[$question->survey_question_id][$i]survey_answer_points")->input('text',
        ['placeholder' => \Yii::t('survey', 'Question Point'),'required'=>true])->label(false);
    if ($question->survey_question_is_scorable || $question->survey->survey_point > 0) {
        // echo Html::beginTag('div', ['class' => 'points-wrap']);
        // if ($i === 0) {
            // echo Html::tag('span', \Yii::t('survey', 'Points'), ['class' => 'points-title']);
        // }
        // echo $form->field($answer, "[$question->survey_question_id][$i]survey_answer_points")->input('number')->label(false);
        // echo Html::endTag('div');
    }

    echo Html::submitButton('<span class="glyphicon glyphicon-plus"></span>', ['class' => 'btn btn-success btn-add-answer survey-question-submit',
        'data-action' => Url::toRoute(['question/add-answer', 'id' => $question->survey_question_id, 'after' => $i])]);
    echo Html::submitButton('<span class="glyphicon glyphicon-minus"></span>', ['class' => 'btn btn-danger btn-delete-answer survey-question-submit',
        'data-action' => Url::toRoute(['question/delete-answer', 'id' => $question->survey_question_id, 'answer' => $i]),
        'name' => 'action', 'value' => 'delete-answer'
    ]);

    // echo $form->field($answer, "[{$question->survey_question_id}][$i]survey_answer_show_descr",
    //     ['options' => [
    //         'class' => 'form-group checkbox-inline'
    //     ]])->checkbox(['class' => 'checkbox-updatable']);

    echo $form->field($answer, "[{$question->survey_question_id}][$i]survey_answer_show_corrective_action",
        ['options' => [
            'class' => 'form-group checkbox-inline'
        ]])->checkbox(['class' => 'checkbox-updatable']);
    echo Html::tag('br', '');

    if ($answer->survey_answer_show_descr) {
        echo $form->field($answer, "[{$question->survey_question_id}][$i]survey_answer_descr")->textarea(['class'=>'w-100','rows'=>'5','cols'=>'10'])->label(false);
    }

    echo Html::tag('br', '');

    if ($answer->survey_answer_show_corrective_action) {
        echo $form->field($answer,"[{$question->survey_question_id}][$i]corrective_action_date")->input('date');
        echo Html::beginTag('div', ['class' => 'desc-100']);
            echo $form->field($answer, "[{$question->survey_question_id}][$i]survey_answer_corrective_action")->textarea(['rows'=>'5','cols'=>'10'])->label(false);
        echo Html::endTag('div');
    }

    echo Html::tag('br', '');
}
