<div class="container">
<h3>Изтриване на разход:</h3>

<div class="element">
<h4>Сиурен ли сте, че искате да изтриете този разход:</h4>
	<p></p>
    <?php $View::renderForm($form);?>
</div>
<div class="element">

<b>Дата: </b><?= convert_date($data['Date']); ?><br>
<b>Пробег: </b><?= $data['Mileage']; ?> км. <br>
<b>Тип: </b><?= $type; ?><br>
<?php if (!empty($data['Fuel_ID'])) : ?>
    <b>Тип Гориво:</b> <?= $fuelName; ?><br>
    <b>Литри:</b> <?= $data['Liters']; ?><br>
<?php endif; ?>
<?php if (!empty($data['Insurance_ID'])) : ?>
    <b>Тип Застраховка: </b> <?= $insuranceName; ?><br>
<?php endif; ?>
<b>Стойност: </b><?= $data['Price']; ?><br>
<b>Допълнителна информация: </b><?= $data['Notes']; ?>

</div>

</div>