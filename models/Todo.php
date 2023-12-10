<?php

namespace app\models;

use app\core\DbModel;
use app\core\Application;

class Todo extends DbModel{

    public string $title = '';
    public string $description = '';
    public int $status = 0;
    public int $user_id = 0;
    public int $id = 0;

    public function save(){
        $this->user_id = Application::$app->session->get('user');
        return parent::save();
    }

    public static function primaryKey(): string{
        return 'id';
    }

    public static function tableName(): string{
        return 'todo';
    }

    public function rules():array{
        return [
            'title' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array{
        return ['title', 'description', 'status', 'user_id', 'id'];
    }

    public function delete(){
        $todo = $this->find(['id' => $this->id]);
        if($todo){
            DbModel::deleteTodoById($this->id);
            Application::$app->response->redirect('/');
        }
        Application::$app->response->redirect('/');
    }

    public function editTodo(){
        $todo = $this->find(['id' => $this->id]);
        if($todo){
            parent::edit($this->id, Application::$app->session->get('user'));
            Application::$app->response->redirect('/');
        }
        Application::$app->response->redirect('/');
    }

    public function show(){
        $todo = $this->find(['id' => $this->id]);
        if($todo){
            return $todo;
        }
    }

}