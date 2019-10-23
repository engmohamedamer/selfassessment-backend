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
    public $theme;
    public $themeFooterLinks;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('@common/views/organization/_form', [
           'model' => $this->model,
           'theme' => $this->theme,
           'themeFooterLinks' => $this->themeFooterLinks,
        ]);
    }
}
