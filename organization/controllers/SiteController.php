<?php

namespace organization\controllers;

use Yii;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use common\helpers\Filter;
use common\models\Organization;
use common\models\SurveyTag;
use common\models\User;
use common\models\base\SurveySelectedSectors;
use organization\models\search\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends OrganizationBackendController
{


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToOrganization') ? 'base' : 'common';

        return parent::beforeAction($action);
    }


    public function actionDashboard(){

        $organization = Yii::$app->user->identity->userProfile->organization;
        $searchModel  = new UserSearch();
        $searchModel->user_role = User::ROLE_USER;
        $searchModel->organization_id = $organization->id;
        $contributors = $searchModel->search(null,6);

        $orgSurveyStats = $this->organizationSurveyStats();
        $surveyChart    = $this->surveyChart();

        $organizationLastSurveys = $this->organizationSurveys($organization->id)->limit(6)->all();

        return $this->render('dashboard',compact('contributors','organization','orgSurveyStats','surveyChart','organizationLastSurveys'));
    }


    private function surveyChart()
    {
        $organization = Yii::$app->user->identity->userProfile->organization;
        $data = $this->organizationSurveysForChart($organization->id)
            ->andFilterWhere(Filter::dateFilter('survey_stat_assigned_at'))
            ->limit(10)
            ->all();
        $labels = ArrayHelper::getColumn($data,'survey_name');
        $data   = ArrayHelper::getColumn($data,'survey_stat');
        return ['labels'=> $labels ,'data'=>$data];
    }

    private function organizationSurveyStats()
    {
        $organization = Yii::$app->user->identity->userProfile->organization;

        $searchModel = new UserSearch();
        $searchModel->user_role = User::ROLE_USER;
        $searchModel->organization_id = $organization->id;
        $dataProvider = $searchModel->searchUntilFilterDate([]);
        $orgUserCount =  count($dataProvider->getModels());
        $surveyIds = $this->organizationSurveysForChart($organization->id)
            // ->andFilterWhere(Filter::dateFilter('survey_stat_assigned_at'))
            ->all();
        // return var_dump($surveyIds);
        $organizationSurveyIds = ArrayHelper::getColumn($surveyIds,'survey_id');
        $surveyStat = $this->surveyStat($organizationSurveyIds);
        $sumComplete   = $surveyStat['sumComplete'];
        $sumUncomplete = $surveyStat['sumUncomplete'];
        $sumNotstart   = ($orgUserCount * count($organizationSurveyIds) ) - ( $sumComplete + $sumUncomplete );

        return [
            'labels'=> [
                \Yii::t('common','Completed'),
                \Yii::t('common','Under completion'),
                \Yii::t('common','Not started'),
            ],
            'data'=>[
                $sumComplete,
                $sumUncomplete,
                $sumNotstart,
            ],
            'countStats'=> $sumComplete + $sumUncomplete + $sumNotstart
        ];
    }

    private function organizationSurveys($organization_id)
    {
        $organizationSurvey = Survey::find()->where(['org_id'=>$organization_id,'survey_is_closed'=>0])->all();

        foreach ($organizationSurvey as $survey) {
            if(strtotime($survey->survey_expired_at)){
                if (time() >= strtotime($survey->survey_expired_at)) {
                    $survey->survey_is_closed = 1;
                    $survey->save(false);
                }
            }
        }

        $organizationSurvey = Survey::find()->select('survey_id, survey_is_closed, survey_expired_at, survey_name, count(survey_stat.survey_stat_id) as survey_stat')
            ->join('LEFT JOIN','{{%survey_stat}}','{{%survey_stat}}.survey_stat_survey_id = {{%survey}}.survey_id')
            ->where(['org_id'=>$organization_id])
            ->andWhere(['admin_enabled'=> 1])
            ->andWhere(Filter::dateFilter('survey_created_at'));

        if (!empty($_GET['SurveySearch']['tags'])) {
            $tagsSurvey = ArrayHelper::getColumn(SurveyTag::find()->where(['IN','tag_id',$_GET['SurveySearch']['tags']])->all(),'survey_id');
            $organizationSurvey->andFilterWhere(['IN','survey_id',array_unique($tagsSurvey)]);
        }

        if (!empty($_GET['SurveySearch']['sector_id'])) {
            $sectorSurvey = ArrayHelper::getColumn(SurveySelectedSectors::find()->where(['IN','sector_id',$_GET['SurveySearch']['sector_id']])->all(),'survey_id');
            $organizationSurvey->andFilterWhere(['IN','survey_id',array_unique($sectorSurvey)]);
        }

        $organizationSurvey
            ->groupBy('survey_id')
            ->orderBy('survey_id DESC');
        return $organizationSurvey;
    }

    private function organizationSurveysForChart($organization_id)
    {
        $organizationSurvey = Survey::find()->select('survey_id, survey_is_closed, survey_expired_at, survey_name, count(survey_stat.survey_stat_id) as survey_stat')
            ->join('LEFT JOIN','{{%survey_stat}}','{{%survey_stat}}.survey_stat_survey_id = {{%survey}}.survey_id')
            ->where(['org_id'=>$organization_id])
            ->andWhere(['admin_enabled'=> 1]);

        if (!empty($_GET['SurveySearch']['tags'])) {
            $tagsSurvey = ArrayHelper::getColumn(SurveyTag::find()->where(['IN','tag_id',$_GET['SurveySearch']['tags']])->all(),'survey_id');
            $organizationSurvey->andFilterWhere(['IN','survey_id',array_unique($tagsSurvey)]);
        }

        if (!empty($_GET['SurveySearch']['sector_id'])) {
            $sectorSurvey = ArrayHelper::getColumn(SurveySelectedSectors::find()->where(['IN','sector_id',$_GET['SurveySearch']['sector_id']])->all(),'survey_id');
            $organizationSurvey->andFilterWhere(['IN','survey_id',array_unique($sectorSurvey)]);
        }

        $organizationSurvey
            ->groupBy('survey_id')
            ->orderBy('survey_id DESC');
        return $organizationSurvey;
    }

    private function surveyStat($surveyIds)
    {
        return [
            'sumComplete' => SurveyStat::find()->where(['IN','survey_stat_survey_id', $surveyIds])->andWhere(['survey_stat_is_done'=>1])->count(),
            'sumUncomplete' => SurveyStat::find()->where(['IN','survey_stat_survey_id', $surveyIds])->andWhere(['survey_stat_is_done'=>0])->count()
        ];
    }
}
