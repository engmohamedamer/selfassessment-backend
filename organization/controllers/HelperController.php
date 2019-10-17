<?php

namespace organization\controllers;

use Yii;
use common\models\User;
use common\models\UserProfile;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

/**
 * SchoolsController implements the CRUD actions for Schools model.
 */
class HelperController extends Controller
{
    //Users
    public function actionUsersList($q = null, $id = null) {
        $q = preg_replace('/\s+/', '', $q);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select(' CONCAT_WS(" ", `firstname`, `lastname`) as text, {{%user_profile}}.user_id as id')
                ->from('{{%user_profile}}')
                ->where('CONCAT( `firstname`, `lastname`) LIKE  \'%'.$q.'%\'  ')->andWhere(['organization_id'=>Yii::$app->user->identity->userProfile->organization_id]);
    
            $query->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user_profile}}.user_id')
                ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER]);

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


}
