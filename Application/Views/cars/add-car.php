<div class="container">
	<h3>Добави автомобил:</h3>
	<form method="post" action="/cars/add/uid/<?= $userid; ?>" class="edit-car">
        <div class="form-wrapper">
            <label for="brand">Марка</label>
            <input id="brand" type="text" name="brand" placeholder="Wolkswagen">
        </div>
        <div class="form-wrapper">
            <label for="model">Модел</label>
            <input id="model" type="text" name="model" placeholder="Golf">
        </div>
        <div class="form-wrapper">
            <label for="year">Година</label>
            <input id="year" type="number" name="year" placeholder="2001">
        </div>
		<label for="color">Цвят</label>
		<input id="color" type="text" name="color" placeholder="Черен"><br>
		<label for="mileage">Пробег</label>
		<input id="mileage" type="number" name="mileage" placeholder="15000"><br>
		<label for="fuel_id1">Гориво</label>
		<select id="fuel_id1" name="fuel_id1">			
            <?php foreach($fuelList as $fuel) : ?>
                <option value="<?= $fuel['ID']; ?>"><?= translate($fuel['Name']); ?></option>;
            <?php endforeach; ?>
		</select><br>
		<label for="fuel_id2">Втори вид гориво(газ)</label>
		<select id="fuel_id2" name="fuel_id2">
			<option value=NULL selected="">Няма</option>
			<?php foreach($fuelList2 as $fuel) : ?>
            <option value="<?= $fuel['ID']; ?>"><?= translate($fuel['Name']); ?></option>;
            <?php endforeach; ?>
		</select><br>
		<label for="info">Бележки:</label><br>
		<textarea id="info" cols="55" rows="5" name="notes"></textarea><br><br>
		<button type="submit">Добави</button>
    </form>
</div>