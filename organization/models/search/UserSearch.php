<?php

namespace organization\models\search;

use common\models\OrganizationStructure;
use common\models\User;
use common\models\UserProfile;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{

    public $user_role;
    public $SearchFullName;

    public $organization_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['created_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['created_at'], 'default', 'value' => null],
            [['username', 'auth_key', 'password_hash', 'email','SearchFullName'], 'safe'],
            ['user_role','string'],
            [['user_role','organization_id'],'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params, $limit = 0)
    {

        $query = User::find();
        if ($limit) {
            $query->limit($limit);
        }
        $query->joinWith(['userProfile'])->where(['organization_id'=>$this->organization_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => false,
        ]);

        if (!($this->load($params) && $this->validate())) {
            //return $dataProvider;
        }

        if($this->SearchFullName){
            $query->andFilterWhere([
                    'id' => $this->SearchFullName
                ]
            );
        }

        if($this->user_role){
            $query->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')
                ->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => $this->user_role])->andFilterWhere(['!=','{{%user}}.id', \Yii::$app->user->identity->id]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);


        if ($this->created_at !== null) {
            $query->andFilterWhere(['between', 'created_at', $this->created_at, $this->created_at + 3600 * 24]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'email', $this->email]);

        if(! \Yii::$app->user->can('administrator')) {
            $query->andFilterWhere(['>', 'id', 1]);  //super admin
        }
        return $dataProvider;
    }

    public static function users($organization_id)
    {
        $query = User::find()->select(['id','CONCAT(`firstname`, " ", `lastname`) as name']);
        

        $sector_id = \Yii::$app->user->identity->userProfile->sector_id;
        if ($sector_id) {
            // return $sector_id;
            $str = OrganizationStructure::findOne($sector_id);
            $structure = OrganizationStructure::find()->where(['root'=>$str->root])->andWhere(['>=','lvl',$str->lvl])->addOrderBy('root, lft')->all();
            // $structure = OrganizationStructure::find()->select('id')->where(['root'=>$sector_id])->all();
            $ids = [];
            foreach ($structure as $value) {
                $ids[] = $value->id;
            }
            // return $ids;
            $query->joinWith(['userProfile'])->andwhere(['organization_id'=>$organization_id])->andWhere(['in','sector_id',$ids]);
        }else{
            $query->joinWith(['userProfile'])->where(['organization_id'=>$organization_id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => false,
        ]);

        $query->join('LEFT JOIN','{{%rbac_auth_assignment}}','{{%rbac_auth_assignment}}.user_id = {{%user}}.id')->andFilterWhere(['{{%rbac_auth_assignment}}.item_name' => User::ROLE_USER])->andFilterWhere(['!=','{{%user}}.id', \Yii::$app->user->identity->id]);

        return $dataProvider->getModels();
    }
}
