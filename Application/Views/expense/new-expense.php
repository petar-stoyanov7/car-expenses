<div class='container'>
<h3>Нов Разход:</h3>

<form method="post" action="/expense/new">
<input type="hidden" name="user-id" value="<?= $userId; ?>">
<label for="expense-type">Вид разход:</label>
<select id="expense-type" name="expense-type">
    <?php foreach($expenseList as $expense) : ?>
        <option value="<?= $expense['ID']; ?>"><?= translate($expense['Name']); ?></option>
    <?php endforeach; ?>
</select>
<div id="expense-subtype">
</div>
<label for="date">Дата:</label>
<!-- <input type="date" name="date" value="<?= date('Y-m-d'); ?>"><br> -->
<input type="date" name="date" value="2018-04-04"><br>
<label for="car-id">Автомобил:</label>
<select id="car-id" name="car-id">
<?php foreach ($cars as $car) : ?>
    <option value=<?= $car['ID']; ?>><?= $car['Brand'].' '.$car['Model']; ?></option>
<?php endforeach; ?>
</select><br>

<label for="mileage">Пробег:</label>
<input id="mileage" type="number" name="mileage" placeholder="текущ пробег" value="<?= $car['Mileage']; ?>"><br>
<div id="optional">
</div>
<label for="value">Стойност:</label>
<input id="value" type="number" name="price" placeholder="стойност на разхода"><br>
<textarea id="description" name="description" placeholder="Допълнителна информация" rows="4" cols="53"></textarea><br><br>
<button type="submit">Добави</button>
</form>
<script src="./scripts/new-expense.js"></script>

</div>
<script type="text/javascript">var fuelTypes = <?= $parsed ?>;</script>
<script type="text/javascript" src="/js/new-expense.js"></script>
