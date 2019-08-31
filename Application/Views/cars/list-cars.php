<?php
use \Core\View;
?>

<div class="container">
    <h3>Автомобили</h3>
    <?php 
        View::displayPartial(
            'list-cars.php',
            [
                'userId'    => $userId,
                'carModel'  => $carModel
            ]
        );
    ?>
</div>