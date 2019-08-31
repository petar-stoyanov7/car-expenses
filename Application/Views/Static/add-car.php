<?php
$title = "Добави автомобил";
include("header.php");
include("top-toolbar.php");
?>
<div class="container">
<h3><font color="red" weight="bold">Това е примерна страница!</font></h3>
<br>Добре дошли в страницата за автомобилни разходи. Това, което виждате е пример за съдържанието на сайта. С помощта на този сайт може да управлявате разходите по автомобила си и да извличате детайлна статистика. Ако желаете да използвате услугите - нужно е да имате регистрация. Регистрация може да направите, като натиснете <a href="../register.php">тук</a>.<br>
За вече регистрирани потребители - <a href="../login.php">тук</a>.
</div>
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