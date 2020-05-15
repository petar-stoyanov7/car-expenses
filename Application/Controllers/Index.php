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
            $cars = $carModel->listCarsByUserId($userId);
            foreach ($cars as $index => $car) {
                $cars[$index]['yearly_spent'] = $statModel->countYearExpensesByUserId($userId,$car['ID']);
            }

            $params = [
                'userId'        => $userId,
                'cars'          => $cars,
                'title'         => 'Car Expenses',
                'lastFive'      => $statModel->getLastByUserId($userId, 5),
                'countCars'     => $carModel->countCarsByUserId($userId),
                'yearExpense'   => $statModel->countYearExpensesByUserId($userId),
                'firstName'     => $_SESSION['user']['Fname'],
                'lastName'      => $_SESSION['user']['Lname'],
            ];
            View::render('index.php', $params);
        } else {
            View::render('Static/index.php');
        }
    }
}