<?php

namespace common\models;

use Yii;
use \common\models\base\Organization as BaseOrganization;

/**
 * This is the model class for table "organization".
 */
class Organization extends BaseOrganization
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name','name_en','business_sector', 'address', 'phone', 'email', 'conatct_name', 'contact_phone', 'contact_email', 'contact_position','first_image','second_image'], 'required'],
            [['city_id', 'district_id', 'limit_account'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['business_sector', 'email', 'conatct_name', 'contact_email', 'contact_position'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['phone', 'mobile', 'contact_phone'], 'string', 'max' => 20],
            [['first_image_base_url', 'first_image_path', 'second_image_base_url', 'second_image_path'], 'string', 'max' => 1024],
            [['first_image','second_image','status'],'safe'],
        ]);
    }
	
}
