<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Room;

/**
 * RoomSearch represents the model behind the search form of `common\models\Room`.
 */
class RoomSearch extends Room
{
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'user_id', 'room_type', 'room_price', 'room_city', 'room_area', 'add_time', 'update_time', 'answer_counts', 'answer_users', 'focus_count', 'comment_count', 'is_essence', 'is_comment','is_over','is_check'], 'integer'],
            [['room_name', 'room_content', 'room_detail', 'room_images', 'room_address','user_name'], 'safe'],
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
        $query = Room::find();
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>6], //分页
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'room_id',
                'user_id',
                'room_type',
                'room_name',
                'room_price',
                'room_city',
                'room_area',
                'room_address',
                'focus_count',
                'comment_count',
                'room_images',
                'add_time',
                'is_comment',
                'is_over',
                'is_check',
                'is_essence',
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
            'room_id' => $this->room_id,
            'user_id' => $this->user_id,
            'room_type' => $this->room_type,
            'room_price' => $this->room_price,
            'room_city' => $this->room_city,
            'room_area' => $this->room_area,
            'add_time' => $this->add_time,
            'update_time' => $this->update_time,
            'answer_counts' => $this->answer_counts,
            'answer_users' => $this->answer_users,
            'focus_count' => $this->focus_count,
            'comment_count' => $this->comment_count,
            'is_essence' => $this->is_essence,
            'is_comment' => $this->is_comment,
            'is_over'=>$this->is_over,
            'is_check'=>$this->is_check,
        ]);

        $query->andFilterWhere(['like', 'room_name', $this->room_name])
            ->andFilterWhere(['like', 'room_content', $this->room_content])
            ->andFilterWhere(['like', 'room_detail', $this->room_detail])
            ->andFilterWhere(['like', 'room_address', $this->room_address]);
        $query->andFilterWhere(['like', 'user.username', $this->user_name]) ;

        return $dataProvider;
    }
}
