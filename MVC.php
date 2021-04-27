<?php

use \Controllers\HomeController as DefaultController;

class MVC
{

    private $defaultController = DefaultController::class;
    private $defaultActionName = 'index';

    private $uri;
    private $segments;
    private $params = [];

    private $hasController;
    private $hasAction;

    private $controller;
    private $action;


    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->segments = explode('/', $this->uri);
        $this->segments = array_values(array_filter($this->segments));
    }

    public function init()
    {
        try {
            $this->checkControllerAndActionExisting()
                ->selectController()
                ->selectAction()
                ->sendParamsToAction();
        } catch (Exception $exception) {
            echo $exception->getMessage();die;
        }
    }

    private function checkControllerAndActionExisting()
    {
        $segments_count = count($this->segments);
        switch ($segments_count) {
            case 0:
                $this->hasController = false;
                $this->hasAction = false;
                break;
            case 1:
                $this->hasController = true;
                $this->hasAction = false;
            default:
                $this->hasController = true;
                $this->hasAction = true;
        }

        if($segments_count > 2) {
            $this->params = array_splice($this->segments, 2, count($this->segments));
        }
        return $this;
    }

    private function selectController()
    {
        $controller = null;
        if (!$this->hasController) {
            $controller = $this->defaultController;
        } else {
            $controllerNameFromParam = ucwords(strtolower($this->segments[0]));
            $controller = '\Controllers\\'. $controllerNameFromParam .'Controller';
        }

        if(!class_exists($controller)) {
            throw new Exception('Controller not found', 404);
        }

        $this->controller = new $controller;
        return $this;
    }

    private function selectAction()
    {
        $action = null;
        if (!$this->hasAction) {
            $action = $this->defaultActionName;
        } else {
            $action = strtolower($this->segments[1]);
        }

        if(!method_exists($this->controller, $action)) {
            throw new Exception('Action not found', 404);
        }

        $this->action = $action;
        return $this;
    }

    private function sendParamsToAction()
    {
        call_user_func_array([$this->controller, $this->action], $this->params);
    }
}