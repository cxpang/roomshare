<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RentForum;

/**
 * RentForumSearch represents the model behind the search form of `common\models\RentForum`.
 */
class RentForumSearch extends RentForum
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_id', 'user_id', 'forum_people_counts', 'forum_star', 'forum_check', 'created_at', 'updated_at'], 'integer'],
            [['forum_name', 'forum_content', 'forum_check_message'], 'safe'],
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
        $query = RentForum::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'forum_id' => $this->forum_id,
            'user_id' => $this->user_id,
            'forum_people_counts' => $this->forum_people_counts,
            'forum_star' => $this->forum_star,
            'forum_check' => $this->forum_check,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'forum_name', $this->forum_name])
            ->andFilterWhere(['like', 'forum_content', $this->forum_content])
            ->andFilterWhere(['like', 'forum_check_message', $this->forum_check_message]);

        return $dataProvider;
    }
}
