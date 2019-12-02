<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:24
 */

use kartik\dialog\Dialog;
use kartik\editable\Editable;
use kartik\helpers\Html;
use kartik\select2\Select2;
use onmotion\yii2\widget\upload\crop\UploadCrop;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $survey \backend\modules\assessment\models\Survey */
/* @var $withUserSearch boolean */

// widget with default options
echo Dialog::widget();

if (Yii::$app->user->identity->userProfile->organization) {
    $brandPrimColor =  Yii::$app->user->identity->userProfile->organization->organizationTheme->brandPrimColor; 
    $brandSecColor =  Yii::$app->user->identity->userProfile->organization->organizationTheme->brandSecColor; 
}


?>

<style>
.surveylevels .col-md-10,.surveylevels .col-md-4{
    padding:0 15px;
}
</style>
    <div class="survey-container">

        <div class="survey-block">
            <?php

            echo Html::beginTag('div', ['class' => 'survey-name-wrap']);

            \yii\widgets\Pjax::begin([
                'id' => 'form-photo-pjax',
                'timeout' => 0,
                'enablePushState' => false
            ]);
            $form = ActiveForm::begin([
                'id' => 'survey-photo-form',
                'action' => \yii\helpers\Url::toRoute(['default/update-image', 'id' => $survey->survey_id]),
                'options' => ['class' => 'form-horizontal', 'data-pjax' => true],
                //  'enableAjaxValidation' => true,
            ]);

            echo UploadCrop::widget([
                'form' => $form,
                'model' => $survey,
                'attribute' => 'imageFile',
                'enableClientValidation' => true,
                'defaultPreviewImage' => $survey->getImage(),
                'jcropOptions' => [
                    //  'dragMode' => 'none',
                    'viewMode' => 2,
                    'aspectRatio' => 1,
                    'autoCropArea' => 1,
                    'rotatable' => true,
                    'scalable' => true,
                    'zoomable' => true,
                    'toggleDragModeOnDblclick' => false
                ]
            ]);

            ActiveForm::end();
            \yii\widgets\Pjax::end();

            echo Editable::widget([
                'model' => $survey,
                'attribute' => 'survey_name',
                'asPopover' => true,
                'header' => Yii::t('survey','Name'),
                'size' => 'md',
                'formOptions' => [
                    'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_name'])
                ],
                'additionalData' => ['id' => $survey->survey_id],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => Yii::t('survey','Enter survey name...'),
                ]
            ]);
            echo Html::endTag('div');
            echo Html::tag('br', '');



            echo Html::beginTag('div', ['class' => 'survey-content-wrap']);
            
            echo Html::beginTag('div', ['class' => 'row', 'style' => 'justify-content: center;']);
            echo Html::beginTag('div', ['class' => 'col-md-3', 'style' => 'background: '.$brandSecColor.'; color:#000; border-radius: 10px; text-align: center; margin:5px;']);
            echo Html::label(Yii::t('survey', 'Expired at') . ': ', 'survey-survey_expired_at');
            echo Html::tag('br', '');

            echo Editable::widget([
                'model' => $survey,
                'attribute' => 'survey_expired_at',
                'header' => Yii::t('survey', 'Expired at'),
                'placement'=>'bottom',
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
                    'options' => ['placeholder' => Yii::t('survey', 'Expired at')]
                ],
                'showButtonLabels' => true,
                'submitButton' => [
                    'icon' => false,
                    'label' => Yii::t('survey','OK'),
                    'class' => 'btn btn-sm btn-primary'
                ],
                'resetButton'=>[
                    'label' => Yii::t('survey','Reset'),
                ]
            ]);
            echo Html::endTag('div'); // col-md-3

            echo Html::beginTag('div', ['class' => 'col-md-3', 'style' => 'background: '.$brandSecColor.'; color:#000; border-radius: 10px; text-align: center; margin:5px;']);
            echo Html::label(Yii::t('survey', 'Time to pass') . ': ', 'survey-survey_time_to_pass');
            echo Html::tag('br', '');
            echo Editable::widget([
                'model' => $survey,
                'attribute' => 'survey_time_to_pass',
                'asPopover' => true,
                'header' => Yii::t('survey', 'Time to pass'),
                'size' => 'md',
                'formOptions' => [
                    'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_time_to_pass'])
                ],
                'additionalData' => ['id' => $survey->survey_id],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => Yii::t('survey', 'Enter time in minutes...'),
                    'type' => 'number',
                ]
            ]);
            echo Html::label(Yii::t('survey', 'minutes'));
            echo Html::endTag('div'); // col-md-3


            echo Html::beginTag('div', ['class' => 'col-md-3', 'style' => 'background: '.$brandSecColor.'; color:#000; border-radius: 10px; text-align: center; margin:5px;']);
            echo Html::label(Yii::t('survey', 'Survey Point (optional)') . ': ', 'survey-survey_point');
            echo Html::tag('br', '');
            echo Editable::widget([
                'model' => $survey,
                'attribute' => 'survey_point',
                'asPopover' => true,
                'header' => Yii::t('survey', 'Survey Point'),
                'size' => 'md',
                'formOptions' => [
                    'action' => Url::toRoute(['default/update-editable', 'property' => 'survey_point'])
                ],
                'additionalData' => ['id' => $survey->survey_id],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => Yii::t('survey', 'Enter Survey Point...'),
                    'type' => 'number',
                ]
            ]);
            echo Html::label(Yii::t('survey', 'Point'));
            echo Html::endTag('div'); // col-md-3
            echo Html::endTag('div'); // row




           
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

            if ($survey->survey_point) {
                $hide = '';
            }else{
                $hide = 'hide';
            }

            echo Html::beginTag('div', ['class' => 'row surveylevels '.$hide]);

            echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
            echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[0]->title ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[0]->from ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[0]->to ]);
                echo Html::endTag('div');
                echo Html::endTag('div');
            echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
            echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[1]->title ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[1]->from ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[1]->to ]);
            echo Html::endTag('div');
            echo Html::endTag('div');
            echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
            echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[2]->title ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[2]->from ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[2]->to ]);
                echo Html::endTag('div');
                echo Html::endTag('div');
            echo Html::beginTag('div', ['class' => 'col-md-10 col-md-offset-1']);
            echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_title[]")->input('text',['value' => $survey->levels[3]->title ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_from[]")->input('number',['value' => $survey->levels[3]->from ]);
                echo Html::endTag('div');
                echo Html::beginTag('div', ['class' => 'col-md-4']);
                echo $form->field($survey, "level_to[]")->input('number',['value' => $survey->levels[3]->to ]);
           
                echo Html::endTag('div');
                     echo Html::endTag('div');
                     echo Html::beginTag('div', ['class' => 'col-md-12']);

            echo $form->field($survey, "survey_descr", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
            )->textarea(['rows' => 3]);

            echo $form->field($survey, "start_info", ['template' => "<div class='survey-form-field'>{label}{input}</div>",]
            )->textarea(['rows' => 3, 'style' => 'height:auto', ]);


                echo Html::tag('div', '', ['class' => 'clearfix']);
                echo Html::endTag('div'); // col-md-12
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
            echo Html::endTag('div'); // col-md-3

            echo Html::beginTag('div', ['class' => 'col-md-9']);
            echo $form->field($survey, "survey_tags")->input('text', ['placeholder' => Yii::t('survey','Comma separated')]);
			if ($withUserSearch) {
				echo Html::tag('div', '', ['class' => 'clearfix']);
				echo $form->field($survey, 'restrictedUserIds')->widget(Select2::classname(),
					[
						'initValueText' => $survey->restrictedUsernames, // set the initial display text
						'options' => ['placeholder' => \Yii::t('survey', 'Restrict survey to selected user...')],
						'pluginOptions' => [
							'allowClear' => true,
							'minimumInputLength' => 3,
							'language' => [
								'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
							],
							'ajax' => [
								'url' => Url::toRoute(['default/search-respondents-by-token']),
								'dataType' => 'json',
								'data' => new JsExpression('function(params) { return {token:params.term}; }')
							],
							'multiple' => true,
							'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
							'templateResult' => new JsExpression('function(city) { return city.text; }'),
							'templateSelection' => new JsExpression('function (city) { return city.text; }'),
						],
						'pluginEvents' => [
							'change' => new JsExpression('function() {         
				                var container = $(this).closest(\'[data-pjax-container]\');
		                        container.find(\'button[type=submit]\').click(); 
		                    }')
						]
					]);
			}
            echo Html::endTag('div'); // col-md-9
            echo Html::endTag('div'); // row

            echo Html::submitButton('', ['class' => 'hidden']);
            echo Html::tag('div', '', ['class' => 'clearfix']);

            ActiveForm::end();

            Pjax::end();
            echo Html::endTag('div');

            ?>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div id="survey-questions">
            <h2 class='mt-2 mb-3 qNumHeader' style='color:#fff; margin: 20px auto; text-align: center;'><?= Yii::t('common','Questions')  ?> (<span><?= count($survey->questions)  ?></span>)</h2>
            <?php
            foreach ($survey->questions as $i => $question) {
                echo $this->render('/question/_form', ['question' => $question]);
            }
            ?>
        </div>
        <?php
        echo Html::tag('div', '', ['id' => 'survey-questions-append']);

        Pjax::begin([
            'id' => 'survey-questions-pjax',
            'enablePushState' => false,
            'timeout' => 0,
            'scrollTo' => false,
            'clientOptions' => [
                'type' => 'post',
                'container' => '#survey-questions-append',
                'skipOuterContainers' => true,
            ]
        ]);
        echo Html::tag('div', Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('survey', 'Add question'), Url::toRoute(['question/create', 'id' => $survey->survey_id]), ['class' => 'btn btn-success secBtn ']),
            ['class' => 'text-center survey-btn', 'id' => '']);
        echo Html::tag('div', Html::submitButton('<i class="fa fa-floppy-o" aria-hidden="true"></i> ' . Yii::t('survey', 'Save'),
            ['class' => 'btn primBtn', 'data-default-text' => '<i class="fa fa-floppy-o" aria-hidden="true"></i> ' . Yii::t('survey', 'Save')]), ['class' => 'text-center survey-btn', 'id' => 'save', 'data-action' => Url::toRoute(['default/view', 'id' => $survey->survey_id])]);

        Pjax::end(); ?>


    </div>

<?php
$this->registerJs(<<<JS
$(document).ready(function(e) {
  $(document).on('cropdone', function() {
    $('#survey-photo-form').submit();
  });
});
JS
);

$this->registerCss(<<<CSS
.modal-backdrop.in{
display: none;
}
CSS
);

$this->registerJs(<<<JS
$(document).ready(function (e) {
    $.fn.survey();

    $('.addQPanel a').on('click', function () {
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        $('.qNumHeader span').html(parseInt($('.qNumHeader span').html())+ 1)
    })
});





$("#survey-survey_point-popover .kv-editable-submit").click(function(){
    if($("#survey-survey_point").val()>0){
        $(".surveylevels").removeClass("hide")
    }else{
        $(".surveylevels").addClass("hide")
    }
    
   
})

JS
);
