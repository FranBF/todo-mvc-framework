<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\core\Response;
use app\core\Application;
use app\models\User;
use app\models\LoginForm;

class AuthController extends Controller{

    public function login(Request $request, Response $response){
        $loginForm = new LoginForm();

        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                Application::$app->response->redirect('/');
            }
        }
        return $this->render('login', [
            "model" => $loginForm
        ]);
    }

    public function register(Request $request){
        $user = new User();
        
        if($request->isPost()){
            
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->save()){
                Application::$app->response->redirect('/login');
                return 'Success';
            }
        }
        return $this->render('register', [
            "model" => $user
        ]);
    }

    public function logout(Request $request, Response $response){
        Application::$app->logout();
        $response->redirect('/');
    }
}