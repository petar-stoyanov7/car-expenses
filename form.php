 <script type="text/javascript" charset="utf-8">
	function updateinfo(obj,values)
	{
		var container = document.getElementById("infocontainer");
	    clearContainer(container);
	    if (obj.value in values ){
	    	if (values[obj.value].hasOwnProperty("options")){
	    		var label = document.createElement("label");
	    		label.innerHTML = values[obj.value]["label"];
	    		label.id = "infoLabel";
	    		container.appendChild(label);
	    		var newobj = document.createElement("select");
	    		newobj.id = "infoData";
	    		container.appendChild(newobj);
				for (var i = 0; i < values[obj.value]["options"].length; i++) {
    				var option = document.createElement("option");
    				option.value = values[obj.value]["options"][i]["value"];
    				option.text = values[obj.value]["options"][i]["label"];
    				newobj.appendChild(option);
				}
	    	}else if (values[obj.value].hasOwnProperty("text")){
	    		var newobj = document.createElement("input");
	    		newobj.id = "infoData";
	    		container.appendChild(newobj);
	    	}
	    }else{
	    	console.log("no data");
	    }
	};
	function clearContainer(containerObj){
		if (containerObj.children.length > 0){
			while (containerObj.firstChild) {
	    		containerObj.removeChild(containerObj.firstChild);
			}
	}
	}

</script>

<?php
	$infoTypes = array (
		"fuel" => array("label" => "Вид Гориво", "options" => array( array( "value" => "gas", "label" => "Бензин"),
																	array("value" => "lpg", "label"=>"Пропан Бутан"),
																	array("value" => "methane", "label"=>"Метан"),
																	array("value" => "diesel", "label"=>"Дизелово Гориво"),
																	array("value" => "electricity", "label"=>"Електричество"),
																	array("value" => "other", "label"=>"Друго"),
																	)),
		"insurance" => array("label" => "Тип Застраховка", "options" => array( array( "value" => "insurance-kasko", "label" => "Каско"),
																				array("value" => "insurance-go", "label"=>"Гражданска Отговорност"),
																				array("value" => "other", "label"=>"Други"),
																	)),
		//example of basic input field
		// "vignette" => array("label" => "fuel-type", "text" => "KUR" ),"insurance" => array("label" => "fuel-type", "text" => "KUR" )
    );

?>
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