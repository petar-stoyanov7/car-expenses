<?php

function display_warning($text) {
	echo "<br>";
	echo "<span class='warn'>";
	echo $text."<br>";
	echo "</span>";
}

function display_test($value) {
	echo "<pre>";
	print_r($value);
	echo "<pre>";
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

function show_back_button() {
	echo '<form method="post" action='.$_SERVER['HTTP_REFERER'].'>';
	echo '<button type="submit">Назад</button>';
	echo '</form>';
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

function display_edit_profile($profile,$auth=0) {
	echo '<h3>Редактирай профил</h3>
		<form method="post" action="#">
		Редакция на профил: <b>'.$profile['Username'].'</b><br><br>';
		echo '<input type="hidden" name="user" value="'.$profile['Username'].'">';
		if ($auth==0) {
			echo '<label for="old_password">Текуща парола:</label>';
			echo '<input id="old_password" type="password" name="old_password"><br><br>';
		}
		echo '<label for="password1">Нова парола:</label>
		<input id="password1" type="password" name="password1" placeholder="Ако не желаеш смяна на парола,"><br>
		<label for="password2">Повтори паролата:</label>
		<input id="password2" type="password" name="password2" placeholder="Остави полето празно"><br>

		<label for="fname">Име:</label>
		<input id="fname" name="fname" type="name" placeholder="Настоящо име: '.$profile['Fname'].'"><br>
		<label for="lname">Фамилия</label>
		<input id="lname" name="lname" type="name" placeholder="Настояща фамилия: '.$profile['Lname'].'"><br>
		<label for="city">Град</label>
		<input id="city" name="city" type="name" placeholder="Настоящ град: '.$profile['City'].'"><br>
		<br>
		<button type="submit">Редактирай</button>
		</form>';
}

function display_edit_car($car) {
	echo '<h3>Редактирай автомобил</h3>
		<form method="post" action="#">
		Редакция на автомобил: <b>'.$car['Brand'].' '.$car['Model'].'</b><br><br>';
		echo '<input type="hidden" name="uid" value="'.$car['UID'].'">';
		echo '<input type="hidden" name="cid" value="'.$car['ID'].'">';
		echo '<label for="color">Цвят</label>';
		echo '<input id="color" type="text" name="color" placeholder="Настоящ цвят: '.$car['Color'].'"><br>';
		echo '<label for="mileage">Пробег</label>';
		echo '<input id="mileage" type="number" name="mileage" placeholder="Настоящ пробег: '.$car['Mileage'].'"><br>';
		echo '<label for="fuel_id2">Втори вид гориво:</label>';
		echo '<select id="fuel_id2" name="fuel_id2">';
		echo '<option value="NULL">Няма</option>';
 		fuel_options();
		echo '</select><br>';		
		echo '<label for="info">Бележки:</label><br>';
		echo '<textarea id="info" cols="55" rows="5" name="notes"></textarea><br><br>';
		echo '<button type="submit">Редактирай</button>';
		echo '</form>'; 
}



function display_statistics_input($uid) {
	$car_dao = new Car_DAO();
	$expense_dao = new Expense_DAO();
	$cars = $car_dao->list_cars_by_user_id($uid);
	$expenses = $expense_dao->get_expenses();
	echo '<form method="post" action="#">';
	echo '<label for="car">Автомобил</label>';
	echo '<select id="car" name="car">';
	echo '<option value="all">Всички</option>';
	foreach ($cars as $car) {
		echo '<option value="'.$car['ID'].'">'.$car['Brand'].' '.$car['Model'].'</option>';
	}	
	echo '</select><br>';
	echo '<label for="expense-type">Тип разход</label>';
	echo '<select id="expense-type" name="expense-type">';
	echo '<option value="all">Всички</option>';
	foreach ($expenses as $expense) {
		echo '<option value="'.$expense['ID'].'">'.translate($expense['Name']).'</option>';
	}
	echo '</select><br>';
	echo '<label for="from">От дата</label>';
	echo '<input id="from" type="date" name="from" value="'.date('Y').'-01-01"><br>';
	echo '<label for="to">До дата</label>';
	echo '<input id="to" type="date" name="to" value="'.date('Y-m-d').'"><br>';
	
	echo '<button type="submit">Извлечи статистика</button>';
	echo '</form>';
}

function display_detailed_statistics($raw_data) {
	echo '<div class="container">';
	echo '<h3>Детайлна Статистика</h3>';
	$data = $raw_data['Raw'];
	$car_dao = new Car_DAO();
	$expense_dao = new Expense_DAO();
	echo '<table class="expenses">';
	echo '<tr>
			<th>Пробег</th>
			<th>Дата</th>
			<th>Автомобил</th>
			<th>Тип разход</th>
			<th>Литри:</th>
			<th>Стойност</th>
			<th>Допълнителна информация</th>
			<th>Изтрий</th>
			<th>Детайли</th>
		</tr>';
	foreach ($data as $row) {
		echo '<tr>';
			echo '<td>'.$row['Mileage'].'</td>';
			echo '<td> '.convert_date($row['Date']).'</td>';
			echo '<td>'.$car_dao->get_car_name_by_id($row['CID']).'</td>';
			echo '<td>'.translate($expense_dao->get_expense_name($row['Expense_ID'])).'</td>';
			echo '<td>'.$row['Liters'].'</td>';
			echo '<td>'.$row['Price'].'</td>';
			echo '<td>'.substr($row['Notes'],0,18).'...</td>';
			echo '<td> <a href="remove-expense.php?id='.$row['ID'].'&year='.substr($row['Date'], 0, 4).'"><img class="icon" src="./img/icon-delete.png"></a> </td>';
			echo '<td> <a href="detailed-info.php?id='.$row['ID'].'&year='.substr($row['Date'], 0, 4).'" target="_blank">[!]</a> </td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</div>';
}
function display_overall_statistics($raw_data) {
	echo '<div class="container">';
	echo '<h3>Общо:</h3>';
	
	//$car = isset($raw_data['Car']) ? $raw_data['Car'] : "Всички";
	$cars = $raw_data['Cars'];
	foreach ($cars as $car) {
		echo '<div class="element">';
		echo '<b>Автомобил:</b> '.$car['Name'].'<br>';
		echo '<b>Изминати километри:</b>'.$car['Mileage'];
		echo '<br>';echo '<b>Похарчени:</b> '.$car['Summary'].'<br>';
		$ratio = $car['Summary'] / $car['Mileage'];
		echo '<b>Лв/Км:</b>'.round($ratio,3);
		echo '</div>';
	}	
	echo '</div>';
}

function display_expense_details($id,$year) {
	$statistics_dao = new Statistics_DAO();
	$expense_dao = new Expense_DAO();
	$car_dao = new Car_DAO();
	$data = $statistics_dao->get_statistic_by_id($id,$year);

	echo '<b>Дата: </b>'.convert_date($data['Date']).'<br>';
	echo '<b>Пробег: </b>'.$data['Mileage'].' км. <br>';
	echo '<b>Тип:</b>'.translate($expense_dao->get_expense_name($data['Expense_ID'])).'<br>';
	if (!empty($data['Fuel_ID'])) {
		echo '<b>Тип Гориво:</b> '.translate($car_dao->get_fuel_name($data['Fuel_ID'])).'<br>';
		echo '<b>Литри:</b> '.$data['Liters'].'<br>';
	}
	if (!empty($data['Insurance_ID'])) {
		echo '<b>Тип Застраховка:</b> '.translate($expense_dao->get_insurance_name($data['Insurance_ID'])).'<br>';
	}
	echo '<b>Стойност:</b>'.$data['Price'].'<br>';
	echo '<b>Допълнителна информация:</b>'.$data['Notes'];
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

function fuel_options2($uid="") {
    $car_dao = new Car_DAO();
    if (!empty($uid)) {
        $fuel_list = $car_dao->get_user_fuel_types($uid);
    } else {
        $fuel_list = $car_dao->get_fuels();
    }
    $arr = array();
    foreach($fuel_list as $fuel) {
        $arr[$fuel['ID']] = $fuel['Name'];
    }
    return $arr;
}


function expense_options() {
	$expense_dao = new Expense_DAO();
	foreach($expense_dao->get_expenses() as $expense) {
		echo '<option value='.$expense['ID'].'>'.translate($expense['Name']).'</option>';		
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

function display_new_expense($uid) {
	$car_dao = new Car_DAO();
	$expense_dao = new Expense_DAO();
	$expense_list = $expense_dao->get_expenses();
	$cars = $car_dao->list_cars_by_user_id($uid);
	echo '<form method="post" action="#">';
	echo '<input type="hidden" name="user-id" value='.$uid.'>';
	echo '<label for="expense-type">Вид разход:</label>';
	echo '<select id="expense-type" name="expense-type">';
	foreach($expense_list as $expense) {
		echo '<option value='.$expense['ID'].'>'.translate($expense['Name']).'</option>';
	}
	echo '</select>';
	echo '<div id="expense-subtype">';
	echo '</div>';
	echo '</select>';
	echo '<label for="date">Дата:</label>';
	echo '<input type="date" name="date" value="'.date('Y-m-d').'"><br>';
	// mileage info
	echo '<aside class="info">';
	echo '<b>Текущ пробег</b>: <br>';
	echo '<select>';
	foreach ($cars as $car) {
		echo '<option>'.$car['Brand'].' '.$car['Model'].' : </label>'.$car['Mileage'].'</option>';
	}
	echo '</select>';
	echo '</aside>';
	// end	
	echo '<label for="car-id">Автомобил:</label>';
	echo '<select id="car-id" name="car-id">';
	foreach ($cars as $car) {
		echo '<option value='.$car['ID'].'>'.$car['Brand'].' '.$car['Model'].'</option>';
	}
	echo '</select><br>';
	
	echo '<label for="mileage">Пробег:</label>';
	echo '<input id="mileage" type="number" name="mileage" placeholder="текущ пробег"><br>';
	echo '<div id="optional">';
	echo '</div>';
	echo '<label for="value">Стойност:</label>';
	echo '<input id="value" type="number" name="price" placeholder="стойност на разхода"><br>';
	echo '<textarea id="description" name="description" placeholder="Допълнителна информация" rows="4" cols="53"></textarea><br><br>';
	echo '<button type="submit">Добави</button>';
	echo '</form>';
	echo '<script src="./scripts/new-expense.js"></script>';
}


?>