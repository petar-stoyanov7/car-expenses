<?php

spl_autoload_register(function ($class) {
    $namespace=str_replace("\\","/",__NAMESPACE__);
    $root = dirname(__DIR__);
    $file = $root . '/' . $namespace . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $file;
    }
});

$router = new Core\Router();

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);


function dt($text, $desc)
{
    echo '<pre>';
    echo '################'.$desc.'######################<br>';
    print_r($text);
    echo '<br>################'.$desc.'######################<br>';
}