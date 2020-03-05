<?php

namespace organization\controllers;

use Yii;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\search\SurveyStatSearch;
use organization\controllers\OrganizationBackendController;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
/**
 * BlogController implements the CRUD actions for Blog model.
 */
class RespondentsController extends OrganizationBackendController
{

    public function actionIndex($surveyId)
    {

    	$searchModel = new SurveyStatSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['survey_stat_survey_id' => $surveyId])
            ->orderBy(['survey_stat_assigned_at' => SORT_DESC]);
        $dataProvider->pagination = false;
        $dataProvider->pagination->route = Url::toRoute(['default/respondents']);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'surveyId' => $surveyId,
            'survey'=> $this->findModel($surveyId)
        ]);
    }

    public function actionDelete($id)
    {
        $stat = SurveyStat::findOne($id);
        $surveyId = $stat->survey_stat_survey_id;
        if ($stat) {
            $stat->delete();
            return $this->redirect('/respondents?surveyId='.$surveyId);
        }else{
            throw new NotFoundHttpException('does not exist.');
        }
    }

    protected function findModel($id)
    {
        if (($model = Survey::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
