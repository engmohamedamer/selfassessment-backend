<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Organization;

/**
 * common\models\OrganizationSearch represents the model behind the search form about `common\models\Organization`.
 */
 class OrganizationSearch extends Organization
{
    public $from;
    public $to;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'district_id', 'limit_account', 'updated_at'], 'integer'],
            [['name', 'business_sector', 'address', 'email', 'phone', 'mobile', 'conatct_name', 'contact_email', 'contact_phone', 'contact_position', 'first_image_base_url', 'first_image_path', 'second_image_base_url', 'second_image_path','from','to'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Organization::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder'=> ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'limit_account' => $this->limit_account,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['BETWEEN', 'DATE(FROM_UNIXTIME(created_at))',$this->from, date('Y-m-d', strtotime("+1 day", strtotime($this->to)))])
            ->andFilterWhere(['like', 'business_sector', $this->business_sector])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'conatct_name', $this->conatct_name])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'contact_position', $this->contact_position])
            ->andFilterWhere(['like', 'first_image_base_url', $this->first_image_base_url])
            ->andFilterWhere(['like', 'first_image_path', $this->first_image_path])
            ->andFilterWhere(['like', 'second_image_base_url', $this->second_image_base_url])
            ->andFilterWhere(['like', 'second_image_path', $this->second_image_path]);

        return $dataProvider;
    }
}
