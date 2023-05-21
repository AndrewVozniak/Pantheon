<?php

namespace migrations;

use App\Models\User;

/**
 * User Table Migration
 */
class UserMigration extends User
{
    protected string $table;

    public function __construct()
    {
        $this->table = 'users';
    }

    public function up()
    {
        // Код для выполнения миграции
    }

    public function down()
    {
        // Код для отката миграции
    }
}