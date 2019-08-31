<?php

function display_warning($text) {
	echo "<br>";
	echo "<span class='warn'>";
	echo $text."<br>";
	echo "</span>";
}

function display_success($text) {
	echo "<br>";
	echo "<span class='success'>";
	echo $text."<br>";
	echo "</span>";
}

function dt($value) {
	echo "<pre>";
	print_r($value);
	echo "<pre>";
}

function nullify($array) {
	foreach ($array as $key => $value) {
		if ($value === 'NULL') {
			$array[$key] = NULL;
		}
	}
	return $array;
}

function sanitize($string,$punctuation="") {
	if (empty($string)) {
		return $string;
	}
	$counter = 0;
	if (empty($punctuation)) {
		$check = '/[\!\?\.\,\@\`\~\#\$\%\^\&\*\(\)\-\_\=\+\\\;\:\'\"\|\<\>\/\|]{1}/';
	} else {
		$check = '/[\`\~\#\$\%\^\&\*\(\)\-\_\=\+\\\;\:\'\"\|\<\>\/\|]{1}/';
	}
	$invalid = "";
	for ($i=0;$i<strlen($string);$i++) {
		if (preg_match($check, $string[$i])) {
			$invalid .= " ".$string[$i];
		} else {			
			$counter++;
		}
	}
	if (strlen($string) != $counter) {
		die(display_warning("Невалидни символи \" ".$invalid." \""));
	} else {
		return $string;
	}
}

function convert_date($date) {
	$year = substr($date, 0,4);
	$month = substr($date, 5,2);
	$day = substr($date, 8,2);
	$bgdate = $day.".".$month.".".$year;
	return $bgdate;
}

function translate($str) {
	switch ($str){
		case "Fuel":
			return "Гориво";
			break;
		case 'Insurance':
			return "Застраховка";
			break;
		case 'Maintenance':
			return "Ремонт";
			break;
		case 'Tax':
			return "Данък";
			break;
		case 'Other':
			return "Други";
			break;
		case 'Gas':
			return "Бензин";
			break;
		case 'Diesel':
			return "Дизел";
			break;
		case 'LPG':
			return "Газ";
			break;
		case 'Methane':
			return "Метан";
			break;
		case 'Electricity':
			return "Електричество";
			break;
		case 'Fuel':
			return "Гориво";
			break;
		case 'GO':
			return "Гражданска Отговорност";
			break;
		case 'Kasko':
			return "Каско";
			break;
		default:
			return $str;			
			break;
	}
}

function fuel_options($uid="") {
	$car_dao = new Car_DAO();
	if (!empty($uid)) {
		$fuel_list = $car_dao->get_user_fuel_types($uid);
	} else {
		$fuel_list = $car_dao->get_fuels();
	}
	foreach($fuel_list as $fuel) {
		echo '<option value='.$fuel['ID'].'>'.translate($fuel['Name']).'</option>';		
	}
}

function insurance_options() {
	$expense_dao = new Expense_DAO();	
	foreach($expense_dao->get_insurance_id() as $id) {
		switch ($id) {
			case 1:
				$name = "Гражданска Отговорност";
				break;
			case 2:
				$name = "Каско";
				break;
			case 3:
				$name = "Друга";
				break;
			default:							
				break;
		}
		echo '<option value="'.$id.'">'.$name.'</option>';
	}
}

?>