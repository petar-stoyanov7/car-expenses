<?php
$title = "Добави автомобил";
include("header.php");
include("top-toolbar.php");
?>
<div class="container">
	<h3>Добави автомобил:</h3>
	<form method="post" action="#">
		<label for="brand">Марка</label>
		<input id="brand" type="text" name="brand" placeholder="Wolkswagen"><br>
		<label for="model">Модел</label>
		<input id="model" type="text" name="model" placeholder="Golf"><br>
		<label for="year">Година</label>
		<input id="year" type="number" name="year" placeholder="2001"><br>
		<label for="color">Цвят</label>
		<input id="color" type="text" name="color" placeholder="Черен"><br>
		<label for="mileage">Пробег</label>
		<input id="mileage" type="text" name="mileage" placeholder="15000"><br>
		<label for="fuel_id1">Гориво</label>
		<select id="fuel_id1" name="fuel_id1">
			<?php fuel_options(); ?>
		</select><br>
		<label for="fuel_id2">Втори вид гориво(газ)</label>
		<select id="fuel_id2" name="fuel_id2">
			<option value=NULL selected="">Няма</option>
			<?php fuel_options(); ?>
		</select><br>
		<label for="info">Бележки:</label><br>
		<textarea id="info" cols="55" rows="5" name="notes"></textarea><br><br>
		<button type="submit">Добави</button>
	</form>
<?php
	if (!empty($_GET['uid'])) {
		$uid = $_GET['uid'];
	} else {
		$uid = $_SESSION['user']['ID'];
	}
	if (!empty($_POST)) {
		$car_dao = new Car_DAO();
		$car = new Car($uid, $_POST['brand'], $_POST['model'], $_POST['year'], $_POST['color'], $_POST['mileage'], $_POST['fuel_id1'], $_POST['fuel_id2'],$_POST['notes']);
		$car_dao->add_car($car);
	}
?>
</div>

<?php
//__construct($user_id,$brand,$model,$year,$color,$mileage,$fuel_id,$fuel_id2="",$notes="")





include("footer.php");
?>