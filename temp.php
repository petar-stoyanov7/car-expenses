<?php
$title = "Trial and error";
$auth_ignore = 1;
include("header.php");
include("top-toolbar.php");


$connection = new database_connection();
$pdo = new _database_connection();
$user_dao = new user_DAO();
$car_dao = new Car_DAO();
$expenses_dao = new Expense_DAO();
$stat_dao = new Statistics_DAO();

//need to keep this - displays container
// echo "<div class='container'>";
//the rest is expendable
#########


//keep the shit bellow
// echo "</div>";
include("footer.php");