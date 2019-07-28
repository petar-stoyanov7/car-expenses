<?php
// namespace Core;

// spl_autoload_register(function ($class) {
//     $namespace=str_replace("\\","/",__NAMESPACE__);
//     echo $class.'<br>';
//     echo $namespace . '<br>';
//     $root = dirname(__DIR__);
//     $file = $root . '/' . $namespace . '/' . str_replace('\\', '/', $class) . '.php';
//     echo $file;
//     if (is_readable($file)) {
//         require $file;
//     }
// });