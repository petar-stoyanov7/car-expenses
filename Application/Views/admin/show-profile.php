<div class="container">
<h3><?= $user['Username']; ?></h3>
Име, Фамилия: <?= $user['Fname'] .' ' . $user['Lname']; ?><br>
Брой автомобили: <?= $carCount ?><br>
Общо похарчени за <?= date('Y') . ': ' . $expenses ?> лв.<br>
</div>
<div class="container">
<h3>Actions</h3>
<button type="button" onclick="location.href='/accout/edit/id/'<?= $userId; ?>">Редактирай</button>
<?php if ($canDelete) : ?>
<!-- <button type="button" onclick="location.href='/admin/delete/id/<?= ''//$userId; ?>'">Изтрий</button> -->
<?php endif; ?>
<button type="button" onclick="location.href='<?= $_SERVER['HTTP_REFERER']; ?>'" style="float:right">Назад</button>
</div>

<div class="container">
<h3>Автомобили:</h3>
<?php $i = 1; ?>
<?php foreach ($cars as $car) : ?>
    <div class="element">
    <h4>Автомобил <?= $i++; ?>:</h4>
    <?= $car['Brand'] . ' ' . $car['Model'] . ' ' . $car['Year']; ?><br>
    <b>Километри</b>: <?= $car['Mileage']; ?> км<br>
    <b>Похарчени за <?= date('Y') . ' година:</b> ' . $expenses; ?> лв.
    </div>
<?php endforeach; ?>
</div>

<div class="container">
<h3>Последни пет:</h3>
<table class="expenses">
<tr>
    <th>Километри</th>
    <th>Автомобил</th>
    <th>Тип разход</th>
    <th>Тип:</th>
    <th>Стойност</th>
    <th>Бележки</th>
</tr>

<?php if (empty($lastFive)) : ?>
    <tr>
    <td>Няма разходи</td>
    <td>Няма разходи</td>
    <td>Няма разходи</td>
    <td>Няма разходи</td>
    <td>Няма разходи</td>
    <td>Няма разходи</td>
    </tr>
<?php endif; ?>
<?php foreach ($lastFive as $array) : ?>
    <?php 
        $carName = $carModel->getCarNameById($array['CID']);
        $expenseName = $expenseModel->getExpenseName($array['Expense_ID']);
    ?>
    <tr>
    <td><?= $array['Mileage']; ?></td>
    <td><?= $carName; ?></td>
    
    <td><?= translate($expenseName); ?></td>
    <?php
    switch ($array['Expense_ID']) {
        case 1:
            $expense_type = $carModel->getFuelName($array['Fuel_ID']);
            $expense_type = translate($expense_type);
            break;
        case 2:
            $expense_type = $expenseModel->getInsuranceName($array['Insurance_ID']);
            $expense_type = translate($expense_type);
            break;			
        default:
            $expense_type = '';
            break;
    }
    ?>
    <td><?= $expense_type; ?></td>
    <td><?= $array['Price']; ?> лв.</td>
    <td><?= $array["Notes"]; ?></td>
    </tr>
<?php endforeach; ?>	
</table>
</div>