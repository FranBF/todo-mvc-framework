<?php

namespace app\core;

use app\core\Request;
use app\core\Response;

class Router{

    public Request $req;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response){
        $this->req = $request;
        $this->response = $response;
    }

    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback){
        $this->routes['post'][$path] = $callback;
    }

    public function delete($path, $callback){
        $this->routes['delete'][$path] = $callback;
    }

    public function resolve(){
        $path = $this->req->getPath();
        $method = $this->req->method();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){
            Application::$app->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if(is_string($callback)){
            return $this->renderView($callback);
        }
        if(is_array($callback)){
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->req, $this->response);
    }

    public function renderViewContent($viewContent){
        $layoutContent = $this->layoutContent();
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    public function renderView($view, $params = []){
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function layoutContent(){
        
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params){
        foreach($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}