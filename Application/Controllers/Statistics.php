<?php

namespace Application\Controllers;

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
        $title = "Статистика";

        if(!empty($params['id'])) {
            $userId = $params['id'];
        } else {
            $userId = $_SESSION['user']['ID'];
        }
        
        $viewParams = [
            'cars' => $this->carModel->listCarsByUserId($userId),
            'expenses' => $this->expenseModel->getExpenses(),
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
                    $viewParams['data'] = $this->statModel->getStatisticForPeriod(
                        $_POST['from'],
                        $_POST['to'],
                        $userId,
                        $_POST['car'],
                        $_POST['expense-type']
                    );
                    $viewParams['carModel'] = $this->carModel;
                    $viewParams['expenseModel'] = $this->expenseModel;
                }
            }

            View::render('statistics.php', $viewParams);

        } else {

            View::render('/Static/statistics.php');
        }
    }
}