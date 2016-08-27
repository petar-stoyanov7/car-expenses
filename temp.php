<?php
$title = "Trial and error";
$auth_ignore = 1;
include("header.php");
include("top-toolbar.php");


$connection = new database_connection();
$user_dao = new user_DAO();
$car_dao = new Car_DAO();
$expenses_dao = new Expense_DAO();
$stat_dao = new Statistics_DAO();

echo "<div class='container'>";
######################################
########## START OF FILE #############
######################################
// $stat = $stat_dao->get_statistic_for_period(2016-01-01,2016-08-27,1,"all","all");
// display_test($stat);
$cars = $car_dao->list_cars_by_user_id(7);
foreach ($cars as $car) {
	display_test($car);
}

// $stat = $stat_dao->get_statistic_for_period("2015-01-01","2016-09-09",7,"all","all");
// display_test($stat);

######################################
########### END OF FILE ##############
######################################
echo "</div>";
include("footer.php");