
<div class="container">
<h3>Статистика за период:</h3>
<?php //display_statistics_input($uid); ?>
<?php $View::renderForm($form); ?>
</div>


<?php if (isset($data) && !empty($data)) : ?>
    <div class="container">
    <h3>Общо:</h3>
    <?php $cars = $data['cars']; ?>
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
	<?php $detailedData = $data['allExpenses']; ?>
	<table class="expenses">
	<tr>
			<th>Пробег</th>
			<th>Дата</th>
			<th>Автомобил</th>
			<th>Тип разход</th>
			<th>Литри:</th>
			<th>Стойност</th>
			<th>Допълнителна информация</th>
			<th>Операции</th>
        </tr>
    <?php //dt($data); ?>
    <?php foreach ($detailedData as $row) : ?>
		<tr class="statistic-row">
			<td class="mileage">
                <?= $row['Mileage']; ?>
            </td>
			<td class="date">
                <?= convert_date($row['Date']); ?>
            </td>
			<td class="car">
                <?= $carModel->getCarNameById($row['CID']); ?>
            </td>
			<td class="expense-type">
                <?= translate($expenseModel->getExpenseName($row['Expense_ID'])); ?>
            </td>
			<td class="expense-liters">
                <?= $row['Liters']; ?>
            </td>
			<td class="expense-value">
                <?= $row['Price']; ?>
            </td>
			<td class="additional-info">
                <?= substr($row['Notes'],0,18); ?>
            </td>
			<td class="expense-operations">
                <a href="/expense/remove/id/<?= $row['ID']; ?>/year/<?= substr($row['Date'], 0, 4); ?>">
                    <img class="icon" src="/img/icon-delete.png">
                </a>
                <a href="/expense/detailed-info/id/<?= $row['ID']; ?>/year/<?= substr($row['Date'], 0, 4); ?>" target="_blank">[!]</a>
            </td>
		</tr>
    <?php endforeach; ?>
	</table>
	</div>

<?php endif; ?>

</div>