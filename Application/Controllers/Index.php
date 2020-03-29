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
                'cars'          => $carModel->listCarsByUserId($userId),
                'greet'         => $greet,
                'title'         => 'Автомобилни разходи',
                'lastFive'      => $statModel->getLastFiveByUserId($userId),
                'countCars'     => $carModel->countCarsByUserId($userId),
                'yearExpense'   => $statModel->countYearExpensesByUserId($userId),
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