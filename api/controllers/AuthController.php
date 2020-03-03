<?php

namespace api\controllers;

use Stevenmaguire\OAuth2\Client\Provider\Keycloak as ProviderKeyc;
use Yii;
use api\helpers\ResponseHelper;
use api\helpers\SignupForm;
use common\models\Organization;
use common\models\User;
use common\models\UserProfile;

class AuthController extends  RestController
{

    public function actionIndex($slug=null){

        if($slug){
            $_SESSION['slug'] = $slug;
        }
        $organization = Organization::findOne(['slug'=>$_SESSION['slug']]);

        $provider = new ProviderKeyc([
            'authServerUrl'             => $organization->authServerUrl,
            'realm'                     => $organization->realm,
            'clientId'                  => $organization->clientId,
            'clientSecret'              => $organization->clientSecret,
            'redirectUri'               => 'http://sahlit.com/auth',
            'encryptionAlgorithm'       => null,
            'encryptionKey'             => null,
            'encryptionKeyPath'         => null
        ]);

        //first visit go to third party provider to get code to be able to request user token
        if (!isset($_GET['code'])) {
            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: '.$authUrl);
            exit;

        // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state, make sure HTTP sessions are enabled.'. $_SESSION['slug']);
        } else {
            // Try to get an access token (using the authorization coe grant)
            try {
                $token = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
            } catch (\Exception $e) {
                exit('Failed to get access token: '.$e->getMessage());
            }

            // Optional: Now you have a token you can look up a users profile data
            try {
                unset($_SESSION['slug']);
                $siteLink = $_SERVER['REQUEST_SCHEME'] . '://'. $organization->slug .'.'. $_SERVER['SERVER_NAME'];
                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);
                // Use these details to create a new profile
                 $name  = $user->getName();
                 $email = $user->getEmail();

                $checkUser = User::find()->where(['email'=>$email])->one();
                if (!$checkUser) {
                    $model = new SignupForm();
                    if ($model->load(['SignupForm'=>[
                        'name'=> $user->getName(),
                        'email'=> $user->getEmail(),
                        'password'=> '123456',
                        'mobile'=> '0512345678',
                    ]]) && $user = $model->save($organization->id)) {
                        $token_temp = \Yii::$app->getSecurity()->generateRandomString();
                        $user = User::findOne(['id'=> $user->id]);
                        $userProfile = $user->userProfile;
                        $userProfile->temporary_token = $token_temp;
                        $userProfile->save(false);
                    }
                 }else{
                    $token_temp = \Yii::$app->getSecurity()->generateRandomString();
                    $userProfile = $checkUser->userProfile;
                    $userProfile->temporary_token = $token_temp;
                    $userProfile->save(false);
                }
                return $userProfile->temporary_token;
                // header('Location: '.$siteLink.'/login?code='.$token_temp);
                exit;

            } catch (\Exception $e) {
                exit('Failed to get resource owner: '.$e->getMessage());
            }
            // Use this to interact with an API on the users behalf
            return ['token'=>$token->getToken() ,'owner'=>$provider->realm, 'name'=>$name ,'user'=>$user->toArray()  ] ;

            //now call the profile end point

        }


    }

    public function actionChangeToken($code){
        $checkUser = UserProfile::find()->where(['temporary_token'=>$code])
            ->one();
            return var_dump($checkUser);
        if ($checkUser) {
            return ResponseHelper::sendFailedResponse(['message'=>'Not Found'],404);
        }
        $checkUser->temporary_token_used  =1;
        $checkUser->save(false);
        $user = $checkUser->user;
        $user->access_token = Yii::$app->getSecurity()->generateRandomString(40);
        $user->save(false);
        return ['token'=> $checkUser->user->access_token, 'profile'=> $checkUser->user ];

    }

}
