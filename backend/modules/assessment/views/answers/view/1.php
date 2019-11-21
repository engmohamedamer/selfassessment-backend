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
// foreach ($question->answers as $i => $answer) {
//     $countUser = count($question->survey->stats);
//     $count = $answer->getTotalUserAnswersCount();
//     echo '
//         <div class="progress-group">
//             <span class="progress-text">'.$answer->survey_answer_name.'</span>
//             <span class="progress-number"><b>'.$count.'</b>/'.$countUser.'</span>
//             <div class="progress sm">
//                 <div class="progress-bar progress-bar-'.$class[rand(0,3)].'" style="width: '. ($count / $countUser) * 100  .'%"></div>
//             </div>
//         </div>
//     ';
// }

?>
<div class="row">
    <div class="col-md-8">

        <div class="chart-responsive">
            <canvas id="pieChart" height="150"></canvas>
        </div>

    </div>
    <div class="col-md-4">
        <ul class="chart-legend clearfix" style="margin-top:70px">
            <li><i class="far fa-circle" style="color:#f56954"></i> Answer 1</li>
            <li><i class="far fa-circle" style="color:#00a65a"></i> Answer 2</li>
            <li><i class="far fa-circle" style="color:#f39c12"></i> Answer 3</li>
            <li><i class="far fa-circle" style="color:#00c0ef"></i> Answer 4</li>
           
        </ul>
    </div>

</div>

</div>



<?php
$this->registerJs(<<<JS


 //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'Answer 1', 
          'Answer 2',
          'Answer 3', 
          'Answer 4', 
          
      ],
      datasets: [
        {
          data: [3,5,1,2],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
          //backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],

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


JS
);

?>

