<?php

namespace common\models;

use Yii;
use \common\models\base\Organization as BaseOrganization;

/**
 * This is the model class for table "organization".
 */
class Organization extends BaseOrganization
{
    public $save_exit;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return 
	    [
            [['contact_email','email'],'email'],
            [['contact_phone','phone'], 'match', 'pattern' => '/^(009665|9665|\+9665|\+9661|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/' ,'message'=>Yii::t('common','Enter valid phone')],

            [['name','slug','business_sector', 'address', 'phone', 'email', 'conatct_name', 'contact_phone', 'contact_email', 'contact_position','first_image','second_image','about'], 'required'],
            [['postalbox','postalcode','mobile'], 'number'],
            [['city_id', 'district_id', 'limit_account'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['business_sector', 'conatct_name', 'contact_position'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['phone', 'mobile'], 'string', 'max' => 20],
            [['first_image_base_url', 'first_image_path', 'second_image_base_url', 'second_image_path'], 'string', 'max' => 1024],
            [['first_image','second_image','status','save_exit'],'safe'],
            ['slug','unique'],
            
        ];
    }
	
}
