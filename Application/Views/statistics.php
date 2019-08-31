
<div class="container">
<h3>Статистика за период:</h3>
<?php //display_statistics_input($uid); ?>


<form method="post" action="#">
<label for="car">Автомобил</label>
<select id="car" name="car">
<option value="all">Всички</option>
<?php foreach ($cars as $car) : ?>
    <option value="<?= $car['ID']; ?>"><?= $car['Brand']; ?> <?= $car['Model']; ?></option>
<?php endforeach; ?>
</select><br>
<label for="expense-type">Тип разход</label>
<select id="expense-type" name="expense-type">
<option value="all">Всички</option>
<?php foreach ($expenses as $expense) : ?>
    <option value="<?= $expense['ID']; ?>"><?= translate($expense['Name']); ?></option>
<?php endforeach; ?>
</select><br>
<label for="from">От дата</label>
<input id="from" type="date" name="from" value="<?= date('Y') . '-01-01'; ?>"><br>
<label for="to">До дата</label>
<input id="to" type="date" name="to" value="<?= date('Y-m-d'); ?>"><br>

<button type="submit">Извлечи статистика</button>
</form>
</div>


<?php if (isset($data) && !empty($data)) : ?>
    <div class="container">
    <h3>Общо:</h3>
    <?php $cars = $data['Cars']; ?>
    <?php foreach ($cars as $car) : ?>
        <div class="element">
        <b>Автомобил:</b> <?= $car['Name']; ?><br>
        <b>Изминати километри:</b><?= $car['Mileage']; ?>
        <br>
        <b>Похарчени:</b> <?= $car['Summary']; ?><br>
        <?php 
        if ($car['Mileage'] <= 0) {
            $ratio = $car['Summary'];
        } else {
            $ratio = $car['Summary'] / $car['Mileage']; 
        }
        ?>
        <b>Лв/Км: </b><?= round($ratio,3); ?>
        </div>
    <?php endforeach; ?>
    </div>


    <div class="container">
	<h3>Детайлна Статистика</h3>
	<?php $detailedData = $data['Raw']; ?>
	<table class="expenses">
	<tr>
			<th>Пробег</th>
			<th>Дата</th>
			<th>Автомобил</th>
			<th>Тип разход</th>
			<th>Литри:</th>
			<th>Стойност</th>
			<th>Допълнителна информация</th>
			<th>Изтрий</th>
			<th>Детайли</th>
        </tr>
    <?php //dt($data); ?>
    <?php foreach ($detailedData as $row) : ?>
		<tr>
			<td><?= $row['Mileage']; ?></td>
			<td><?= convert_date($row['Date']); ?></td>
			<td><?= $carModel->get_car_name_by_id($row['CID']); ?></td>
			<td><?= translate($expenseModel->get_expense_name($row['Expense_ID'])); ?></td>
			<td><?= $row['Liters']; ?></td>
			<td><?= $row['Price']; ?></td>
			<td><?= substr($row['Notes'],0,18); ?></td>
			<td>
                <a href="/expense/remove/id/<?= $row['ID']; ?>/year/<?= substr($row['Date'], 0, 4); ?>">
                    <img class="icon" src="/img/icon-delete.png">
                </a>
            </td>
			<td>
                <a href="/expense/detailed-info/id/<?= $row['ID']; ?>/year/<?= substr($row['Date'], 0, 4); ?>" target="_blank">[!]</a>
            </td>
		</tr>
    <?php endforeach; ?>
	</table>
	</div>

<?php endif; ?>

</div>