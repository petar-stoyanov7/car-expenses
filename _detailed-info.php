<?php
ob_start();
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
echo '<h3>Детайлна Справка:</h3>';
echo '<div class="element">';
display_expense_details($id,$year);
show_back_button();

echo '</div>';
echo "</div>";
include("footer.php");
ob_end_flush();
?>