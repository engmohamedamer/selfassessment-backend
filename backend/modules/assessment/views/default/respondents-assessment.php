<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $searchModel \backend\modules\assessment\models\search\SurveyStatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $surveyId integer */

$siteLink = $_SERVER['REQUEST_SCHEME'] . '://'. $organization->slug . $_SERVER['SERVER_NAME'];
$link =  str_ireplace(['api','endpoints','organization'],'',$siteLink);

?>
<div id="survey-respondents" class="survey-container">

	<?php

	echo ListView::widget([
		'id' => 'survey-respondents-list',
		'layout' => "<div class='pull-right'>{summary}</div>\n<div class='clearfix'></div>{items}\n<div class='clearfix'></div><div class='col-md-12'>{pager}</div>",
		'dataProvider' => $dataProvider,
		'itemOptions' => ['class' => 'item'],
		'itemView' => function ($model, $key, $index, $widget) use ($surveyId,$link){
			/** @var $model \backend\modules\assessment\models\SurveyStat */
			$surveyStat = $model;
			ob_start();
			?>
			<div class="assigned-user">
				<?php
				echo $surveyStat->user->userProfile->fullName
				?>
                - <a href="<?= $link.'/report/'.$surveyStat->survey_stat_hash ?>" target="_blank">
                    <?= Yii::t('survey','view Assessment Answers')?>
                </a>

			</div>
			<div class="buttons">
				<?php
				echo Html::submitButton(\Yii::t('survey', '<i class="glyphicon glyphicon-trash" aria-hidden="true"></i>'),
					[
						'class' => 'btn btn-danger btn-delete-assigned-user user-assign-submit',
						'data-action' => Url::toRoute(['default/unassign-user', 'surveyId' => $surveyId]),
						'name' => 'userId',
						'value' => $surveyStat->survey_stat_user_id
					]);
				?>
			</div>
			<?php
			return ob_get_clean();
		},
	]);

	?>

</div>

