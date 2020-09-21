<?php

use yii\db\Expression;
use yii\db\Migration;

class m200907_141609_create_table_question extends Migration {

    public $newTableName = 'question';

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $newTableName = $this->newTableName;
        if ($this->db->driverName === 'pgsql') {
            $newTableName = Yii::$app->params['schema'] . '.' . $newTableName;
        }

        $this->createTable($newTableName, [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull()->comment('Название'),

            'active'     => $this->boolean()->notNull()->defaultValue(true)->comment('Активно'),
            'created_at' => $this->integer()->notNull()->defaultValue(new Expression("NOW()"))->comment('Создано'),
            'updated_at' => $this->integer()->comment('Изменено'),
        ], $tableOptions . ' COMMENT="Вопросы"');

        $this->batchInsert($newTableName,
            ['id', 'name', 'active', 'created_at', 'updated_at'],
            [
                [1, 'Первый вопрос', true, time(), NULL],
                [2, 'Второй вопрос', true, time(), NULL],
            ]
        );
    }

    public function down() {
        $newTableName = $this->newTableName;
        if ($this->db->driverName === 'pgsql') {
            $newTableName = Yii::$app->params['schema'] . '.' . $newTableName;
        }
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->dropTable($newTableName);
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
    }
}
