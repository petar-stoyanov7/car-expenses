<?php
ob_start();
$title = "Автомобилни разходи";
include("header.php");
include("top-toolbar.php");
if(!isset($_SESSION['user'])) {
		header("Location: ./static/index.php");
}
	$car_dao = new Car_DAO();
	$expense_dao = new Expense_DAO();
	$statistics = new Statistics_DAO();
	$cars = $car_dao->list_cars_by_user_id($_SESSION['user']['ID']);
	$greet = $_SESSION['user']['Sex']=="male" ? "дошъл" : "дошла";

	echo '<div class="container">
		<h3>Добре '.$greet.', '.$_SESSION['user']['Fname'].' '.$_SESSION['user']['Lname'].'</h3>
		Брой автомобили: '.$car_dao->count_cars_by_user_id($_SESSION['user']['ID']).'<br>
		Общо похарчени за '.date('Y').': '.$statistics->count_year_expenses_by_uid($_SESSION["user"]["ID"]).' лв.<br>

	</div>
	<div class="container">
	<h3>Автомобили:</h3>';
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

	$last_five_array = $statistics->get_last_five_by_uid($_SESSION['user']['ID']);
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

include("footer.php");
ob_end_flush();
?>