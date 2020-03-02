<?php

namespace api\controllers;

use Yii;

use Stevenmaguire\OAuth2\Client\Provider\Keycloak as ProviderKeyc;

class AuthController extends  RestController
{

    public function actionIndex($slug=null){

        if($slug){
            //get org info
        }

        //now fill org info
        $provider = new ProviderKeyc([
            'authServerUrl'             => "https://sso.tamkeen.land/auth",
            'realm'                     => 'tamkeen',
            'clientId'                  => 'self-asses-new',
            'clientSecret'              => 'af2604e1-1fe6-4f29-bfd3-cbcb6168a5cc',
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

                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);
                // Use these details to create a new profile
                 $name =    $user->getName();
               // printf('Hello %s!\n<br>', $user->getName());

            } catch (\Exception $e) {
                exit('Failed to get resource owner: '.$e->getMessage());
            }

            // Use this to interact with an API on the users behalf
            return ['token'=>$token->getToken() ,'owner'=>$token->getResourceOwnerId(), 'name'=>$name ,'user'=>$user->toArray()  ] ;

            //now call the profile end point

        }


    }

}
