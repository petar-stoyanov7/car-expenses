<?php
$title = "Потребителски профил";
include("header.php");
include("top-toolbar.php");
?>
<div class="container">	
	<h3>Потребителски Панел</h3>
	<span>Име:</span> Иван<br>
	<b>Фамилия:</b> Иванов<br>
	<b>Град:</b> Пловдив<br>
	<b>Потребителско Име:</b> ivan85<br>
	<b>Електронна Поща:</b> iivanov85@gmail.com<br>
</div>
<div class="container">
<h3>Потребител:</h3>
	<table class="user">
		<tr>
			<td>Потребителско Име:</td>
			<td>ivan85</td>
		</tr>
		<tr>
			<td>Име:</td>
			<td>Иван</td>
		</tr>
		<tr>
			<td>Фамилия:</td>
			<td>Иванов</td>
		</tr>
		<tr>
			<td>Град:</td>
			<td>Пловдив</td>
		</tr>
		<tr>
			<td>Електронна поща:</td>
			<td>iivanov@gmail.com</td>
		</tr>
	</table>
	<h3>Автомобили:</h3>
		<div class="element">
			<h4>Автомобил 1:</h4>
			<b>Марка</b>: BMW<br>
			<b>Модел:</b> M3<br>
			<b>Година: </b> 2010<br>
			<b>Цвят: </b> Тъмносин металик<br>
			<b>Пробег:</b> 80000 км<br>
		</div>
		<div class="element">
			<h4>Автомобил 2:</h4>
			<b>Марка</b>: Wolkswagen<br>
			<b>Модел:</b> Golf<br>
			<b>Година: </b> 2001<br>
			<b>Цвят: </b> Сребрист<br>
			<b>Пробег:</b> 150000 км<br>
		</div>
	<div class="element">
		<a href="add-car.php"><img src="./img/icon-add.png" height="110 px" width="110 px"></a>
	</div>
</div>



<?php
include("footer.php");
?>