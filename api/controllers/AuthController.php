<?php

namespace api\controllers;

use Stevenmaguire\OAuth2\Client\Provider\Keycloak as ProviderKeyc;
use Yii;
use api\helpers\SignupForm;
use common\models\Organization;

class AuthController extends  RestController
{

    public function actionIndex($slug=null){

        if($slug || isset($_SESSION['slug'])){
            $organization = Organization::findOne(['slug'=>$slug]);
            $_SESSION['slug'] = $slug;
        }

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
            exit('Invalid state, make sure HTTP sessions are enabled.');
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

                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);
                // Use these details to create a new profile
                 $name  = $user->getName();
                 $email = $user->getEmail();

                $checkUser = User::find()->where(['email'])->one();
                if (!$checkUser) {
                    $model = new SignupForm();
                    if ($model->load(['SignupForm'=>[
                        'name'=> $user->getName(),
                        'email'=> $user->getEmail(),
                        'password'=> 123456,
                        'mobile'=> 0512345678,
                    ]]) && $user = $model->save($organization->id)) {
                        $user= User::findOne(['id'=> $user->id]);
                        return ResponseHelper::sendSuccessResponse(['message'=>Yii::t('common','Account Created Successfully')]);
                    }
                }else{
                    return ['token_temp'=>'temp token!'];
                }

            } catch (\Exception $e) {
                exit('Failed to get resource owner: '.$e->getMessage());
            }
            // Use this to interact with an API on the users behalf
            return ['token'=>$token->getToken() ,'owner'=>$provider->realm, 'name'=>$name ,'user'=>$user->toArray()  ] ;

            //now call the profile end point

        }


    }

}
