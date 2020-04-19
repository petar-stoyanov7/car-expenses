<?php

namespace Application\Controllers;

use Application\Forms\StatisticsForm;
use \Core\View;
use \Application\Models\StatisticsModel;
use \Application\Models\CarModel;
use \Application\Models\ExpenseModel;

class Statistics
{
    private $statModel;
    private $carModel;
    private $expenseModel;

    public function __construct()
    {
        $this->statModel = new StatisticsModel();
        $this->carModel = new CarModel();
        $this->expenseModel = new ExpenseModel();
    }

    public function indexAction($params)
    {
        if(!empty($params['id'])) {
            $userId = $params['id'];
        } else {
            $userId = $_SESSION['user']['ID'];
        }
        
        $cars = $this->carModel->listCarsByUserId($userId);
        $expenses = $this->expenseModel->getExpenses();
        $form = new StatisticsForm($cars, $expenses);
        $viewParams = [
            'form'  => $form,
            'title' => 'Statistics'
        ];

        if (isset($_SESSION['user'])) {
            if(!empty($_POST)) {
                $start_year = substr($_POST['from'], 0, 4);
                $end_year = substr($_POST['to'], 0, 4);
                if ($start_year > $end_year) {
                    echo "<div class='container'>";
                    display_warning("Некоректен период!");
                    echo "</div>";;
                }
                else {
                    $data['allExpenses'] = $this->statModel->getAllExpensesForPeriod(
                        $_POST['from'],
                        $_POST['to'],
                        $userId,
                        $_POST['car'],
                        $_POST['expense-type']
                    );
                    $data['cars'] = $this->statModel->getOverallForPeriod(
                        $_POST['from'],
                        $_POST['to'],
                        $userId,
                        $_POST['car'],
                        $_POST['expense-type']
                    );
                    $vewParams = array_merge(
                        $viewParams,
                        [
                            'data'          => $data,
                            'carModel'      => $this->carModel,
                            'expenseModel'  => $this->expenseModel
                        ]
                    );
                }
            }

            View::render('statistics.php', $viewParams);

        } else {

            View::render('/Static/statistics.php');
        }
    }
}