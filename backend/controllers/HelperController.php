<?php

namespace backend\controllers;

use common\models\UserProfile;
use Yii;
use backend\models\City;
use backend\models\District;
use common\models\Organization;
use backend\models\base\EventRequest;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class HelperController extends Controller
{
    //Users
    public function actionUsersList($q = null, $id = null) {
        $q = preg_replace('/\s+/', '', $q);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            //$users= User::find()
            $query = new Query();
            $query->select(' CONCAT_WS(" ", `firstname`, `lastname`) as text, {{%user_profile}}.user_id as id')
                ->from('{{%user_profile}}')
                ->where('CONCAT( `firstname`, `lastname`) LIKE  \'%'.$q.'%\'  ')
                ->limit(20);

            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => UserProfile::find($id)->fullName];
        }
        return $out;
    }

    //endpoints


    // list schools for select2 plugin
    public function actionSchoolList($q = null, $id = null) {
        $q = preg_replace('/\s+/', '', $q);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {

            $strOrderBy = 'name DESC ';

            $query = new Query();
            $query->select(' name as text, id ')
                ->from('ya_school')
                ->where('name like "%'.$q.'%"')
                ->limit(20);

            $command = $query->createCommand();
            $data = $command->queryAll();

            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Organization::findOne(['id'=>$id])->name];
        }
        return $out;
    }


    public function actionSchoolDistricts($schoolId = null) {
        $out = [];
        // return print_r($schoolId);
        if (isset($_POST['depdrop_parents']) and $_POST['depdrop_parents'][0]!= '') {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $city_id = $parents[0];
                $districts = District::find()->where(['city_id'=>$city_id])->all();
                $school = Organization::find()->where(['id'=>$schoolId])->one();
                foreach ($districts as $district) {
                    $data[]= ['id'=>$district->id, 'name'=>$district->title ];
                }

                $out = $data;
            }
        }
        return  Json::encode(['output'=>$out, 'selected'=>$school->district_id]);
    }


}
