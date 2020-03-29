<div class="container">
<h3>Редактирай автомобил</h3>
<form method="post" action="#" class="edit-car">
Редакция на автомобил: <b><?= $car['Brand'].' '.$car['Model']; ?></b>
<div class="form-wrapper">
    <input type="hidden" name="uid" value="<?= $car['UID']; ?>">
    <input type="hidden" name="cid" value="<?= $car['ID']; ?>">
</div>
<div class="form-wrapper">
    <label for="color">Цвят</label>
    <input id="color" type="text" name="color" value="<?= $car['Color']; ?>">
</div>
<div class="form-wrapper">
    <label for="mileage">Пробег</label>
    <input id="mileage" type="number" name="mileage" value="<?= $car['Mileage']; ?>">
</div>
<div class="form-wrapper">
    <label for="fuel_id2">Втори вид гориво:</label>
    <select id="fuel_id2" name="fuel_id2">
        <option value="NULL">Няма</option>
        <?php foreach($fuelList as $fuel) : ?>
            <?php if ($fuel['ID'] === $car['Fuel_ID2']) : ?>
                <option value="<?= $fuel['ID']; ?>" selected><?= translate($fuel['Name']); ?></option>;
            <?php else : ?>
                <option value="<?= $fuel['ID']; ?>"><?= translate($fuel['Name']); ?></option>;
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-wrapper">
    <label for="info">Бележки:</label><br>
    <textarea id="info" cols="55" rows="5" name="notes"><?= $car['Notes']; ?></textarea>
</div>
<button type="submit">Редактирай</button>
</form>