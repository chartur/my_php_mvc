<?php

spl_autoload_register(function ($class) {

    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class.'.php');
    include $classPath;

    // Проверяем необходимость подключения указанного класса
    if (!class_exists($class, false)) {
        trigger_error("Не удалось загрузить класс: $class", E_USER_WARNING);
    }
});

require_once "MVC.php";

$mvc = new MVC();
$mvc->init();