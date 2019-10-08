<?php

namespace api\resources;

class User extends \common\models\User
{
    public function fields()
    {
        return [
            'id'=>function($model){
                 return $model->id;
              },
            'status'=>function($model){
                return  ['id'=>$model->status,'title'=> self::statuses()[$model->status] ] ;
            },
            'type'=>function($model){

               if(array_keys(\Yii::$app->authManager->getRolesByUser($model->id))[0] != User::ROLE_TRAINER ){
                   return ['id'=>0,'title'=>'parent'];
               }else{
                   return  ['id'=>1 , 'title'=>'trainer'] ;
               }

            },
            'firstname'=>function($model){
                return $model->userProfile->firstname ;
            },
            'lastname'=>function($model){
                return $model->userProfile->lastname ;
            },


            'phone'=>function($model){
                return  [ $model->prefix , $model->username] ;
            },

//
//            'sportsType'=>function($model){
//
//                if($model->userProfile->sportsType > 0){
//                    return ['id'=>$model->userProfile->sportsType,'title'=>$model->userProfile->sport->title];
//                }else{
//                    return  [] ;
//                }
//
//            },



//            'token'=>function($model){
//                return $model->access_token;
//            },

//            'image'=>function($model){
//                return   $model->userProfile->avatar?:"" ;
//            },

        ];
    }


}
