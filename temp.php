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

$old = $connection->get_data_from_database("show tables");
$new = $pdo->get_data_from_database("show tables");
?>

<table>
	<tr>
		<th>Old</th>
		<th>New</th>
	</tr>
	<tr>
		<td><?php display_test($old);?></td>
		<td><?php display_test($new);?></td>
	</tr>
</table>


//keep the shit bellow
// echo "</div>";
include("footer.php");