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

echo '
    <p class="text-center">
        <strong>Answers</strong>
    </p>
';
?>
<?php
$class = ['red','aqua','green','yellow'];
foreach ($question->answers as $i => $answer) {
    $countUser = count($question->survey->stats);
    $count = $answer->getTotalUserAnswersCount();
    echo '
        <div class="progress-group">
            <span class="progress-text">'.$answer->survey_answer_name.' <i class="fas fa-info-circle"  data-toggle="popover" title="Corrective Actions" data-content="And heres some amazing content. Its very engaging. Right?"></i></span>
            <span class="progress-number"><b>'.$count.'</b>/'.$countUser.'</span>
            <div class="progress sm">
                <div class="progress-bar progress-bar-'.$class[rand(0,3)].'" style="width: '. ($count / $countUser) * 100  .'%"></div>
            </div>
        </div>
    ';
}

?>
<!-- 
    <div class="progress-group">
        <span class="progress-text">Add Products to Cart</span>
        <span class="progress-number"><b>160</b>/200</span>

        <div class="progress sm">
            <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
        </div>
    </div>
    <div class="progress-group">
    <span class="progress-text">Complete Purchase</span>
    <span class="progress-number"><b>310</b>/400</span>

    <div class="progress sm">
        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
    </div>
    </div>
    <div class="progress-group">
    <span class="progress-text">Visit Premium Page</span>
    <span class="progress-number"><b>480</b>/800</span>

    <div class="progress sm">
        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
    </div>
    </div>
    <div class="progress-group">
    <span class="progress-text">Send Inquiries</span>
    <span class="progress-number"><b>250</b>/500</span>

    <div class="progress sm">
        <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
    </div>
    </div> -->

</div>
