<?php

namespace api\controllers;

use api\helpers\ResponseHelper;
use api\resources\User;


class ProfileController extends  RestController
{

    public $enableCsrfValidation = false;

    public function actionIndex(){

        $resource = new User();
        $resource->load(\Yii::$app->user->getIdentity()->attributes, '');

        $profile = User::findOne(['username'=>$resource->username]);

        //return ResponseHelper::sendSuccessResponse($profile);
        return  ['status'=>1 , 'profile'=>$profile] ;
    }

    public function actionUpdate(){

        $params = \Yii::$app->request->post();

        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        $profile=$user->userProfile;

        if (isset($params['firstname'])) $profile->firstname= $params['firstname'] ;
        if (isset($params['lastname'])) $profile->lastname= $params['lastname'] ;
        if (isset($params['device_token'])) $profile->device_token= $params['device_token'] ;

        if (isset($params['binary'] )  &&  $params['binary']!= "" ){
//            $filename = Media::PrepareImage($params['binary'] );
//            $profile->image ='/uploads/profile/'.$filename ;
        }

        if(isset($params['phone'][0]) && isset($params['phone'][1])){

            $profile->mobile =  $params['phone'][0] . $params['phone'][1] ;
        }


        //var_dump($params);

        if($profile->save() && $user->save()){  //$user->save() &&

            return ['status'=>1 , 'profile'=>$user ];

        }else{

            return ['status'=>0 , 'message'=>'Invalid Data','errors'=> array_merge($profile->errors,$user->errors) ];
        }


    }



}