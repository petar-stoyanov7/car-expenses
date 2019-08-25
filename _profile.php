<?php
$title = "Потребителски профил";
include("header.php");
include("top-toolbar.php");
if(!isset($_SESSION['user'])) {
	header("Location: ./static/profile.php");
}
echo '<div class="container">
<h3>Потребител:</h3>
	<table class="user">
		<tr>
			<td>Потребител:</td>
			<td>'.$_SESSION['user']['Username'].'</td>
		</tr>
		<tr>
			<td>Име:</td>
			<td>'.$_SESSION['user']['Fname'].'</td>
		</tr>
		<tr>
			<td>Фамилия:</td>
			<td>'.$_SESSION['user']['Lname'].'</td>
		</tr>
		<tr>
			<td>Град:</td>
			<td>'.$_SESSION['user']['City'].'</td>
		</tr>
		<tr>
			<td>Електронна поща:</td>
			<td>'.$_SESSION['user']['Email'].'</td>
		</tr>		
	</table>
	<br>
	<form type="post" action="edit-profile.php">
		<button type="submit">Редактирай</button>
	</form>
	<br>
	<h3>Автомобили:</h3>';
	include("list-cars.php");
echo '</div>';
?>


<?php
include("footer.php");
?>