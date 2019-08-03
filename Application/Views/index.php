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
    <b>Похарчени за <?= date('Y'); ?> година:</b> <?= $statModel->count_year_expenses_by_uid($userId,$car['ID']); ?> лв.
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
$last_five_array = $statModel->get_last_five_by_uid($_SESSION['user']['ID']);
if (empty($last_five_array)) : ?>
    <tr>
        <?php for ($i=0; $i<=6; $i++) {
            echo "<td>Няма разходи</td>"; 
        }?>
    </tr>
<?php endif; ?>
<?php foreach ($last_five_array as $array) : ?>
    <tr>
    <td><?= $array['Mileage']; ?></td>
    <td><?= $carModel->get_car_name_by_id($array['CID']); ?></td>
    <td><?= translate($expense_dao->get_expense_name($array['Expense_ID'])); ?>"</td>
    <?php switch ($array['Expense_ID']) {
        case 1:
            $expense_type = $carModel->get_fuel_name($array['Fuel_ID']);
            $expense_type = translate($expense_type);
            break;
        case 2:
            $expense_type = $expense_dao->get_insurance_name($array['Insurance_ID']);
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