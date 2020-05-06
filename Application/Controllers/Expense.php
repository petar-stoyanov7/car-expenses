<?php


namespace Application\Controllers;

use Application\Forms\DeleteExpenseForm;
use Application\Forms\NewExpenseForm;
use \Core\View;
use \Application\Models\CarModel;
use \Application\Models\ExpenseModel;
use \Application\Models\StatisticsModel;
use \Application\Classes\Expense as ExpenseClass;


class Expense
{
    private $expenseModel;
    private $carModel;
    private $statisticsModel;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
        $this->carModel = new CarModel();
        $this->statisticsModel = new StatisticsModel();
    }

    public function indexAction()
    {
        header('Location: /');
    }

    public function newAction()
    {
        $title = "Нов разход";
        $carModel = new CarModel();

        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user']['ID'];
            $form = new NewExpenseForm($userId);
            $viewParams = [
                'title' => 'New expense',
                'form'  => $form,
                'JS'    => ['new-expense.js'],
                'CSS'   => ['new-expense.css']
            ];
            if (!empty($_POST)) {
                $values = nullify($_POST);
                $expense = new ExpenseClass(
                        $values['user-id'],
                        $values['car-id'],
                        $values['date'],
                        $values['mileage'],
                        $values['expense-type'],
                        $values['price'],
                        $values['fuel-type'],
                        $values['liters'],
                        $values['insurance-type'],
                        $values['description']
                    );
                $this->expenseModel->addExpense($expense);
                header('Location: /expense/new');
            }
            View::render('expense/new-expense.php', $viewParams);
        } else {
            View::render('Static/new-expense.php');
        }
    }

    public function removeAction($params)
    {
        if (!empty($_POST['date']) && !empty($_POST['expenseId'])) {
            $year = explode('-', $_POST['date'])[0];
            $this->expenseModel->removeExpense($_POST['expenseId'],$year);
            echo json_encode(['success' => true]);
            die();
        }
        echo json_encode(['success' => false]);
        die();
    }

    public function newAjaxExpenseAction()
    {
        if (!empty($_POST)) {
            $values = nullify($_POST);
            $expense = new ExpenseClass(
                $values['userId'],
                $values['carId'],
                $values['date'],
                $values['mileage'],
                $values['expenseType'],
                $values['value'],
                $values['fuelType'],
                $values['liters'],
                $values['insuranceType'],
                $values['description']
            );
            $this->expenseModel->addExpense($expense);
            echo json_encode(['success' => true]);
            die();
        }
        echo json_encode(['success' => false]);
        die();
    }

    public function getLastFiveAction()
    {
        if (!empty($_POST) && !empty($_POST['userId'])) {
            $result = [];
            $lastFive = $this->statisticsModel->getLastByUserId($_POST['userId'], 5);
            if (!empty($lastFive)) {
                foreach($lastFive as $expense) {
                    $expenseType = '';
                    switch ($expense['Expense_ID']) {
                        case 1:
                            $expenseType = $this->carModel->getFuelName($expense['Fuel_ID']);
                            break;
                        case 2:
                            $expenseType = $this->expenseModel->getInsuranceName($expense['Insurance_ID']);
                            break;
                        default:
                            $expenseType = '';
                            break;
                    }
                    $result[] = [
                        'mileage'       => $expense['Mileage'],
                        'car'           => $this->carModel->getCarNameById($expense['CID']),
                        'expenseType'   => $this->expenseModel->getExpenseName($expense['Expense_ID']),
                        'type'          => $expenseType,
                        'price'         => $expense['Price'],
                        'notes'         => $expense['Notes']
                    ];
                }
            }
            echo json_encode($result);
            die();
        }
    }
}