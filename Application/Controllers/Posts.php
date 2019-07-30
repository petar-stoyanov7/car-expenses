<?php

namespace Application\Controllers;

class Posts
{
    public function indexAction(array $params = null)
    {
        echo 'Posts Index';
        $this->showParams($params);
    }

    public function addNewAction(array $params = null)
    {
        echo 'Posts Add new';
        $this->showParams($params);        
    }

    private function showParams(array $params)
    {
        if (null !== $params) {
            echo '<pre>';
            print_r($params);
            echo '</pre>';
        }
    }
}