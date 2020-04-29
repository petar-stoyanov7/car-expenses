<?php

namespace Core;

use Core\Form\AbstractForm;

class View
{
    public static function render($view, $arguments = [], $displayTop = true)
    {
        $jsArray = [];
        $cssArray = [];
        if (!empty($arguments['title'])) {
            $title = $arguments['title'];
            unset($arguments['title']);
        }
        if (!empty($arguments['JS'])) {
            if (is_array($arguments['JS'])) {
                $jsArray = $arguments['JS'];
            } else {
                $jsArray = [$arguments['JS']];
            }
            unset($arguments['JS']);
        }
        if (!empty($arguments['CSS'])) {
            if (is_array($arguments['CSS'])) {
                $cssArray = $arguments['CSS'];
            } else {
                $cssArray = [$arguments['CSS']];
            }
            unset($arguments['CSS']);
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

    public static function renderForm(AbstractForm $renderedForm)
    {
        $form = $renderedForm;
        require('form.php');
    }
}