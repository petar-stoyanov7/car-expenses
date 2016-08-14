<?php
$title = "Изтриване на автомобил";
include("header.php");
include("top-toolbar.php");
?>
<div class='container'>
<h3>Изтриване на автомобил:</h3>
<?php
$car_dao = new Car_DAO();
$id = isset($_GET['id']) ? $_GET['id']  : NULL;
$car = $car_dao->get_car_by_id($id);
if (isset($_GET['id'])) {
	display_warning("Сиурен ли сте, че искате да изтриете този автомобил:<br>".$car['Brand']." ".$car['Model'].", ".$car['Year']);
	echo "<p></p>";
	echo "<form class='yes' method='post' action='delete-car.php'>
			<input type='hidden' name='id' value='".$id."'>
			<input type='hidden' name='choice' value='yes'>
			<button class='yes' type='submit'>Да</button>
			</form>";
	echo "<form class='yes' method='post' action='profile.php'>
			<button  type='submit'>Не</button>
			</form>";	
}
if (isset($_POST['id']) && isset($_POST['choice'])) {
	$car_dao->remove_car_by_id($_POST['id']);
	header("Location: profile.php");
}
?>
</div>

<?php
include("footer.php");
?>