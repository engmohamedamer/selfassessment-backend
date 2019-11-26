<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CorrectiveActionReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use backend\models\CorrectiveActionReport;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyAnswer;
use backend\modules\assessment\models\SurveyQuestion;
use common\models\Organization;
use common\models\User;
use kartik\export\ExportMenu;
use kartik\grid\EnumColumn;
use kartik\grid\GridView;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\web\JsExpression;

$this->title = Yii::t('backend', 'Corrective Action Report');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
$org_id = \Yii::$app->user->identity->userProfile->organization_id;

$query = User::find()->select("id ,Concat(`firstname` , `lastname`  ) as name");
$query->joinWith(['userProfile']);
$query->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER]);
$query->andFilterWhere(['organization_id'=>$org_id]);
$usersData = \yii\helpers\ArrayHelper::map($query->asArray()->all(), 'id', 'name');
?>
<div class="corrective-action-report-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        // [
        //         'attribute' => 'org_id',
        //         'label' => Yii::t('common','Organization'),
        //         'value' => function($model){
        //             if ($model->org)
        //             {return $model->org->name;}
        //             else
        //             {return NULL;}
        //         },
        //         'filterType' => GridView::FILTER_SELECT2,
        //         'filter' => \yii\helpers\ArrayHelper::map(Organization::find()->asArray()->all(), 'id', 'name'),
        //         'filterWidgetOptions' => [
        //             'pluginOptions' => ['allowClear' => true],
        //         ],
        //         'filterInputOptions' => ['placeholder' => Yii::t('common','Organization'), 'id' => 'grid-corrective-action-report-search-org_id']
        //     ],
        [
            'attribute' => 'user_id',
            'label' => Yii::t('backend', 'Users'),
            'value' => function($model){
                if ($model->user)
                {return $model->user->userProfile->firstname .' '. $model->user->userProfile->lastname ;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => $usersData,
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' =>  Yii::t('backend','Users'), 'id' => 'grid-corrective-action-report-search-user_id']
        ],
        [
            'attribute' => 'survey_id',
            'label' => Yii::t('common', 'Survey'),
            'value' => function($model){
                if ($model->survey)
                {return $model->survey->survey_name;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(Survey::find()->where(['org_id'=>  $org_id ])->asArray()->all(), 'survey_id', 'survey_name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('common', 'Survey'), 'id' => 'grid-corrective-action-report-search-survey_id']
        ],
        [
            'attribute' => 'question_id',
            'label' => Yii::t('backend', 'Question'),
            'value' => function($model){
                if ($model->question)
                {return $model->question->survey_question_name;}
                else
                {return NULL;}
            },
            // 'filterType' => GridView::FILTER_SELECT2,
            // 'filter' => \yii\helpers\ArrayHelper::map(SurveyQuestion::find()->asArray()->all(), 'survey_question_id', 'survey_question_name'),
            // 'filterWidgetOptions' => [
            //     'pluginOptions' => ['allowClear' => true],
            // ],
            // 'filterInputOptions' => ['placeholder' => Yii::t('backend', 'Question'), 'id' => 'grid-corrective-action-report-search-question_id']
        ],
        // [
        //     'attribute' => 'answer_id',
        //     'label' => Yii::t('backend', 'Answer'),
        //     'value' => function($model){
        //         if ($model->answer)
        //         {return $model->answer->survey_answer_name;}
        //         else
        //         {return NULL;}
        //     },
        //     'filterType' => GridView::FILTER_SELECT2,
        //     'filter' => \yii\helpers\ArrayHelper::map(SurveyAnswer::find()->asArray()->all(), 'survey_answer_id', 'survey_answer_id'),
        //     'filterWidgetOptions' => [
        //         'pluginOptions' => ['allowClear' => true],
        //     ],
        //     'filterInputOptions' => ['placeholder' => 'Survey answer', 'id' => 'grid-corrective-action-report-search-answer_id']
        // ],
        [
            'attribute'=>'corrective_action',
            'format'=>'raw',
        ],
        'corrective_action_date',
       // [
       //     'attribute' => 'corrective_action_date',
       //     'format' => 'datetime',
       //     'filter' => DateTimeWidget::widget([
       //         'model' => $searchModel,
       //         'attribute' => 'corrective_action_date',
       //         'phpDatetimeFormat' => 'YYYY-MM-DD',
       //         'momentDatetimeFormat' => 'YYYY-MM-DD',
       //         'clientOptions'=>[
       //          'locale'=>'en',
       //         ],
       //         'clientEvents' => [
       //             'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
       //         ],
       //     ])
       // ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'enum' => CorrectiveActionReport::status(),
            'filter' => CorrectiveActionReport::status()
        ],
        // 'comment:ntext',
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{view}'
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-corrective-action-report']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>

</div>
