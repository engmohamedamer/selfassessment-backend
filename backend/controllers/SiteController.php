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
        $organizations = Organization::find()->orderBy('id desc')->limit(6)->all();

        $surveyStatsCountPerMonth = SurveyStat::find()->select('MONTH(survey_stat_assigned_at) as month, count(MONTH(survey_stat_assigned_at)) as count_month')->where(['Year(survey_stat_assigned_at)'=>date('Y')])->groupBy('MONTH(survey_stat_assigned_at)')->all();

        $usersCountPerMonth = User::find()->select('MONTH(FROM_UNIXTIME(user.created_at)) as month, count(MONTH(FROM_UNIXTIME(user.created_at))) as count_month')->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
        ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER])->andFilterWhere(['YEAR(FROM_UNIXTIME(user.created_at))'=>date('Y')])->groupBy('MONTH(FROM_UNIXTIME(user.created_at))')->all();

        $labels = [];
        $data1 = [];
        $data2 = [];
        $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
        for ($i=1; $i <= date('m'); $i++) { 
            $labels [] = $months[$i]; 
            $data1 [] = 0;
            $data2 [] = 0;
        }

        foreach ($usersCountPerMonth as $key => $value) {
            $data1[($value->month - 1)] = $value->count_month;
        }
        foreach ($surveyStatsCountPerMonth as $key => $value) {
            $data2[($value->month - 1)] = $value->count_month;
        }

        $surveyCount = Survey::find()->count();
        $surveyStatsCount = SurveyStat::find()->count();
        $surveyCurrentMonth = Survey::find()->where(['MONTH(survey_created_at)'=>date('m')])->count();
        $surveyLastMonth = Survey::find()->where(['MONTH(survey_created_at)'=> date("m", strtotime("last month")) ])->count();
        if ($surveyCurrentMonth > $surveyLastMonth ) {
            $assessmentStatus = 'ion-android-arrow-up';
        }else{
            $assessmentStatus = 'ion-android-arrow-down';
        }

        $user = User::find()->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
                ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER]);
        $userCount = $user->count();
        return $this->render('dashboard',compact('organizations','surveyCount','surveyCurrentMonth','surveyLastMonth','assessmentStatus','userCount','surveyStatsCount','labels','data1','data2'));
    }

}
