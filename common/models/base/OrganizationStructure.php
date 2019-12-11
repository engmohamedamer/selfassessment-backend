<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "organization_structure".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 * @property integer $child_allowed
 */
class OrganizationStructure extends \kartik\tree\models\Tree
{

    public function __construct(){
        parent::__construct();
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['root', 'lft', 'rgt', 'lvl'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 255],
            [['icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_structure';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'root' => Yii::t('common', 'Root'),
            'lft' => Yii::t('common', 'Lft'),
            'rgt' => Yii::t('common', 'Rgt'),
            'lvl' => Yii::t('common', 'Lvl'),
            'name' => Yii::t('common', 'Name'),
            'icon' => Yii::t('common', 'Icon'),
            'icon_type' => Yii::t('common', 'Icon Type'),
            'active' => Yii::t('common', 'Active'),
            'selected' => Yii::t('common', 'Selected'),
            'disabled' => Yii::t('common', 'Disabled'),
            'readonly' => Yii::t('common', 'Readonly'),
            'visible' => Yii::t('common', 'Visible'),
            'collapsed' => Yii::t('common', 'Collapsed'),
            'movable_u' => Yii::t('common', 'Movable U'),
            'movable_d' => Yii::t('common', 'Movable D'),
            'movable_l' => Yii::t('common', 'Movable L'),
            'movable_r' => Yii::t('common', 'Movable R'),
            'removable' => Yii::t('common', 'Removable'),
            'removable_all' => Yii::t('common', 'Removable All'),
            'child_allowed' => Yii::t('common', 'Child Allowed'),
        ];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    // public function behaviors()
    // {
    //     return array_merge(parent::behaviors(), [
    //         'timestamp' => [
    //             'class' => TimestampBehavior::className(),
    //             'createdAtAttribute' => 'created_at',
    //             'updatedAtAttribute' => 'updated_at',
    //             'value' => new \yii\db\Expression('NOW()'),
    //         ],
    //         'blameable' => [
    //             'class' => BlameableBehavior::className(),
    //             'createdByAttribute' => 'created_by',
    //             'updatedByAttribute' => 'updated_by',
    //         ],
    //     ]);
    // }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \common\models\query\OrganizationStructureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrganizationStructureQuery(get_called_class());
    }
}
