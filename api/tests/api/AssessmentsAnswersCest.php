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
      * @dataProvider dataAnswerProvider
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
                    'message'=>'Survey not found', // not found because assessment id not exist
                ],
            ],
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
                    'errors'=>['message'=>'Forbidden'], // Forbidden because this question not allowed attach file
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-1"=>"نصي  جواب",
                    ],
                ],
                'contains'=>[
                    'success'=>true,
                ],
            ],
            // check update exist answer
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-1"=>"نصي",
                    ],
                ],
                'contains'=>[
                    'success'=>true,
                ],
            ],
        ];
    }
}
