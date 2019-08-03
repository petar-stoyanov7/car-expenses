<?php

namespace Application\Models;

class CarModel extends DbModelAbstract
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list_all_cars() {
        $array = $this->getData('SELECT * FROM Cars');
        return $array;
    }

    public function list_cars_by_user_id($uid) {
        $cars_array = $this->getData("SELECT * FROM `Cars` WHERE `UID` = '".$uid."'");
        return $cars_array;
    }

    public function count_cars_by_user_id($uid) {
        $count = $this->getData("SELECT COUNT(*) FROM `Cars` WHERE `UID` = '".$uid."'");
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
        $fuel_array = $this->getData($query);
        return $fuel_array;
    }

    public function get_uid_by_cid($cid) {
        $query = "SELECT `UID` FROM `Cars` WHERE `ID` = ".$cid." LIMIT 1";
        $data = $this->getData($query);
        return $data[0]['UID'];
    }

    public function get_fuels() {
        $query = "SELECT * FROM `Fuel_Types`";
        $fuels = $this->getData($query);
        return $fuels;
    }
    
    public function get_fuel_name($id) {
        $query = "SELECT `NAME` FROM `Fuel_Types` WHERE `ID`=".$id;
        $result = $this->getData($query);
        return $result[0]['NAME'];
    }

    public function get_car_by_id($id) {
        $car_array = $this->getData("SELECT * FROM `Cars` WHERE `ID` = '".$id."'");
        return $car_array[0];
    }

    public function get_car_name_by_id($id) {
        $car_array = $this->getData("SELECT * FROM `Cars` WHERE `ID` = '".$id."'");
        $string = $car_array[0]['Brand']." ".$car_array[0]['Model'];
        return $string;
    }

    public function get_fuel_names() {
        $fuels_list = $this->getData("SELECT `Name` FROM `Fuel_Types`");
        $fuels_array = array();
        foreach ($fuels_list as $fuel) {
            array_push($fuels_array, $fuel['Name']);
        }
        return $fuels_array;
    }
    public function get_fuel_id() {
        $fuels_list = $this->getData("SELECT `ID` FROM `Fuel_Types`");
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
        } elseif (empty($car->get_property("mileage"))) {
            return display_warning("Не е въведен пробег!");
        } elseif ($car->get_property("mileage") < 0) {
            return display_warning("Невалиден пробег!");
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
        $this->execute_sql_query($query);
        display_warning("Автомобилът е добавен успешно!");
        header("refresh:1;url=profile.php");
    }

    public function edit_car($car,$cid) {
        $query = "UPDATE `Cars` SET ";
        if ($car->get_property("mileage") < 0) {
            return display_warning("Невалиден пробег!");
        }
        if (!empty($car->get_property("color"))) {
            $query .= "`Color` = '".$car->get_property("color")."', ";
        } 
        if (!empty($car->get_property("fuel_id2"))) {
            $query .= "`Fuel_ID2` = ".$car->get_property("fuel_id2").", ";
        }
        if (!empty($car->get_property("mileage"))) {
            $query .= "`Mileage` = ".$car->get_property("mileage").", ";
        }
        if (!empty($car->get_property("notes"))) {
            $qury .= "`Notes` = '".$car->get_property("notes")."', ";
        }
        $query .= "`UID` = ".$car->get_property('user_id')." ";
        $query .= "WHERE `ID` = ".$cid;
        $this->execute_sql_query($query);
        display_warning("Промените са направени успешно!");
    }

    public function remove_car_by_id($id) {
        $query = "DELETE FROM `Cars` WHERE `ID`=".$id;
        $this->execute_sql_query($query);
    }

    public function remove_car_by_uid($uid) {
        $query = "DELETE FROM `Cars` WHERE `UID` = ".$uid;
        $this->execute_sql_query($query);
    }
}