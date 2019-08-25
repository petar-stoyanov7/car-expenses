<?php
$title = "Редактирай автомобил";
include("header.php");
include("top-toolbar.php");
	$car_dao = new Car_DAO();
	echo '<div class="container">';
	$cid = $_GET['cid'];
	$car = $car_dao->get_car_by_id($cid);
	display_edit_car($car);
	show_back_button();
	/*
	[uid] => 7
    [cid] => 10
    [color] => син
    [mileage] => 521300
    [fuel_id2] => NULL
    [notes] => 
    */
	if (!empty($_POST)) {
		$uid = $car_dao->get_uid_by_cid($cid);
		$car_edit = new Car($uid,$car['Brand'],$car['Model'],$car['Year'],$_POST['color'],$_POST['mileage'],$car['Fuel_ID'],$_POST['fuel_id2'],$_POST['notes']);
		$car_dao->edit_car($car_edit,$car['ID']);
	}

	echo '</div>';

include("footer.php");
?>