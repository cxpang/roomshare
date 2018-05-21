<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RentStory;

/**
 * RentStorySearch represents the model behind the search form of `common\models\RentStory`.
 */
class RentStorySearch extends RentStory
{
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'story_name', 'support_counts', 'love_counts', 'create_at', 'is_star'], 'integer'],
            [['story_text'], 'safe'],
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
        $query = RentStory::find();
        $query->joinWith(['user']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>6], //分页

        ]);

        $dataProvider->setSort([
            'attributes' => [
                'user_id',
                'story_name',
                'support_counts',
                'love_counts',
                'is_star',
                'user_name' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                    'label' => 'UserName'
                ],

                /*=============*/
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'story_name' => $this->story_name,
            'support_counts' => $this->support_counts,
            'love_counts' => $this->love_counts,
            'create_at' => $this->create_at,
            'is_star' => $this->is_star,
        ]);

        $query->andFilterWhere(['like', 'story_text', $this->story_text]);
        $query->andFilterWhere(['like', 'user.username', $this->user_name]) ;
        return $dataProvider;
    }
}
