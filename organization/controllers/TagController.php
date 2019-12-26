<?php

namespace organization\controllers;

use yii\web\Controller;
use common\models\Tag;
use sjaakp\taggable\TagSuggestAction;

class TagController extends Controller	{

    public function actions()    {
        return [
            'suggest' => [
                'class' => TagSuggestAction::class,
                'tagClass' => Tag::class,
            ],
        ];
    }
}