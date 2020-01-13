<?php

namespace organization\controllers;

use Yii;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use common\models\Organization;
use common\models\User;
use organization\models\search\UserSearch;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends OrganizationController
{


    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToOrganization') ? 'base' : 'common';

        return parent::beforeAction($action);
    }


    public function actionDashboard(){

        $organization  = Yii::$app->user->identity->userProfile->organization;
        $searchModel = new UserSearch();
        $searchModel->user_role = User::ROLE_USER;
        $searchModel->organization_id = $organization->id;
        $contributors = $searchModel->search(null,6);
        $orgSurveyStats = $this->actionOrgSurveyStats(false);
        $organizationSurvey = Survey::find()->where(['org_id'=>$organization->id])->limit(5)->orderBy('survey_id desc')->all();
        $countStats = $orgSurveyStats['data'][0] + $orgSurveyStats['data'][1] + $orgSurveyStats['data'][2];

        $surveyChart       = $this->surveyChart();
        $surveyChartLabels = $surveyChart['labels'];
        $surveyChartDate   = $surveyChart['data'];


        return $this->render('dashboard',compact('contributors','organizationSurvey','organization','orgSurveyStats','countStats','surveyChartLabels','surveyChartDate'));
    }


    public  function actionTest(){
        return $this->render('test');
    }


    private function surveyChart()
    {
        
        $organization = Yii::$app->user->identity->userProfile->organization;
        $organizationSurvey = Survey::find()->where(['org_id'=>$organization->id])
            ->orderBy('survey_id DESC')
            ->limit(8)
            ->all();
        $labels = [];
        $data = [];
        foreach ($organizationSurvey as $survey) {
            $labels[] = $survey->survey_name;
            $data[] = count($survey->stats);
        }

        return ['labels'=> $labels ,'data'=>$data];
    }

    public function actionOrgSurveyStats($api = true)
    {
        if ($api) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        $organization = Yii::$app->user->identity->userProfile->organization;

        $searchModel = new UserSearch();
        $searchModel->user_role = User::ROLE_USER;
        $searchModel->organization_id = $organization->id;
        $dataProvider = $searchModel->search([]);
        $orgUserCount =  count($dataProvider->getModels());

        $sumComplete  = 0;
        $sumUncomplete  = 0;
        $sumNotstart = 0;
        foreach ($organization->survey as $survey) {
            $countComplete = SurveyStat::find()->where(['survey_stat_survey_id'=> $survey->survey_id,'survey_stat_is_done'=>1])->count();
            $countUncomplete = SurveyStat::find()->where(['survey_stat_survey_id'=> $survey->survey_id,'survey_stat_is_done'=>0])->count();
            $notstart = $orgUserCount - ( $countComplete + $countUncomplete );
            $sumComplete += $countComplete;
            $sumUncomplete += $countUncomplete;
            $sumNotstart += $notstart;
        }
        return [
            'labels'=> ['اكتمل','قيد الاستكمال','لم يبدأ'] ,
            'data'=>[
                $sumComplete,
                $sumUncomplete,
                $sumNotstart,
            ]
        ];
    }

}
