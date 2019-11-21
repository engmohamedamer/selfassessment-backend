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

<div class="chart-responsive">
  <canvas id="pieChart" height="150"></canvas>
</div>

</div>
<script>
 //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
          'Opera', 
          'Navigator', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })
</script>