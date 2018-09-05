<?php
	class database_connection {
		private $connection;
		private $host = "localhost";
		private $db = "pestart_car_expenses";
		private $usr = "pestart_expense";
		private $pwd = "avto-r4zhod1";

		public function __construct() {
			try {
				$this->connection = new PDO("mysql:host=$this->host; dbname=$this->db",$this->usr,$this->pwd);
			} catch(PDOException $e) {
				die("Could not connect: $e->getMessage()");
			}
		}		

		public function get_data_from_database($sql) {
			echo $query;
			$data = array();
			$result = $this->connection->prepare($sql);
			$result->execute();
			$data = $result->fetchAll(PDO::FETCH_ASSOC);
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