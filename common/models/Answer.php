<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "answer".
 *
 * @property int      id
 * @property string   respondent_name    Имя
 * @property string   respondent_email   E-mail
 * @property string   respondent_comment Комментарий
 * @property int      question_id        Вопрос
 * @property int      question_rate      Ответ
 * @property int      active             Активно
 * @property int      created_at         Створено
 * @property int|null updated_at         Змінено
 *
 * @property Question question
 */
class Answer extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'answer';
    }

    /**
     * @return array
     */
    public function behaviors(): array {
        return [
            // При добавлении записи задается только created_at, а при редактировании только updated_at
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['respondent_name', 'respondent_email', 'respondent_comment', 'question_id', 'question_rate',], 'required'],

            [['respondent_name','respondent_email',], 'string', 'max' => 255],
            [['respondent_email'], 'email'],
            [['respondent_comment'], 'string'],
            [['question_id', 'question_rate',], 'integer'],
            [['active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id'                 => 'ID',
            'respondent_name'    => 'Имя',
            'respondent_email'   => 'E-mail',
            'respondent_comment' => 'Комментарий',
            'question_id'        => 'Вопрос',
            'question_name'      => 'Вопрос',
            'question_rate'      => 'Ответ',
            'active'             => 'Активно',
            'created_at'         => 'Создано',
            'updated_at'         => 'Изменено',
        ];
    }

    /**
     * Вопрос к ответу
     *
     * @return ActiveQuery
     */
    public function getQuestion(): ActiveQuery {
        return $this->hasOne(Question::class, ['id' => 'question_id']);
    }
}
