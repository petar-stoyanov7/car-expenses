<?php

namespace Application\Models;

use Application\Models\CarModel;
use Application\Models\ExpenseModel;
use Core\DbModelAbstract;

class StatisticsModel extends DbModelAbstract
{ 
    public function __construct()
    {
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

    public function getLastFiveByUserId($uid)
    {
        $year = date('Y');
        $last_year = $year-1;
        $query = "SELECT * FROM `Expense_{$last_year}` WHERE `UID`= ? 
                UNION ALL
                SELECT * FROM `Expense_{$year}` WHERE `UID` = ?
                ORDER BY `Date` DESC LIMIT 5";
        $values = [
            $uid,
            $uid
        ];
        $array = $this->getData($query, $values);
        return $array;
    }

    public function getStatisticForPeriod($start, $end, $uid, $cid, $expense_id)
    {
        $carModel = new CarModel();
        $expenseModel = new ExpenseModel();
        $startYear = date("Y", strtotime($start));
        $endYear = date("Y", strtotime($end));
        $tables = $this->getTableList();
        $data = [];
        $where = "WHERE `Date` >= '".$start."' AND `Date` <= '".$end."' AND `UID` = ".$uid." ";
        $overall = "";
        $sum = "";
        $mileage = "";
        $whereExpense = "";			
        $data['Cars'] = [];		
        if ($cid === "all") {
            $cars = $carModel->listCarsByUserId($uid);
            $whereCar = "";
        } else {
            $cars = [];
            $car = $carModel->getCarById($cid);
            array_push($cars, $car);
            $whereCar = "AND `CID` = ".$cid." ";
        }

        if ($expense_id !== "all") {
            $whereExpense .= " AND `Expense_ID` = ".$expense_id." ";
            $data['Expense'] = $expenseModel->getExpenseName($expense_id);
        } else {
            $whereExpense = "";
        }	
        foreach ($tables as $year => $table) {
            if ($startYear === $endYear) {
                $overall = "SELECT * FROM `Expense_".$startYear."` ".$where.$whereExpense.$whereCar;
                break;
            }
            if ($year < $endYear) {
                $overall .= "SELECT * FROM `".$table."` ".$where.$whereExpense.$whereCar." UNION ALL ";
            } elseif ($year == $endYear) {
                $overall .= "SELECT * FROM `".$table."` ".$where.$whereExpense.$whereCar;
            }
        }
        foreach ($cars as $car) {
            $summaryQuery = "SELECT SUM(`Overall`) as `Sum` FROM ( ";
            $mileageQuery = "SELECT SUM(`Distance`) as `Sum` FROM ( ";
            $whereCar = " AND `CID` = ".$car['ID']." ";
            foreach ($tables as $year => $table) {
                if ($year < $startYear) {
                    continue;					
                } elseif ($year >= $startYear && $year < $endYear) {
                    $summaryQuery .= "SELECT Sum(`Price`) as `Overall` FROM `{$table}` ".$where.$whereExpense.$whereCar." UNION ALL ";
                    $mileageQuery .= "SELECT Max(`Mileage`) - Min(`Mileage`) AS `Distance` FROM `{$table}` ".$where.$whereCar." UNION ALL ";
                } elseif ($year == $endYear) {
                    $summaryQuery .= "SELECT Sum(`Price`) as `Overall` FROM `{$table}` ".$where.$whereExpense.$whereCar." ) as SubQuery";
                    $mileageQuery .= "SELECT Max(`Mileage`) - Min(`Mileage`) AS `Distance` FROM `{$table}` ".$where.$whereCar." ) as SubQuery";
                }
            }

            $name = $carModel->getCarNameById($car['ID']);
            $summary = $this->getData($summaryQuery);
            $mileage = $this->getData($mileageQuery);				
            $temp = array("Name" => $name, "Summary" => $summary[0]['Sum'], "Mileage" => $mileage[0]['Sum']);
            
            array_push($data['Cars'], $temp);

        }
        // echo "overall";
        // display_test($overall);
        $data['Raw'] = $this->getData($overall);

        return $data;
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
}


?>