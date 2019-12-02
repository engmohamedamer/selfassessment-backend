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
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1>
            <?= Yii::t('backend', 'Corrective Action').' '. Html::encode($this->title) ?></h1>
        </div>
       
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

   
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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
</div>
</div>
</div>
