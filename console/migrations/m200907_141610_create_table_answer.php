<?php

use yii\db\Expression;
use yii\db\Migration;

class m200907_141610_create_table_answer extends Migration {

    public $newTableName = 'answer';

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
            'id' => $this->primaryKey()->notNull(),

            'respondent_name'    => $this->string(255)->notNull()->comment('Имя'),
            'respondent_email'   => $this->string(255)->notNull()->comment('E-mail'),
            'respondent_comment' => $this->text()->comment('Комментарий'),
            'question_id'        => $this->integer()->notNull()->comment('Вопрос'),
            'question_rate'      => $this->integer()->notNull()->comment('Ответ'),

            'active'     => $this->boolean()->notNull()->defaultValue(true)->comment('Активно'),
            'created_at' => $this->integer()->notNull()->defaultValue(new Expression("NOW()"))->comment('Создано'),
            'updated_at' => $this->integer()->comment('Изменено'),
        ], $tableOptions . ' COMMENT="Ответы"');

        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $tableName = 'question';
        if ($this->db->driverName === 'pgsql') {
            $tableName = Yii::$app->params['schema'] . '.' . $tableName;
        }
        $this->addForeignKey('fk-'.$newTableName.'-question_id', $newTableName, 'question_id', $tableName, 'id', 'CASCADE', 'NO ACTION');

        // Включаем ключи связывания таблиц
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
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
