<?php


namespace Application\Controllers;

use Application\Forms\NewExpenseForm;
use Application\Forms\ImportExpenseForm;
use Application\Models\PartsModel;
use \Core\View;
use \Application\Models\CarModel;
use \Application\Models\ExpenseModel;
use \Application\Models\StatisticsModel;
use \Application\Classes\Expense as ExpenseClass;
use DateTime;
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
            $form2 = new ImportExpenseForm($userId);
            $viewParams = [
                'title' => 'New expense',
                'form' => $form,
                'form2' => $form2,
                'JS' => ['new-expense.js'],
                'CSS' => ['new-expense.css']
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
            $this->expenseModel->removeExpense($expenseId, $year);
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
            switch ($type) {
                case 1:
                    $values['insuranceType'] = null;
                    $values['partName'] = null;
                    unset($values['replacementParts']);
                    break;
                case 2:
                    $values['fuelType'] = null;
                    $values['liters'] = null;
                    $values['partName'] = null;
                    unset($values['replacementParts']);
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
                    unset($values['replacementParts']);
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
                if (!empty($values['replacementParts'])) {
                    $this->partsModel->removeParts($values['replacementParts']);
                }
            }

        }
        echo json_encode($response);
        die();
    }

    public function importFileAction()
    {
        if (
            empty($_POST)
            || empty($_POST['carId'])
            || empty($_POST['csvContent'])
            || empty($_POST['userId'])
        ) {
            echo "Incomplete form";
            die();
        }

        $response['success'] = true;

        $csvContent = $_POST['csvContent'];
        $content = explode(PHP_EOL, $csvContent);
        if (!is_array($content) || empty($csvContent)) {
            echo "Invalid content";
            die();
        }

        foreach ($content as $row) {
            $exp = explode(':', $row);
            if (!is_array($exp)) {
                continue;
            }
            $Expense = new ExpenseClass();
            $Expense->setUserId($_POST['userId']);
            $Expense->setCarId($_POST['carId']);
            $Expense->setMileage($exp[0]);
            $date = new DateTime($exp[5]);
            $Expense->setDate($date->format('Y-m-d'));
            $Expense->setPrice($exp[3]);

            if (!empty($exp[4])) {
                $Expense->setNotes($exp[4]);
            }

            $type = strtolower($exp[1]);
            switch (mb_strtolower($exp[1])) {
                case 'го':
                    $Expense->setExpenseType(2);
                    $Expense->setInsuranceType(1);
                    break;
                case 'каско':
                    $Expense->setExpenseType(2);
                    $Expense->setInsuranceType(2);
                    break;
                case 'бенз':
                case 'бензин':
                    $Expense->setExpenseType(1);
                    $Expense->setFuelType(1);
                    $Expense->setLiters($exp[3]);
                    break;
                case 'газ':
                case 'гз':
                case 'lpg':
                    $Expense->setExpenseType(1);
                    $Expense->setFuelType(3);
                    $Expense->setLiters($exp[3]);
                    break;
                case 'ремонт':
                    $Expense->setExpenseType(3);
                    break;
                case 'tax':
                case 'данък':
                    $Expense->setExpenseType(4);
                    break;
                case 'fine':
                case 'глоба':
                    $Expense->setExpenseType(6);
                    break;
                default:
                    $Expense->setExpenseType(999);
                    break;
            }

            try {
                $this->expenseModel->addExpense($Expense);
            } catch (Exception $e) {
                $response['success'] = false;
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