<h3>Редактирай автомобил</h3>
<form method="post" action="#">
Редакция на автомобил: <b><?= $car['Brand'].' '.$car['Model']; ?></b><br><br>
<input type="hidden" name="uid" value="<?= $car['UID']; ?>">
<input type="hidden" name="cid" value="<?= $car['ID']; ?>">
<label for="color">Цвят</label>
<input id="color" type="text" name="color" placeholder="Настоящ цвят: <?= $car['Color']; ?>"><br>
<label for="mileage">Пробег</label>
<input id="mileage" type="number" name="mileage" placeholder="Настоящ пробег: <?= $car['Mileage']; ?>"><br>
<label for="fuel_id2">Втори вид гориво:</label>
<select id="fuel_id2" name="fuel_id2">
    <option value="NULL">Няма</option>
    <?php foreach($fuelList as $fuel) : ?>
        <option value="<?= $fuel['ID']; ?>"><?= translate($fuel['Name']); ?></option>;
    <?php endforeach; ?>
</select><br>		
<label for="info">Бележки:</label><br>
<textarea id="info" cols="55" rows="5" name="notes" value="<?= $car['Notes']; ?>"></textarea><br><br>
<button type="submit">Редактирай</button>
</form> 