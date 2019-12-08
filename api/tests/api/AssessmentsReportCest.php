<?php 
namespace api\tests\api;
use api\tests\ApiTester;

class AssessmentsReportCest
{

	public function _before(ApiTester $I)
    {
        $I->haveFixtures([
        	'user' => [
                'class' => \common\fixtures\UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'assessments' => [
                'class' => \common\fixtures\AssessmentFixture::className(),
                'dataFile' => codecept_data_dir() . 'assessments.php'
            ],
        ]);
    }

    /**
	  * @dataProvider dataReportProvider
	*/
    protected function report(ApiTester $I, \Codeception\Example $example)
    {
    	$I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
    	$I->sendPUT($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataReportProvider() 
    {
    	return [
    		[
            	'url'=>'assessments/report/1',
        		'code'=>200,
        		'contains'=>[
        			'data'=>[
        				'generalInfo'=>[]
        			],
        		],
    		],
    		[
            	'url'=>'assessments/report/2',
        		'code'=>404,
        		'contains'=>[
        			'errors'=>[
        				'message'=>'Survey not found'
        			],
        		],
    		],
    	];
    }
}
