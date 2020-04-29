<?php
use \Core\View;
?>
<div class="container">

<h3>Потребител:</h3>
    <?php $View::renderForm($form); ?>
	<h3>Автомобили:</h3>	
	<?php 
	View::displayPartial(
		'list-cars.php', 
		[
			'carModel' 	=> $carModel, 
			'userId' 	=> $userId
		]
	); 
	?>
</div>