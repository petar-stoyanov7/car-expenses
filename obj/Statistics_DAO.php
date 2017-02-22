<?php
	require_once("functions.php");

	class Statistics_DAO {
		private $connection;

		public function __construct() {
			$this->connection = new database_connection();
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

		public function get_last_five_by_uid($uid) {
			$year = date('Y');
			$last_year = $year-1;
			$query = "SELECT * FROM `Expense_".$last_year."` WHERE `UID`=".$uid." 
					UNION ALL
					SELECT * FROM `Expense_".$year."` WHERE `UID`=".$uid."
					ORDER BY `Mileage` DESC LIMIT 5";
			$array = $this->connection->get_data_from_database($query);
			return $array;
		}

		public function get_statistic_for_period($start,$end,$uid,$cid,$expense_id) {			
			$car_dao = new Car_DAO();
			$expense_dao = new Expense_DAO();
			$start_year = substr($start, 0, 4);
			$end_year = substr($end, 0, 4);
			$tables = $this->get_table_list();
			$data = array();
			$where = "WHERE `Date` >= '".$start."' AND `Date` <= '".$end."' AND `UID` = ".$uid." ";
			$overall = "";
			$sum = "";
			$mileage = "";
			$where_exp = "";			
			$data['Cars'] = array();		
			if ($cid == "all") {
				$cars = $car_dao->list_cars_by_user_id($uid);
				$where_car = "";
			} else {
				$cars = array();
				$car = $car_dao->get_car_by_id($cid);
				array_push($cars, $car);
				$where_car = "AND `CID` = ".$cid." ";
			}

			if ($expense_id!="all") {
				$where_exp .= " AND `Expense_ID` = ".$expense_id." ";
				$data['Expense'] = $expense_dao->get_expense_name($expense_id);
			} else {
				$where_exp = "";
			}	
			foreach ($tables as $year => $table) {
				if ($start_year == $end_year) {
					$overall = "SELECT * FROM `Expense_".$start_year."` ".$where.$where_exp.$where_car;
					break;
				}
				if ($year < $end_year) {
					$overall .= "SELECT * FROM `".$table."` ".$where.$where_exp.$where_car." UNION ALL ";
				} elseif ($year = $end_year) {
					$overall .= "SELECT * FROM `".$table."` ".$where.$where_exp.$where_car;
				}
			}
			foreach ($cars as $car) {
				$summary_query = "SELECT SUM(`Overall`) as `Sum` FROM ( ";
				$mileage_query = "SELECT SUM(`Distance`) as `Sum` FROM ( ";
				$where_car = " AND `CID` = ".$car['ID']." ";
				foreach ($tables as $year => $table) {
					if ($year < $start_year) {
						continue;
					} elseif ($year > $start_year && $year < $end_year) {
						$summary_query .= "SELECT Sum(`Price`) as `Overall` FROM `".$table."` ".$where.$where_exp.$where_car." UNION ALL ";
						$mileage_query .= "SELECT Max(`Mileage`) - Min(`Mileage`) AS `Distance` FROM `".$table."` ".$where.$where_car." UNION ALL ";
					} elseif ($year == $end_year) {
						$summary_query .= "SELECT Sum(`Price`) as `Overall` FROM `".$table."` ".$where.$where_exp.$where_car." ) as SubQuery";
						$mileage_query .= "SELECT Max(`Mileage`) - Min(`Mileage`) AS `Distance` FROM `".$table."` ".$where.$where_car." ) as SubQuery";
					}
				}
				// #display the query
				// echo "summary";
				// display_test($summary_query);
				// echo "mileage";
				// display_test($mileage_query);

				$name = $car_dao->get_car_name_by_id($car['ID']);
				$summary = $this->connection->get_data_from_database($summary_query);
				$mileage = $this->connection->get_data_from_database($mileage_query);
				$temp = array("Name" => $name, "Summary" => $summary[0]['Sum'], "Mileage" => $mileage[0]['Sum']);
				
				array_push($data['Cars'], $temp);

			}
			// echo "overall";
			// display_test($overall);
			$raw_data = $this->connection->get_data_from_database($overall);
			$data['Raw'] = $raw_data;

			return $data;
		}

		public function get_statistic_by_id($id,$year="") {
			if (empty($year)) {
				$year = date('Y');
			}
			$query = "SELECT * FROM `Expense_".$year."` WHERE `ID` = ".$id;
			$data = $this->connection->get_data_from_database($query);
			return $data[0];
		}

		public function count_year_expenses_by_uid($uid,$cid="",$year="") {
			if (empty($year)) {
				$year = date('Y');
			}
			if (!empty($cid)) {
				$query = "SELECT SUM(`PRICE`) FROM `Expense_".$year."` WHERE `UID`=".$uid." AND `CID`=".$cid;
			} else {
				$query = "SELECT SUM(`PRICE`) FROM `Expense_".$year."` WHERE `UID`=".$uid;
			}
			$array = $this->connection->get_data_from_database($query);
			if (empty($array[0]["SUM(`PRICE`)"])) {
				return 0;
			} else {
				return $array[0]["SUM(`PRICE`)"];
			}
		}

	}

?>