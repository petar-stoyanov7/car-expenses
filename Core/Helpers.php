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

function show_user_brief($uid) {
	$car_dao = new Car_DAO();
	$expense_dao = new Expense_DAO();
	$statistics = new Statistics_DAO();
	$user_dao = new User_DAO();
	$user = $user_dao->get_user_by_id($uid);
	$cars = $car_dao->list_cars_by_user_id($uid);
	$greet = $user['Sex']=="male" ? "дошъл" : "дошла";
	echo '<div class="container">';
	echo '<h3>Автомобили:</h3>';
	$i = 1;
	foreach ($cars as $car) {
		echo '<div class="element">';
		echo '<h4>Автомобил '.$i++.':</h4>';
		echo $car['Brand'].' '.$car['Model'].' '.$car['Year'].'<br>';
		echo '<b>Километри</b>: '.$car['Mileage'].' км<br>';
		echo '<b>Похарчени за '.date('Y').' година:</b> '.$statistics->count_year_expenses_by_uid($_SESSION["user"]["ID"],$car['ID']).' лв.';
		echo '</div>';
	}
	echo '</div>';

	echo '<div class="container">';
	echo '<h3>Последни пет:</h3>';
	echo '<table class="expenses">';
	echo '<tr>';
	echo 	'<th>Километри</th>';
	echo 	'<th>Автомобил</th>';
	echo 	'<th>Тип разход</th>';
	echo 	'<th>Тип:</th>';
	echo 	'<th>Стойност</th>';
	echo 	'<th>Бележки</th>';
	echo '</tr>';

	$last_five_array = $statistics->get_last_five_by_uid($user['ID']);
	if (empty($last_five_array)) {
		echo "<tr>";
		echo "<td>Няма разходи</td>";
		echo "<td>Няма разходи</td>";
		echo "<td>Няма разходи</td>";
		echo "<td>Няма разходи</td>";
		echo "<td>Няма разходи</td>";
		echo "<td>Няма разходи</td>";
		echo "</tr>";
	}
	foreach ($last_five_array as $array) {
		$car_name = $car_dao->get_car_name_by_id($array['CID']);
		echo "<tr>";
		echo "<td>".$array['Mileage']."</td>";
		echo "<td>".$car_name."</td>";
		$expense_name = $expense_dao->get_expense_name($array['Expense_ID']);
		echo "<td>".translate($expense_name)."</td>";
		switch ($array['Expense_ID']) {
			case 1:
				$expense_type = $car_dao->get_fuel_name($array['Fuel_ID']);
				$expense_type = translate($expense_type);
				break;
			case 2:
				$expense_type = $expense_dao->get_insurance_name($array['Insurance_ID']);
				$expense_type = translate($expense_type);
				break;			
			default:
				$expense_type = "";
				break;
		}
		echo "<td>".$expense_type."</td>";
		echo "<td>".$array['Price']. "лв.</td>";
		echo "<td>".$array["Notes"]."</td>";
		echo "</tr>";
	}	
	echo '</table>';
	echo '</div>';
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