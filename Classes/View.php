<?php

namespace Classes;

class View
{
    private $viewPath = 'views';

    private $params = [];

    static private $_instance;

    static public function getInstance()
    {
        if(self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function render($path)
    {
        if($path[0] == '/') {
            $this->viewPath .= "$path.php";
        }else{
            $this->viewPath .= "/$path.php";
        }

        return $this;
    }

    public function with($args) {
        $this->params = $args;
    }

    public function __destruct()
    {
        extract($this->params);
        include $this->viewPath;
    }
}