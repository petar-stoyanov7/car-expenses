<?php

namespace Core;

use Core\Form\Form;

class View
{
    public static function render($view, $arguments = [], $displayTop = true)
    {
        $jsArray = [];
        $cssArray = [];
        foreach ($arguments as $key => $argument) {
            switch($key) {
                case 'JS':
                    unset($arguments[$key]);
                    if (empty($argument)) {
                        break;
                    }
                    if (is_array($argument)) {
                        $jsArray = $argument;
                    } else {
                        $jsArray = [$argument];
                    }
                    break;
                case 'CSS':
                    unset($arguments[$key]);
                    if (empty($argument)) {
                        break;
                    }
                    if (is_array($argument)) {
                        $cssArray = $argument;
                    } else {
                        $cssArray = [$argument];
                    }
                    break;
                default:
                    break;
            }
        }
        $file = "../Application/Views/$view";
        $arguments['View'] = new View();
        if (is_readable($file)) {
            /**TODO this needs reworking. Need to to move part of this logic into a
             * consisntent part of the View and add optional customizations from Application
             */
            extract($arguments, EXTR_SKIP);
            $customHeader = '../Application/Views/Layout/header.php';
            if (is_readable($customHeader)) {
                require($customHeader);
            }
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

    public static function renderForm(Form $form)
    {
        $path = dirname(__FILE__);
        require('form.php');
    }
}