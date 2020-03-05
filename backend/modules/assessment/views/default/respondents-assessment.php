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
<style>
body {
    background-color: #fff !important;
}
</style>
<div class="col-md-12 ">
    <div class="content-header">
        <div class="">
            <div class="">
                <h1 class="m-0 text-dark">
                <i class="icofont-users-social"></i> <?= Yii::t('common', 'Contributors list') ?>
                </h1>
            </div>

        </div>
        <!-- /.row -->
    </div>
	<table class="kv-grid-table table table-bordered table-striped kv-table-wrap">
		<thead>
			<tr class="kartik-sheet-style">
				<th>اسم المشارك</th>
				<th>تاريخ المشاركة</th>
				<th>خيارات</th>
			</tr>
			
		</thead>
		<tbody>
			<tr class="kv-grid-demo">
				<td>اسم المشارك</td>
				<td>20/20/2002</td>
				<td class="skip-export kv-align-center kv-align-middle kv-grid-demo">
					<a href="/user/view?id=6" title="View" aria-label="View" data-pjax="0">
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
					</a>
					
					<a href="/user/delete?id=6" title="Delete" aria-label="Delete" data-pjax="0" data-method="post" data-confirm="هل انت متاكد من الحذف">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
			<tr class="kv-grid-demo">
				<td>اسم المشارك</td>
				<td>20/20/2002</td>
				<td class="skip-export kv-align-center kv-align-middle kv-grid-demo">
					<a href="/user/view?id=6" title="View" aria-label="View" data-pjax="0">
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
					</a>
					
					<a href="/user/delete?id=6" title="Delete" aria-label="Delete" data-pjax="0" data-method="post" data-action="<?=  Url::toRoute(['default/unassign-user', 'surveyId' => $surveyId]) ?>" data-confirm="هل انت متاكد من الحذف">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
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

