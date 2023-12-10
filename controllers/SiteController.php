<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Todo;

class SiteController extends Controller{

    public function home(){
        $params = [];
        $todo = new Todo();
        if(!Application::$app->isGuest()){
            
            $todos = $todo::getAllByUser(["user_id" => Application::$app->session->get('user')]);
            foreach ($todos as $key => $value){
                array_push($params, [$key => $value]);
            }
            return $this->render('home', [
                "params" => $params,
                "model" => $todo
            ]);
        }
        return $this->render('home', [
            "model" => $todo
        ]);
    }

    public function deleteTodo(Request $request){
        $todo = new Todo();
        if($request->isGet()){
            $todo->loadData($request->getBody());
            $todo->delete();
        }
    }
}