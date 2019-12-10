<?php 
namespace api\tests\api;
use api\tests\ApiTester;
use common\fixtures\AssessmentQuestionAnswersFixture;
use common\fixtures\AssessmentQuestionsFixture;

class AssessmentsAnswersCest
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
            'assessmentsQuestionAnswers' => [
                'class' => \common\fixtures\AssessmentQuestionAnswersFixture::className(),
                'dataFile' => codecept_data_dir() . 'asessment_questions_answers.php'
            ],
        ]);
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
    }

    /**
      * @dataProvider dataProvider
    */
    public function answer(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProvider() 
    {
        return [
            [
                'url'=>'assessments/1000',
                'code'=>404,
                'data'=>[
                ],
                'contains'=>[
                    'message'=>'Assessment not found', // not found because assessment id does not exist
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Invalid Params'], // because answer empty or not sent
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataQuestion1Provider
    */
    public function answerQuestion1(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataQuestion1Provider() 
    {
        return [
            [
                'url'=>'assessments/1',
                'code'=>403,
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
                    'errors'=>['message'=>'Forbidden'], // forbidden because this question not allowed attach file
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-1"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not allowe array answers
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-1"=>"Text",
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataQuestion2Provider
    */
    public function answerQuestion2(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataQuestion2Provider() 
    {
        // Multiple choice id -> 1
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-2"=> [
                        ],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Invalid Params'], // bad request because this question not allowe array answers - * you change it to success after fix remove answer from body request
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-2"=>[4,5,6],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not have answers ids sent
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-2"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataQuestion3Provider
    */
    public function answerQuestion3(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataQuestion3Provider() 
    {
        // One choise of list -> 2
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-3"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-3 not allowed array type
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-3"=>3,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-3 not have answer id 3
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-3"=>6,
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],

        ];
    }

    /**
      * @dataProvider dataQuestion4Provider
    */
    public function answerQuestion4(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataQuestion4Provider() 
    {
        // Dropdown -> 3
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-4"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-4 not allowed array type
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-4"=>3,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-4 not have answer id 3
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-4"=>9,
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],

        ];
    }


    /**
      * @dataProvider dataQuestion5Provider
    */
    public function answerQuestion5(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataQuestion5Provider() 
    {
        // Ranking -> 4
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-5"=>1,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-5 allowed array type
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-2"=>[4,5,6],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not have answers ids sent
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-5"=>[
                            9=>[
                                'rate'=>1
                            ],
                            10=>[
                                'rate'=>1
                            ],
                            11=>[
                                'rate'=>1
                            ],
                            12=>[
                                'rat'=>1
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because key {rat} not allowed
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-5"=>[
                            9=>[
                                'rate'=>1
                            ],
                            10=>[
                                'rate'=>1
                            ],
                            11=>[
                                'rate'=>1
                            ],
                            12=>[
                                'rate'=>1
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],

        ];
    }
}
