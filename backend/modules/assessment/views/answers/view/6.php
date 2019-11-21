<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use backend\modules\assessment\models\SurveyUserAnswer;
use kartik\slider\Slider;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Progress;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */
\backend\assets\AssessmentAsset::register($this);

$totalVotesCount = $question->getTotalUserAnswersCount();

echo Html::beginTag('div', ['class' => 'answers-stat']);
 	$count = count($question->survey->stats);
    try {
        $percent = ($count / $totalVotesCount) * 100;
    }catch (\Exception $e){
        $percent = 0;
    }
    echo Progress::widget([
        'id' => 'progress-' . $answer->survey_answer_id,
        'percent' => $percent,
        'label' => $totalVotesCount,
        'barOptions' => ['class' => 'progress-bar-info init']
    ]);
echo Html::endTag('div');
?>

<div class="text-center">
<p class="text-center">
    <strong>Answer Rate</strong>
    (<strong>50</strong>/100)
    </p>
<div class='chart' data-percentage='75'>
  <div class='percentage'></div>
  <div class='completed active'></div>
  
</div>

</div>
<style>


</style>