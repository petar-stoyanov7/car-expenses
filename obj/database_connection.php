<?php
	class database_connection {
		private $connection;

		public function __construct() {
			//$this->connection = new mysqli("localhost","expense","avto-r4zhod1","car_expenses");
			$this->connection = new mysqli("localhost","pestart_expense","avto-r4zhod1","pestart_car_expenses");
		}

		

		public function get_connection() {
			$this->connection;
		}

		public function get_data_from_database($sql) {
			$data = array();
			$result = $this->connection->query($sql);
			if ($this->connection->error) {
				die("Error in execution".$this->connection->error);
			}
			while ($row = $result->fetch_assoc()) {
				array_push($data, $row);
			}
			return $data;
		}

		public function execute_sql_query($sql) {
			$this->connection->query($sql);
			if ($this->connection->error) {
				die("Error in execution".$this->connection->error);
			}
		}
	}
?>