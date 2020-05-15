<?php

namespace Application\Controllers;

use Application\Forms\CarForm;
use Application\Forms\UserForm;
use \Core\View;
use \Application\Models\UserModel;
use \Application\Models\CarModel;
use \Application\Models\StatisticsModel;
use \Application\Models\ExpenseModel;
use \Application\Classes\User;

class Admin
{
    private $carModel;
    private $userModel;
    private $statModel;
    private $expenseModel;

    public function __construct()
    {
        if ($_SESSION['user']['Group'] !== 'admins') {
            header('Location: /');
        }
        $this->carModel = new CarModel();
        $this->userModel = new UserModel();
        $this->statModel = new StatisticsModel();
        $this->expenseModel = new ExpenseModel();
    }

    public function indexAction()
    {
        $userForm = new UserForm();
        $userForm->removeElements(['check','email2']);
        $userForm->disableElement('username');
        $viewParams = [
            'title'     => 'Admin panel',
            'carForm'   => new CarForm(),
            'userForm'  => $userForm,
            'userList'  => $this->userModel->listUsers(),
            'carModel'  => $this->carModel,
            'CSS'       => ['admin.css', 'profile.css', 'cars.css'],
            'JS'        => ['cars.js', 'profile.js', 'admin.js'],
        ];

        View::render('admin/admin.php', $viewParams);
    }

    public function removeProfileAction($params)
    {
        if (isset($params['user_id'])) {
            $userId = $params['user_id'];
            $this->userModel->removeUser($userId);
            display_warning("Потребителят ".$this->userModel->getUserByUserId($userId)['Username']." е изтрит успешно");
            header("refresh:2;url=/admin");
            $viewParams = [
                'title' => 'admin panel',
            ];

        } else {
            header('Location: /');
        }
    }
}