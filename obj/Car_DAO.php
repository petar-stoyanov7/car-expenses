<?php
	require_once("functions.php");
	class Car_DAO {
		/*Car construct:
		__construct($user_id,$brand,$model,$year,$color,$mileage,$fuel_id,$fuel_id2="",$notes="")
		*/
		private $connection;
		
		public function __construct() {
			$this->connection = new database_connection();
		}

		public function list_all_cars() {
			$array = $this->connection->get_data_from_database("SELECT * FROM `Cars`");
			return $array;
		}

		public function list_cars_by_user_id($uid) {
			$cars_array = $this->connection->get_data_from_database("SELECT * FROM `Cars` WHERE `UID` = '".$uid."'");
			return $cars_array;
		}

		public function count_cars_by_user_id($uid) {
			$count = $this->connection->get_data_from_database("SELECT COUNT(*) FROM `Cars` WHERE `UID` = '".$uid."'");
			return $count[0]["COUNT(*)"];
		}

		public function get_user_fuel_types($uid) {
			$query = "SELECT DISTINCT `Cars`.`Fuel_ID` AS `ID`, `Fuel_Types`.`Name` FROM `Cars`
						JOIN `Fuel_Types`
						ON `Cars`.`Fuel_ID` = `Fuel_Types`.`ID`
						WHERE `Cars`.`UID` = ".$uid."
						UNION ALL
						SELECT DISTINCT `Cars`.`Fuel_ID2` AS `ID`, `Fuel_Types`.`Name` FROM `Cars`
						JOIN `Fuel_Types`
						ON `Cars`.`Fuel_ID2` = `Fuel_Types`.`ID`
						WHERE `Cars`.`UID` = ".$uid." ORDER BY `ID` ASC";
			$fuel_array = $this->connection->get_data_from_database($query);			
			return $fuel_array;
		}
		public function get_fuels() {
			$query = "SELECT * FROM `Fuel_Types`";
			$fuels = $this->connection->get_data_from_database($query);
			return $fuels;
		}
		public function get_fuel_name($id) {
			$query = "SELECT `NAME` FROM `Fuel_Types` WHERE `ID`=".$id;
			$result = $this->connection->get_data_from_database($query);
			return $result[0]['NAME'];
		}
		
		public function get_car_by_uid($uid) {
			$cars_array = $this->connection->get_data_from_database("SELECT * FROM `Cars` WHERE `UID` = '".$uid."'");
			return $cars_array;
		}

		public function get_car_by_id($id) {
			$car_array = $this->connection->get_data_from_database("SELECT * FROM `Cars` WHERE `ID` = '".$id."'");
			return $car_array[0];
		}

		public function get_car_name_by_id($id) {
			$car_array = $this->connection->get_data_from_database("SELECT * FROM `Cars` WHERE `ID` = '".$id."'");
			$string = $car_array[0]['Brand']." ".$car_array[0]['Model'];
			return $string;
		}

		public function get_fuel_names() {
			$fuels_list = $this->connection->get_data_from_database("SELECT `Name` FROM `Fuel_Types`");
			$fuels_array = array();
			foreach ($fuels_list as $fuel) {
				array_push($fuels_array, $fuel['Name']);
			}
			return $fuels_array;
		}
		public function get_fuel_id() {
			$fuels_list = $this->connection->get_data_from_database("SELECT `ID` FROM `Fuel_Types`");
			$fuels_array = array();
			foreach ($fuels_list as $fuel) {
				array_push($fuels_array, $fuel['ID']);
			}
			return $fuels_array;
		}
		
		public function add_car($car) {
			if (empty($car->get_property("brand"))) {
				return display_warning("Не е въведена марка!");
			} elseif (empty($car->get_property("model"))) {
				return display_warning("Не е въведен модел!");
			} elseif (empty($car->get_property("fuel_id"))) {
				return display_warning("Не е въведено гориво!");
			}
			$query = "INSERT INTO `Cars` (`UID`, `Brand`, `Model`, `Year`, `Color`, `Mileage`, `Fuel_ID`, `Fuel_ID2`, `Notes`)
								VALUES (".$car->get_property("user_id").",
										'".$car->get_property("brand")."',
										'".$car->get_property("model")."',
										'".$car->get_property("year")."',
										'".$car->get_property("color")."',
										".$car->get_property("mileage").",
										".$car->get_property("fuel_id").",
										".$car->get_property("fuel_id2").",
										'".$car->get_property("notes")."')";
			$this->connection->execute_sql_query($query);
			display_warning("Автомобилът е добавен успешно!");
			header("refresh:1;url=profile.php");
		}

		public function remove_car_by_id($id) {
			$query = "DELETE FROM `Cars` WHERE `ID`=".$id;
			$this->connection->execute_sql_query($query);
		}

		public function remove_car_by_uid($uid) {
			$query = "DELETE FROM `Cars` WHERE `UID` = ".$uid;
			$this->connection->execute_sql_query($query);
		}
	}
?>