<?php


namespace Application\Controllers;

use Application\Forms\NewExpenseForm;
use Application\Models\PartsModel;
use \Core\View;
use \Application\Models\CarModel;
use \Application\Models\ExpenseModel;
use \Application\Models\StatisticsModel;
use \Application\Classes\Expense as ExpenseClass;
use Exception;


class Expense
{
    private $expenseModel;
    private $carModel;
    private $partsModel;
    private $statisticsModel;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
        $this->carModel = new CarModel();
        $this->partsModel = new PartsModel();
        $this->statisticsModel = new StatisticsModel();
    }

    public function indexAction()
    {
        header('Location: /');
    }

    public function newAction()
    {
        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user']['ID'];
            $form = new NewExpenseForm($userId);
            $viewParams = [
                'title' => 'New expense',
                'form'  => $form,
                'JS'    => ['new-expense.js'],
                'CSS'   => ['new-expense.css']
            ];
            View::render('expense/new-expense.php', $viewParams);
        } else {
            header('location: /');
        }
    }

    public function removeAction()
    {
        $result['success'] = false;
        if (!empty($_POST['date']) && !empty($_POST['expenseId'])) {
            $date = $_POST['date'];
            $expenseId = $_POST['expenseId'];
            $year = explode('-', $date)[0];
            $this->expenseModel->removeExpense($expenseId,$year);
            $this->partsModel->removeByExpenseId($expenseId, $date);
            $result['success'] = true;
        }
        echo json_encode($result);
        die();
    }

    public function newAjaxExpenseAction()
    {
        $response['success'] = false;
        $newPart = false;
        if (!empty($_POST)) {
            $values = nullify($_POST);
            $type = (int)$values['expenseType'];
            switch($type) {
                case 1:
                    $values['insuranceType'] = null;
                    $values['partName'] = null;
                    break;
                case 2:
                    $values['fuelType'] = null;
                    $values['liters'] = null;
                    $values['partName'] = null;
                    break;
                case 5:
                    $newPart = true;
                    $values['insuranceType'] = null;
                    $values['fuelType'] = null;
                    $values['liters'] = null;
                    break;
                default:
                    $values['insuranceType'] = null;
                    $values['fuelType'] = null;
                    $values['liters'] = null;
                    $values['partName'] = null;
                    break;
            }
            $values['description'] = null === $values['description'] ? '' : $values['description'];
            $Expense = new ExpenseClass(
                $values['userId'],
                $values['carId'],
                $values['date'],
                $values['mileage'],
                $values['expenseType'],
                $values['value'],
                $values['fuelType'],
                $values['liters'],
                $values['insuranceType'],
                $values['partName'],
                $values['description']
            );
            try {
                $expenseId = $this->expenseModel->addExpense($Expense);
                $response['success'] = true;
            } catch (Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
            if ($newPart && !empty($expenseId)) {
                $this->partsModel->addNewParts($Expense, $expenseId);
            }

        }
        echo json_encode($response);
        die();
    }

    public function getLastFiveAction()
    {
        if (!empty($_POST) && !empty($_POST['userId'])) {
            $lastFive = $this->statisticsModel->getLastByUserId($_POST['userId'], 5);
            echo json_encode($lastFive);
            die();
        }
    }
}