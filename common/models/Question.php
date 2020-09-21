<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "question".
 *
 * @property int         id
 * @property string      name        Вопрос
 * @property int         active      Активно
 * @property int         created_at  Створено
 * @property int|null    updated_at  Змінено
 */
class Question extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'question';
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

    public function transactions(): array {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],

            [['name'], 'string', 'max' => 255],
            [['active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id'          => 'ID',
            'name'        => 'Вопрос',
            'active'      => 'Активно',
            'created_at'  => 'Создано',
            'updated_at'  => 'Изменено',
        ];
    }

    /**
     * Все ответы
     *
     * @return ActiveQuery
     */
    public function getAnswers(): ActiveQuery {
        return $this->hasMany(Answer::class, ['question_id' => 'id']);
    }
}
