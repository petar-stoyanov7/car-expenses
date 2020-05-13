<?php

namespace Application\Controllers;

use Application\Forms\CarForm;
use Application\Forms\LoginForm;
use Application\Forms\UserForm;
use \Core\View;
use \Application\Models\UserModel;
use \Application\Models\CarModel;
use \Application\Classes\User;
use Exception;

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
        $form->removeElement('user-id');
        if(!empty($_POST)) {
            if ($form->validate($_POST)) {
                $values = $form->getValues();
                $user = new User(
                    $values['username'],
                    $values['password1'],
                    $values['password2'],
                    $values['email1'],
                    $values['email2'],
                    $values['firstname'],
                    $values['lastname'],
                    $values['city'],
                    $values['sex']
                );
                try {
                    $this->userModel->addUser($user);
                } catch(Exception $e) {
                    display_warning($e->getMessage());
                }
            } else {
                $form->populate($form->getValues());
            }
        }
        $viewParams = [
            'title' => "Нова регистрация",
            'form'  => $form
        ];

        View::render('account/register.php', $viewParams);
    }

    public function profileAction()
    {
        if (isset($_SESSION['user'])) {
            $user = $this->userModel->getUserByUserId($_SESSION['user']['ID']);
            $form = new UserForm();
            $carForm = new CarForm();
            $form->addClass('profile-edit');
            $form->removeElements(['email2', 'check', 'old-password']);
            $form->disableElement('username');

            $userData = [
                'id'        => $user['ID'],
                'username'  => $user['Username'],
                'firstname' => $user['Fname'],
                'lastname'  => $user['Lname'],
                'city'      => $user['City'],
                'email1'    => $user['Email'],
                'userId'    => $user['ID'],
                'sex'       => $user['Sex'],
                'notex'     => $user['Notes']
            ];

            $form->populate($userData);

            $viewParams = [
                'title'         => 'Потребителски профил',
                'form'          => $form,
                'carForm'       => $carForm,
                'user'          => $userData,
                'cars'          => $this->carModel->listCarsByUserId($user['ID']),
                'JS'            => ['profile.js', 'cars.js'],
                'CSS'           => ['profile.css', 'cars.css']
            ];
            View::render('account/profile.php', $viewParams);
        } else {
            View::render('Static/profile.php');
        }
    }

    public function editAction()
    {
        $response = [];
        if (!empty($_POST)) {
            $currentUser = $this->userModel->getUserByUserId($_POST['user-id']);
            $User = new User($currentUser['Username'], $_POST['old-password']);
            $this->userModel->editUser($User, $_POST,true);
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
        echo json_encode($response);
    }

    public function getUserInfoAction()
    {
        if (!empty($_POST)) {
            $user = $this->userModel->getUserByUserId($_POST['userId']);
            if (!empty($user)) {
                $result = [
                    'user-id'   => $user['ID'],
                    'username'  => $user['Username'],
                    'firstname' => $user['Fname'],
                    'lastname'  => $user['Lname'],
                    'city'      => $user['City'],
                    'email'     => $user['Email'],
                    'sex'       => $user['Sex'],
                ];
                echo json_encode($result);
                die();
            }
        }
    }
}

?>