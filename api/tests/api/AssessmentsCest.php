<?php 
namespace api\tests\api;
use api\tests\ApiTester;
use common\fixtures\AssessmentQuestionsFixture;

class AssessmentsCest
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
            'assessmentsStats' => [
                'class' => \common\fixtures\AssessmentsStatsFixture::className(),
                'dataFile' => codecept_data_dir() . 'assessments_stats.php'
            ],
            'assessmentsQuestion' => [
                'class' => \common\fixtures\AssessmentQuestionsFixture::className(),
                'dataFile' => codecept_data_dir() . 'asessment_questions.php'
            ],
        ]);
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
    }

    // tests
    public function list(ApiTester $I)
    {
    	$I->sendGET('assessments');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
        	'items'=>[
                [
                    'id'=>5,
                    'isClosed'=> false,
                    'status'=> 1,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-28 13:50:00',
                ],
                [
                    'id'=>4,
                    'isClosed'=> false,
                    'status'=> 2,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-28 13:50:00',
                ],
                [
                    'id'=>3,
                    'isClosed'=> true,
                    'status'=> 0,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-01 13:50:00',
                ],
                [
                    'id'=>2,
                    'isClosed'=> true,
                    'status'=> 0,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-26 13:50:00',
                ],
                [
                    'id'=>1,
                    'isClosed'=> false,
                    'status'=> 0,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-26 13:50:00',
                ]
        	],
    	]);
    	// $this->assessment = $I->grabDataFromResponseByJsonPath('$.items..id');
    }

    /**
	  * @dataProvider dataViewProvider
	*/
    public function view(ApiTester $I, \Codeception\Example $example)
    {
    	$I->sendGET($example['url']);
        $I->seeResponseCodeIs($example['code']);
        $I->seeResponseContainsJson($example['contains']);
    }

    /**
     * @return array
    */
    protected function dataViewProvider() 
    {
    	return [
            [
                'url'=>'assessments/1000',
                'code'=>404,
                'contains'=>[
                    'errors'=>['message'=>'Survey not found'],
                ],
            ],
    		[
            	'url'=>'assessments/1',
        		'code'=> 200,
        		'contains'=>[
        			'pages'=>[],
        		],
    		],
    		[
            	'url'=>'assessments/2',
        		'code'=> 403,
        		'contains'=>[
        			'errors'=>['message'=>'Forbidden'],
        		],
    		],
            [
                'url'=>'assessments/3',
                'code'=> 403,
                'contains'=>[
                    'errors'=>['message'=>'Forbidden'],
                ],
            ],
            [
                'url'=>'assessments/4',
                'code'=> 403,
                'contains'=>[
                    'errors'=>['message'=>'Forbidden'],
                ],
            ],
            [
                'url'=>'assessments/5',
                'code'=> 200,
                'contains'=>[
                    'pages'=>[],
                ],
            ],
            
    	];
    }


    /**
	  * @dataProvider dataAnswerProvider
	*/
    public function answerAssessments(ApiTester $I, \Codeception\Example $example)
    {
    	$I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataAnswerProvider() 
    {
    	return [
    		[
            	'url'=>'assessments/1000',
        		'code'=>404,
            	'data'=>[
            		"answers"=>[
				        "q-1"=>"نصي  جواب مع صورة",
				        "f-1"=>true,
				        "a-1"=>[
				            [
				                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
				                "type"=>"image/png",
				                "content"=>"http://storage.selfassest.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
				            ],
				        ],
                    ],
            	],
                'contains'=>[
                    'message'=>'Survey not found',
                ],
    		],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-1"=>"نصي  جواب مع صورة",
                        "f-1"=>true,
                        "a-1"=>[
                            [
                                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
                                "type"=>"image/png",
                                "content"=>"http://storage.selfassest.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'success'=>true,
                ],
            ],
    	];
    }
}
