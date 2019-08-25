<?php
$title = "Нов разход";
include("header.php");
include("top-toolbar.php");

echo "<div class='container'>";
echo "<h3>Нов Разход:</h3>";
display_new_expense($_SESSION['user']['ID']);

if (!empty($_POST)) {
	$expense = new Expense($_POST['user-id'],$_POST['car-id'],$_POST['date'],$_POST['mileage'],$_POST['expense-type'],$_POST['price'],$_POST['fuel-type'],$_POST['liters'],$_POST['insurance-type'],$_POST['description']);
	$expense_dao = new Expense_DAO();
	$expense_dao->add_expense($expense);
}
echo "</div>";
$fuel_types = fuel_options2($_SESSION["user"]["ID"]);
$parsed = json_encode($fuel_types);
?>
<script type="text/javascript">var fuelTypes = <?= $parsed ?>;</script>
<script type="text/javascript" src="./scripts/new-expense.js"></script>

<?php
include("footer.php");
?>