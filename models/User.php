<?php

namespace app\models;

use app\core\Model;
use app\core\UserModel;

class User extends UserModel{

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public int $status = 1;

    public function save(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->status = 1;
        return parent::save();
    }

    public static function primaryKey(): string{
        return 'id';
    }

    public static function tableName(): string{
        return 'users';
    }

    public function rules():array{
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
        ];
    }

    public function attributes(): array{
        return ['name', 'email', 'password', 'status'];
    }

    public function getDisplayName(): string{
        return $this->name;
    }
}