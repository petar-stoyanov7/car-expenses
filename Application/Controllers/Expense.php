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

    public function detailedInfoAction($params)
    {
        $title = "Детайлна справка";
        if(isset($params['id']) && isset($params['year'])) {
            $id = $params['id'];
            $year = $params['year'];
            $data = $this->statisticsModel->getStatisticById($id,$year);

            $viewParams = [
                'data' => $data,
                'expenseModel' => $this->expenseModel,
                'carModel' => $this->carModel,
            ];
            View::render('expense/detailed-info.php', $viewParams);
        } else {
            header("Location: /statistics");
        }
    }

    public function removeAction($params)
    {
        if (isset($params['id']) && isset($params['year'])) {
            $expenseId = $params['id'];
            $year = $params['year'];
            $form = new DeleteExpenseForm($expenseId, $year);
            $data = $this->statisticsModel->getStatisticById($expenseId, $year);
            $viewParams = [
                'form'          => $form,
                'title'         => 'Remove expense',
                'CSS'           => ['new-expense.css'],
                'data'          => $data,
                'type'          => $this->expenseModel->getExpenseName($data['Expense_ID']),
                'fuelName'      => $this->carModel->getFuelName($data['Fuel_ID']),
                'insuranceName' => $this->expenseModel->getInsuranceName($data['Insurance_ID'])
            ];
            if (isset($_POST['id']) && isset($_POST['year'])) {
                $this->expenseModel->removeExpense($_POST['id'],$_POST['year']);
                header("Location: /statistics");
            }
            View::render('expense/remove-expense.php', $viewParams);
        } else {
            header('Location: /statistics');
        }
    }
}