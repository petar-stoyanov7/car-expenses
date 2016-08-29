<?php
$title = "Нов разход";
include("header.php");
include("top-toolbar.php");
?>
<script type="text/javascript" src="./scripts/new-expense.js"></script>
<?php
	$infoTypes = array (
		"fuel" => array("label" => "Вид:", "options" => array( array( "value" => "gas", "label" => "Бензин"),
																	array("value" => "lpg", "label"=>"Пропан Бутан"),
																	array("value" => "methane", "label"=>"Метан"),
																	array("value" => "diesel", "label"=>"Дизел"),
																	array("value" => "electricity", "label"=>"Електричество"),
																	array("value" => "other", "label"=>"Друго"),
																	)),
		"insurance" => array("label" => "Тип:", "options" => array( array( "value" => "insurance-kasko", "label" => "Каско"),
																				array("value" => "insurance-go", "label"=>"Гражданска Отговорност"),
																				array("value" => "other", "label"=>"Други"),
																	)),
		//example of basic input field
		// "vignette" => array("label" => "fuel-type", "text" => "KUR" ),"insurance" => array("label" => "fuel-type", "text" => "KUR" )
    );

?>
<div class="container">
	<h3>Нов Разход:</h3>
	<form method="post" action="#">
		<label for="mileage">Километри:</label>
		<input id="mileage" type="number" name="mileage" placeholder="> 18000"><br>
		<label for="car-id">Автомобил:</label>
		<select id="car-id" name="car-id">
			<option value="car1">Volkswagen Golf</option>
			<option value="car2">BMW M3</option>
		</select><br>
		<label for="expense-type">Тип Разход</label>
		<select id="expense-type" name="expense-type" onchange='updateinfo(this,<?php echo json_encode($infoTypes); ?>)'>
			<option value="fuel">Гориво</option>
			<option value="vignette">Винетка</option>
			<option value="insurance">Застраховка</option>
			<option value="maintenance">Ремонт</option>
		</select><br>
		<div id="infocontainer">
		</div>
		<label for="value">Стойност:</label>
		<input id="value" type="number" placeholder="стойност на разхода"><br>
		<textarea id="description" name="description" placeholder="Допълнителна информация" rows="4" cols="53"></textarea><br><br>
		<button type="submit">Добави</button>
	</form>
	<script type="text/javascript" charset="utf-8">
	updateinfo(document.getElementById("expense-type"),<?php echo json_encode($infoTypes); ?>)
	</script>
</div>
<?php
include("footer.php");
?>