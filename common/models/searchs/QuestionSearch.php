<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use common\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `common\models\Question`.
 *
 * @property int         id
 * @property string      name        Вопрос
 * @property int         active      Активно
 * @property int         created_at  Створено
 * @property int|null    updated_at  Змінено
 */
class QuestionSearch extends Model {

    public $id;
    public $name;
    public $active;
    public $created_at;
    public $updated_at;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', ], 'safe'],
            [['active', ], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = static::getQueryList();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'self.id' => $this->id,
            'self.active' => $this->active,
            'self.created_at' => $this->created_at,
            'self.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'self.name', $this->name])
            ->andFilterWhere(['like', 'self.description', $this->description])
        ;

        return $dataProvider;
    }



    /**
     * @return ActiveQuery
     */
    public static function getQueryList() {
        return Question::find()
            ->select([
                'self.*',
            ])
            ->alias('self')
        ;
    }
}
