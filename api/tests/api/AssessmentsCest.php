<?php 
namespace api\tests\api;
use api\tests\ApiTester;

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
            	'url'=>'assessments/1',
        		'code'=>200,
        		'contains'=>[
        			'pages'=>[],
        		],
    		],
    		[
            	'url'=>'assessments/2',
        		'code'=>404,
        		'contains'=>[
        			'errors'=>['message'=>'Survey not found'],
        		],
    		],
    	];
    }


    /**
	  * @dataProvider dataAnswerProvider
	*/
    protected function answerAssessments(ApiTester $I, \Codeception\Example $example)
    {
    	$I->sendPUT($example['url']);
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
            	'url'=>'assessments/33',
        		'code'=>404,
            	'data'=>[
            		"answers"=>[
				        "q-52"=>"نصي  جواب مع صورة",
				        "f-52"=>true,
				        "a-52"=>[
				            [
				                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
				                "type"=>"image/png",
				                "content"=>"http://storage.selfassest.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
				            ]
				        ],
				        "q-53"=>[
				            "115",
				            "114"
				        ],
				        "q-54"=>"116",
				        "q-55"=>[
				            [
				                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
				                "type"=>"image/png",
				                "content"=>"http://storage.selfassest.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
				            ]
				        ],
				        "q-56"=>[
				            "120"=>[
				                "rate"=>1
				            ],
				            "121"=>[
				                "rate"=>2
				            ],
				            "122"=>[
				                "rate"=>3
				            ],
				            "123"=>[
				                "rate"=>4
				            ]
				        ],
				        "q-82"=>"Done"
				    ]
            	],
        		'contains'=>[
        			'message'=>'Survey is Completed',
        		],
    		],
    	];
    }
}
