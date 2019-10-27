<?php

namespace api\controllers;


use api\resources\SurveyResource;


class AssessmentsController extends  MyActiveController
{
    public $modelClass = SurveyResource::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);

        return $actions;
    }



}
