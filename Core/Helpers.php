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
?>