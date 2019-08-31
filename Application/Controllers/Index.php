<?php

namespace Application\Controllers;

use \Core\View;
use \Application\Models\CarModel;
use \Application\Models\ExpenseModel;
use \Application\Models\StatisticsModel;

class Index
{
    public function indexAction()
    {
        if(isset($_SESSION['user'])) {
            $carModel = new CarModel();
            $expenseModel = new ExpenseModel();
            $statModel = new StatisticsModel();
            $userId = $_SESSION['user']['ID'];
            $greet = ($_SESSION['user']['Sex'] === 'male') ? 'дошъл' : 'дошла';
            $params = [
                'userId'        => $userId,
                'cars'          => $carModel->list_cars_by_user_id($userId),
                'greet'         => $greet,
                'title'         => 'Автомобилни разходи',
                'lastFive'      => $statModel->get_last_five_by_uid($userId),
                'countCars'     => $carModel->count_cars_by_user_id($userId),
                'yearExpense'   => $statModel->count_year_expenses_by_uid($userId),
                'firstName'     => $_SESSION['user']['Fname'],
                'lastName'      => $_SESSION['user']['Lname'],
                'carModel'      => $carModel,
                'expenseModel'  => $expenseModel,
                'statModel'     => $statModel,
            ];
            View::render('index.php', $params);
        } else {
            View::render('Static/index.php');
        }
    }
}