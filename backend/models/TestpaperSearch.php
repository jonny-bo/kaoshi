<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Testpaper;

/**
 * TestpaperSearch represents the model behind the search form about `backend\models\Testpaper`.
 */
class TestpaperSearch extends Testpaper
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'limitedTime', 'itemCount', 'createdUserId', 'createdTime', 'updatedUserId', 'updatedTime', 'copyId'], 'integer'],
            [['name', 'description', 'pattern', 'target', 'status', 'metas'], 'safe'],
            [['score', 'passedScore'], 'number'],
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
        $query = Testpaper::find();

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
            'id' => $this->id,
            'limitedTime' => $this->limitedTime,
            'score' => $this->score,
            'passedScore' => $this->passedScore,
            'itemCount' => $this->itemCount,
            'createdUserId' => $this->createdUserId,
            'createdTime' => $this->createdTime,
            'updatedUserId' => $this->updatedUserId,
            'updatedTime' => $this->updatedTime,
            'copyId' => $this->copyId,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'pattern', $this->pattern])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'metas', $this->metas]);

        return $dataProvider;
    }
}
