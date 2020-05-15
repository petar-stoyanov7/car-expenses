<?php
use \Core\View;
?>

<div class="container">
    <h3>User:</h3>
    <?php
    View::displayPartial(
        'profile.php',
        [
            'user'  => $user,
            'form'  => $form,
        ]
    );
    ?>
</div>

<div class="container">
	<h3>Cars:</h3>
	<?php 
	View::displayPartial(
		'list-cars.php', 
		[
			'cars'   	=> $cars,
			'userId' 	=> $user['userId'],
            'carForm'   => $carForm,
            'showCars'  => true,
		]
	); 
	?>
</div>
