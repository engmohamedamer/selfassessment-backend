<?php

use backend\models\CorrectiveActionReport;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CorrectiveActionReport */

$this->title = $model->user->userProfile->firstname .' '. $model->user->userProfile->lastname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Corrective Action Report'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corrective-action-report-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('backend', 'Corrective Action').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id',
        [
            'attribute' => 'org.name',
            'label' => Yii::t('common', 'Organization'),
        ],
        [
            'attribute' => 'user',
            'value'=>function($model){
                return $model->user->userProfile->firstname .' '. $model->user->userProfile->lastname;
            },
            'label' => Yii::t('common', 'Contributor'),
        ],
        [
            'attribute' => 'survey.survey_name',
            'label' => Yii::t('common', 'Survey'),
        ],
        [
            'attribute' => 'question.survey_question_name',
            'label' => Yii::t('backend', 'Question'),
        ],
        [
            'attribute' => 'answer.survey_answer_name',
            'label' => Yii::t('backend', 'Answer'),
        ],
        [
            'attribute'=>'corrective_action',
            'format'=>'raw'
        ],
        'corrective_action_date',
        [
            'attribute'=>'status',
            'value'=>function($model){
                return  CorrectiveActionReport::status()[$model->status];
            },
            'format'=>'raw'
        ],
        'comment:ntext',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
 
</div>
