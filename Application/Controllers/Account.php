<?php

namespace Application\Controllers;

use Application\Forms\CarForm;
use Application\Forms\LoginForm;
use Application\Forms\UserForm;
use Application\Models\ExpenseModel;
use Application\Models\PartsModel;
use \Core\View;
use \Application\Models\UserModel;
use \Application\Models\CarModel;
use \Application\Classes\User;
use Exception;

class Account
{

    private $userModel;
    private $carModel;
    private $expenseModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->carModel = new CarModel();
        $this->expenseModel = new ExpenseModel();
    }
    public function indexAction()
    {
        header('Location: /');
    }
    
    public function loginAction()
    {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $User = new User($_POST['username'],$_POST['password']);
            if ($this->userModel->login($User)) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
            echo json_encode($response);
        }
        die();
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
        if(!empty($_POST)) {
            $values = $form->getValues();
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
            if ($this->userModel->addUser($user)) {
                $this->userModel->login($user);
                header('Location: /');
            };


        }
    }

    public function profileAction()
    {
        if (isset($_SESSION['user'])) {
            $user = $this->userModel->getUserByUserId($_SESSION['user']['ID']);
            $form = new UserForm();
            $carForm = new CarForm();
            $form->addClass('profile-edit');
            $form->removeElements(['email2', 'check']);
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
                'title'         => $user['Username']."'s profile",
                'form'          => $form,
                'carForm'       => $carForm,
                'user'          => $userData,
                'cars'          => $this->carModel->listCarsByUserId($user['ID']),
                'JS'            => ['profile.js', 'cars.js'],
                'CSS'           => ['profile.css', 'cars.css']
            ];
            View::render('account/profile.php', $viewParams);
        } else {
            header('location: /');
        }
    }

    public function editAction()
    {
        $response = [];
        if (!empty($_POST)) {
            $currentUser = $this->userModel->getUserByUserId($_POST['user-id']);
            //TODO: FIX THIS!
            $User = new User($currentUser['Username'], 'blank');
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

    public function getUsersAction()
    {
        if (!empty($_POST) && (bool)$_POST['isAjax'] === true ) {
            $userList = $this->userModel->listUsers();
            $result['users'] = array_column($userList, 'Username');
            $result['emails'] = array_column($userList, 'Email');
            if (!empty($userList)) {
                echo json_encode($result);
                die();
            }
        } else {
            header('Location: /');
        }
    }

    public function deleteAction()
    {
        $response['success'] = false;
        if (!empty($_POST)) {
            $userId = $_POST['userId'];
            if ((bool)$_POST['deleteExpenses']) {
                $this->expenseModel->removeUserExpenses($userId);
            }
            if ((bool)$_POST['deleteCars']) {
                $this->carModel->removeUserCars($userId);
            }
            $partsModel = new PartsModel();
            $partsModel->removeByUserId($userId);
            $this->userModel->removeUser($userId);
            $response['success'] = true;
        }
        json_encode($response);
        die();
    }
}

?>