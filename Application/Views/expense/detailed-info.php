<div class="container">
<h3>Детайлна Справка:</h3>
<div class="element">

<b>Дата: </b><?= convert_date($data['Date']); ?><br>
<b>Пробег: </b><?= $data['Mileage']; ?> км. <br>
<b>Тип:</b><?= translate($expenseModel->get_expense_name($data['Expense_ID'])); ?><br>
<?php if (!empty($data['Fuel_ID'])) : ?>
    <b>Тип Гориво:</b> <?= translate($carModel->get_fuel_name($data['Fuel_ID'])); ?><br>
    <b>Литри:</b> <?= $data['Liters']; ?><br>
<?php endif; ?>
<?php if (!empty($data['Insurance_ID'])) : ?>
    <b>Тип Застраховка:</b> <?= translate($expenseModel->get_insurance_name($data['Insurance_ID'])); ?><br>
<?php endif; ?>
<b>Стойност:</b><?= $data['Price']; ?><br>
<b>Допълнителна информация:</b><?= $data['Notes']; ?>
<br><br>
<button type="button" onclick="location.href='<?= $_SERVER['HTTP_REFERER']; ?>'">Назад</button>

</div>
</div>