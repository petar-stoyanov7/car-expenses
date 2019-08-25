<?php


namespace Application\Controllers;

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
            $fuelList = $this->carModel->get_user_fuel_types($userId);
            $fuelTypes = [];
            foreach($fuelList as $fuel) {
                $fuelTypes[$fuel['ID']] = $fuel['Name'];
            }

            $viewParams = [
                'userId'        => $userId,
                'expenseList'   => $this->expenseModel->get_expenses(),
                'cars'          => $carModel->list_cars_by_user_id($userId),
                'parsed'        => json_encode($fuelTypes),
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
                $this->expenseModel->add_expense($expense);
                header('Location: /expense/new');
            }
            View::render('new-expense.php', $viewParams);
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
            $data = $this->statisticsModel->get_statistic_by_id($id,$year);

            $viewParams = [
                'data' => $data,
                'expenseModel' => $this->expenseModel,
                'carModel' => $this->carModel,
            ];
            View::render('detailed-info.php', $viewParams);
        } else {
            header("Location: /statistics");
        }
    }

    public function removeAction($params)
    {
        $title = "Детайлна справка";
        if (isset($params['id']) && isset($params['year'])) {
            $id = $params['id'];
            $year = $params['year'];
            /** proper way to work */
            if (isset($_POST['id']) && isset($_POST['year'])) {
                $this->expenseModel->remove_expense($_POST['id'],$_POST['year']);
                header("Location: /statistics");
            }
            $viewParams = [
                'id'            => $id,
                'year'          => $year,
                'data'          => $this->statisticsModel->get_statistic_by_id($id,$year),
                'expenseModel'  => $this->expenseModel,
                'carModel'      => $this->carModel,
            ];
            View::render('remove-expense.php', $viewParams);
        } else {
            /** exit state */
            header('Location: /statistics');
        }
    }
}