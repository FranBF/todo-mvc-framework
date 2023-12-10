<?php

namespace app\core;

use app\core\Model;

#[AllowDynamicProperties]

abstract class DbModel extends Model{

    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;

    public function save(){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $stmt = self::prepare("
        INSERT INTO $tableName (".implode(',', $attributes) .", status) VALUES(".implode(',', $params).", 1)");
        
        foreach($attributes as $attribute){
            $stmt->bindValue(":$attribute", $this->{$attribute});
        }

        $stmt->execute();

        return true;
    }

    public function edit($id, $user_id){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        unset($params[2]);
        unset($params[3]);
        unset($attributes[2]);
        unset($attributes[3]);

        $stmt = self::prepare("
                UPDATE $tableName SET title=:title, description=:description, status=:status, user_id=:user_id, id=:id WHERE id=:id");

        foreach($attributes as $attribute){
            $stmt->bindValue(":$attribute", $this->{$attribute});
        }

        $stmt->bindValue(":status", 1);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->bindValue(":id", $id);

        $stmt->execute();

        return true;
    }

    public static function findOne($where){
        $tableName = static::tableName();
        $attributes = array_keys($where);
        
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key => $item){
            $stmt->bindValue(":$key", $item);
        }

        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

    public function find($where){
        $tableName = $this->tableName();
        $attributes = array_keys($where);
        
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key => $item){
            $stmt->bindValue(":$key", $item);
        }

        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

    public static function getAllByUser($user){
        $tableName = static::tableName();
        $attributes = array_keys($user);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach($user as $key => $item){
            $stmt->bindValue(":$key", $item);
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteTodoById($id){
        $tableName = $this->tableName();
        $stmt = self::prepare("DELETE FROM $tableName WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return true;
    }

    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }
}