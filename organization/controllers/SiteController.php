<?php

namespace organization\controllers;

use Yii;
use backend\modules\assessment\models\Survey;
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
        $contributors = $searchModel->search(null,8);

        $organizationSurvey = Survey::find()->where(['org_id'=>$organization->id])->limit(5)->orderBy('survey_id desc')->all();
        return $this->render('dashboard',compact('contributors','organizationSurvey'));  //,compact()
    }


    public  function actionTest(){
        return $this->render('test');
    }


    public function actionOrgSurvey()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $organization = Yii::$app->user->identity->userProfile->organization;
        $labels = [];
        $data = [];
        foreach ($organization->survey as $survey) {
            $labels[] = $survey->survey_name;
            $data[] = count($survey->stats);
        }

        return ['labels'=> $labels ,'data'=>$data];
    }

    public function actionOrgSurveyCountDegree($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $organization = Yii::$app->user->identity->userProfile->organization;
        $survey = Survey::find()->where(['org_id'=>$organization->id,'survey_id'=>$id])->one();

        if ($survey) {
            foreach ($survey->stats as $stat) {
                $gained_points =  \Yii::$app->db->createCommand('SELECT sum(survey_user_answer_point) as gained_points from survey_user_answer where survey_user_answer_user_id = '.$stat->survey_stat_user_id.' and survey_user_answer_survey_id ='.$survey->survey_id )->queryScalar();
                $gained_score_title = [];
                if ($survey->survey_point) {
                    $gained_score =  ($gained_points / $survey->survey_point) * 100;
                    foreach ($survey->levels as $key => $value) {
                        if ($value->from <= $gained_score and $gained_score <= $value->to) {
                            $gained_score_title[] = $value->title;
                            break;
                        }
                    }

                }
            }
            $titles = [];
            $counts = [];
            foreach ($survey->levels as $level) {
                $titles[] = $level->title;
                $counts[] = array_count_values($gained_score_title)[$level->title] ?: 0;
            }
            return ['labels'=> $titles ,'data'=>$counts];
        }
    }

}
