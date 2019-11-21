<?php

namespace organization\controllers;

use Yii;
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

        $searchModel = new UserSearch();
        $searchModel->user_role = User::ROLE_USER;
        $searchModel->organization_id = Yii::$app->user->identity->userProfile->organization_id;
        $contributors = $searchModel->search(null,8);
        return $this->render('dashboard',compact('contributors'));  //,compact()
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

}
