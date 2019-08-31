<?php

namespace Application\Classes;

class Car 
{
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
        $this->brand = sanitize($brand);
        $this->model = sanitize($model);
        $this->year = sanitize($year);
        $this->color = sanitize($color);
        $this->mileage = $mileage;
        $this->fuel_id = $fuel_id;
        $this->fuel_id2 = $fuel_id2;
        $this->notes = sanitize($notes,1);
    }

    public function get_property($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            die("Non existent property");
        }
    }

	public function set_property($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		} else {
			die("Non existent property");
		}
	}
}
?>