<?php
	$title = "Списък с автомобили";
	require_once("header.php");
	require_once("top-toolbar.php");

	if(!empty($_GET['uid'])) {
		$uid = $_GET['uid'];
	} else {
		$uid = $_SESSION['user']['ID'];
	}
	$car_dao = new Car_DAO();
	$cars = $car_dao->list_cars_by_user_id($uid);
	$i = 1;
	foreach ($cars as $car) {
		echo "<div class='element'>";
		echo "<a href='delete-car.php?cid=".$car['ID']."'><span class='edit'><img class='icon' src='./img/icon-delete.png'></span></a>";
		echo "<a href='edit-car.php?cid=".$car['ID']."'><span class='edit'><img class='icon' src='./img/icon-edit.png'></span></a>";
		echo "<h4>Автомобил: ".$i++."</h4><br>";
		echo "<b>Марка: </b>".$car['Brand']."<br>";
		echo "<b>Модел: </b>".$car['Model']."<br>";
		echo "<b>Година: </b>".$car['Year']."<br>";
		echo "<b>Цвят: </b>".$car['Color']."<br>";
		echo "<b>Пробег: </b>".$car['Mileage']." км<br>";
		$fuel1 = $car_dao->get_fuel_name($car['Fuel_ID']);
		echo "<b>Гориво1: </b>".translate($fuel1)."<br>";
		if (!empty($car['Fuel_ID2'])) {			
			$fuel2 = $car_dao->get_fuel_name($car['Fuel_ID2']);
			echo "<b>Гориво2: </b>".translate($fuel2)."<br>";
		}
		echo "<b>Бележки: </b>".$car['Notes'];
		echo "</div>";		
	}
	
	echo '<div class="element">
		<a href="add-car.php?uid='.$uid.'"><img src="./img/icon-add.png" height="110 px" width="110 px"></a>
	</div>';
	require_once("footer.php");
?>