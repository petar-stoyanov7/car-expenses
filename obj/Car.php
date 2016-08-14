<?php
	class Car {
		private $user_id;
		private $brand;
		private $model;
		private $year;
		private $color;
		private $mileage;
		private $fuel_id;
		private $fuel_id2;
		private $notes;

		public function __construct($user_id,$brand,$model,$year,$color,$mileage,$fuel_id,$fuel_id2="",$notes="") {
			$this->user_id = $user_id;
			$this->brand = $brand;
			$this->model = $model;
			$this->year = $year;
			$this->color = $color;
			$this->mileage = $mileage;
			$this->fuel_id = $fuel_id;
			$this->fuel_id2 = $fuel_id2;
			$this->notes = $notes;
		}

		//get the value of a property
		public function get_property($property) {
			if (property_exists('Car', $property)) {
				return $this->$property;
			} else {
				die("Non existent property");
			}
		}

		//debugger
		public function say_hello() {
			echo "<br>Helo from ".$this->brand." ".$this->model."!";
			echo "<br>I am from ".$this->year." and I drive on ".$this->fuel_id."!";
		}
	}
?>