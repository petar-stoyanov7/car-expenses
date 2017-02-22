<?php
	require_once("functions.php");
	
	class Expense_DAO {
		private $connection;
		private $year;
		private $table;
		private $car_dao;

		public function __construct() {
			$this->connection = new database_connection();
			$this->car_dao = new Car_DAO();
			$year = getdate()['year'];
			$query = "CREATE TABLE IF NOT EXISTS `Expense_".$year."` (
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
			$this->connection->execute_sql_query($query);
			/*
			#creates new table if month is november
			#for now I'm disabling it, as it doesn't work if nobody accesses the site in nov, dec.
			$newyear = getdate()['year']+1;
			$month = getdate()['mon'];
			
			if($month == 11 || $month == 12) {
				$query = "CREATE TABLE IF NOT EXISTS `Expense_".$newyear."` (
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
				$this->connection->execute_sql_query($query);
			}
			*/
			$this->year = "";
			$this->table = "";
		}

		public function get_table_list() {
			$arrays = $this->connection->get_data_from_database("SHOW TABLES LIKE 'Expense_2%'");
			$list = array();
			foreach ($arrays as $array) {
				$year = substr($array['Tables_in_pestart_car_expenses (Expense_2%)'], -4);
				$list[$year] = $array['Tables_in_pestart_car_expenses (Expense_2%)'];
			}
			return $list;
		}

		public function create_table_year($year) {
			$query = "CREATE TABLE IF NOT EXISTS `Expense_".$year."` (
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
			$this->connection->execute_sql_query($query);
		}
		//might delete this
		public function get_expense_names() {
			$expense_list = $this->connection->get_data_from_database("SELECT `Name` FROM `Expense_Types`");
			$expense_array = array();
			foreach ($expense_list as $expense) {
				array_push($expense_array, $expense['Name']);
			}
			return $expense_array;
		}
		//might delete this
		public function get_expense_id() {
			$expense_list = $this->connection->get_data_from_database("SELECT `ID` FROM `Expense_Types`");
			$expense_array = array();
			foreach ($expense_list as $expense) {
				array_push($expense_array, $expense['ID']);
			}
			return $expense_array;
		}
		public function get_expenses() {
			$expense_list = $this->connection->get_data_from_database("SELECT * FROM `Expense_Types`");
			return $expense_list;
		}
		public function get_expense_name($id) {
			$query = "SELECT `Name` FROM `Expense_Types` WHERE `ID`=".$id;
			$result = $this->connection->get_data_from_database($query);
			return $result[0]['Name'];
		}

		public function get_insurance_names() {
			$insurance_list = $this->connection->get_data_from_database("SELECT `Name` FROM `Insurance_Types`");
			$insurance_array = array();
			foreach ($insurance_list as $insurance) {
				array_push($insurance_array, $insurance['Name']);
			}
			return $insurance_array;
		}
		public function get_insurance_id() {
			$insurance_list = $this->connection->get_data_from_database("SELECT `ID` FROM `Insurance_Types`");
			$insurance_array = array();
			foreach ($insurance_list as $insurance) {
				array_push($insurance_array, $insurance['ID']);
			}
			return $insurance_array;
		}
		public function get_insurance_name($id) {
			$query = "SELECT `Name` FROM `Insurance_Types` WHERE `ID`=".$id;
			$result = $this->connection->get_data_from_database($query);
			return $result[0]['Name'];
		}

		public function add_expense($expense) {
			$year = substr($expense->get_property("date"),0,4);
			if ($year != getdate()['year']) {
				$this->create_table_year($year);
			}
			$car = $this->car_dao->get_car_by_id($expense->get_property("car_id"));
			// Removed this, since I've added the functionality to add expenses from the past.

			// if ($expense->get_property("mileage") < $car['Mileage']) {
			// 	return display_warning("Пробегът не може да е по-малък от настоящия!");
			// } 
			if ($expense->get_property("price") < 0) {
				return display_warning("Стойността на разхода не може да е отрицателна!");
			} elseif ($expense->get_property("liters") < 0) {
				return display_warning("Стойността на литрите не може да е отрицателна!");
			} elseif (($expense->get_property("expense_type") == 0) && 
				($expense->get_property("fuel_type") != $car['Fuel_ID'] && $expense->get_property("fuel_type") != $car['Fuel_ID2'])) {
				return display_warning("Невалиден вид гориво!");
			} elseif (empty($expense->get_property("price"))) {
				return display_warning("Не е въведена стойност на разхода!");
			} elseif (empty($expense->get_property("mileage"))) {
				return display_warning("Не е въведен пробег!");
			} else {
				$query = "INSERT INTO `Expense_".$year."` (
				`UID`, `CID`, `Date`, `Mileage`, `Expense_ID`, `Price`, `Fuel_ID`, `Insurance_ID`, `Liters`, `Notes`)
				VALUES (".$expense->get_property("user_id").", 
						".$expense->get_property("car_id").",
						'".$expense->get_property("date")."',
						".$expense->get_property("mileage").",
						".$expense->get_property("expense_type").",
						".$expense->get_property("price").",
						".$expense->get_property("fuel_type").",
						".$expense->get_property("insurance_type").",
						".$expense->get_property("liters").",
						'".$expense->get_property("notes")."')";
				if ($expense->get_property("mileage") > $car['Mileage']) {
					$update = "UPDATE `Cars` SET `Mileage` = ".$expense->get_property("mileage")." WHERE `ID` = ".$expense->get_property("car_id");
					$this->connection->execute_sql_query($update);
				}
				$this->connection->execute_sql_query($query);
				header('Location: '.$_SERVER['REQUEST_URI']);
			}
		}

		public function get_year() {
			$this->year = getdate()['year'];
			return $this->year;
		}

		public function remove_expense($id,$year) {
			$query = "DELETE FROM `Expense_".$year."` WHERE `ID`=".$id;
			$this->connection->execute_sql_query($query);
		}
	}
?>