<?php

namespace Core;

class View
{
    public static function render($view, $arguments = [], $displayTop = true)
    {
        $file = "../Application/Views/$view";
        $arguments['View'] = new View();
        if (is_readable($file)) {
            extract($arguments, EXTR_SKIP);
            require('../Application/Views/Layout/header.php');
            if ($displayTop) {
                require('../Application/Views/Layout/top-toolbar.php');
            }
            require($file);
            require('../Application/Views/Layout/footer.php');
        } else {
            echo "$file not found";
        }
    }

    public static function displayPartial($file)
    {
        $file = '../Application/Views/partials/' . $file;
        if (is_readable($file)) {
            require($file);
        } else {
            echo "{$file} not found";
        }
    }
}