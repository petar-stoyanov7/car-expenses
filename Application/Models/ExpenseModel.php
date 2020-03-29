<?php

namespace Application\Models;

use Application\Models\CarModel;
	
class ExpenseModel extends DbModelAbstract 
{    
    private $carModel;

    public function __construct() {
        parent::__construct();
        $this->carModel = new CarModel();
        $year = getdate()['year'];
        $query = "CREATE TABLE IF NOT EXISTS `Expense_{$year}` (
                        `ID` int primary key auto_increment,
                        `UID` int references `Users`(`ID`),
                        `CID` int references `Cars`(`ID`),
                        `Date` date,
                        `Mileage` int,
                        `Price` int,
                        `Expense_ID` int references `Expense_Types`(`ID`),
                        `Fuel_ID` int references `Fuel_Types`(`ID`),
                        `Insurance_ID` int references `Insurance_Types`(`ID`),
                        `Liters` int,
                        `Notes` text
                        ) CHARSET=utf8";				
        $this->execute($query);
        $this->year = "";
        $this->table = "";
    }

    public function getTableList() {
        $arrays = $this->getData("SHOW TABLES LIKE 'Expense_2%'");
        $list = array();
        foreach ($arrays as $array) {
            $year = substr($array['Tables_in_pestart_car_expenses (Expense_2%)'], -4);
            $list[$year] = $array['Tables_in_pestart_car_expenses (Expense_2%)'];
        }
        return $list;
    }

    public function createTableYear($year) {
        $query = "CREATE TABLE IF NOT EXISTS `Expense_{$year}` (
                        `ID` int primary key auto_increment,
                        `UID` int references `Users`(`ID`),
                        `CID` int references `Cars`(`ID`),
                        `Date` date,
                        `Mileage` int,
                        `Price` int,
                        `Expense_ID` int references `Expense_Types`(`ID`),
                        `Fuel_ID` int references `Fuel_Types`(`ID`),
                        `Insurance_ID` int references `Insurance_Types`(`ID`),
                        `Liters` int,
                        `Notes` text
                        ) CHARSET=utf8";
        $this->execute($query);
    }
    //might delete this
    public function getExpenseNames() {
        $expenseList = $this->getData("SELECT `Name` FROM `Expense_Types`");
        $expenseArray = array();
        foreach ($expenseList as $expense) {
            array_push($expenseArray, $expense['Name']);
        }
        return $expenseArray;
    }
    //might delete this
    public function getExpenseId() {
        $expenseList = $this->getData("SELECT `ID` FROM `Expense_Types`");
        $expenseArray = array();
        foreach ($expenseList as $expense) {
            array_push($expenseArray, $expense['ID']);
        }
        return $expenseArray;
    }

    public function getExpenses() {
        return $this->getData("SELECT * FROM `Expense_Types`");
    }
    
    public function getExpenseName($id) {
        $query = "SELECT `Name` FROM `Expense_Types` WHERE `ID`=".$id;
        $result = $this->getData($query);
        return $result[0]['Name'];
    }

    public function getInsuranceNames() {
        $insuranceList = $this->getData("SELECT `Name` FROM `Insurance_Types`");
        $insuranceArray = [];
        foreach ($insuranceList as $insurance) {
            array_push($insuranceArray, $insurance['Name']);
        }
        return $insuranceArray;
    }
    public function getInsuranceId() {
        $insuranceList = $this->getData("SELECT `ID` FROM `Insurance_Types`");
        $insuranceArray = array();
        foreach ($insuranceList as $insurance) {
            array_push($insuranceArray, $insurance['ID']);
        }
        return $insuranceArray;
    }
    public function getInsuranceName($id) {
        $query = "SELECT `Name` FROM `Insurance_Types` WHERE `ID`=".$id;
        $result = $this->getData($query);
        return $result[0]['Name'];
    }

    public function addExpense($expense) {
        $year = substr($expense->getProperty("date"),0,4);
        $expenseTables = $this->getTableList();
        if (!array_key_exists($year, $expenseTables)) {
            $this->createTableYear($year);
        }
        $car = $this->carModel->getCarById($expense->getProperty("car_id"));
        if (empty($expense->getProperty("mileage"))) {
            $expense->setProperty('mileage', $car['Mileage']);
        }
        if ($expense->getProperty("price") < 0) {
            return display_warning("Стойността на разхода не може да е отрицателна!");
        } elseif ($expense->getProperty("liters") < 0) {
            return display_warning("Стойността на литрите не може да е отрицателна!");
        } elseif (($expense->getProperty("expense_type") == 0) && 
            ($expense->getProperty("fuel_type") != $car['Fuel_ID'] && $expense->getProperty("fuel_type") != $car['Fuel_ID2'])) {
            return display_warning("Невалиден вид гориво!");
        } elseif (empty($expense->getProperty("price"))) {
            return display_warning("Не е въведена стойност на разхода!");
        } else {
            $query = "INSERT INTO `Expense_{$year}` (
            `UID`, `CID`, `Date`, `Mileage`, `Expense_ID`, `Price`, `Fuel_ID`, `Insurance_ID`, `Liters`, `Notes`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $values = [
                $expense->getProperty("user_id"),
                $expense->getProperty("car_id"),
                $expense->getProperty("date"),
                $expense->getProperty("mileage"),
                $expense->getProperty("expense_type"),
                $expense->getProperty("price"),
                $expense->getProperty("fuel_type"),
                $expense->getProperty("insurance_type"),
                $expense->getProperty("liters"),
                $expense->getProperty("notes"),
            ];
            if ($expense->getProperty("mileage") > $car['Mileage']) {
                $update = "UPDATE `Cars` SET `Mileage` = ? WHERE `ID` = ?";
                $updateValues = [$expense->getProperty("mileage"), $expense->getProperty("car_id")];
                $this->execute($update, $updateValues);
            }
            $this->execute($query, $values);
        }
    }

    public function removeExpense($id, $year) {
        $query = "DELETE FROM `Expense_{$year}` WHERE `ID`= ?";
        $values = [$id];
        $this->execute($query, $values);
    }    
}
?>