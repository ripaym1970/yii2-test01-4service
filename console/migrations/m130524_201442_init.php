<?php

use yii\db\Expression;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public $newTableName = 'user';

    public function up()
    {
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

            'username'      => $this->string()->notNull()->unique()->comment('Имя'),
            'password_hash' => $this->string()->notNull()->comment('Хеш пароля'),
            'auth_key'      => $this->string(32)->comment('Ключ авторизации'),
            'status'        => $this->smallInteger()->notNull()->defaultValue(10)->comment('Статус'),

            'created_at' => $this->integer()->notNull()->defaultValue(new Expression("NOW()"))->comment('Создано'),
            'updated_at' => $this->integer()->comment('Изменено'),
        ], $tableOptions . ' COMMENT="Пользователи"');
    }

    public function down()
    {
        $newTableName = $this->newTableName;
        if ($this->db->driverName === 'pgsql') {
            $newTableName = Yii::$app->params['schema'] . '.' . $newTableName;
        }
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->dropTable($newTableName);
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
    }
}
