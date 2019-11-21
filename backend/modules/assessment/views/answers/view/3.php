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

$totalVotesCount = $question->getTotalUserAnswersCount();

echo Html::beginTag('div', ['class' => 'answers-stat']);
?>
<?php
foreach ($question->answers as $i => $answer) {
    $count = $answer->getTotalUserAnswersCount();
    try {
        $percent = ($count / $totalVotesCount) * 100;
    }catch (\Exception $e){
        $percent = 0;
    }
    echo $answer->survey_answer_name;
    echo Progress::widget([
        'id' => 'progress-' . $answer->survey_answer_id,
        'percent' => $percent,
        'label' => $count,
        'barOptions' => ['class' => 'progress-bar-info init']
    ]);
}

?>



    <p class="text-center">
    <strong>Answers</strong>
    </p>

    <div class="progress-group">
    <span class="progress-text">Add Products to Cart</span>
    <span class="progress-number"><b>160</b>/200</span>

    <div class="progress sm">
        <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
    </div>
    </div>
    <!-- /.progress-group -->
    <div class="progress-group">
    <span class="progress-text">Complete Purchase</span>
    <span class="progress-number"><b>310</b>/400</span>

    <div class="progress sm">
        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
    </div>
    </div>
    <!-- /.progress-group -->
    <div class="progress-group">
    <span class="progress-text">Visit Premium Page</span>
    <span class="progress-number"><b>480</b>/800</span>

    <div class="progress sm">
        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
    </div>
    </div>
    <!-- /.progress-group -->
    <div class="progress-group">
    <span class="progress-text">Send Inquiries</span>
    <span class="progress-number"><b>250</b>/500</span>

    <div class="progress sm">
        <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
    </div>
    </div>
    <!-- /.progress-group -->

</div>
