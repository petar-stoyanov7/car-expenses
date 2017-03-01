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
$array = fuel_options2();
display_test($array);
echo "</div>";
include("footer.php");