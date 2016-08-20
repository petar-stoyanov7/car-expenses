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
			$query = "SELECT * FROM `Expense_".$year."` WHERE `UID`=".$uid." ORDER BY `Mileage` DESC LIMIT 5";
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
			$where = "WHERE `Date` >= '".$start."' AND `Date` <= '".$end."' AND `UID` = ".$uid;
			$overall = "";
			$sum = "SELECT SUM(`Overall`) as `Sum` FROM ( ";
			$mileage = "SELECT SUM(`Distance`) as `Sum` FROM ( ";
			if ($cid!="all") {
				$where = $where." AND `CID` = ".$cid;
				$data['Car'] = $car_dao->get_car_name_by_id($cid);
			}
			if ($expense_id!="all") {
				$where = $where." AND `Expense_ID` = ".$expense_id;
				$data['Expense'] = $expense_dao->get_expense_name($expense_id);
			}
			foreach ($tables as $year => $table) {
				if ($year < $end_year) {
					$overall .= "SELECT * FROM `".$table."` ".$where." UNION ALL ";
					$sum .= "SELECT Sum(`Price`) as `Overall` FROM `".$table."` ".$where." UNION ALL ";
					$mileage .= "SELECT Max(`Mileage`) - Min(`Mileage`) AS `Distance` FROM `".$table."` ".$where." UNION ALL ";
				} elseif ($year = $end_year) {
					$overall .= "SELECT * FROM `".$table."` ".$where;
					$sum .= "SELECT Sum(`Price`) as `Overall` FROM `".$table."` ".$where." ) as SubQuery";
					$mileage .= "SELECT Max(`Mileage`) - Min(`Mileage`) AS `Distance` FROM `".$table."` ".$where." ) as SubQuery";
				}
			}		
			$raw_data = $this->connection->get_data_from_database($overall);
			$summary = $this->connection->get_data_from_database($sum);
			$mileage = $this->connection->get_data_from_database($mileage);
			$data['Summary'] = $summary[0]['Sum'];
			$data['Mileage'] = $mileage[0]['Sum'];
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