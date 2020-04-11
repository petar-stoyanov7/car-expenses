<?php

namespace Core;

use Core\Form\Form;

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
            echo "{$file} not found";
        }
    }

    public static function displayPartial($file, $arguments = [])
    {
        $file =  "../Application/Views/partials/" . $file;
        $arguments['View'] = new View();
        if (is_readable($file)) {
            extract($arguments, EXTR_SKIP);
            require($file);
        } else {
            echo "{$file} not found";
        }
    }

    public static function drawForm(Form $form)
    {
        $path = dirname(__FILE__);
        require('form.php');
    }
}