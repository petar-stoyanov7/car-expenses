<?php

namespace Application\Models;

use Application\Models\CarModel;
use Application\Models\ExpenseModel;
use Core\DbModelAbstract;

class StatisticsModel extends DbModelAbstract
{
    private $carModel;
    private $expenseModel;

    public function __construct()
    {
        $this->carModel = new CarModel();
        $this->expenseModel = new ExpenseModel();
        parent::__construct();        
    }

    public function getTableList()
    {
        $arrays = $this->getData("SHOW TABLES LIKE 'Expense_2%'");
        $list = [];
        foreach ($arrays as $array) {
            $year = substr($array['Tables_in_pestart_car_expenses (Expense_2%)'], -4);
            $list[$year] = $array['Tables_in_pestart_car_expenses (Expense_2%)'];
        }
        return $list;
    }

    public function getLastByUserId($uid, $limit = 5)
    {
        $year = date('Y');
        $result = [];
        $tableList = $this->expenseModel->getTableList();
        while($limit > 0) {
            $query = "SELECT * FROM `Expense_{$year}` WHERE `UID`= ?
                ORDER BY `ID` DESC LIMIT {$limit}";
            $array = $this->getData($query, [$uid]);
            $result = array_merge($result, $array);
            $limit = $limit - count($array);
            $year--;
            if (!array_key_exists($year, $tableList)) {
                //can't go back any further
                $limit = 0;
            }
        }
        return $result;
    }

    public function getAllExpensesForPeriod($start, $end, $userId, $carId, $expenseId)
    {
        $startYear = date("Y", strtotime($start));
        $endYear = date("Y", strtotime($end));
        $queryDetails = $this->_getWhere($start, $end, $userId, $carId, $expenseId);
        $where = $queryDetails['where'];
        $queryParams = $queryDetails['params'];
        $query = '';
        $params = [];

        if ($startYear === $endYear) {
            $query = "SELECT * FROM `Expense_{$startYear}` " . $where;
            $params = $queryParams;
        } else {
            for ($y = $startYear; $y <= $endYear; $y++) {
                $query .= "SELECT * FROM `Expense_{$y}` {$where} UNION ALL ";
                $params = array_merge($params, $queryParams);
            }
            $query = preg_replace('/ UNION ALL $/', '', $query);
        }

        return $this->getData($query, $params);
    }

    public function getOverallForPeriod($start, $end, $userId, $carId, $expenseId) {
        if ($carId === "all") {
            $cars = $this->carModel->listCarsByUserId($userId);
        } else {
            $cars[] = $this->carModel->getCarById($carId);
        }
        $result = [];
        foreach ($cars as $car) {
            $data = $this->getCarOverallForPeriod(
                $start,
                $end,
                $userId,
                $car['ID'],
                $expenseId
            );
            $result[$car['ID']] = array_merge($data, $car);
        }

        return $result;
    }

    public function getCarOverallForPeriod($start, $end, $userId, $carId, $expenseId) {
        $startYear = date("Y", strtotime($start));
        $endYear = date("Y", strtotime($end));
        $queryDetails = $this->_getWhere($start, $end, $userId, $carId, $expenseId);
        $where = $queryDetails['where'];
        $queryParams = $queryDetails['params'];
        $params = [];

        if ($startYear === $endYear) {
            $query = "SELECT Sum(`Price`) as `Overall`, Max(`Mileage`) - Min(`Mileage`) as `Distance` FROM Expense_{$startYear} {$where}";
            $params = $queryParams;
        } else {
            $query = "SELECT Sum(`Price`) as `Overall`, Sum(`Distance`) as `Distance` FROM (";
            for ($y = $startYear; $y <= $endYear; $y++) {
                $table = "Expense_{$y}";
                $query .= "SELECT sum(Price) as Price, Max(Mileage) - Min(Mileage) as Distance FROM {$table} {$where} UNION ALL ";
                $params = array_merge($params, $queryParams);
            }
            $query = preg_replace('/ UNION ALL $/', '', $query);
            $query .= ') as SubQuery';
        }

        $result = $this->getData($query, $params);

        return !empty($result) ? $result[0] : [];
    }

    public function getStatisticById($id, $year="")
    {
        if (empty($year)) {
            $year = date('Y');
        }
        $query = "SELECT * FROM `Expense_".$year."` WHERE `ID` = ".$id;
        $data = $this->getData($query)
;			return $data[0];
    }

    public function countYearExpensesByUserId($uid, $cid="", $year="")
    {
        if (empty($year)) {
            $year = date('Y');
        }
        if (!empty($cid)) {
            $query = "SELECT SUM(`PRICE`) FROM `Expense_".$year."` WHERE `UID`=".$uid." AND `CID`=".$cid;
        } else {
            $query = "SELECT SUM(`PRICE`) FROM `Expense_".$year."` WHERE `UID`=".$uid;
        }
        $array = $this->getData($query);
        if (empty($array[0]["SUM(`PRICE`)"])) {
            return 0;
        } else {
            return $array[0]["SUM(`PRICE`)"];
        }
    }

    private function _getWhere($start, $end, $userId, $carId, $expenseId)
    {
        $where = "WHERE `Date` >= ? AND `Date` <= ? AND `UID` = ? ";
        $params = [$start, $end, $userId];

        if ($carId !== "all") {
            $where .= "AND `CID` = ? ";
            $params[] = $carId;
        }

        if ($expenseId !== "all") {
            $where .= " AND `Expense_ID` = ? ";
            $params[] = $expenseId;
            $data['Expense'] = $expenseModel->getExpenseName($expenseId);
        }

        $result['where'] = $where;
        $result['params'] = $params;
        return $result;
    }
}


?>