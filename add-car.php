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
		<label for="info">Бележки:</label>
		<input id="info" type="text" name="info" placeholder="допъллнителна информация"><br><br>
		<button type="submit">Добави</button>
	</form>
</div>

<?php
include("footer.php");
?>