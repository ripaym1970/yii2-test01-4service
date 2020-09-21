<?php

namespace common\models\searchs;

use common\models\Question;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use common\models\Answer;

/**
 * AnswerSearch represents the model behind the search form about `common\models\Answer`.
 *
 * @property int      $id
 * @property string   respondent_name    Имя
 * @property string   respondent_email   E-mail
 * @property string   respondent_comment Комментарий
 * @property int      question_id        Вопрос
 * @property int      question_name      Вопрос
 * @property int      question_rate      Ответ
 * @property int      active             Активно
 * @property int      created_at         Створено
 * @property int|null updated_at         Змінено
 */
class AnswerSearch extends Model {

    public $id;
    public $respondent_name;
    public $respondent_email;
    public $respondent_comment;
    public $question_id;
    public $question_name;
    public $question_rate;
    public $active;
    public $created_at;
    public $updated_at;
    public $range_created_at;


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'question_rate',], 'integer'],
            [['respondent_name', 'respondent_email', 'respondent_comment', 'question_name', 'question_id', 'range_created_at', 'created_at', 'updated_at',], 'safe'],
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
        //dd($query->asArray()->all());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'respondent_name',
                    'respondent_email',
                    'respondent_comment',
                    'question_name',
                    'question_id',
                    'question_rate',
                ],
                'defaultOrder' => ['id' => SORT_DESC],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'self.id'            => $this->id,
            'self.question_rate' => $this->question_rate,
            'self.active'        => $this->active,
            'self.created_at'    => $this->created_at,
            'self.updated_at'    => $this->updated_at,
        ]);

        if (is_numeric($this->question_id)) {
            $query->andWhere(['self.question_id' => $this->question_id]);
        } else {
            $query->andFilterWhere(['like', 'qu.name', $this->question_id]);
        }

        if ($this->range_created_at) {
            [$d1, $d2] = explode(' - ', $this->range_created_at);
            $query->andFilterWhere([
                '>=', 'self.created_at', strtotime($d1.' 00:00:00')
            ]);
            $query->andFilterWhere([
                '<=', 'self.created_at', strtotime($d2.' 24:00:00')
            ]);
        }

        $query->andFilterWhere(['like', 'self.respondent_name', $this->respondent_name])
            ->andFilterWhere(['like', 'self.respondent_email', $this->respondent_email])
            ->andFilterWhere(['like', 'self.respondent_comment', $this->respondent_comment])
            ->andFilterWhere(['like', 'self.question_name', $this->question_name])
        ;

        return $dataProvider;
    }



    /**
     * @return ActiveQuery
     */
    public static function getQueryList() {
        return Answer::find()
            ->alias('self')
            ->select([
                'self.*',
                'question_name' => 'qu.name',
            ])
            ->leftJoin(
                ['qu' => Question::tableName()],
                'qu.id = self.question_id'
            );
    }
}
