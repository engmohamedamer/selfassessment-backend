<?php 
namespace api\controllers;
use api\helpers\ImageHelper;
use api\helpers\ResponseHelper;
use backend\modules\assessment\models\SurveyQuestion;
use common\models\SurveyUserAnswerAttachments;

class MediaController extends  MyActiveController
{
    public $modelClass = SurveyUserAnswerAttachments::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        return $actions;
    }
	public function actionCreate()
	{
        $params = \Yii::$app->request->post();
        return var_dump($params,$_FILES);
        $files= $params['files'];
        $questionId= $params['question_id'];
        $question = SurveyQuestion::findOne(['survey_question_id'=>$questionId]);

        if(!$question) return ResponseHelper::sendFailedResponse(['data'=>"Wrong Question"],'400');
        if ($files) {
            foreach ($files as $file){
                $uploaddir = \Yii::getAlias('@storage'). '/web/source/answers';
				$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

				echo '<pre>';
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				    echo "File is valid, and was successfully uploaded.\n";
				} else {
				    echo "Possible file upload attack!\n";
				}

                if(isset($file['type']) && $file['type']  == 'application/pdf' ){
		            $filename = ImageHelper::Base64IPdfConverter($file['content'],'answers');

		        }else{
		            $filename = ImageHelper::Base64IMageConverter($file['content'],'answers');
		        }
                if($filename){
                    $fileObj= new SurveyUserAnswerAttachments();
                    $fileObj->survey_user_answer_attachments_user_id = \Yii::$app->user->identity->getId();
                    $fileObj->survey_user_answer_attachments_survey_id = $question->survey_question_survey_id ;
                    $fileObj->survey_user_answer_attachments_question_id = $question->survey_question_id ;
                    $fileObj->path = 'answers/'.$filename;
                    $fileObj->base_url= $path;
                    $fileObj->name = $file['meta']['name']? : $filename;
                    $fileObj->meta = $params['attachmentType'];
                    $fileObj->save();
                }
            }
            return ResponseHelper::sendSuccessResponse(['message'=>'Created'], 200);

        }else{
            return ResponseHelper::sendFailedResponse(['role'=>"Invalid Data"],'403');
        }
        return var_dump($params);
	}

}



