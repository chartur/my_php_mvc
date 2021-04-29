<?php

if(!file_exists('view')) {
    function view($filePath) {
        return \Classes\View::getInstance()
            ->render($filePath);
    }
}

if(!file_exists('config')) {
    function config($property) {
        $config = include "config.php";
        return $config[$property];
    }
}

if(!file_exists('dd')) {
    function dd($data) {
        echo '<pre>';
        var_dump($data);
        die;
    }
}