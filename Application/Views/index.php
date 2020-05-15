<div class="container">
    <h3>Wellcome <?= "{$firstName} {$lastName}"; ?></h3>
    <div class="content">
    Number of cars: <?= $countCars; ?><br>
    Total spent for <?= date('Y') . ' : ' . $yearExpense;  ?><br>
    </div>

</div>
<div class="container">
<h3>Cars:</h3>
    <div class="flex-wrapper">
    <?php
    foreach ($cars as $car) : ?>
        <div class="element">
            <h4><?= $car['Brand'] .' ' . $car['Model'] . ' ' . $car['Year']; ?></h4>
            <div>
                <b>Mileage:</b> <?= $car['Mileage']; ?> км
            </div>
            <div>
                <b>Spent for year:  <?= date('Y'); ?></b> <?= $car['yearly_spent'] ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>

<div class="container">
<h3>Last five:</h3>
<table class="expenses">
<tr>
	<th>Mileage</th>
	<th>Car</th>
	<th>Expense type</th>
	<th>Type</th>
	<th>Value</th>
	<th>Notes</th>
</tr>

<?php
if (empty($lastFive)) : ?>
    <tr>
        <?php
        for ($i=0; $i<=6; $i++) {
            echo "<td>Няма разходи</td>"; 
        }
        ?>
    </tr>
<?php endif; ?>
<?php foreach ($lastFive as $array) : ?>
    <tr>
    <td><?= $array['Mileage']; ?></td>
    <td><?= "{$array['car_brand']} {$array['car_model']}" ?></td>
    <td><?= $array['expense_name']; ?></td>
    <td>
        <?php switch ($array['Expense_ID']) {
            case 1:
                echo $array['fuel_name'];
                break;
            case 2:
                echo $array['insurance_name'];
                break;
            default:
                $expenseType = '';
                break;
        }
        ?>
    </td>
    <td><?= $array['Price']; ?></td>
    <td><?= $array["Notes"]; ?></td>
    </tr>
<?php endforeach; ?>	
</table>
</div>