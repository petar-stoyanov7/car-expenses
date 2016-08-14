<?php
$title = "Trial and error";
include("header.php");
include("top-toolbar.php");


$connection = new database_connection();
$user_dao = new user_DAO();
$car_dao = new Car_DAO();
$expenses_dao = new Expense_DAO();
$statistics_dao = new Statistics_DAO();

echo "<div class='container'>";
######################################
########## START OF FILE #############
######################################
echo phpversion();


######################################
########### END OF FILE ##############
######################################
echo "</div>";
include("footer.php");