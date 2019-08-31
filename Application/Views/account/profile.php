<?php
use \Core\View;
?>
<div class="container">
<h3>Потребител:</h3>
	<table class="user">
		<tr>
			<td>Потребител:</td>
			<td><?= $user; ?></td>
		</tr>
		<tr>
			<td>Име:</td>
			<td><?= $firstName; ?></td>
		</tr>
		<tr>
			<td>Фамилия:</td>
			<td><?= $lastName; ?></td>
		</tr>
		<tr>
			<td>Град:</td>
			<td><?= $city; ?></td>
		</tr>
		<tr>
			<td>Електронна поща:</td>
			<td><?= $email; ?></td>
		</tr>		
	</table>
	<br>
    <button type="button" onclick="location.href='/account/edit/'">Редактирай</button>
	<br>
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