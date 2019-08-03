<?php

namespace Application\Controllers;

use \Core\View;
use \Application\Models\UserModel;
use \Application\Classes\User;

class Account
{
    public function indexAction()
    {
        header('Location: /');
    }
    
    public function loginAction()
    {
        $params['title'] = "Вход";
        
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $user = new User($_POST['username'],$_POST['password']);
            $userModel = new UserModel();
            if ($userModel->login($user)) {
                header("Location: /");
            } else {
                display_warning("Невалиден потребител/парола");
            }
        }        

        View::render('login.php', $params);
    }

    public function logoutAction()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /");
    }

    public function registerAction()
    {        
        $title = "Нова регистрация";
        if(isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['email1'])) {
            if (!$_POST['checkbox']) {
                display_warning("Трябва да се съгласите с условията!");
            } else {
                display_test($_POST);
                $user = new User(
                    $_POST['username'],
                    $_POST['password1'],
                    $_POST['password2'],
                    $_POST['email1'],
                    $_POST['email2'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['city'],
                    $_POST['sex']
                );
                $userModel = new UserModel();
                $userModel->add_user($user);
                header("Location: /");
            }
        }
        View::render('register.php');
    }

    public function profileAction()
    {
        if (isset($_SESSION['user'])) {
            $title = "Потребителски профил";
            $params = [
                'user' => $_SESSION['user']['Username'],
                'firstName' => $_SESSION['user']['Fname'],
                'lastName' => $_SESSION['user']['Lname'],
                'city' => $_SESSION['user']['City'],
                'email' => $_SESSION['user']['Email'],
            ];
            View::render('profile.php', $params);
        } else {
            View::render('Static/profile.php');
        }
    }
}

?>