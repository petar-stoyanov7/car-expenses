<?php

namespace Application\Controllers;

use \Core\View;
use \Application\Models\UserModel;
use \Application\Models\CarModel;
use \Application\Classes\User;

class Account
{

    private $userModel;
    private $carModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->carModel = new CarModel();    
    }
    public function indexAction()
    {
        header('Location: /');
    }
    
    public function loginAction()
    {
        $viewParams['title'] = "Вход";
        
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $User = new User($_POST['username'],$_POST['password']);
            if ($this->userModel->login($User)) {
                header("Location: /");
            } else {
                display_warning("Невалиден потребител/парола");
            }
        }        

        View::render('/account/login.php', $viewParams);
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
        $viewParams['title'] = "Нова регистрация";
        if(isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['email1'])) {
            if (!$_POST['checkbox']) {
                display_warning("Трябва да се съгласите с условията!");
            } else {
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
                $this->userModel->addUser($user);
                header("Location: /");
            }
        }
        View::render('account/register.php', $viewParams);
    }

    public function profileAction()
    {
        if (isset($_SESSION['user'])) {
            $viewParams = [
                'title'         => 'Потребителски профил',
                'userId'        => $_SESSION['user']['ID'],
                'user'          => $_SESSION['user']['Username'],
                'firstName'     => $_SESSION['user']['Fname'],
                'lastName'      => $_SESSION['user']['Lname'],
                'city'          => $_SESSION['user']['City'],
                'email'         => $_SESSION['user']['Email'],
                'carModel'      => $this->carModel,
            ];
            View::render('account/profile.php', $viewParams);
        } else {
            View::render('Static/profile.php');
        }
    }

    public function editAction($params)
    {
        if (isset($_SESSION['user'])) {
            if (isset($params['id']) && !empty($params['id'])) {
                $password = 'blank';
                $viewParams = [
                    'uid'       => $params['id'],
                    'isAdmin'   => TRUE,
                ];
            } else {
                $viewParams = [
                    'uid'       => $_SESSION['user']['ID'],
                    'isAdmin'   => FALSE,
                ];
            }
            $viewParams['user'] = $this->userModel->getUserByUserId($viewParams['uid']);
            if (!empty($_POST)) {
                if (isset($password)) {
                    $User = new User($_POST['user'], $password);
                    $this->userModel->editUser($User,$_POST,1);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    $User = new User($_POST['user'], $_POST['old_password']);
                    $this->userModel->editUser($User,$_POST);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }

            View::render('account/edit-profile.php', $viewParams);
        } else {
            header("Location: /");
        }
    }
}

?>