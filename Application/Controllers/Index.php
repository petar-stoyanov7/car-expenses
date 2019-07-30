<?php

namespace Application\Controllers;

use \Core\View;

class Index
{
    public function __construct()
    {
        //
    }

    public function indexAction()
    {

        View::render('index.php', [
            'title' => 'Home page',
            'name' => 'Pesho',
            ]
        );
    }


    public function testAction()
    {
        echo "TEST<br>";
    }
}