<?php

namespace app\controllers;

use app\models\Todo;
use app\core\Controller;
use app\core\Request;
use app\core\Application;

class TodoController extends Controller{

    public function create(Request $request){
        $todo = new Todo();

        if($request->isPost()){
            $todo->loadData($request->getBody());
            if($todo->validate() && $todo->save()){
                Application::$app->response->redirect('/');
                return 'Success';
            }
            
        }

        return $this->render('todo-table', [
            "model" => $todo
        ]);
    }

    public function edit(Request $request){
        $params = [];
        $todo = new Todo();
        $todo->loadData($request->getBody());
        $todoShow = $todo->show();
        if($request->isPost()){
            $todo->loadData($request->getBody());
            if($todo->validate() && $todo->editTodo()){
                Application::$app->response->redirect('/');
            }
        }
        foreach($todoShow as $key => $value){
            array_push($params, [$key => $value]);
        }
        return $this->render('show-todo', [
            "params" => $params,
            "model" => $todo
        ]);
    }
}