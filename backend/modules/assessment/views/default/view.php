<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:24
 */

use cenotia\components\modal\RemoteModal;
use kartik\select2\Select2;
use backend\modules\assessment\models\search\SurveyStatSearch;
use kartik\editable\Editable;
use kartik\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\BootstrapPluginAsset;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $survey \backend\modules\assessment\models\Survey */
/* @var $respondentsCount integer */
/* @var $withUserSearch boolean */

$this->title = Yii::t('survey', 'Survey') . ' - ' . $survey->survey_name;

BootstrapPluginAsset::register($this);


?>
    <div  id="survey-view" data-SurveyId='<?= $survey->survey_id; ?>'>
        <div id="survey-title">
            <div class="subcontainer flex">
                <h4><?= $survey->survey_name; ?></h4>
                <div>
                    <div class="survey-labels">
                        <a href="<?= Url::toRoute(['default/update/', 'id' => $survey->survey_id]) ?>"
                           class="btn btn-info btn-xs survey-label" data-pjax="0"
                           title="edit"><span class="glyphicon glyphicon-pencil"></span></a>
                        <span class="survey-label btn btn-info btn-xs respondents-toggle" data-toggle="tooltip"
                              title="<?= \Yii::t('survey', 'Respondents count') ?>">
                             <?= \Yii::t('survey', 'Respondents count') ?>: <?= $survey->getRespondentsCount() ?>
                        </span>
                        <span class="survey-label btn btn-info btn-xs" data-toggle="tooltip"
                              title="<?= \Yii::t('survey', 'Questions') ?>">
                               <?= \Yii::t('survey', 'Questions') ?>: <?= $survey->getQuestions()->count() ?>
                        </span>
                    </div>

                </div>

            </div>
            <div class="subcontainer">
                <?php
                echo Html::beginTag('div', ['class' => 'row']);
                echo Html::beginTag('div', ['class' => 'col-md-6']);
                echo Html::label(Yii::t('survey', 'Expired at') . ': ', 'survey-survey_expired_at');
                echo Editable::widget([
                    'model' => $survey,
                    'attribute' => 'survey_expired_at',
                    'header' => 'Expired at',
                    'asPopover' => true,
                    'size' => 'md',
                    'inputType' => Editable::INPUT_DATETIME,
                    'formOptions' => [
                        'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_expired_at'])
                    ],
                    'additionalData' => ['id' => $survey->survey_id],
                    'options' => [
                        'class' => Editable::INPUT_DATETIME,
                        'pluginOptions' => [
                            'autoclose' => true,
                            // 'format' => 'd.m.Y H:i'
                        ],
                        'options' => ['placeholder' => 'Expired at']
                    ]
                ]);
                echo Html::endTag('div');

                echo Html::beginTag('div', ['class' => 'col-md-6']);
                echo Html::endTag('div');
                echo Html::endTag('div');

                Pjax::begin([
                    'id' => 'survey-pjax',
                    'enablePushState' => false,
                    'timeout' => 0,
                    'scrollTo' => false,
                    'clientOptions' => [
                        'type' => 'post',
                        'skipOuterContainers' => true,
                    ]
                ]);

                $form = ActiveForm::begin([
                    'id' => 'survey-form',
                    'action' => Url::toRoute(['default/update', 'id' => $survey->survey_id]),
                    'options' => ['class' => 'form-inline', 'data-pjax' => true],
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => false,
                    'fieldConfig' => [
                        'template' => "<div class='survey-form-field'>{label}{input}\n{error}</div>",
                        'labelOptions' => ['class' => ''],
                    ],
                ]);

                echo Html::beginTag('div', ['class' => 'row']);

                echo Html::beginTag('div', ['class' => 'col-md-3']);
                    echo $form->field($survey, "survey_point", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                    )->input('number',['min'=>0]);
                echo Html::endTag('div'); // row

                echo Html::beginTag('div', ['class' => 'col-md-12']);
                echo $form->field($survey, "survey_descr", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                )->textarea(['rows' => 3]);

                 echo $form->field($survey, "start_info", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
                )->textarea(['rows' => 3,'calss'=>'form-control']);

                echo Html::tag('div', '', ['class' => 'clearfix']);
                echo Html::endTag('div');
                echo Html::endTag('div');

                echo Html::beginTag('div', ['class' => 'row']);
                echo Html::beginTag('div', ['class' => 'col-md-3']);
                echo $form->field($survey, "survey_is_closed", ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                )->checkbox(['class' => 'checkbox danger'], false);
                echo Html::tag('div', '', ['class' => 'clearfix']);
                // echo $form->field($survey, "survey_is_pinned", ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                // )->checkbox(['class' => 'checkbox'], false);
                // echo Html::tag('div', '', ['class' => 'clearfix']);
                echo $form->field($survey, "survey_is_visible", ['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
                )->checkbox(['class' => 'checkbox'], false);
				if ($withUserSearch) {
					echo Html::tag('div', '', ['class' => 'clearfix']);
					echo $form->field($survey,
						"survey_is_private",
						['template' => "<div class='survey-form-field submit-on-click'>{input}{label}</div>",]
					)->checkbox(['class' => 'checkbox danger'], false);
				}
                echo Html::endTag('div');

                echo Html::beginTag('div', ['class' => 'col-md-9']);
                echo $form->field($survey, "survey_tags")->input('text', ['placeholder' => Yii::t('survey','Comma separated')]);
                echo Html::endTag('div');
                echo Html::endTag('div');

                echo Html::submitButton('', ['class' => 'hidden']);
                echo Html::tag('div', '', ['class' => 'clearfix']);

                ActiveForm::end();

                Pjax::end();
                ?>

            </div>

        </div>
        <?php if($survey->survey_point):?>
        <div class='row'>
            <!-- <div class="text-center surveyView-preloader preloader col-sm-12" style="display:none">
                <img src="./img/preloader.gif" alt="">
            </div> -->
            <div class='col-md-6'>
                <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">نسب التقييم في الاستبيان</h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="surveyViewChart" style="height: 237px; width: 475px;" height="237" width="475"></canvas>
                </div>
                <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">نسب المشاركة في الإستبيان</h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="participantsStatusChart" style="height: 237px; width: 475px;" height="237" width="475"></canvas>
                </div>
                <!-- /.box-body -->
                </div>
            </div>
        </div>
        <?php endif;?>
        <div>
            <div class="survey-container">

                <div id="survey-questions">
                    <?php
                    foreach ($survey->questions as $i => $question) {
                        echo $this->render('/question/_viewForm', ['question' => $question, 'number' => $i]);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<div class="hidden-modal-right " id="respondents-modal">
    <div class="close-btn">&times;</div>
    <?php

    $surveyId = $survey->survey_id;

    echo $this->render('respondents',
        compact('searchModel', 'dataProvider', 'surveyId', 'withUserSearch'));
    ?>
</div>


<?php
$this->registerJs(<<<JS
$(document).ready(function(e) {
    setTimeout(function() {
       $('.progress-bar').each(function(i, el) {
            if ($(el).hasClass('init')){
                $(el).removeClass('init');
            }
        })
    }, 1000);
});
JS
);
$id  = $survey->survey_id;
$js = <<<JS
$(document).ready(function (e) {
    $.fn.survey();



    $.ajax({
    url: `/site/org-survey-count-degree?id=$id`,
    type: 'GET',
    beforeSend: function () { $('.surveyView-preloader').show()},
    complete: function () { },
    success: res => {
        var ctx = document.getElementById('surveyViewChart').getContext('2d');
        var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: res.data,
                backgroundColor: [
                    '#ecf0f1',
                    '#f39c12',
                    '#2ecc71'
                ],
            }],
            labels: res.labels
        },
        options: {
            responsive: true
        }
        });
        $('.surveyView-preloader').hide()
    },
    error: function (err) {
        console.log(err);
        $('.surveyView-preloader').hide()
    }
    });



    var ctx = document.getElementById('participantsStatusChart').getContext('2d');
        var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: res.data,
                backgroundColor: [
                    "#ecf0f1",
                    "#f39c12",
                    "#2ecc71"
                ],
            }],
            labels: res.labels
        },
        options: {
            responsive: true
        }
        });




});
JS;
$this->registerJs($js);
