<?php

namespace Core;

class View
{
    public static function render($view, $arguments = [])
    {
        $file = "../Application/Views/$view";
        $arguments['View'] = new View();
        if (is_readable($file)) {
            extract($arguments, EXTR_SKIP);
            require('../Application/Views/Layout/header.php');
            require($file);
            require('../Application/Views/Layout/footer.php');
        } else {
            echo "$file not found";
        }
    }    
}