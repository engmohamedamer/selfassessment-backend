<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use backend\modules\assessment\models\SurveyUserAnswer;
use yii\bootstrap\Progress;
use yii\helpers\Html;

/** @var $question \backend\modules\assessment\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */
\backend\assets\AssessmentAsset::register($this);
$totalVotesCount = $question->getTotalUserAnswersCount();

echo Html::beginTag('div', ['class' => 'answers-stat']);

echo '
    <p class="text-center">
        <strong>Answers</strong>
    </p>
';
?>
<?php
$class = ['red','aqua','green','yellow'];
$colors = ['#f56954','#00a65a','#f39c12','#00c0ef','#f56954','#00a65a','#f39c12','#00c0ef'];
$labels = [];
$answerCount = [];
foreach ($question->answers as $i => $answer) {
    $labels[] = $answer->survey_answer_name;
    $answerCount [] = $answer->getTotalUserAnswersCount();
    $countUser = count($question->survey->stats);
    $count = $answer->getTotalUserAnswersCount();
    // echo '
    //     <div class="progress-group">
    //         <span class="progress-text">'.$answer->survey_answer_name.'</span>
    //         <span class="progress-number"><b>'.$count.'</b>/'.$countUser.'</span>
    //         <div class="progress sm">
    //             <div class="progress-bar progress-bar-'.$class[rand(0,3)].'" style="width: '. ($count / $countUser) * 100  .'%"></div>
    //         </div>
    //     </div>
    // ';
}

?>
<div class="row">
    <div class="col-md-8">

        <div class="chart-responsive">
            <canvas id="pieChart" height="150"></canvas>
        </div>

    </div>
    <div class="col-md-4">
        <ul class="chart-legend clearfix" style="margin-top:70px">
          <?php foreach($labels as  $i => $lable):?>
            <li><i class="far fa-circle" style="color:<?= $colors[$i]?>"></i> <?= $lable ?></li>
          <?php endforeach;?>
        </ul>
    </div>

</div>

</div>

<?php

$labelsData = json_encode($labels);
$answerCountData = json_encode($answerCount);
$colorsData = json_encode($colors);
$js = <<<JS
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: $labelsData,
      datasets: [
        {
          data: $answerCountData,
          backgroundColor : $colorsData,
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

JS;
$this->registerJs($js);
?>

