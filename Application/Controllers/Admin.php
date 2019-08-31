<?php

namespace Application\Controllers;

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
        $viewParams = [
            'title'     => 'Admin panel',
            'userList'  => $this->userModel->list_users(),
            'carModel'  => $this->carModel,
        ];

        // if (isset($_GET['uid'])) {
		// 	$uid = $_GET['uid'];
		// 	$user_dao = new User_DAO();
		// 	$user_dao->remove_user($uid);
		// 	display_warning("Потребителят ".$user_dao->get_user_by_id($uid)."е изтрит успешно");
		// 	header("Location: admin.php");
		// }

        View::render('admin/admin.php', $viewParams);
    }

    public function showProfileAction($params)
    {
        if (isset($params['user_id'])) {
            $userId = $params['user_id'];
            $user = $this->userModel->get_user_by_id($userId);
            $canDelete = $userId === $_SESSION['user']['ID'] ? false : true;
            $canDelete = $userId === 1 ? false : $canDelete;

            $viewParams = [
                'title'         => 'Потребителски профил',
                'canDelete'     => $canDelete,
                'userId'        => $userId,
                'user'          => $user,
                'carCount'      => $this->carModel->count_cars_by_user_id($userId),
                'expenses'      => $this->statModel->count_year_expenses_by_uid($userId),
                'user'          => $this->userModel->get_user_by_id($userId),
                'cars'          => $this->carModel->list_cars_by_user_id($userId),
                'greet'         => $user['Sex'] === 'male' ? 'дошъл' : 'дошла',
                'lastFive'      => $this->statModel->get_last_five_by_uid($userId),
                'carModel'      => $this->carModel,
                'expenseModel'  => $this->expenseModel,
            ];
            
            View::render('admin/show-profile.php', $viewParams);
        } else {
            header('Location: /');
        }
    }

    public function removeProfileAction($params)
    {
        if (isset($params['user_id'])) {
            $userId = $params['user_id'];
            $this->userModel->remove_user($userId);
            display_warning("Потребителят ".$this->userModel->get_user_by_id($userId)['Username']." е изтрит успешно");
            header("refresh:2;url=/admin");
            $viewParams = [
                'title' => 'admin panel',
            ];

        } else {
            header('Location: /');
        }
    }
}