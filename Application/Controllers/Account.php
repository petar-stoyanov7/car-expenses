<?php

namespace Application\Controllers;

use Application\Forms\LoginForm;
use Application\Forms\UserForm;
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
        $form = new LoginForm();
        $viewParams =[
            'title' => 'Login',
            'form'  => $form
        ];
        
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
        $form = new UserForm();
        $form->setOptions(['classes' => 'register-form']);
        $form->setName('register-form');
        $form->setTarget('/account/register');
        $viewParams = [
            'title' => "Нова регистрация",
            'form'  => $form
        ];
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
            $user = $this->userModel->getUserByUserId($_SESSION['user']['ID']);
            $form = new UserForm(
                $user['ID'],
                $user['Username']
            );
            $form->setName('edit-account-form');
            $form->setTarget('/account/edit');
            $form->setOptions(['classes' => 'account-edit-form']);
            $userData = [
                'username'  => $user['Username'],
                'firstname' => $user['Fname'],
                'lastname'  => $user['Lname'],
                'city'      => $user['City'],
                'email1'    => $user['Email'],
            ];
            $form->populate($userData);

            $viewParams = [
                'title'         => 'Потребителски профил',
                'form'          => $form,
                'userId'        => $user['ID'],
                'user'          => $user['Username'],
                'firstName'     => $user['Fname'],
                'lastName'      => $user['Lname'],
                'city'          => $user['City'],
                'email'         => $user['Email'],
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
            if (
                isset($params['id']) &&
                !empty($params['id']) &&
                $_SESSION['user']['Group'] === 'admins'
            ) {
                $password = 'blank';
                $viewParams = [
                    'uid'       => $params['id'],
                    'isAdmin'   => TRUE,
                ];
            } else {
                $password = $_POST['old-password'];
                $viewParams = [
                    'uid'       => $_SESSION['user']['ID'],
                    'isAdmin'   => FALSE,
                ];
            }
            $currentUser = $this->userModel->getUserByUserId($viewParams['uid']);
            $viewParams['user'] = $currentUser;
            if (!empty($_POST)) {
                if (isset($password)) {
                    $User = new User($currentUser['Username'], $password);
                    $this->userModel->editUser($User,$_POST,1);
                    header('Location: /account/profile');
                } else {
                    $User = new User($currentUser['Username'], $currentUser['Password']);
                    $this->userModel->editUser($User,$_POST);
                    header('Location: /account/profile');
                }
            }

            View::render('account/edit-profile.php', $viewParams);
        } else {
            header("Location: /");
        }
    }
}

?>