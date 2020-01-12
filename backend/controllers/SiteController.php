<?php

namespace backend\controllers;

use Yii;
use backend\models\Event;
use backend\models\EventBeneficiary;
use backend\models\EventField;
use backend\models\EventRequest;
use backend\models\EventSelectedBeneficary;
use backend\models\News;
use backend\models\NewsStatus;
use backend\models\SchoolCategory;
use backend\models\SchoolGender;
use backend\models\Schools;
use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use common\models\Organization;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionGo(){
        $this->layout= 'baselayout';
        return $this->render('go');
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';

        return parent::beforeAction($action);
    }


    public function actionDashboard(){

        $dateOrganizations = $this->dateFilter('created_at',true);
        $organizations = Organization::find()
            ->where($dateOrganizations)
            ->orderBy('id desc')
            ->limit(6)
            ->all();
        // charts data
        $labels = $this->chartData('labels'); 
        $data1  = $this->chartData('data1'); 
        $data2  = $this->chartData('data2'); 
        
        $dateStats = $this->dateFilter('survey_stat_assigned_at');
        $surveyStatsCount  = SurveyStat::find()->where($dateStats)->count();
        
        $dateSurvey = $this->dateFilter('survey_created_at');
        $surveyCount = Survey::find()
            ->where($dateSurvey)
            ->andWhere($this->filterByOrganization('org_id'))->count();

        $dateUser = $this->dateFilter('created_at',true,'user.');
        $user = User::find()
            ->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
            ->join('LEFT JOIN','{{%user_profile}}','{{%user_profile}}.user_id = {{%user}}.id')
            ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER])
            ->andWhere($dateUser)
            ->andWhere($this->filterByOrganization('organization_id'));
        $userCount = $user->count();
        return $this->render('dashboard',compact('organizations','surveyCount','assessmentStatus','userCount','surveyStatsCount','labels','data1','data2'));
    }

    public function filterByOrganization($organization_column)
    {
        $key = $_GET['organization_id'] ?: null;
        if ($key == null) return ['IS NOT',$organization_column,null];
        return [$organization_column=>$key];
    }

    private function dateFilter($column_date, $unix = false, $prefix = '')
    {
        $key = $_GET['date'] ?: null;

        if ($key == null) return ['IS NOT',$prefix.$column_date,null];
        
        $dateFormat  = $unix ? "DATE(FROM_UNIXTIME($prefix$column_date))"  : "DATE($column_date)";
        $monthFormat = $unix ? "MONTH(FROM_UNIXTIME($prefix$column_date))" : "MONTH($column_date)";
        $yearForamt  = $unix ? "YEAR(FROM_UNIXTIME($prefix$column_date))"  : "YEAR($column_date)";

        $date['dateCurrentDay']   = [$dateFormat => date('Y-m-d')];
        $date['dateLastDay']      = [$dateFormat => date('Y-m-d',strtotime("-1 day"))];
        
        $date['dateCurrentWeek']   = ["BETWEEN", "$column_date",date("Y-m-d",strtotime("last saturday")),date("Y-m-d",strtotime("1 day"))];
        $date["dateLastWeek"]      = ["BETWEEN", "$column_date", date("Y-m-d",strtotime("-7 days",strtotime(date("Y-m-d",strtotime("last saturday"))))),date("Y-m-d",strtotime("last saturday"))];

        $date["dateCurrentMonth"]  = [ $monthFormat => date("m"),"YEAR($column_date)"=>date("Y")];
        $date["dateLastMonth"]     = [  $monthFormat => date("m",strtotime("-1 month")),
            $yearForamt => (date("m",strtotime("-1 month")) == "12" ) ? date("Y",strtotime("-1 year")) : date("Y")
        ];
        
        $date["dateCurrentYear"]  = [ $yearForamt => date("Y")];
        $date["dateLastYear"]     = [ $yearForamt => date("Y",strtotime("-1 year"))];

        return $date[$key];
    }

    private function chartData($chartKey)
    {
        $surveyStatsCountPerMonth = SurveyStat::find()
            ->select('MONTH(survey_stat_assigned_at) as month, count(MONTH(survey_stat_assigned_at)) as count_month')
            ->where(['Year(survey_stat_assigned_at)'=>date('Y')])
            ->groupBy('MONTH(survey_stat_assigned_at)')
            ->all();
        // return var_dump($surveyStatsCountPerMonth);
        $usersCountPerMonth = User::find()
            ->select('MONTH(FROM_UNIXTIME(user.created_at)) as month, count(MONTH(FROM_UNIXTIME(user.created_at))) as count_month')
            ->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
            ->join('LEFT JOIN','{{%user_profile}}','{{%user_profile}}.user_id = {{%user}}.id')
            ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER])
            ->andFilterWhere(['YEAR(FROM_UNIXTIME(user.created_at))'=>date('Y')])
            ->groupBy('MONTH(FROM_UNIXTIME(user.created_at))')
            ->all();

        $labels = [];
        $data1 = [];
        $data2 = [];
        for ($i=1; $i <= date('m'); $i++) { 
            $labels[] = $this->months()[$i]; 
            $data1 [] = 0;
            $data2 [] = 0;
        }

        foreach ($usersCountPerMonth as $key => $value) {
            $data1[($value->month - 1)] = $value->count_month;
        }
        foreach ($surveyStatsCountPerMonth as $key => $value) {
            $data2[($value->month - 1)] = $value->count_month;
        }
        $data = ['data1'=>$data1,'data2'=>$data2,'labels'=>$labels];
        return $data[$chartKey];
    }

    private function months()
    {
        return array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
    }

}
