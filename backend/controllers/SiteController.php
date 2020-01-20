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
use common\helpers\Filter;
use common\models\Organization;
use common\models\User;
use yii\helpers\ArrayHelper;

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

        $dateOrganizations = Filter::dateFilter('created_at',true);
        $organizations = Organization::find()->select('id,name')
            ->where($dateOrganizations)
            ->orderBy('id DESC')
            ->limit(10)
            ->all();
        
        $organizationsCount = Organization::find()->select('id,name')
            ->where($dateOrganizations)
            ->count();
        
        // charts data
        $chartData = $this->chartData() ;
        $labels = $chartData['labels']; 
        $data1  = $chartData['data1']; 
        $data2  = $chartData['data2']; 
        
        $dateSurvey = Filter::dateFilter('survey_created_at');
        $surveyCount = Survey::find()
            ->where($dateSurvey)
            ->andWhere($this->filterByOrganization('org_id'))->count();

        $dateStats = Filter::dateFilter('survey_stat_assigned_at');
        $surveyStatsCount  = SurveyStat::find()->where($dateStats);

        if (!empty($_GET['organization_id'])) {
            $surveyIds = ArrayHelper::getColumn(Survey::find()->where(['org_id'=>$_GET['organization_id']])->all(),'survey_id');
            $surveyStatsCount->andWhere(['IN','survey_stat_survey_id',$surveyIds]);
        }
        $surveyStatsCount  = $surveyStatsCount->count();
        
        $dateUser = Filter::dateFilter('created_at',true,'user.');
        $user = User::find()
            ->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
            ->join('LEFT JOIN','{{%user_profile}}','{{%user_profile}}.user_id = {{%user}}.id')
            ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER])
            ->andWhere($dateUser)
            ->andWhere($this->filterByOrganization('organization_id'));
        $userCount = $user->count();
        return $this->render('dashboard',compact('organizations','organizationsCount','surveyCount','assessmentStatus','userCount','surveyStatsCount','labels','data1','data2'));
    }

    public function filterByOrganization($organization_column)
    {
        $key = $_GET['organization_id'] ?: null;
        if ($key == null) return ['IS NOT',$organization_column,null];
        return [$organization_column=>$key];
    }

    

    private function chartData()
    {

        if (!empty($_GET['organization_id'])) {
            $surveyIds = ArrayHelper::getColumn(Survey::find()->where(['org_id'=>$_GET['organization_id']])->all(),'survey_id');
            $filter = ['IN','survey_stat_survey_id',$surveyIds];
        }else{
            $filter = ['IS NOT','survey_stat_survey_id',null];
        }

        if (!empty($_GET['date'])  and $_GET['date'] == 'dateLastYear' ) {
            $year = date("Y",strtotime("-1 year"));
        }else{
            $year = date('Y');
        }

        $surveyStatsCountPerMonth = SurveyStat::find()
            ->select('MONTH(survey_stat_assigned_at) as month, count(MONTH(survey_stat_assigned_at)) as count_month')
            ->where(['Year(survey_stat_assigned_at)'=> $year])
            ->andWhere($filter)
            ->groupBy('MONTH(survey_stat_assigned_at)')
            ->all();

        $usersCountPerMonth = User::find()
            ->select('MONTH(FROM_UNIXTIME(user.created_at)) as month, count(MONTH(FROM_UNIXTIME(user.created_at))) as count_month')
            ->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
            ->join('LEFT JOIN','{{%user_profile}}','{{%user_profile}}.user_id = {{%user}}.id')
            ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER])
            ->andFilterWhere(['YEAR(FROM_UNIXTIME(user.created_at))'=> $year])
            ->andWhere($this->filterByOrganization('organization_id'))
            ->groupBy('MONTH(FROM_UNIXTIME(user.created_at))')
            ->all();
        $labels = [];
        $data1 = [];
        $data2 = [];

        for ($i=1; $i <= 12; $i++) { 
            $labels[] = $this->months()[$i]; 
            $data1 [] = 0;
            $data2 [] = 0;
        }

        // foreach ($usersCountPerMonth as $key => $value) {
        //     $data1[($value->month - 1)] = $value->count_month;
        // }

        foreach ($surveyStatsCountPerMonth as $key => $value) {
            $data2[($value->month - 1)] = $value->count_month;
        }

        return ['data1'=>$data1,'data2'=>$data2,'labels'=>$labels];
    }

    private function months()
    {
        return array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
    }

}
