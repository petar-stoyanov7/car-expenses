<?php
$title = "Нов разход";
include("header.php");
include("top-toolbar.php");
?>
<div class="container">
	<h3>Нов Разход:</h3>
	<form method="post" action="#">
		<label for="mileage">Пробег:</label>
		<input id="mileage" type="number" name="mileage" placeholder="> 18000"><br>
		<label for="car-id">Автомобил:</label>
		<select id="car-id" name="car-id">
			<option value="car1">Volkswagen Golf</option>
			<option value="car2">BMW M3</option>
		</select><br>
		<label for="expense-type">Тип Разход</label>
		<select id="expense-type" name="expense-type">
			<option value="fuel">Гориво</option>
			<option value="insurance">Застраховка</option>
			<option value="maintenance">Ремонт</option>
			<option value="other">Други</option>
		</select><br>

		<label for="fuel-type">Тип Гориво</label>
		<select id="fuel-type" name="fuel-type">
			<option value="gas">Бензин</option>
			<option value="lpg">Пропан</option>
			<option value="methane">Метан</option>
			<option value="diesel">Дизел</option>
			<option value="electricity">Електричество</option>
			<option value="other">Други</option>
		</select><br>
		<label for="liters">Литри:</label>
		<input id="liters" type="number" name="liters"><br>

		<label for="insurance-type">Тип Застраховка</label>
		<select id="insurance-type" name="insurance-type">
			<option value="kasko">Каско</option>
			<option value="go">Гражданска Отговорност</option>
			<option value="other">Други</option>
		</select><br>

		<label for="value">Стойност:</label>
		<input id="value" type="number" placeholder="стойност на разхода"><br>
		<textarea id="description" name="description" placeholder="Допълнителна информация" rows="4" cols="53"></textarea><br><br>
		<button type="submit">Добави</button>
	</form>
</div>
<?php
include("footer.php");
?>