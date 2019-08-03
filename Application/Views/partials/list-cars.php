<?php

use \Application\Models\CarModel;

$title = "Списък с автомобили";

if(!empty($_GET['uid'])) {
    $uid = $_GET['uid'];
} else {
    $uid = $_SESSION['user']['ID'];
}

$carModel = new CarModel();
$cars = $carModel->list_cars_by_user_id($uid);
$i = 1;
foreach ($cars as $car) : ?>
    <div class='element'>
    <a href="/cars/delete/cid/<?=$car['ID']; ?>"><span class='edit'><img class='icon' src='/img/icon-delete.png'></span></a>
    <a href="/cars/edit/cid/<?=$car['ID']; ?>"><span class='edit'><img class='icon' src='/img/icon-edit.png'></span></a>
    <h4>Автомобил: <?= $i++; ?></h4><br>
    <b>Марка: </b><?= $car['Brand']; ?><br>
    <b>Модел: </b><?= $car['Model']; ?><br>
    <b>Година: </b><?= $car['Year']; ?><br>
    <b>Цвят: </b><?= $car['Color']; ?><br>
    <b>Пробег: </b><?= $car['Mileage']; ?> км<br>
    <?php $fuel1 = $carModel->get_fuel_name($car['Fuel_ID']); ?>
    <b>Гориво1: </b><?= translate($fuel1); ?><br>
    <?php 
    if (!empty($car['Fuel_ID2'])) {
        $fuel2 = $carModel->get_fuel_name($car['Fuel_ID2']);
        echo '<b>Гориво2: </b>' . translate($fuel2) . '<br>';
    } 
    ?>
    <b>Бележки: </b><?= $car['Notes']; ?>
    </div>		
<?php endforeach; ?>

<div class="element">
    <a href="/cars/add/uid/<?= $uid ?>"><img src="/img/icon-add.png" height="110 px" width="110 px"></a>
</div>