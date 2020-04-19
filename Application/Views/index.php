<div class="container">
    <h3>Добре <?= $greet . ', ' . $firstName . ' ' . $lastName; ?></h3>
    Брой автомобили: <?= $countCars; ?><br>
    Общо похарчени за <?= date('Y') . ' : ' . $yearExpense;  ?> лв.<br>

</div>
<div class="container">
<h3>Автомобили:</h3>
<?php 
$i = 1;
foreach ($cars as $car) : ?>
    <div class="element">
    <h4>Автомобил <?= $i++ ?> :</h4>
    <?= $car['Brand'] .' ' . $car['Model'] . ' ' . $car['Year']; ?><br>
    <b>Километри</b>: <?= $car['Mileage']; ?> км<br>
    <b>Похарчени за <?= date('Y'); ?> година:</b> <?= $statModel->countYearExpensesByUserId($userId,$car['ID']); ?> лв.
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

<?php
if (empty($lastFive)) : ?>
    <tr>
        <?php for ($i=0; $i<=6; $i++) {
            echo "<td>Няма разходи</td>"; 
        }?>
    </tr>
<?php endif; ?>
<?php foreach ($lastFive as $array) : ?>
    <tr>
    <td><?= $array['Mileage']; ?></td>
    <td><?= $carModel->getCarNameById($array['CID']); ?></td>
    <td><?= translate($expenseModel->getExpenseName($array['Expense_ID'])); ?></td>
    <?php switch ($array['Expense_ID']) {
        case 1:
            $expenseType = $carModel->getFuelName($array['Fuel_ID']);
            $expenseType = translate($expenseType);
            break;
        case 2:
            $expenseType = $expenseModel->getInsuranceName($array['Insurance_ID']);
            $expenseType = translate($expenseType);
            break;			
        default:
            $expenseType = '';
            break;
    }
    ?>
    <td><?= $expenseType; ?></td>
    <td><?= $array['Price']; ?> лв.</td>
    <td><?= $array["Notes"]; ?></td>
    </tr>
<?php endforeach; ?>	
</table>
</div>