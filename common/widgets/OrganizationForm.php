<?php

namespace common\widgets;

use Yii;
use yii\base\Widget;

/**
 * Class DbText
 * Return a text block content stored in db
 * @package common\widgets\text
 */
class OrganizationForm extends Widget
{
    public $model;
    public function init()
    {
        parent::init();
        if ($this->model === null) {
            $this->model = 'School Edit Form View';
        }
    }

    public function run()
    {
        return $this->render('@common/views/organization/_form', [
           'model' => $this->model,
        ]);
    }
}
