<?php
namespace api\tests\api;

use api\tests\ApiTester;

class ThemeCest
{


    function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'organization' => [
                'class' => \common\fixtures\OrganizationFixture::className(),
                'dataFile' => codecept_data_dir() . 'organization.php'
            ],
            'organizationTheme' => [
                'class' => \common\fixtures\OrganizationThemeFixture::className(),
                'dataFile' => codecept_data_dir() . 'organization_theme.php'
            ],
            'organizationFooterLinks' => [
                'class' => \common\fixtures\OrganizationThemeFooterLinks::className(),
                'dataFile' => codecept_data_dir() . 'organization_footer_links.php'
            ]
        ]);
    }

    public function testTheme(ApiTester $I)
    {
        $I->sendPOST('/theme?org=org1', []);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        //$I->seeResponseContains(['status'=>\Codeception\Util\HttpCode::NOT_FOUND]);

    }


}

?>
