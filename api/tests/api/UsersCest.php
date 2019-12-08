<?php
namespace api\tests\api;

use api\tests\ApiTester;

class UsersCest
{

    function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'organization' => [
                'class' => \common\fixtures\OrganizationFixture::className(),
                'dataFile' => codecept_data_dir() . 'organization.php'
            ]
        ]);
    }

    // tests
    public function signUp(ApiTester $I)
    {
        // $I->sendPOST('/user/signup', [
        //     'name' => 'User One',
        //     'email' => 'user@org1.com',
        //     'password' => '123456',
        //     'bio' => 'About User One',
        //     'mobile' => '0519283612',
        //     'organization' => 'org1',
        // ]);
        // $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        // $I->seeResponseIsJson();
        // $I->seeResponseContains('{"success":true,"status":200,"data":{"message":"Account Created Successfully"}}');

    }


    public function LoginFail(ApiTester $I)
    {
        //$I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/login', [
            'identity' => 'user@org1.com',
            'password' => '123456',
            'locale' => 'ar'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

}

?>
