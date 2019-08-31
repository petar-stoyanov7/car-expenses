<div class="container">
<h3>Изтриване на разход:</h3>

<div class="element">
<h4>Сиурен ли сте, че искате да изтриете този разход:</h4>
	<p></p>
	<form class="yes" method="post" action="/expense/remove/id/<?= $id.'/year/'.$year; ?>">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="year" value="<?= $year; ?>"
        <input type="hidden" name="choice" value="yes">
        <button class="yes" type="submit">Да</button>
    </form>
	<form class="yes" method="post" action="/statistics">
        <button  type="submit">Не</button>
    </form>
</div>
<div class="element">

<b>Дата: </b><?= convert_date($data['Date']); ?><br>
<b>Пробег: </b><?= $data['Mileage']; ?> км. <br>
<b>Тип: </b><?= translate($expenseModel->get_expense_name($data['Expense_ID'])); ?><br>
<?php if (!empty($data['Fuel_ID'])) : ?>
    <b>Тип Гориво:</b> <?= translate($carModel->get_fuel_name($data['Fuel_ID'])); ?><br>
    <b>Литри:</b> <?= $data['Liters']; ?><br>
<?php endif; ?>
<?php if (!empty($data['Insurance_ID'])) : ?>
    <b>Тип Застраховка: </b> <?= translate($expenseModel->get_insurance_name($data['Insurance_ID'])); ?><br>
<?php endif; ?>
<b>Стойност: </b><?= $data['Price']; ?><br>
<b>Допълнителна информация: </b><?= $data['Notes']; ?>

</div>

</div>