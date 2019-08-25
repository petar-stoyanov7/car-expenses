<?php
$title = "Детайлна справка";
include("header.php");
include("top-toolbar.php");
if(isset($_GET['id']) && isset($_GET['year'])) {
	$id = $_GET['id'];
	$year = $_GET['year'];
} else {
	header("Location: statistics.php");
}
echo '<div class="container">';
echo '<h3>Изтриване на разход:</h3>';

echo '<div class="element">';
echo "<h4>Сиурен ли сте, че искате да изтриете този разход:</h4>";
	echo "<p></p>";
	echo "<form class='yes' method='post' action='#'>
			<input type='hidden' name='id' value='".$id."'>
			<input type='hidden' name='year' value = '".$year."'
			<input type='hidden' name='choice' value='yes'>
			<button class='yes' type='submit'>Да</button>
			</form>";
	echo "<form class='yes' method='post' action='profile.php'>
			<button  type='submit'>Не</button>
			</form>";
echo '</div>';
echo '<div class="element">';
$expense_dao = new Expense_DAO();
display_expense_details($id,$year);
if (isset($_POST['id']) && isset($_POST['year'])) {
	$expense_dao->remove_expense($_POST['id'],$_POST['year']);
	header("Location: statistics.php");
}

echo '</div>';
echo "</div>";
include("footer.php");
?>