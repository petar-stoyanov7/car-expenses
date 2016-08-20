<?php
	class Expense {
		private $user_id;
		private $car_id;
		private $date;
		private $mileage;
		private $expense_type;
		private $price;
		private $fuel_type;
		private $liters;
		private $insurance_type;
		private $notes;

		public function __construct($user_id,$car_id,$date,$mileage,$expense_type,$price,$fuel_type="",$liters="",$insurance_type="",$notes="") {
			$this->user_id = $user_id;
			$this->car_id = $car_id;
			$this->date = $date;
			$this->mileage = $mileage;
			$this->expense_type = $expense_type;
			$this->price = $price;
			$this->fuel_type = $fuel_type;
			$this->liters = $liters;
			$this->insurance_type = $insurance_type;
			$this->notes = sanitize($notes,1);
		}

		public function get_property($property) {
			if (property_exists('Expense', $property)) {
				return $this->$property;
			} else {
				die("Non existent property");
			}
		}
	}

?>